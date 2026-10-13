<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoStatus extends Model
{
    protected $table='historico_status';
    protected $primaryKey='id_historico';
    protected $fillable=[
        'id_historico',
        'status',
        'created_at',
        'chamado_id',
        'usuario_id'
    ];
}
