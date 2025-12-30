<?php

namespace App\Http\Controllers;

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

        return view('client.dashboard', compact('user', 'zwierzeta', 'wizyty'));
    }
}
