<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $resquest){
        $dados = $resquest->validate([
            'email'=> ['required', 'email'],
            'senha'=> ['required', 'string']
        ]);

        $usuario = Usuario::where('email', $dados['email'])->first();

        if(!$usuario || !Hash::check($dados['senha'], $usuario->senha)){
            return response()->json([
                'message' => 'Email ou senha inválidos!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $usuario->createToken('chamadoja')->plainTextToken;

        return response()->json([
            'message'=>'Login realizado com sucesso.',
            'usuario'=>[
                'id_usuario'=>$usuario->id_usuario,
                'nome_usuario'=>$usuario->nome_usuario,
                'email'=> $usuario->email
            ],
            'access_token'=> $token,
            'token_type'=>'Bearer'

        ], Response::HTTP_OK);

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'Logout realizado com sucesso.'
        ],Response::HTTP_OK);
    }
}
