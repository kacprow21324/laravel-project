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
                'status' => 'umówiona',
                'opis_zgloszenia' => fake()->sentence(10),
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
                    $status = 'zakończona';
                } else {
                    $dataWizyty = fake()->dateTimeBetween('+1 day', '+3 months');
                    $status = 'umówiona';
                }

                $wizyta = Wizyta::create([
                    'lekarz_id' => $weterynarze[array_rand($weterynarze)]->id,
                    'zwierze_id' => $zwierze->id,
                    'data_wizyty' => $dataWizyty,
                    'status' => $status,
                    'opis_zgloszenia' => fake()->sentence(10),
                ]);

                // Dla wizyt zakończonych dodajemy usługi, leki i dokumentację
                if ($status === 'zakończona') {
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

                    // Utworzenie dokumentacji medycznej
                    DokumentacjaMedyczna::create([
                        'wizyta_id' => $wizyta->id,
                        'diagnoza' => fake()->sentence(15),
                        'zalecenia' => fake()->paragraph(3),
                        'temperatura' => fake()->randomFloat(2, 36.5, 40.5),
                    ]);
                }
            }
        }
    }
}
