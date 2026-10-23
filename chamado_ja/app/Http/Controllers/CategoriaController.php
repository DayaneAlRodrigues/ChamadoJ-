<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use Symfony\Component\HttpFoundation\Response;


class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();

        return (new CategoriaResource($categorias))
        ->response()->setStatusCode(Response::HTTP_OK);

    }

    public function store(StoreCategoriaRequest $request){
        $dados = $request->validated();

        $categoria = Categoria::create($dados);

        return (new CategoriaResource($categoria))
        ->response()->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(int $id){
        $categoria = Categoria::where('id_categoria', $id);

        if(!$categoria){
            return response()->json([
                'message'=> 'Categoria não encontrada'
            ], Response::HTTP_NOT_FOUND);
        }

        if($categoria){
            return (new CategoriaResource($categoria))
            ->response()->setStatusCode(Response::HTTP_OK);
        }
    }
}
