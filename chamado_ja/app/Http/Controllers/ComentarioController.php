<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Http\Resources\ComentarioResource;
use App\Models\Comentario;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Chamado;

class ComentarioController extends Controller
{
    public function index(){
        $comentarios = Comentario::with('chamado')->get();

        return ComentarioResource::collection($comentarios)
            -> response()
            ->setStatusCode(Response::HTTP_OK);
    }
    
    public function store(StoreComentarioRequest $request, int $id)
    {
        $chamado = Chamado::where('id_chamado', $id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        $comentario = $chamado->comentarios()->create(
            $request->validated()
        );

        return (new ComentarioResource(
            $comentario->load('chamado')
        ))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}