<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Livro;

/**
 * @extends Factory<Livro>
 */
class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition(): array
    {
        return [
            'Titulo' => substr($this->faker->sentence(3), 0, 40),
            'Editora' => substr($this->faker->company, 0, 40),
            'AnoPublicacao' => $this->faker->year,
            'Preco' => $this->faker->numberBetween(10, 1000),
        ];
    }
}
