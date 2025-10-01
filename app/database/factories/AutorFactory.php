<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Nome' => fake()->name(),
        ];
    }
}
