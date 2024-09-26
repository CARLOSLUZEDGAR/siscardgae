<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAeronave extends Model
{
    protected $table = 'tipo_aeronave';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'tipo', 'observacion', 'estado', 'sysuser'
    ];
}
