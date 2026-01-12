<?php

namespace Tests\Feature;

use App\Models\Gatunek;
use App\Models\Rola;
use App\Models\Usluga;
use App\Models\Uzytkownik;
use App\Models\Zwierze;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SystemValidationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $gatunek;
    protected $usluga;
    protected $zwierze;

    protected function setUp(): void
    {
        parent::setUp();

        // Tworzymy role w odpowiedniej kolejności (admin=1, weterynarz=2, klient=3)
        // Tak aby metoda isKlient() działała poprawnie (sprawdza rola_id === 3)
        Rola::create(['nazwa' => 'admin']);      // id = 1
        Rola::create(['nazwa' => 'weterynarz']); // id = 2
        $rolaKlient = Rola::create(['nazwa' => 'klient']); // id = 3

        // Tworzymy użytkownika z numerem telefonu (bez factory - bezpośrednio)
        $this->user = Uzytkownik::create([
            'rola_id' => $rolaKlient->id,
            'adres_id' => null,
            'imie' => 'Jan',
            'nazwisko' => 'Kowalski',
            'email' => 'jan@test.pl',
            'haslo' => Hash::make('password'),
            'telefon' => '123456789',
        ]);

        // Logujemy użytkownika
        $this->actingAs($this->user);

        // Tworzymy gatunek dla zwierzaka (bez factory)
        $this->gatunek = Gatunek::create(['nazwa' => 'Pies']);

        // Tworzymy usługę (bez factory) - wszystkie wymagane pola
        $this->usluga = Usluga::create([
            'nazwa' => 'Konsultacja',
            'opis' => 'Standardowa konsultacja weterynaryjna',
            'cena_aktualna' => 100.00,
            'czas_trwania_minuty' => 30,
        ]);

        // Tworzymy zwierzaka dla testów wizyt - wszystkie wymagane pola
        $this->zwierze = Zwierze::create([
            'uzytkownik_id' => $this->user->id,
            'gatunek_id' => $this->gatunek->id,
            'imie' => 'Burek',
            'waga' => 10,
            'plec' => 'samiec',
            'data_urodzenia' => Carbon::now()->subYear()->format('Y-m-d'),
        ]);
    }

    // =======================================
    // TESTY WALIDACJI GODZIN WIZYT
    // =======================================

    /**
     * Test: Nie można umówić wizyty o 3 w nocy (poza godzinami pracy 8:00-20:00)
     * Format: data_wizyty to datetime-local, czyli 'Y-m-d\TH:i'
     */
    public function test_nie_mozna_umowic_wizyty_o_3_w_nocy(): void
    {
        // Jutro o 03:00 - poza godzinami pracy
        $dataWizyty = Carbon::tomorrow()->setTime(3, 0)->format('Y-m-d\TH:i');

        $response = $this->post(route('client.wizyty.store'), [
            'zwierze_id' => $this->zwierze->id,
            'usluga_id' => $this->usluga->id,
            'data_wizyty' => $dataWizyty,
            'opis_zgloszenia' => 'Testowa wizyta',
        ]);

        $response->assertSessionHasErrors('data_wizyty');
    }

    /**
     * Test: Nie można umówić wizyty o 23:00 (poza godzinami pracy 8:00-20:00)
     */
    public function test_nie_mozna_umowic_wizyty_o_23_00(): void
    {
        // Jutro o 23:00 - poza godzinami pracy
        $dataWizyty = Carbon::tomorrow()->setTime(23, 0)->format('Y-m-d\TH:i');

        $response = $this->post(route('client.wizyty.store'), [
            'zwierze_id' => $this->zwierze->id,
            'usluga_id' => $this->usluga->id,
            'data_wizyty' => $dataWizyty,
            'opis_zgloszenia' => 'Testowa wizyta',
        ]);

        $response->assertSessionHasErrors('data_wizyty');
    }

    /**
     * Test: Można umówić wizytę o 10:00 (w godzinach pracy)
     */
    public function test_mozna_umowic_wizyte_o_10_rano(): void
    {
        // Jutro o 10:00 - w godzinach pracy (8:00-20:00)
        $dataWizyty = Carbon::tomorrow()->setTime(10, 0)->format('Y-m-d\TH:i');

        $response = $this->post(route('client.wizyty.store'), [
            'zwierze_id' => $this->zwierze->id,
            'usluga_id' => $this->usluga->id,
            'data_wizyty' => $dataWizyty,
            'opis_zgloszenia' => 'Testowa wizyta',
        ]);

        $response->assertSessionDoesntHaveErrors('data_wizyty');
    }

    // =======================================
    // TESTY WALIDACJI WAGI ZWIERZAKA
    // =======================================

    /**
     * Test: Nie można dodać zwierzaka z ujemną wagą
     */
    public function test_nie_mozna_dodac_zwierzaka_z_ujemna_waga(): void
    {
        $response = $this->post(route('client.zwierzeta.store'), [
            'gatunek_id' => $this->gatunek->id,
            'imie' => 'Mruczek',
            'waga' => -5,
            'plec' => 'samiec',
            'data_urodzenia' => Carbon::now()->subYear()->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors('waga');
    }

    /**
     * Test: Można dodać zwierzaka z poprawną wagą
     */
    public function test_mozna_dodac_zwierzaka_z_poprawna_waga(): void
    {
        $response = $this->post(route('client.zwierzeta.store'), [
            'gatunek_id' => $this->gatunek->id,
            'imie' => 'Mruczek',
            'waga' => 10,
            'plec' => 'samiec',
            'data_urodzenia' => Carbon::now()->subYear()->format('Y-m-d'),
        ]);

        $response->assertSessionDoesntHaveErrors('waga');
    }

    // =======================================
    // TESTY WALIDACJI DATY URODZENIA ZWIERZAKA
    // =======================================

    /**
     * Test: Nie można dodać zwierzaka urodzonego w przyszłości
     */
    public function test_nie_mozna_dodac_zwierzaka_urodzonego_w_przyszlosci(): void
    {
        $response = $this->post(route('client.zwierzeta.store'), [
            'gatunek_id' => $this->gatunek->id,
            'imie' => 'Reksio',
            'waga' => 15,
            'plec' => 'samiec',
            'data_urodzenia' => Carbon::tomorrow()->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors('data_urodzenia');
    }

    /**
     * Test: Można dodać zwierzaka urodzonego wczoraj
     */
    public function test_mozna_dodac_zwierzaka_urodzonego_wczoraj(): void
    {
        $response = $this->post(route('client.zwierzeta.store'), [
            'gatunek_id' => $this->gatunek->id,
            'imie' => 'Reksio',
            'waga' => 15,
            'plec' => 'samiec',
            'data_urodzenia' => Carbon::yesterday()->format('Y-m-d'),
        ]);

        $response->assertSessionDoesntHaveErrors('data_urodzenia');
    }
}
