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
            'data_urodzenia' => 'nullable|date|before:today',
            'waga' => 'nullable|numeric|min:0|max:500',
            'nr_czipa' => 'nullable|string|max:50',
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
            'data_wizyty' => 'required|date|after:now',
            'opis_zgloszenia' => 'required|string|max:1000',
        ]);

        // Sprawdź czy zwierzę należy do użytkownika
        $zwierze = Zwierze::where('id', $request->zwierze_id)
            ->where('uzytkownik_id', auth()->id())
            ->firstOrFail();

        $wizyta = Wizyta::create([
            'zwierze_id' => $request->zwierze_id,
            'lekarz_id' => null, // Do przydzielenia przez admina
            'data_wizyty' => $request->data_wizyty,
            'status' => 'oczekujaca',
            'opis_zgloszenia' => $request->opis_zgloszenia,
        ]);

        // Dołącz usługę do wizyty
        $wizyta->uslugi()->attach($request->usluga_id);

        return redirect()->route('client.dashboard')->with('success', 'Wizyta została zarezerwowana! Oczekuje na zatwierdzenie przez klinikę.');
    }
}
