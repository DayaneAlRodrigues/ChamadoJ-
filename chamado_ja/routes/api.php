<?php
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadoController;
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

Route::get('/api/usuarios', [UsuarioController::class,'index']);
Route::post('/api/usuarios', [UsuarioController::class, 'store']);

Route::get('/api/categorias', [CategoriaController::class, 'index']);
Route::post('/api/categorias',[CategoriaController::class,'store']);

Route::get('/api/chamados', [ChamadoController::class, 'index']);
Route::post('/api/chamados',[ChamadoController::class,'store']);
Route::get('/api/chamados/{id}', [ChamadoController::class, 'show']);
Route::patch('/api/chamados/{id}', [ChamadoController::class,'update']);
Route::delete('/chamados/{id}', [ChamadoController::class, 'destroy']);

?>