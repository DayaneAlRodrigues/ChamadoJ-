<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Http\Resources\ComentarioResource;
use App\Models\Comentario;
use Symfony\Component\HttpFoundation\Response;

class ComentarioController extends Controller
{
    public function store(StoreComentarioRequest $request)
    {
        $comentario = Comentario::create(
            $request->validated()
        );

        return (new ComentarioResource(
            $comentario->load('chamado')
        ))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}