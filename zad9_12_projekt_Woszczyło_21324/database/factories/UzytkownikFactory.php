<?php

namespace Database\Factories;

use App\Models\Uzytkownik;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UzytkownikFactory extends Factory
{
    protected $model = Uzytkownik::class;

    public function definition(): array
    {
        return [
            'adres_id' => null,
            'rola_id' => 1,
            'imie' => $this->faker->firstName(),
            'nazwisko' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'haslo' => Hash::make('password'),
            'telefon' => $this->faker->numerify('#########'),
        ];
    }
}
