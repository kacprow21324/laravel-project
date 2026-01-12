<?php

namespace App\Http\Controllers;

use App\Models\Gatunek;
use App\Models\Usluga;
use App\Models\Zwierze;
use App\Models\Wizyta;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Wyświetl panel klienta.
     */
    public function dashboard()
    {
        $user = auth()->user();
        $zwierzeta = $user->zwierzeta()->with('gatunek')->get();
        $gatunki = Gatunek::orderBy('nazwa')->get();
        $uslugi = Usluga::orderBy('nazwa')->get();
        $wizyty = collect();

        // Pobierz wizyty dla wszystkich zwierząt użytkownika
        foreach ($zwierzeta as $zwierze) {
            $wizytyZwierzecia = $zwierze->wizyty()
                ->with(['lekarz', 'zwierze'])
                ->orderBy('data_wizyty', 'desc')
                ->get();
            $wizyty = $wizyty->merge($wizytyZwierzecia);
        }

        // Sortuj wszystkie wizyty po dacie
        $wizyty = $wizyty->sortByDesc('data_wizyty');

        return view('client.dashboard', compact('user', 'zwierzeta', 'wizyty', 'gatunki', 'uslugi'));
    }

    /**
     * Dodaj nowe zwierzę.
     */
    public function storeZwierze(Request $request)
    {
        $request->validate([
            'imie' => 'required|string|max:100',
            'gatunek_id' => 'required|exists:gatunki,id',
            'plec' => 'required|in:samiec,samica',
            'data_urodzenia' => 'nullable|date|before_or_equal:today',
            'waga' => 'nullable|numeric|gt:0|max:500',
            'nr_czipa' => 'nullable|string|max:50',
        ], [
            'waga.gt' => 'Waga musi być większa od zera.',
            'data_urodzenia.before_or_equal' => 'Data urodzenia nie może być z przyszłości.',
        ]);

        Zwierze::create([
            'imie' => $request->imie,
            'gatunek_id' => $request->gatunek_id,
            'uzytkownik_id' => auth()->id(),
            'plec' => $request->plec,
            'data_urodzenia' => $request->data_urodzenia,
            'waga' => $request->waga,
            'nr_czipa' => $request->nr_czipa,
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Zwierzę zostało dodane pomyślnie!');
    }

    /**
     * Umów wizytę.
     */
    public function storeWizyta(Request $request)
    {
        $request->validate([
            'zwierze_id' => 'required|exists:zwierzeta,id',
            'usluga_id' => 'required|exists:uslugi,id',
            'data_wizyty' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $data = \Carbon\Carbon::parse($value);
                    $teraz = \Carbon\Carbon::now();
                    
                    // Sprawdzenie czy data nie jest w przeszłości
                    if ($data->isPast() && !$data->isToday()) {
                        $fail('Data wizyty nie może być w przeszłości.');
                        return;
                    }
                    
                    // Jeśli data to dzisiaj - sprawdz czy godzina nie jest przeszła
                    if ($data->isToday() && $data->lessThanOrEqualTo($teraz)) {
                        $fail('Wybrana godzina już minęła. Proszę wybrać późniejszą godzinę.');
                        return;
                    }
                    
                    // Sprawdzenie godzin pracy - codziennie 8:00 - 20:00
                    $godzina = $data->hour;
                    $minuty = $data->minute;
                    $czasMinuty = $godzina * 60 + $minuty;
                    
                    // 8:00 = 480 minut, 20:00 = 1200 minut
                    if ($czasMinuty < 480 || $czasMinuty >= 1200) {
                        $fail('Klinika jest otwarta codziennie od 8:00 do 20:00.');
                        return;
                    }
                },
            ],
            'opis_zgloszenia' => 'required|string|max:1000',
        ]);

        // Sprawdź czy zwierzę należy do użytkownika
        $zwierze = Zwierze::where('id', $request->zwierze_id)
            ->where('uzytkownik_id', auth()->id())
            ->firstOrFail();

        // Pobierz obiekt usługi, aby zapisać cenę aktualną
        $usluga = Usluga::findOrFail($request->usluga_id);

        $wizyta = Wizyta::create([
            'zwierze_id' => $request->zwierze_id,
            'lekarz_id' => null, // Do przydzielenia przez admina
            'data_wizyty' => $request->data_wizyty,
            'status' => 'oczekujaca',
            'opis_zgloszenia' => $request->opis_zgloszenia,
        ]);

        // Dołącz usługę do wizyty wraz z ceną w chwili wizyty
        $wizyta->uslugi()->attach($usluga->id, [
            'cena_w_chwili_wizyty' => $usluga->cena_aktualna,
            'ilosc' => 1
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Wizyta została zarezerwowana! Oczekuje na zatwierdzenie przez klinikę.');
    }
}
