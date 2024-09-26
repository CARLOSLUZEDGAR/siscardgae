<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronaveMotor extends Model
{
    protected $table = 'aeronave_motors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_aeronave', 'posicion', 'fabricacion', 'modelo', 'serie', 'observacion', 'estado', 'sysuser'
    ];
}
