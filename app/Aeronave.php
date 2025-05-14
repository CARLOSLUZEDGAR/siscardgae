<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    protected $table = 'aeronaves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'fabrica', 
        'modelo', 
        'serie', 
        'id_tipo_aeronave', 
        'id_categoria_aeronave', 
        'id_condicion_aeronave', 
        'fotografia', 
        'estado', 
        'sysuser'
    ];
}
