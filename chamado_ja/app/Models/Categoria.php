<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categorias';
    protected $primaryKey='id_categoria';

    protected $fillable=[
        'id_categoria',
        'nome_categoria',
        'tipo'
    ];

    public function chamado(){
        return $this->hasMany('App/Chamado', 'id_categoria','categoria_id');
    }
}
