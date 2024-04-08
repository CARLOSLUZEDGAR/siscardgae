<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaltasController extends Controller
{
    public function Faltas1()
    {
        $falta1 = DB::table('nivel1_faltas')
            ->select('id','descripcion')
            ->where('estado',1)
            ->orderBy('descripcion')
            ->get();
        
        return response()->json($falta1);
    }

    public function Faltas2(Request $request)
    {
        $falta1 = $request->falta1;
        $nivel = $request->nivel;
        $falta2 = DB::table('nivel2_faltas')
            ->select('id','descripcion')
            ->where('f1_cod',$falta1)
            ->where('clasificacion','<',$nivel)
            ->where('estado',1)
            ->orderBy('descripcion')
            ->get();
        
        return response()->json($falta2);
    }

    public function Sancion(Request $request)
    {
        $nivel = $request->nivel;
        $sancion = DB::table('sanciones')
            ->select('id','descripcion')
            ->where('nivel','<',$nivel)
            ->where('estado',1)
            ->orderBy('descripcion')
            ->get();

        return response()->json($sancion);
    }
}
