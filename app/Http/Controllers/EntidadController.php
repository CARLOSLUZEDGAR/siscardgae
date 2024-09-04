<?php

namespace App\Http\Controllers;

use App\Entidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EntidadController extends Controller
{
    public function CrearEntidad(Request $request) //BASE
    {
        $entidad = Entidad::create([
            'id_nacionalidad' => $request->pais,
            'entidad' => mb_strtoupper($request->entidad),
            'sigla' => mb_strtoupper($request->sigla),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
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
