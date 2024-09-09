<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_gran_unidad', 'unidad', 'abreviatura', 'orden', 'estado', 'sysuser'
    ];
}
