<?php

namespace Database\Factories;

use App\Models\Adres;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdresFactory extends Factory
{
    protected $model = Adres::class;

    public function definition(): array
    {
        return [
            'miasto' => $this->faker->city(),
            'ulica' => $this->faker->streetName(),
            'nr_domu' => $this->faker->buildingNumber(),
            'kod_pocztowy' => $this->faker->postcode(),
        ];
    }
}
