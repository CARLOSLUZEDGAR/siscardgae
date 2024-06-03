<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    protected $table = 'aeronaves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'matricula', 'modelo', 'nombre', 'fotografia', 'estado', 'sysuser'
    ];
}
