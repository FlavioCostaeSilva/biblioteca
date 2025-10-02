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
            'Titulo' => $this->faker->sentence(3),
            'Editora' => $this->faker->company,
            'AnoPublicacao' => $this->faker->year,
            'Preco' => $this->faker->numberBetween(10, 100),
        ];
    }
}
