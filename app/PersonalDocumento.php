<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDocumento extends Model
{
    protected $table = 'personal_documentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_personal', 'id_licencia', 'documento', 'observacion', 'estado', 'sysuser'
    ];
}
