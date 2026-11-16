<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoricoStatusResource;
use App\Models\HistoricoStatus;
use Symfony\Component\HttpFoundation\Response;

class HistoricoStatusController
{
    public function index(){
        $historicos = HistoricoStatus::with('chamado')->get();
        
        return HistoricoStatusResource::collection($historicos)
            -> response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
