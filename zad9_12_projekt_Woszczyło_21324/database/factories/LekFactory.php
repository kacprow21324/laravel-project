<?php

namespace Database\Factories;

use App\Models\Lek;
use Illuminate\Database\Eloquent\Factories\Factory;

class LekFactory extends Factory
{
    protected $model = Lek::class;

    public function definition(): array
    {
        return [
            'nazwa' => $this->faker->randomElement([
                'Amoxicylina',
                'Meloksykam',
                'Prednizon',
                'Dexametazon',
                'Karprofen',
                'Gentamycyna',
                'Medetomidyna',
                'Atropina',
            ]),
            'jednostka' => $this->faker->randomElement(['ml', 'mg', 'tabletka', 'ampułka']),
            'ilosc_na_stanie' => $this->faker->numberBetween(10, 200),
            'cena_jednostkowa' => $this->faker->randomFloat(2, 5, 100),
        ];
    }
}
