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

    public function usuario(){
        return $this->belongsTo('App/Usuario', 'usuario_id', 'id_usuario');
    }

    public function categoria(){
        return $this->belongsTo('App/Categoria','categoria_id','id_categoria');
    }

    public function comentario(){
        return $this->hasMany('App/Comentario', 'id_chamado', 'chamado_id');
    }

    public function historico(){
        return $this->hasMany('App/HistoricoStatus', 'id_chamado','chamado_id');
    }
}
