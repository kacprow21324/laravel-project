<?php

namespace App\Http\Controllers;

use App\Models\Lek;
use App\Models\Rola;
use App\Models\Usluga;
use App\Models\Uzytkownik;
use App\Models\Wizyta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Wyświetl panel administratora (wszystkie wizyty).
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Wszystkie dzisiejsze wizyty (nie filtrujemy po lekarzu)
        $dzisiejszeWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz'])
            ->whereDate('data_wizyty', Carbon::today())
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Nadchodzące wizyty (do 7 dni)
        $nadchodzaceWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek', 'lekarz'])
            ->whereDate('data_wizyty', '>', Carbon::today())
            ->whereDate('data_wizyty', '<=', Carbon::today()->addDays(7))
            ->whereIn('status', ['umowiona', 'oczekujaca'])
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Oczekujące wizyty (do przydzielenia lekarza)
        $oczekujaceWizyty = Wizyta::with(['zwierze.uzytkownik', 'zwierze.gatunek'])
            ->where('status', 'oczekujaca')
            ->whereNull('lekarz_id')
            ->orderBy('data_wizyty', 'asc')
            ->get();

        // Weterynarze do przydzielenia
        $weterynarze = Uzytkownik::where('rola_id', 2)->orderBy('nazwisko')->get();

        // Pracownicy (admin + weterynarz)
        $pracownicy = Uzytkownik::whereIn('rola_id', [1, 2])->orderBy('nazwisko')->get();

        // Role do formularza
        $role = Rola::all();

        // Statystyki globalne
        $statystyki = [
            'dzisiaj' => $dzisiejszeWizyty->count(),
            'oczekujace' => $oczekujaceWizyty->count(),
            'weterynarze' => Uzytkownik::where('rola_id', 2)->count(),
            'klienci' => Uzytkownik::where('rola_id', 3)->count(),
        ];

        return view('admin.dashboard', compact(
            'user', 
            'dzisiejszeWizyty', 
            'nadchodzaceWizyty', 
            'oczekujaceWizyty',
            'weterynarze',
            'pracownicy',
            'role',
            'statystyki'
        ));
    }

    /**
     * Wyświetl magazyn leków (taki sam jak dla weterynarza).
     */
    public function leki()
    {
        $leki = Lek::orderBy('nazwa')->get();
        
        return view('staff.leki', compact('leki'));
    }

    /**
     * Dodaj nowego pracownika (admin lub weterynarz).
     */
    public function storePracownik(Request $request)
    {
        $request->validate([
            'imie' => 'required|string|max:100',
            'nazwisko' => 'required|string|max:100',
            'email' => 'required|email|unique:uzytkownicy,email',
            'telefon' => 'nullable|string|max:20',
            'haslo' => 'required|string|min:6',
            'rola_id' => 'required|in:1,2', // Tylko admin lub weterynarz
        ]);

        Uzytkownik::create([
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'haslo' => Hash::make($request->haslo),
            'rola_id' => $request->rola_id,
        ]);

        $rolaText = $request->rola_id == 1 ? 'Administrator' : 'Weterynarz';
        
        return redirect()->route('admin.dashboard')->with('success', "{$rolaText} został dodany pomyślnie!");
    }

    /**
     * Przydziel lekarza do wizyty i zatwierdź ją.
     */
    public function przydzielLekarza(Request $request, $id)
    {
        $request->validate([
            'lekarz_id' => 'required|exists:uzytkownicy,id',
        ]);

        // Sprawdź czy lekarz jest weterynarzem
        $lekarz = Uzytkownik::where('id', $request->lekarz_id)
            ->where('rola_id', 2)
            ->firstOrFail();

        $wizyta = Wizyta::findOrFail($id);
        $wizyta->update([
            'lekarz_id' => $request->lekarz_id,
            'status' => 'umowiona',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Wizyta została przydzielona do weterynarza i zatwierdzona!');
    }

    /**
     * Dodaj nowy lek do magazynu.
     */
    public function storeLek(Request $request)
    {
        $request->validate([
            'nazwa' => 'required|string|max:200',
            'ilosc_na_stanie' => 'required|integer|min:0',
            'jednostka' => 'required|string|max:50',
            'cena_jednostkowa' => 'required|numeric|min:0',
        ]);

        Lek::create([
            'nazwa' => $request->nazwa,
            'ilosc_na_stanie' => $request->ilosc_na_stanie,
            'jednostka' => $request->jednostka,
            'cena_jednostkowa' => $request->cena_jednostkowa,
        ]);

        return redirect()->back()->with('success', 'Lek został dodany do magazynu!');
    }

    /**
     * Usuń użytkownika z systemu.
     */
    public function destroyUser($id)
    {
        $user = Uzytkownik::findOrFail($id);
        
        // Nie pozwól usunąć samego siebie
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.dashboard')->with('error', 'Nie możesz usunąć własnego konta!');
        }

        $nazwa = $user->imie . ' ' . $user->nazwisko;
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', "Użytkownik {$nazwa} został usunięty!");
    }

    // =============================================
    // ZARZĄDZANIE UŻYTKOWNIKAMI
    // =============================================

    /**
     * Lista wszystkich użytkowników z paginacją.
     */
    public function users()
    {
        $users = Uzytkownik::with('rola')
            ->orderBy('rola_id')
            ->orderBy('nazwisko')
            ->paginate(15);
        
        $role = Rola::all();

        return view('admin.users.index', compact('users', 'role'));
    }

    /**
     * Formularz tworzenia nowego użytkownika.
     */
    public function createUser()
    {
        $role = Rola::all();
        
        return view('admin.users.create', compact('role'));
    }

    /**
     * Zapisz nowego użytkownika (dowolna rola: Admin, Weterynarz, Klient).
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'imie' => 'required|string|max:100',
            'nazwisko' => 'required|string|max:100',
            'email' => 'required|email|unique:uzytkownicy,email',
            'telefon' => 'nullable|string|max:20',
            'haslo' => 'required|string|min:6',
            'rola_id' => 'required|exists:role,id',
        ]);

        Uzytkownik::create([
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'haslo' => Hash::make($request->haslo),
            'rola_id' => $request->rola_id,
        ]);

        $rola = Rola::find($request->rola_id);
        $rolaText = ucfirst($rola->nazwa);
        
        return redirect()->route('admin.users.index')->with('success', "{$rolaText} został dodany pomyślnie!");
    }

    // =============================================
    // ZARZĄDZANIE USŁUGAMI (CRUD)
    // =============================================

    /**
     * Lista wszystkich usług.
     */
    public function uslugi()
    {
        $uslugi = Usluga::orderBy('nazwa')->get();
        
        return view('admin.uslugi.index', compact('uslugi'));
    }

    /**
     * Formularz tworzenia nowej usługi.
     */
    public function createUsluga()
    {
        return view('admin.uslugi.create');
    }

    /**
     * Zapisz nową usługę.
     */
    public function storeUsluga(Request $request)
    {
        $request->validate([
            'nazwa' => 'required|string|max:200',
            'opis' => 'nullable|string|max:1000',
            'cena_aktualna' => 'required|numeric|min:0',
            'czas_trwania_minuty' => 'nullable|integer|min:0',
        ]);

        Usluga::create([
            'nazwa' => $request->nazwa,
            'opis' => $request->opis,
            'cena_aktualna' => $request->cena_aktualna,
            'czas_trwania_minuty' => $request->czas_trwania_minuty,
        ]);

        return redirect()->route('admin.uslugi.index')->with('success', 'Usługa została dodana pomyślnie!');
    }

    /**
     * Formularz edycji usługi.
     */
    public function editUsluga($id)
    {
        $usluga = Usluga::findOrFail($id);
        
        return view('admin.uslugi.edit', compact('usluga'));
    }

    /**
     * Aktualizuj usługę.
     */
    public function updateUsluga(Request $request, $id)
    {
        $request->validate([
            'nazwa' => 'required|string|max:200',
            'opis' => 'nullable|string|max:1000',
            'cena_aktualna' => 'required|numeric|min:0',
            'czas_trwania_minuty' => 'nullable|integer|min:0',
        ]);

        $usluga = Usluga::findOrFail($id);
        $usluga->update([
            'nazwa' => $request->nazwa,
            'opis' => $request->opis,
            'cena_aktualna' => $request->cena_aktualna,
            'czas_trwania_minuty' => $request->czas_trwania_minuty,
        ]);

        return redirect()->route('admin.uslugi.index')->with('success', 'Usługa została zaktualizowana!');
    }

    /**
     * Usuń usługę.
     */
    public function destroyUsluga($id)
    {
        $usluga = Usluga::findOrFail($id);
        $nazwa = $usluga->nazwa;
        $usluga->delete();

        return redirect()->route('admin.uslugi.index')->with('success', "Usługa \"{$nazwa}\" została usunięta!");
    }

    // =============================================
    // ZARZĄDZANIE LEKAMI (EDYCJA)
    // =============================================

    /**
     * Formularz edycji leku.
     */
    public function editLek($id)
    {
        $lek = Lek::findOrFail($id);
        
        return view('admin.leki.edit', compact('lek'));
    }

    /**
     * Aktualizuj lek.
     */
    public function updateLek(Request $request, $id)
    {
        $request->validate([
            'nazwa' => 'required|string|max:200',
            'ilosc_na_stanie' => 'required|integer|min:0',
            'jednostka' => 'required|string|max:50',
            'cena_jednostkowa' => 'required|numeric|min:0',
        ]);

        $lek = Lek::findOrFail($id);
        $lek->update([
            'nazwa' => $request->nazwa,
            'ilosc_na_stanie' => $request->ilosc_na_stanie,
            'jednostka' => $request->jednostka,
            'cena_jednostkowa' => $request->cena_jednostkowa,
        ]);

        return redirect()->route('admin.leki')->with('success', 'Lek został zaktualizowany!');
    }

    /**
     * Anuluj wizytę oczekującą.
     */
    public function anulujWizyte($id)
    {
        $wizyta = Wizyta::findOrFail($id);
        $wizyta->update(['status' => 'anulowana']);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Wizyta została anulowana.');
    }
}
