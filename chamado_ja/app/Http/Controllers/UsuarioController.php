<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Hash;
use Symfony\Component\HttpFoundation\Response;


class UsuarioController extends Controller
{
    public function index(){
        $usuarios = Usuario::all();
        return (new UsuarioResource($usuarios))
        ->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreUsuarioRequest $request){

        $dados = $request->validated();

        $dados['senha'] = Hash::make($dados['senha']);

        $usuario = Usuario::create($dados);

        return (new UsuarioResource($usuario))
        ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(int $id){
        $usuario = Usuario::where('id_usuario', $id)->first();

        if(!$usuario){
            return response()->json([
                'message'=> 'Usuário não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        if($usuario){
            return (new UsuarioResource($usuario))
            ->reponse()->setStatusCode(Response::HTTP_OK);
        }
    }
}
