<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalLicencia extends Model
{
    protected $table = 'personal_licencias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_personal', 'id_categoria', 'id_entidad', 'id_grado', 
        'id_licencia', 'id_habilitacion', 'id_comp_linguistica', 
        'observacion', 'fecha_emision', 'fecha_expiracion', 'estado', 'sysuser'
    ];
}
