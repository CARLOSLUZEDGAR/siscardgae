<?php

namespace App\Http\Controllers;

use App\AeronaveDesignacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AeronaveDesignacionController extends Controller
{
    public function CrearAeronaveDesignacion(Request $request) //BASE
    {
        $aeronave_designacion = AeronaveDesignacion::create([
            'id_nacionalidad' => $request->pais,
            'entidad' => mb_strtoupper($request->entidad),
            'sigla' => mb_strtoupper($request->sigla),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
    }

    public function EditarAeronaveDesignacion(Request $request) //BASE
    {
        
    }

    public function EliminarAeronaveDesignacion(Request $request) //BASE
    {
        
    }

    public function ListarAeronaveDesignacion(Request $request) //BASE
    {
        $aeronave = $request->id_nacionalidad;
        
        $entidad = DB::table('entidads')
                ->select('id', 'id_nacionalidad', 'entidad', 'sigla')
                ->where('estado', 1)
                ->where('id_nacionalidad', $aeronave)
                ->orderBy('entidad', 'asc')
                ->get();
                return ['entidades' => $entidad];
    }
}
