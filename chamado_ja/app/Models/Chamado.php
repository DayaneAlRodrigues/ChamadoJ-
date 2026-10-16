<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;
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
        return $this->belongsTo(Usuario::class, 'usuario_id','id_usuario');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class,'categoria_id','id_categoria');
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class, 'chamado_id','id_chamado');
    }

    public function historicos(){
        return $this->hasMany(HistoricoStatus::class, 'chamado_id','id_chamado');
    }
}
