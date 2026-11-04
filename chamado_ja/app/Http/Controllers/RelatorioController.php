<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class RelatorioController extends Controller
{
    public function resumoDeChamados(){    
        // Total de chamados
        $total = Chamado::count();

        // Quantidade de chamados agrupados por status
        $porStatus = DB::table('chamados')
            ->select('status', DB::raw('COUNT(*) as quantidade'))
            ->groupBy('status')
            ->pluck('quantidade', 'status');

        return response()->json([
            'dados' => [
                'total' => $total,
                'por_status' => [
                    'aberto' => $porStatus->get('aberto', 0),
                    'em_atendimento' => $porStatus->get('em_atendimento', 0),
                    'resolvido' => $porStatus->get('resolvido', 0),
                    'fechado' => $porStatus->get('fechado', 0),
                ]
            ]
        ], Response::HTTP_OK);
    }
}
