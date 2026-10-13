<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $table='chamados';
    protected $primaryKey='id_chamado';
    protected $fillable=[
        'id_chamado',
        'titulo',
        'descricao',
        'status',
        'prioridade',
        'created_at',
        'updated_at',
        'usuario_id',
        'categoria_id'
    ];
}
