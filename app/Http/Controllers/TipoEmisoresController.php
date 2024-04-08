<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoEmisoresController extends Controller
{
    public function selectbuscarTipoEmisor(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $tipo_emisores = DB::table('tipo_emisores')
                            ->select('id','descripcion as nombretipoemisor')
                            ->where('emi_cod',$id)
                            ->where('estado','=','1')
                            ->orderBy('id','asc')
                            ->get();

        return ['tipo_emisores' => $tipo_emisores];
    }
    public function searchTypeEmisor(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $tipo_emisores = DB::table('tipo_emisores')
                            ->select('id','emi_cod','descripcion as nombretipoemisor')
                            ->where('emi_cod',$id)
                            ->where('estado','=','1')
                            ->orderBy('id','asc')
                            ->get();

        return response()->json($tipo_emisores);
    }
}
