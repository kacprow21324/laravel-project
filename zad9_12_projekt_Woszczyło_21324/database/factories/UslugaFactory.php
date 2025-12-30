<?php

namespace Database\Factories;

use App\Models\Usluga;
use Illuminate\Database\Eloquent\Factories\Factory;

class UslugaFactory extends Factory
{
    protected $model = Usluga::class;

    public function definition(): array
    {
        return [
            'nazwa' => $this->faker->randomElement([
                'Konsultacja ogólna',
                'Szczepienie',
                'Badanie krwi',
                'USG',
                'Chirurgia',
                'Pielęgnacja zębów',
                'Kastracja/sterylizacja',
                'RTG',
            ]),
            'opis' => $this->faker->paragraph(),
            'cena_aktualna' => $this->faker->randomFloat(2, 50, 500),
            'czas_trwania_minuty' => $this->faker->randomElement([15, 30, 45, 60, 90, 120]),
        ];
    }
}
