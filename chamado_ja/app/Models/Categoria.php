<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table='categorias';
    protected $primaryKey='id_categoria';
     public $timestamps = false;

    protected $fillable=[
        'id_categoria',
        'nome_categoria',
        'tipo'
    ];

    public function chamados(){
        return $this->hasMany(Chamado::class, 'categoria_id','id_categoria');
    }
}
