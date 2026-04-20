<?php

namespace App\Http\Controllers;

use App\AeronaveCondicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AeronaveCondicionController extends Controller
{
    public function CrearAeronaveCondicion(Request $request) //BASE
    {
        $aeronave_designacion = AeronaveCondicion::create([
            'id_nacionalidad' => $request->pais,
            'entidad' => mb_strtoupper($request->entidad),
            'sigla' => mb_strtoupper($request->sigla),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
    }

    public function EditarAeronaveCondicion(Request $request) //BASE
    {
        
    }

    public function EliminarAeronaveCondicion(Request $request) //BASE
    {
        
    }

    public function ListarAeronaveCondicion(Request $request) //BASE
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
