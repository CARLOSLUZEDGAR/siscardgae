<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronaveDocumento extends Model
{
    protected $table = 'aeronave_documentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'id_aeronave', 
        'documento', 
        'observacion', 
        'estado', 
        'sysuser'
    ];
}
