<?php

namespace App\Http\Controllers;

use App\Models\Lek;
use App\Models\Wizyta;
use App\Models\Zwierze;
use App\Models\DokumentacjaMedyczna;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Wyświetl panel weterynarza (tylko jego wizyty).
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Dzisiejsze wizyty TYLKO dla zalogowanego lekarza
        $dzisiejszeWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz', 'uslugi'])
            ->where('lekarz_id', $user->id)
            ->whereDate('data_wizyty', Carbon::today())
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Nadchodzące wizyty (do 7 dni) TYLKO dla zalogowanego lekarza
        $nadchodzaceWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz', 'uslugi'])
            ->where('lekarz_id', $user->id)
            ->whereDate('data_wizyty', '>', Carbon::today())
            ->whereDate('data_wizyty', '<=', Carbon::today()->addDays(7))
            ->whereIn('status', ['umowiona', 'oczekujaca'])
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Statystyki TYLKO dla zalogowanego lekarza
        $statystyki = [
            'dzisiaj' => $dzisiejszeWizyty->count(),
            'tydzien' => Wizyta::where('lekarz_id', $user->id)
                ->whereDate('data_wizyty', '>=', Carbon::today())
                ->whereDate('data_wizyty', '<=', Carbon::today()->addDays(7))
                ->whereIn('status', ['umowiona', 'oczekujaca'])
                ->count(),
            'zakonczone_miesiac' => Wizyta::where('lekarz_id', $user->id)
                ->whereMonth('data_wizyty', Carbon::now()->month)
                ->where('status', 'zakonczona')
                ->count(),
        ];

        return view('staff.dashboard', compact('user', 'dzisiejszeWizyty', 'nadchodzaceWizyty', 'statystyki'));
    }

    /**
     * Wyświetl szczegóły wizyty z formularzem dokumentacji.
     */
    public function wizyta($id)
    {
        $user = auth()->user();
        
        $wizyta = Wizyta::with([
            'zwierze.uzytkownik.adres', 
            'zwierze.gatunek', 
            'lekarz', 
            'uslugi', 
            'leki',
            'dokumentacjaMedyczna'
        ])->where('lekarz_id', $user->id)
          ->findOrFail($id);

        // Pobierz leki do formularza przepisywania
        $leki = Lek::where('ilosc_na_stanie', '>', 0)->orderBy('nazwa')->get();

        return view('staff.wizyta', compact('wizyta', 'user', 'leki'));
    }

    /**
     * Zapisz lub zaktualizuj dokumentację medyczną dla wizyty.
     */
    public function updateDokumentacja(Request $request, $id)
    {
        $user = auth()->user();
        
        // Sprawdź czy wizyta należy do tego lekarza
        $wizyta = Wizyta::where('lekarz_id', $user->id)->findOrFail($id);

        $request->validate([
            'diagnoza' => 'nullable|string|max:2000',
            'zalecenia' => 'nullable|string|max:2000',
            'temperatura' => 'nullable|numeric|min:30|max:45',
        ]);

        // updateOrCreate - jeśli dokumentacja nie istnieje, stworzy nową
        DokumentacjaMedyczna::updateOrCreate(
            ['wizyta_id' => $wizyta->id],
            [
                'diagnoza' => $request->input('diagnoza'),
                'zalecenia' => $request->input('zalecenia'),
                'temperatura' => $request->input('temperatura'),
            ]
        );

        // Opcjonalnie zmień status wizyty na "zakończona"
        if ($request->input('zakoncz_wizyte')) {
            $wizyta->update(['status' => 'zakonczona']);
        }

        return redirect()
            ->route('staff.wizyta', $wizyta->id)
            ->with('success', 'Dokumentacja medyczna została zapisana.');
    }

    /**
     * Przepisz lek do wizyty z kontrolą stanu magazynowego.
     */
    public function przepiszLek(Request $request, $id)
    {
        $user = auth()->user();
        
        // Sprawdź czy wizyta należy do tego lekarza
        $wizyta = Wizyta::where('lekarz_id', $user->id)->findOrFail($id);

        $request->validate([
            'lek_id' => 'required|exists:leki,id',
            'ilosc' => 'required|integer|min:1',
        ]);

        $lek = Lek::findOrFail($request->lek_id);

        // Sprawdź stan magazynowy
        if ($lek->ilosc_na_stanie < $request->ilosc) {
            return redirect()
                ->back()
                ->with('error', "Brak wystarczającej ilości leku '{$lek->nazwa}' w magazynie! Dostępne: {$lek->ilosc_na_stanie} {$lek->jednostka}.");
        }

        // Zmniejsz stan magazynowy
        $lek->decrement('ilosc_na_stanie', $request->ilosc);

        // Przypisz lek do wizyty (attach do pivot table)
        // Sprawdź czy lek już jest przypisany - jeśli tak, zwiększ ilość
        $existing = $wizyta->leki()->where('lek_id', $lek->id)->first();
        
        if ($existing) {
            $wizyta->leki()->updateExistingPivot($lek->id, [
                'ilosc_zuzyta' => $existing->pivot->ilosc_zuzyta + $request->ilosc
            ]);
        } else {
            $wizyta->leki()->attach($lek->id, ['ilosc_zuzyta' => $request->ilosc]);
        }

        return redirect()
            ->route('staff.wizyta', $wizyta->id)
            ->with('success', "Lek '{$lek->nazwa}' został przepisany pomyślnie ({$request->ilosc} {$lek->jednostka}).");
    }

    /**
     * Wyświetl magazyn leków.
     */
    public function leki()
    {
        $leki = Lek::orderBy('nazwa')->get();
        
        return view('staff.leki', compact('leki'));
    }

    /**
     * Wyświetl kartę pacjenta (zwierzęcia).
     */
    public function pacjent($id)
    {
        $zwierze = Zwierze::with(['gatunek', 'uzytkownik.adres'])->findOrFail($id);
        
        // Historia wizyt
        $wizyty = Wizyta::with(['lekarz', 'uslugi'])
            ->where('zwierze_id', $id)
            ->orderBy('data_wizyty', 'desc')
            ->get();
        
        // Dokumentacja medyczna
        $dokumentacje = DokumentacjaMedyczna::whereIn('wizyta_id', $wizyty->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('staff.pacjent', compact('zwierze', 'wizyty', 'dokumentacje'));
    }
}
