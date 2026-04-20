<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AeronaveCondicion extends Model
{
    protected $table = 'aeronave_condicions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'id_aeronave', 
        'id_aeronave_cert',
        'id_condicion', 
        'observacion', 
        'estado', 
        'sysuser'
    ];
}
