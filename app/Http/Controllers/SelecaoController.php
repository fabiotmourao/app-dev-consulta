<?php

namespace App\Http\Controllers;

use App\Models\Selecao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SelecaoController extends Controller
{
    public function index()
    {
        $selecoes = Selecao::with(['cliente','candidato'])->latest()->take(10)->get()->reverse();

        return $selecoes;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'candidato_id' => 'required',
            'cliente_id' => 'required',
        ],[
            'nome.required' => '*O campo nome é obrigatório.',
            'nome.max' => '*O campo nome dever conter máximo 255 caracteres.',
            'candidato_id.required' => '*É obrigatório selecionar um candidato',
            'cliente_id.required' => '*É obrigatório selecionar um cliente'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $selecao = Selecao::create([
            'nome' => $request->nome,
            'candidato_id' => $request->candidato_id,
            'cliente_id' => $request->cliente_id,
        ]);

        if ($selecao) {
            return response()->json([
                'status' => 200,
                'message' => 'Seleção criada com sucesso!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Erro ao criar seleção',
            ], 404);
        }
    }

}


