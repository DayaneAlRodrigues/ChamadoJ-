<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriaRequest;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();

        return response()->json($categorias);

    }

    public function store(StoreCategoriaRequest $request){
        $dados = $request->validated();

        $categoria = Categoria::create($dados);

        return response()->json($categoria,201);

    }
}
