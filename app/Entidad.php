<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_nacionalidad', 'entidad', 'sigla', 'estado', 'sysuser'
    ];
}
