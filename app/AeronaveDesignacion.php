<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronaveDesignacion extends Model
{
    protected $table = 'aeronave_designacions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'id_aeronave', 
        'id_aeronave_cert',
        'matricula', 
        'id_entidad', 
        'id_g_unidad', 
        'id_unidad', 
        'fecha_designacion', 
        'documento', 
        'nro_documento', 
        'observacion', 
        'estado', 
        'sysuser'
    ];
}
