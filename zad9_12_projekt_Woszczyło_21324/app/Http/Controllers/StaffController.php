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
        $dzisiejszeWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz'])
            ->where('lekarz_id', $user->id)
            ->whereDate('data_wizyty', Carbon::today())
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Nadchodzące wizyty (do 7 dni) TYLKO dla zalogowanego lekarza
        $nadchodzaceWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz'])
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
