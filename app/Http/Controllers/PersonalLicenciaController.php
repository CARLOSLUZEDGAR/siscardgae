<?php

namespace App\Http\Controllers;

use App\PersonalLicencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonalLicenciaController extends Controller
{
    public function CrearEntidad(Request $request) //BASE
    {

    }

    public function EditarEntidad(Request $request) //BASE
    {
        
    }

    public function EliminarEntidad(Request $request) //BASE
    {
        
    }

    public function ListarEntidad(Request $request) //BASE
    {
        $nacionalidad = $request->id_nacionalidad;
        
        $entidad = DB::table('entidads')
                ->select('id', 'id_nacionalidad', 'entidad', 'sigla')
                ->where('estado', 1)
                ->where('id_nacionalidad', $nacionalidad)
                ->orderBy('entidad', 'asc')
                ->get();
                return ['entidades' => $entidad];
    }
}
