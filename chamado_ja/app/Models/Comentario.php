<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table='comentarios';
    protected $primaryKey='id_comentario';
    protected $fillable=[
        'id_comentario',
        'comentario',
        'created_at',
        'chamado_id'
    ];

    public function chamado(){
        return $this->belongsTo('App/Chamado', 'chamado_id', 'id_chamado');
    }
}
