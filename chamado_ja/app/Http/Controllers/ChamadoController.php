<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteChamadoRequest;
use App\Http\Requests\StoreChamadoRequest;
use App\Http\Requests\UpdateChamadoRequest;
use App\Http\Resources\ChamadoResource;
use App\Models\Chamado;
use Symfony\Component\HttpFoundation\Response;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamados = Chamado::all();

        return (new ChamadoResource(
            $chamados->load(['usuario', 'categoria'])
        ))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreChamadoRequest $request)
    {

        $chamado = Chamado::create([
            ...$request->validated(),
            'status' => 'aberto',
        ]);

        return (new ChamadoResource(
            $chamado->load(['usuario', 'categoria'])
        ))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $chamado = Chamado::where('id_chamado', $id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($chamado) {
            return (new ChamadoResource(
                $chamado->load(['usuario', 'categoria'])
            ))->response()->setStatusCode(Response::HTTP_OK);
        }
    }

    public function update(UpdateChamadoRequest $request, int $id)
    {
        $chamado = Chamado::where('id_chamado', $id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        $dados = $request->validated();

        $chamado->update($dados);

        return (new ChamadoResource(
            $chamado->load(['usuario', 'categoria'])
        ))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function destroy( int $id){
        $chamado= Chamado::where('id_chamado',$id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        $chamado->delete();

        return response()->noContent();
    }
}