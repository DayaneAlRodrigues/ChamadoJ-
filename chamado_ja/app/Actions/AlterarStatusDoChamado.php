<?php

namespace App\Actions;

use App\Models\Chamado;
use Illuminate\Support\Facades\DB;
use DomainException;

final class AlterarStatusDoChamado
{
    public function executar(
        Chamado $chamado,
        string $novoStatus,
    ): Chamado {
        $transicoesPermitidas = [
            'aberto' => ['em_atendimento'],
            'em_atendimento' => ['resolvido'],
            'resolvido' => ['fechado', 'em_atendimento'],
            'fechado' => [],
        ];

        $permitidos = $transicoesPermitidas[$chamado->status] ?? [];

        if (!in_array($novoStatus, $permitidos, true)) {
            throw new DomainException(
                'Transição de status não permitida.'
            );
        }

        return DB::transaction(function () use (
            $chamado,
            $novoStatus
        ): Chamado {

            $chamado->update([
                'status' => $novoStatus,
            ]);

            $chamado->historicosStatus()->create([
                'status' => $novoStatus,
            ]);

            return $chamado->refresh();
        });
    }
}
