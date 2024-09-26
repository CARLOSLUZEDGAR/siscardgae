<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CondicionAeronave extends Model
{
    protected $table = 'condicion_aeronave';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'condicion', 'observacion', 'estado', 'sysuser'
    ];
}
