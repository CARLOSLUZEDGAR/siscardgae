<?php

namespace App\Http\Controllers;

use App\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function selectProvincia(Request $request){
        // if(!$request->ajax()) return view('/');
         $provincia = Provincia::where('estado','=','1')
         ->select('id','nombre')->orderBy('nombre','asc')->get();
         return['provincia' => $provincia];
    }


    public function selectbuscarProvincia(Request $request){

        $buscar = $request->buscar;
        // if (!$request->ajax()) return redirect('/');
        $provincia = Provincia::where('depa_codigo','=',$buscar)
        ->where('estado','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['provincia' => $provincia];
    }

    public function selectbuscarProv(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        
        $provincia = Provincia::where('id','=',$buscar)
        ->where('estado','=','1')
        ->select('id','nombre')->orderBy('id', 'asc')->get();
        return ['provincia' => $provincia];
    } 
}
