<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::take(10)->get();

        return $candidatos;
    }
}
