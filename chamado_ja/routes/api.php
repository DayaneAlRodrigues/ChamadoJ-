<?php
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

?>