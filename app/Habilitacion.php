<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilitacion extends Model
{
    protected $table = 'habilitacions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_licencia', 'habilitacion', 'observacion', 'estado', 'sysuser'
    ];
}
