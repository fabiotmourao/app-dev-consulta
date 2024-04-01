<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Candidato;
use App\Models\Selecao;

class SelecaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::all()->each(function ($cliente) {
            $cliente->selecoes()->saveMany(
                Candidato::factory(10)->create()->map(function ($candidato) {
                    return Selecao::factory()->make(['candidato_id' => $candidato->id]);
                })
            );
        });
    }
}
