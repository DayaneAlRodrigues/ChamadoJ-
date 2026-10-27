<?php
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

Route::get('/saude', function (): JsonResponse {
    return response()->json([
        'dados' => [
            'aplicacao' => 'ChamadoJá',
            'status' => 'funcionando',
                ],
        ]);
    });

Route::get('/usuarios', [UsuarioController::class,'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class,'show']);

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias',[CategoriaController::class,'store']);
Route::get('/categorias/{id}', [CategoriaController::class,'show']);

Route::get('/chamados', [ChamadoController::class, 'index']);
Route::post('/chamados',[ChamadoController::class,'store']);
Route::get('/chamados/{id}', [ChamadoController::class, 'show']);
Route::patch('/chamados/{id}', [ChamadoController::class,'update']);
Route::delete('/chamados/{id}', [ChamadoController::class, 'destroy']);

Route::post('/chamados/{id}/comentarios', [ComentarioController::class, 'store']);

?>