<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'categoria', 'observacion', 'estado', 'sysuser'
    ];
}
