<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        if($clientes->count() > 0){
            return response()->json([
                'status' => 200,
                'clientes' => $clientes,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Clientes não encontrado',
            ], 404);
        }
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if($cliente){
            return response()->json([
                'status' => 200,
                'cliente' => $cliente,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'ID do Cliente não encontrado',
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {

        $validator = Validator::make($request->all(),  [
            'razao_social' => 'required|max:255',
            'cnpj' => 'required|digits:14',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }else{
            $cliente = Cliente::find($id);

            if($cliente){
                $cliente->update([
                  'razao_social' => $request->razao_social,
                  'cnpj' => $request->cnpj,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Clente atualizado com sucesso!',
                ], 200);

            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Erro ao editar cliente!',
                ], 404);
            }
        }
    }


}
