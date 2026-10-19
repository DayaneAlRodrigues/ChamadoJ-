<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChamadoRequest;
use App\Http\Requests\UpdateChamadoRequest;
use App\Models\Chamado;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index(){
        $chamados = Chamado::all();

        return response()->json($chamados);
    }

    public function store(StoreChamadoRequest $request){
        $dados = $request->validated();

        $chamado = Chamado::create($dados);

        return response()->json($chamado, 201);
    }

    public function show(int $id){
        $chamado = Chamado::where('id_chamado',$id)->first();

        if(!$chamado){
            return response()->json([
                'message'=> 'Chamado não encontrado.'
            ], 404);
        }

        if($chamado){
            return response()->json($chamado,200);
        }
    }

    public function update(UpdateChamadoRequest $request, int $id){
        $chamado =  Chamado::where('id_chamado',$id)->first();

        if(!$chamado){
            return response()->json([
                'message'=> 'Chamado não encontrado.'
            ], 404);
        }

        $dados = $request->validated();

        $chamado->update($dados);

        return response()->json($chamado,200);

    }
}