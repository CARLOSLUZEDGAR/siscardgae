<?php

namespace App\Http\Controllers;

use App\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    public function selectLocalidad(Request $request){
        // if(!$request->ajax()) return view('/');
         $localidad = Localidad::where('estado','=','1')
         ->select('id','nombre')->orderBy('nombre','asc')->get();
         return['localidad' => $localidad];
    }


    public function selectbuscarLocalidad(Request $request){

    $buscar = $request->buscar;
    

    // if (!$request->ajax()) return redirect('/');
    $localidad = Localidad::where('prov_codigo','=',$buscar)
    ->select('id','nombre')->orderBy('nombre', 'asc')->get();
    return ['localidad' => $localidad];
    }
    
    public function selectbuscarLoca(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        
        $localidad = Localidad::where('id','=',$buscar)
        ->where('estado','=','1')
        ->select('id','nombre')->orderBy('id', 'asc')->get();
        return ['localidad' => $localidad];
    } 
}
