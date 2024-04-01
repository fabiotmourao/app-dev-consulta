<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Selecao;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Selecao>
 */
class SelecaoFactory extends Factory
{

    protected $model = Selecao::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->jobTitle,
        ];
    }
}
