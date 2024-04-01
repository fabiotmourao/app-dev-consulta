<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidatoController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::take(10)->get();

        if($candidatos->count() > 0){
            return response()->json([
                'status' => 200,
                'candidatos' => $candidatos,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Candidatos não encontrado',
            ], 404);
        }
    }

    public function edit($id)
    {
        $candidato = Candidato::find($id);

        if($candidato){
            return response()->json([
                'status' => 200,
                'candidato' => $candidato,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'ID do Candidato não encontrado',
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'cpf' => 'required|max:11|min:11',
            'logradouro' => 'required|max:255',
        ],[
            'nome.required' => '*O campo nome é obrigatório.',
            'nome.max' => '*O campo nome dever conter maximo 255 caracteres.',
            'cpf.required' => '*O campo cpf é obrigatório.',
            'cpf.max' => '*O campo cpf deve ter conter 11 caracteres.',
            'cpf.min' => '*O campo cpf deve ter no mínimo 11 caracteres.',
            'logradouro.required' => '*O campo logradouro é obrigatório.',
            'logradouro.max' => '*O campo logradouro dever conter maximo 255 caracteres.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $candidato = Candidato::find($id);

        if ($candidato) {
            $candidato->update([
                'nome' => $request->nome,
                'cpf' => $cpf,
                'logradouro' => $request->logradouro,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Candidato atualizado com sucesso!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Erro ao editar candidato!',
            ], 404);
        }
    }

}
