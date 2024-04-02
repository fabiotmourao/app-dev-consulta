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

        $razaoSocial = rtrim($this->faker->company, ',') . ' ' . $tipos[rand(0, count($tipos) - 1)];

        return [
            'razao_social' => $razaoSocial,
            'cnpj' => str_pad(mt_rand(0, 999999999), 14, '0', STR_PAD_LEFT),
        ];
    }
}
