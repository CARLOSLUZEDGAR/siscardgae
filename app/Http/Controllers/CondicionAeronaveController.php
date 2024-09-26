<?php

namespace App\Http\Controllers;

use App\CondicionAeronave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CondicionAeronaveController extends Controller
{
    public function CrearCondicionAeronave(Request $request) //BASE
    {
        $entidad = CondicionAeronave::create([
            'id_nacionalidad' => $request->pais,
            'entidad' => mb_strtoupper($request->entidad),
            'sigla' => mb_strtoupper($request->sigla),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
    }

    public function EditarCondicionAeronave(Request $request) //BASE
    {
        
    }

    public function EliminarCondicionAeronave(Request $request) //BASE
    {
        
    }

    public function ListarCondicionAeronave(Request $request) //BASE
    {
        // $nacionalidad = $request->id_nacionalidad;
        
        $condicion_aeronave = DB::table('condicion_aeronave')
                ->select('id', 'condicion', 'observacion')
                ->where('estado', 1)
                // ->where('id_nacionalidad', $nacionalidad)
                ->orderBy('condicion', 'asc')
                ->get();
                return ['condicion_aeronaves' => $condicion_aeronave];
    }
}
