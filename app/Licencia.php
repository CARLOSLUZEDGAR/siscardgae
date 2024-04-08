<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    protected $table = 'licencias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_categoria', 'licencia', 'traduccion', 'observacion', 'estado', 'sysuser'
    ];
}
