<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoricoStatusResource;
use App\Models\HistoricoStatus;
use Illuminate\Http\Request;

class HistoricoStatusController
{
    public function index(){
        $historicos = HistoricoStatus::with('chamado')->get();
        
        return HistoricoStatusResource::collection($historicos)
            -> response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
