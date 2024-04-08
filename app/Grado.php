<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_entidad', 'nombre', 'abreviatura', 'estado', 'sysuser'
    ];
}
