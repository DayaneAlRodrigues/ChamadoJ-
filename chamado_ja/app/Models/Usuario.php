<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use  HasApiTokens,HasFactory, Notifiable;
    protected $table='usuarios';
    protected $primaryKey='id_usuario';
    public $timestamps = false;

    protected $fillable= [
        'nome_usuario',
        'email',
        'senha'

    ];

    protected $hidden = [
        'senha',
    ];

    public function chamados(){
        return $this->hasMany(Chamado::class, 'usuario_id','id_usuario');
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
    
}
