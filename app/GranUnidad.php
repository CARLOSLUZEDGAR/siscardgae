<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GranUnidad extends Model
{
    protected $table = 'gran_unidads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_entidad', 'gran_unidad', 'abreviatura', 'estado', 'sysuser'
    ];
}
