<?php

namespace App\Http\Controllers;

use App\Models\Selecao;
use Illuminate\Http\Request;

class SelecaoController extends Controller
{
    public function index()
    {
        $selecoes = Selecao::with(['cliente','candidato'])->take(10)->get();

        return $selecoes;
    }
}


