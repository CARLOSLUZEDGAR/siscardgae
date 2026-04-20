<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronaveCertificacion extends Model
{
    protected $table = 'aeronave_certificacions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'id_aeronave', 
        'certificacion', 
        'fecha_emision', 
        'fecha_expiracion',  
        'observacion', 
        'estado', 
        'sysuser'
    ];
}
