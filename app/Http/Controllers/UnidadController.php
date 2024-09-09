<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadController extends Controller
{
    public function CrearUnidad(Request $request) //BASE
    {
        // $entidad = Entidad::create([
        //     'id_nacionalidad' => $request->pais,
        //     'entidad' => mb_strtoupper($request->entidad),
        //     'sigla' => mb_strtoupper($request->sigla),
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);
    }

    public function EditarUnidad(Request $request) //BASE
    {
        
    }

    public function EliminarUnidad(Request $request) //BASE
    {
        
    }

    public function ListarUnidad(Request $request) //BASE
    {
        $gran_unidad = $request->id_gran_unidad;
        
        $unidad = DB::table('unidads')
                ->select('id', 'id_gran_unidad', 'unidad', 'abreviatura')
                ->where('estado', 1)
                ->where('id_gran_unidad', $gran_unidad)
                ->orderBy('unidad', 'asc')
                ->get();
                return ['unidades' => $unidad];
    }
}
