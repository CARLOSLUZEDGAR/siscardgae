<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaAeronave extends Model
{
    protected $table = 'categoria_aeronave';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'categoria', 'observacion', 'estado', 'sysuser'
    ];
}
