<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table='comentarios';
    protected $primaryKey='id_comentario';
    protected $fillable=[
        'id_comentario',
        'comentario',
        'created_at',
        'chamado_id'
    ];

    public function chamado(){
        return $this->belongsTo(Chamado::class, 'chamado_id','id_chamado');
    }
}
