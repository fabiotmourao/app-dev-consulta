<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{

    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = [
            'Ltda',
            'S.A.',
            'MEI',
            'EIRELI'
        ];

        $razaoSocial = $this->faker->company . ' ' . $tipos[rand(0, count($tipos) - 1)];

        return [
            'nome' => explode(' ', $razaoSocial)[0], 
            'razao_social' => $razaoSocial,
            'cnpj' => $this->faker->unique()->randomNumber(8) . $this->faker->unique()->randomNumber(6),
        ];
    }
}
