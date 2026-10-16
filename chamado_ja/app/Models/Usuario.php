<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;
    protected $table='usuarios';
    protected $primaryKey='id_usuario';
    public $timestamps = false;

    protected $fillable= [
        'id_usuario',
        'nome_usuario',
        'email',
        'senha'

    ];

    public function chamados(){
        return $this->hasMany(Chamado::class, 'usuario_id','id_usuario');
    }
    
}
