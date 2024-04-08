<?php

namespace App\Http\Controllers;

use App\Datos_fisicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosFisicosController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->per_codigo;
        $criterio = $request->criterio;
        
        if($buscar==''){
            $datos_fisicos = Datos_fisicos::orderBy('id','desc')->get();
        }
        else{
            $datos_fisicos = Datos_fisicos::Where('per_codigo','=',$buscar)
            ->Where('estado','=','1')
            ->orderBy('id','desc')->get();
        }
        return response()->json(['datos_fisicos' => $datos_fisicos]);
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');
        $datos_fisicos = new Datos_fisicos();
        $datos_fisicos->per_codigo = $request->datfis_percodigo;
        $datos_fisicos->piel = $request->datfis_piel;
        $datos_fisicos->gs = $request->datfis_gs;
        $datos_fisicos->ojos = $request->datfis_ojos;
        $datos_fisicos->cabello = $request->datfis_cabello;
        $datos_fisicos->boca =$request->datfis_boca;
        $datos_fisicos->labios = $request->datfis_labios;
        $datos_fisicos->nariz = $request->datfis_nariz;
        $datos_fisicos->senaspart = $request->datfis_senaspart;
        $datos_fisicos->estatura = $request->datfis_estatura;
        $datos_fisicos->peso = $request->datfis_peso; 
        $datos_fisicos->enfermedad = $request->datfis_enfermedad;
        $datos_fisicos->alergias = $request->datfis_alergias;
        $datos_fisicos->contexturas = $request->datfis_contextura;
        $datos_fisicos->estado = '1';
        $datos_fisicos->observacion = $request->datfis_observacion;
        $datos_fisicos->sysuser = Auth::user()->id;    
        $datos_fisicos->save();
    }


    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');
        $datos_fisicos = Datos_fisicos::findOrFail($request->datfis_id);
        $datos_fisicos->per_codigo = $request->datfis_percodigo;
        $datos_fisicos->piel = $request->datfis_piel;
        $datos_fisicos->gs = $request->datfis_gs;
        $datos_fisicos->ojos = $request->datfis_ojos;
        $datos_fisicos->cabello = $request->datfis_cabello;
        $datos_fisicos->boca =$request->datfis_boca;
        $datos_fisicos->labios = $request->datfis_labios;
        $datos_fisicos->nariz = $request->datfis_nariz;
        $datos_fisicos->senaspart = $request->datfis_senaspart;
        $datos_fisicos->estatura = $request->datfis_estatura;
        $datos_fisicos->peso = $request->datfis_peso; 
        $datos_fisicos->enfermedad = $request->datfis_enfermedad;
        $datos_fisicos->alergias = $request->datfis_alergias;
        $datos_fisicos->contexturas = $request->datfis_contextura;
        $datos_fisicos->estado = '1';
        $datos_fisicos->observacion = $request->datfis_observacion;
        $datos_fisicos->sysuser = Auth::user()->id;    
        $datos_fisicos->save();
    }
}
