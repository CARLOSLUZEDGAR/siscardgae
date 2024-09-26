<?php

namespace App\Http\Controllers;
use App\TipoAeronave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TipoAeronaveController extends Controller
{
    public function CrearTipoAeronave(Request $request) //BASE
    {
        $entidad = TipoAeronave::create([
            'id_nacionalidad' => $request->pais,
            'entidad' => mb_strtoupper($request->entidad),
            'sigla' => mb_strtoupper($request->sigla),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
    }

    public function EditarTipoAeronave(Request $request) //BASE
    {
        
    }

    public function EliminarTipoAeronave(Request $request) //BASE
    {
        
    }

    public function ListarTipoAeronave(Request $request) //BASE
    {
        // $nacionalidad = $request->id_nacionalidad;
        
        $tipo_aeronave = DB::table('tipo_aeronave')
                ->select('id', 'tipo', 'observacion')
                ->where('estado', 1)
                // ->where('id_nacionalidad', $nacionalidad)
                ->orderBy('tipo', 'asc')
                ->get();
                return ['tipo_aeronaves' => $tipo_aeronave];
    }
}
