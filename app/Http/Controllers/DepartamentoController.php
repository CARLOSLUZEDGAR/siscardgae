<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function selectDepartamento(Request $request){
        // if(!$request->ajax()) return view('/');
         $departamento = Departamento::where('estado','=','1')
         ->select('id','nombre')->orderBy('nombre','asc')->get();
         return['departamento' => $departamento];
    }

    public function selectbuscarDepartamento(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        
        $departamento = Departamento::where('id','=',$buscar)
        ->where('estado','=','1')
        ->select('id','nombre','abreviatura')->orderBy('id', 'asc')->get();
        return ['departamento' => $departamento];
    } 
}
