<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoStatus extends Model
{
    use HasFactory;
    protected $table='historico_status';
    protected $primaryKey='id_historico';
    protected $fillable=[
        'id_historico',
        'status',
        'created_at',
        'chamado_id'
    ];

    public function chamado(){
        return $this->belongsTo(Chamado::class, 'chamado_id','id_chamado');
    }
}
