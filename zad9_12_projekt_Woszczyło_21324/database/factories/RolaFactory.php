<?php

namespace Database\Factories;

use App\Models\Rola;
use Illuminate\Database\Eloquent\Factories\Factory;

class RolaFactory extends Factory
{
    protected $model = Rola::class;

    public function definition(): array
    {
        return [
            'nazwa' => $this->faker->randomElement(['admin', 'weterynarz', 'klient']),
        ];
    }
}
