<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Adres;
use App\Models\Rola;
use App\Models\Gatunek;
use App\Models\Usluga;
use App\Models\Lek;
use App\Models\Uzytkownik;
use App\Models\Zwierze;
use App\Models\Wizyta;
use App\Models\DokumentacjaMedyczna;

class DatabaseSeeder extends Seeder
{
    /**
     * Realistyczne opisy zgłoszeń dla wizyt weterynaryjnych.
     */
    private array $opisyZgloszen = [
        'Pies kuleje na lewą tylną łapę od wczoraj.',
        'Kot nie chce jeść od 2 dni, jest osowiały.',
        'Kontrola po zabiegu sterylizacji.',
        'Szczepienie przeciw wściekliźnie - przypomnienie.',
        'Zwierzę ma problemy z oddychaniem, kaszel.',
        'Podejrzenie pasożytów - drapanie, wypadanie sierści.',
        'Wymioty i biegunka od rana.',
        'Kontrola szczeniaka - pierwsze szczepienia.',
        'Rana na łapie po ugryzieniu przez innego psa.',
        'Problemy z uszami - potrząsanie głową, nieprzyjemny zapach.',
        'Guz na brzuchu - do zbadania.',
        'Pies ciężko dyszy, nie chce wychodzić na spacer.',
        'Kot ma łzawiące oczy i kicha.',
        'Kontrola po leczeniu antybiotykiem.',
        'Zwierzę przybrało na wadze, zmiana diety.',
        'Problemy z zębami, nieprzyjemny oddech.',
        'Kulawizna przedniej łapy.',
        'Alergia skórna, intensywne drapanie.',
        'Szczepienie podstawowe - 8 tygodni.',
        'Zwierzę jest apatyczne, mało aktywne.',
        'Kontrola po operacji usunięcia guza.',
        'Ukąszenie przez kleszcza.',
        'Problemy z trawieniem, wzdęcia.',
        'Kontrola ciąży.',
        'Badanie przed planowaną sterylizacją.',
    ];

    /**
     * Realistyczne zalecenia weterynaryjne.
     */
    private array $zalecenia = [
        'Dieta lekkostrawna przez 3 dni. Małe porcje podawane częściej.',
        'Podawać lek Amoxicylina 2x dziennie przez 7 dni.',
        'Kontrola za tydzień. Obserwować stan ogólny.',
        'Ograniczenie ruchu przez 10 dni. Spacery tylko na smyczy.',
        'Stosować maść na ranę 2x dziennie. Utrzymywać ranę w czystości.',
        'Zmiana karmy na hypoalergiczną. Unikać przekąsek.',
        'Podawać probiotyki przez 5 dni. Dużo wody.',
        'Kołnierz ochronny przez 7 dni. Kontrola szwów za 10 dni.',
        'Krople do oczu 3x dziennie przez 5 dni.',
        'Krople do uszu rano i wieczorem przez 7 dni.',
        'Podawać tabletkę przeciwbólową według potrzeb, max 2x dziennie.',
        'Obserwacja w domu. W razie pogorszenia natychmiastowy kontakt.',
        'Regularne czesanie i kąpiele lecznicze co 3 dni.',
        'Kontrola wagi za miesiąc. Zmniejszyć dzienne porcje o 20%.',
        'Szczepienie przypominające za rok. Wpisać do kalendarza.',
        'Odpoczynek przez 24h po zabiegu. Bez karmienia przez 12h.',
        'Antybiotyk do końca opakowania, nawet po ustąpieniu objawów.',
        'Regularna aktywność fizyczna, krótkie ale częste spacery.',
    ];

    /**
     * Realistyczne diagnozy weterynaryjne.
     */
    private array $diagnozy = [
        'Infekcja bakteryjna górnych dróg oddechowych. Rokowanie dobre.',
        'Zapalenie stawu kolanowego. Zalecany odpoczynek.',
        'Alergia pokarmowa. Konieczna dieta eliminacyjna.',
        'Pasożyty zewnętrzne (pchły). Wdrożono leczenie.',
        'Stan po zabiegu prawidłowy. Gojenie przebiega bez powikłań.',
        'Zapalenie ucha środkowego. Etiologia bakteryjna.',
        'Nieżyt żołądkowo-jelitowy. Prawdopodobnie dietetyczny.',
        'Brak niepokojących objawów. Kontrola profilaktyczna.',
        'Rana szarpana, wymagała szycia. 4 szwy.',
        'Nadwaga. BMI powyżej normy dla rasy.',
        'Zapalenie dziąseł. Kamień nazębny do usunięcia.',
        'Reakcja alergiczna skórna. Przyczyna do ustalenia.',
        'Zapalenie spojówek. Etiologia wirusowa.',
        'Guz łagodny (tłuszczak). Obserwacja, bez interwencji.',
        'Zwichnięcie łapy. Założony opatrunek stabilizujący.',
    ];

    /**
     * Losuje element z tablicy.
     */
    private function losujOpis(): string
    {
        return $this->opisyZgloszen[array_rand($this->opisyZgloszen)];
    }

    private function losujZalecenie(): string
    {
        return $this->zalecenia[array_rand($this->zalecenia)];
    }

    private function losujDiagnoze(): string
    {
        return $this->diagnozy[array_rand($this->diagnozy)];
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Utworzenie ról
        $adminRole = Rola::create(['nazwa' => 'admin']);
        $weterynarzRole = Rola::create(['nazwa' => 'weterynarz']);
        $klientRole = Rola::create(['nazwa' => 'klient']);

        // 2. Utworzenie gatunków
        $pies = Gatunek::create(['nazwa' => 'Pies']);
        $kot = Gatunek::create(['nazwa' => 'Kot']);
        $krolik = Gatunek::create(['nazwa' => 'Królik']);
        $chomik = Gatunek::create(['nazwa' => 'Chomik']);
        $swinkaMorska = Gatunek::create(['nazwa' => 'Świnka morska']);
        $papuga = Gatunek::create(['nazwa' => 'Papuga']);
        
        $gatunki = [$pies, $kot, $krolik, $chomik, $swinkaMorska, $papuga];

        // 3. Utworzenie usług
        $uslugi = [
            ['nazwa' => 'Konsultacja ogólna', 'opis' => 'Podstawowe badanie ogólne zwierzęcia', 'cena_aktualna' => 150.00, 'czas_trwania_minuty' => 30],
            ['nazwa' => 'Szczepienie podstawowe', 'opis' => 'Szczepienie ochronne dla zwierząt', 'cena_aktualna' => 120.00, 'czas_trwania_minuty' => 15],
            ['nazwa' => 'Badanie krwi', 'opis' => 'Kompleksowe badanie laboratoryjne krwi', 'cena_aktualna' => 250.00, 'czas_trwania_minuty' => 45],
            ['nazwa' => 'USG jamy brzusznej', 'opis' => 'Ultrasonografia narządów wewnętrznych', 'cena_aktualna' => 300.00, 'czas_trwania_minuty' => 60],
            ['nazwa' => 'Zabieg chirurgiczny', 'opis' => 'Operacja chirurgiczna', 'cena_aktualna' => 800.00, 'czas_trwania_minuty' => 120],
            ['nazwa' => 'Pielęgnacja zębów', 'opis' => 'Czyszczenie i kontrola uzębienia', 'cena_aktualna' => 200.00, 'czas_trwania_minuty' => 45],
            ['nazwa' => 'Kastracja', 'opis' => 'Zabieg kastracji/sterylizacji', 'cena_aktualna' => 400.00, 'czas_trwania_minuty' => 90],
            ['nazwa' => 'RTG', 'opis' => 'Badanie rentgenowskie', 'cena_aktualna' => 180.00, 'czas_trwania_minuty' => 30],
        ];
        
        foreach ($uslugi as $usluga) {
            Usluga::create($usluga);
        }

        // 4. Utworzenie leków
        $leki = [
            ['nazwa' => 'Amoxicylina', 'jednostka' => 'ml', 'ilosc_na_stanie' => 100, 'cena_jednostkowa' => 15.50],
            ['nazwa' => 'Meloksykam', 'jednostka' => 'ml', 'ilosc_na_stanie' => 80, 'cena_jednostkowa' => 25.00],
            ['nazwa' => 'Prednizon', 'jednostka' => 'tabletka', 'ilosc_na_stanie' => 150, 'cena_jednostkowa' => 3.50],
            ['nazwa' => 'Dexametazon', 'jednostka' => 'ampułka', 'ilosc_na_stanie' => 60, 'cena_jednostkowa' => 12.00],
            ['nazwa' => 'Karprofen', 'jednostka' => 'mg', 'ilosc_na_stanie' => 200, 'cena_jednostkowa' => 8.00],
            ['nazwa' => 'Gentamycyna', 'jednostka' => 'ml', 'ilosc_na_stanie' => 70, 'cena_jednostkowa' => 18.00],
            ['nazwa' => 'Medetomidyna', 'jednostka' => 'ml', 'ilosc_na_stanie' => 50, 'cena_jednostkowa' => 45.00],
            ['nazwa' => 'Atropina', 'jednostka' => 'ampułka', 'ilosc_na_stanie' => 40, 'cena_jednostkowa' => 10.00],
        ];
        
        foreach ($leki as $lek) {
            Lek::create($lek);
        }

        // 5. Utworzenie Admina (TESTOWY)
        $adminAdres = Adres::create([
            'miasto' => 'Warszawa',
            'ulica' => 'Centralna',
            'nr_domu' => '1',
            'kod_pocztowy' => '00-001',
        ]);

        Uzytkownik::create([
            'adres_id' => $adminAdres->id,
            'rola_id' => $adminRole->id,
            'imie' => 'Admin',
            'nazwisko' => 'Systemowy',
            'email' => 'admin@klinika.pl',
            'haslo' => Hash::make('haslo123'),
            'telefon' => '123456789',
        ]);

        // 6. Utworzenie weterynarza testowego
        $lekarzAdres = Adres::create([
            'miasto' => 'Warszawa',
            'ulica' => 'Lekarska',
            'nr_domu' => '10',
            'kod_pocztowy' => '00-002',
        ]);

        $lekarzTestowy = Uzytkownik::create([
            'adres_id' => $lekarzAdres->id,
            'rola_id' => $weterynarzRole->id,
            'imie' => 'Jan',
            'nazwisko' => 'Kowalski',
            'email' => 'lekarz@klinika.pl',
            'haslo' => Hash::make('haslo123'),
            'telefon' => '501234567',
        ]);

        // 7. Utworzenie klienta testowego ze zwierzętami
        $klientAdres = Adres::create([
            'miasto' => 'Kraków',
            'ulica' => 'Kliencka',
            'nr_domu' => '5',
            'kod_pocztowy' => '30-001',
        ]);

        $klientTestowy = Uzytkownik::create([
            'adres_id' => $klientAdres->id,
            'rola_id' => $klientRole->id,
            'imie' => 'Maria',
            'nazwisko' => 'Nowak',
            'email' => 'klient@klinika.pl',
            'haslo' => Hash::make('haslo123'),
            'telefon' => '601234567',
        ]);

        // Zwierzęta dla klienta testowego
        $zwierzeTestowe1 = Zwierze::create([
            'uzytkownik_id' => $klientTestowy->id,
            'gatunek_id' => $pies->id,
            'imie' => 'Burek',
            'data_urodzenia' => '2020-05-15',
            'plec' => 'samiec',
            'waga' => 25.50,
            'nr_czipa' => 'PL123456789',
        ]);

        $zwierzeTestowe2 = Zwierze::create([
            'uzytkownik_id' => $klientTestowy->id,
            'gatunek_id' => $kot->id,
            'imie' => 'Mruczek',
            'data_urodzenia' => '2021-03-10',
            'plec' => 'samiec',
            'waga' => 4.20,
            'nr_czipa' => 'PL987654321',
        ]);

        // 8. Utworzenie dodatkowych Weterynarzy
        $weterynarze = [$lekarzTestowy];
        $imionaWet = ['Anna', 'Piotr'];
        $nazwiskaWet = ['Nowak', 'Wiśniewski'];

        for ($i = 0; $i < 2; $i++) {
            $adres = Adres::create([
                'miasto' => fake()->city(),
                'ulica' => fake()->streetName(),
                'nr_domu' => fake()->buildingNumber(),
                'kod_pocztowy' => fake()->postcode(),
            ]);

            $weterynarze[] = Uzytkownik::create([
                'adres_id' => $adres->id,
                'rola_id' => $weterynarzRole->id,
                'imie' => $imionaWet[$i],
                'nazwisko' => $nazwiskaWet[$i],
                'email' => 'weterynarz' . ($i + 2) . '@klinika.pl',
                'haslo' => Hash::make('haslo123'),
                'telefon' => '50' . rand(1000000, 9999999),
            ]);
        }

        // 9. Utworzenie dodatkowych Klientów z zwierzętami
        $wszystkieZwierzeta = [$zwierzeTestowe1, $zwierzeTestowe2];
        $imionaKlientow = ['Tomasz', 'Katarzyna', 'Michał', 'Ewa', 'Paweł', 'Magdalena', 'Krzysztof', 'Joanna', 'Andrzej'];
        $nazwiskaKlientow = ['Nowacki', 'Lewandowska', 'Zieliński', 'Wójcik', 'Kamiński', 'Dąbrowska', 'Mazur', 'Krawczyk', 'Piotrowski'];
        
        $imionaZwierzat = ['Azor', 'Rex', 'Max', 'Luna', 'Bella', 'Charlie', 'Filemon', 'Reksio', 'Puszek', 'Łatka'];

        for ($i = 0; $i < 9; $i++) {
            $adres = Adres::create([
                'miasto' => fake()->city(),
                'ulica' => fake()->streetName(),
                'nr_domu' => fake()->buildingNumber(),
                'kod_pocztowy' => fake()->postcode(),
            ]);

            $klient = Uzytkownik::create([
                'adres_id' => $adres->id,
                'rola_id' => $klientRole->id,
                'imie' => $imionaKlientow[$i],
                'nazwisko' => $nazwiskaKlientow[$i],
                'email' => 'klient' . ($i + 2) . '@example.com',
                'haslo' => Hash::make('haslo123'),
                'telefon' => '60' . rand(1000000, 9999999),
            ]);

            // Każdy klient ma 1-2 zwierzęta
            $iloscZwierzat = rand(1, 2);
            for ($j = 0; $j < $iloscZwierzat; $j++) {
                $zwierze = Zwierze::create([
                    'uzytkownik_id' => $klient->id,
                    'gatunek_id' => $gatunki[array_rand($gatunki)]->id,
                    'imie' => $imionaZwierzat[array_rand($imionaZwierzat)],
                    'data_urodzenia' => fake()->dateTimeBetween('-10 years', '-1 year'),
                    'plec' => fake()->randomElement(['samiec', 'samica']),
                    'waga' => fake()->randomFloat(2, 2, 40),
                    'nr_czipa' => 'PL' . rand(100000000, 999999999),
                ]);

                $wszystkieZwierzeta[] = $zwierze;
            }
        }

        // 10. Utworzenie wizyt (w tym dzisiejsze dla testów)
        $wszystkieUslugi = Usluga::all();
        $wszystkieLeki = Lek::all();

        // Dodaj kilka wizyt na DZISIAJ dla testów panelu pracownika
        $dzisiaj = now();
        for ($h = 9; $h <= 15; $h += 2) {
            $wizytaDzis = Wizyta::create([
                'lekarz_id' => $weterynarze[array_rand($weterynarze)]->id,
                'zwierze_id' => $wszystkieZwierzeta[array_rand($wszystkieZwierzeta)]->id,
                'data_wizyty' => $dzisiaj->copy()->setTime($h, 0),
                'status' => fake()->randomElement(['umowiona', 'oczekujaca']),
                'opis_zgloszenia' => $this->losujOpis(),
            ]);
        }

        // Dodaj kilka wizyt OCZEKUJĄCYCH (bez przydzielonego lekarza) dla testów panelu admina
        for ($i = 0; $i < 5; $i++) {
            Wizyta::create([
                'lekarz_id' => null,
                'zwierze_id' => $wszystkieZwierzeta[array_rand($wszystkieZwierzeta)]->id,
                'data_wizyty' => now()->addDays(rand(1, 7))->setTime(rand(9, 16), 0),
                'status' => 'oczekujaca',
                'opis_zgloszenia' => $this->losujOpis(),
            ]);
        }

        // Dodaj puste sloty (niezarezerwowane terminy) dla testów admina
        for ($i = 0; $i < 3; $i++) {
            Wizyta::create([
                'lekarz_id' => $weterynarze[array_rand($weterynarze)]->id,
                'zwierze_id' => null, // Pusty slot - brak pacjenta
                'data_wizyty' => now()->addDays(rand(1, 5))->setTime(rand(9, 17), 0),
                'status' => 'wolny',
                'opis_zgloszenia' => 'Dostępny termin',
            ]);
        }

        foreach ($wszystkieZwierzeta as $zwierze) {
            // Każde zwierzę ma 2-4 wizyty
            $iloscWizyt = rand(2, 4);
            
            for ($k = 0; $k < $iloscWizyt; $k++) {
                // 70% wizyt zakończonych, 30% przyszłych
                $czyZakonczona = rand(1, 10) <= 7;
                
                if ($czyZakonczona) {
                    $dataWizyty = fake()->dateTimeBetween('-6 months', '-1 day');
                    // Losowy status dla zakończonych: zakonczona lub anulowana
                    $status = fake()->randomElement(['zakonczona', 'zakonczona', 'zakonczona', 'anulowana']);
                } else {
                    $dataWizyty = fake()->dateTimeBetween('+1 day', '+3 months');
                    // Losowy status dla przyszłych: umowiona lub oczekujaca
                    $status = fake()->randomElement(['umowiona', 'oczekujaca']);
                }

                $wizyta = Wizyta::create([
                    'lekarz_id' => $weterynarze[array_rand($weterynarze)]->id,
                    'zwierze_id' => $zwierze->id,
                    'data_wizyty' => $dataWizyty,
                    'status' => $status,
                    'opis_zgloszenia' => $this->losujOpis(),
                ]);

                // Dla wizyt zakończonych dodajemy usługi, leki i dokumentację
                if ($status === 'zakonczona') {
                    // Przypisanie 1-3 losowych usług
                    $iloscUslug = rand(1, 3);
                    $wybraneUslugi = $wszystkieUslugi->random($iloscUslug);
                    
                    foreach ($wybraneUslugi as $usluga) {
                        $wizyta->uslugi()->attach($usluga->id, [
                            'cena_w_chwili_wizyty' => $usluga->cena_aktualna,
                            'ilosc' => 1,
                        ]);
                    }

                    // Przypisanie 1-2 losowych leków
                    $iloscLekow = rand(1, 2);
                    $wybraneLeki = $wszystkieLeki->random($iloscLekow);
                    
                    foreach ($wybraneLeki as $lek) {
                        $wizyta->leki()->attach($lek->id, [
                            'ilosc_zuzyta' => rand(1, 5),
                        ]);
                    }

                    // Utworzenie dokumentacji medycznej z realistycznymi danymi
                    DokumentacjaMedyczna::create([
                        'wizyta_id' => $wizyta->id,
                        'diagnoza' => $this->losujDiagnoze(),
                        'zalecenia' => $this->losujZalecenie(),
                        'temperatura' => fake()->randomFloat(1, 37.5, 39.5),
                    ]);
                }
            }
        }
    }
}
