<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Usuario;
use Hash;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function store(StoreUsuarioRequest $request){

        $dados = $request->validated();

        $dados['senha'] = Hash::make($dados['senha']);

        $usuario = Usuario::create($dados);

        return response()->json($usuario, 201);
    }
}
