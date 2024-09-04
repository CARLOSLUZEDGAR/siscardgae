<?php

namespace App\Http\Controllers;

use App\GranUnidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GranUnidadController extends Controller
{
    public function CrearGranUnidad(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarGranUnidad(Request $request) //BASE
    {
        
    }

    public function EliminarGranUnidad(Request $request) //BASE
    {
        
    }

    public function ListarGranUnidad(Request $request) //BASE
    {
        $entidad = $request->id_entidad;
        
        $gran_unidad = DB::table('gran_unidads')
                ->select('id', 'id_entidad', 'gran_unidad', 'abreviatura')
                ->where('estado', 1)
                ->where('id_entidad', $entidad)
                ->orderBy('gran_unidad', 'asc')
                ->get();
                return ['gran_unidades' => $gran_unidad];
    }
}
