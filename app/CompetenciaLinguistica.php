<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetenciaLinguistica extends Model
{
    protected $table = 'competencia_linguisticas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'nivel', 'traduccion', 'observacion', 'estado', 'sysuser'
    ];
}
