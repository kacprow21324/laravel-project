<?php

namespace Database\Factories;

use App\Models\Gatunek;
use Illuminate\Database\Eloquent\Factories\Factory;

class GatunekFactory extends Factory
{
    protected $model = Gatunek::class;

    public function definition(): array
    {
        return [
            'nazwa' => $this->faker->randomElement(['Pies', 'Kot', 'Królik', 'Chomik', 'Świnka morska', 'Papuga']),
        ];
    }
}
