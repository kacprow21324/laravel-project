<?php

namespace App\Http\Controllers;

use App\Models\Wizyta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Wyświetl panel pracownika.
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Dzisiejsze wizyty
        $dzisiejszeWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz'])
            ->whereDate('data_wizyty', Carbon::today())
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Nadchodzące wizyty (do 7 dni)
        $nadchodzaceWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz'])
            ->whereDate('data_wizyty', '>', Carbon::today())
            ->whereDate('data_wizyty', '<=', Carbon::today()->addDays(7))
            ->where('status', 'umówiona')
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Statystyki
        $statystyki = [
            'dzisiaj' => $dzisiejszeWizyty->count(),
            'tydzien' => Wizyta::whereDate('data_wizyty', '>=', Carbon::today())
                ->whereDate('data_wizyty', '<=', Carbon::today()->addDays(7))
                ->where('status', 'umówiona')
                ->count(),
            'zakonczone_miesiac' => Wizyta::whereMonth('data_wizyty', Carbon::now()->month)
                ->where('status', 'zakończona')
                ->count(),
        ];

        return view('staff.dashboard', compact('user', 'dzisiejszeWizyty', 'nadchodzaceWizyty', 'statystyki'));
    }
}
