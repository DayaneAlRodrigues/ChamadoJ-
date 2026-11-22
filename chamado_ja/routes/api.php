<?php
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HistoricoStatusController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AuthController;

//ROTAS PUBLICAS

Route::get('/saude', function (): JsonResponse {
    return response()->json([
        'dados' => [
            'aplicacao' => 'ChamadoJá',
            'status' => 'funcionando',
                ],
        ]);
    });
//cadastro de usuario
Route::post('/usuarios', [UsuarioController::class, 'store']);
//login
Route::post('/login', [AuthController::class,'login']);

//rotas protegidas
Route::middleware('auth:sanctum')->group(function(){
    // logout
    Route::post('/logout', [AuthController::class,'logout']);

    //usuarios
    Route::get('/usuarios', [UsuarioController::class,'index']);
    Route::get('/usuarios/{id}', [UsuarioController::class,'show']);

    //categorias
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::post('/categorias',[CategoriaController::class,'store']);
    Route::get('/categorias/{id}', [CategoriaController::class,'show']);

    //chamados
    Route::get('/chamados', [ChamadoController::class, 'index']);
    Route::post('/chamados',[ChamadoController::class,'store']);
    Route::get('/chamados/{id}', [ChamadoController::class, 'show']);
    Route::patch('/chamados/{id}', [ChamadoController::class,'update']);
    Route::delete('/chamados/{id}', [ChamadoController::class, 'destroy']);
    Route::patch('/chamados/{id}/status', [ChamadoController::class, 'updateStatus']);

    //comentarios
    Route::get('/chamados/{id}/comentarios', [ComentarioController::class, 'index']);
    Route::post('/chamados/{id}/comentarios', [ComentarioController::class, 'store']);

    //historico
    Route::get('chamados/{id}/historico', [HistoricoStatusController::class, 'index']);

    //resumo
    Route::get('/relatorios/resumo-chamados',[RelatorioController::class,'resumoDeChamados']);
});








?>