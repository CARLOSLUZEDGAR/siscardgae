<?php

namespace App\Http\Controllers;

use App\PersonalFalta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalFaltaController extends Controller
{
    public function ReportePromocion()
    {
        // $personas = DB::table('personals as p')
        //     ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
        //     ->join('grados as g','pe.gra_cod','g.id')
        //     ->select('p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm','p.per_codigo','g.abreviatura as grado')            
        //     ->where('p.per_cm','LIKE',$request->cm.'%')
        //     ->where('pe.estado',1)
        //     ->orderBy('p.per_cm')
        //     ->get();
        // $data = [];
        // foreach ($personas as $key => $value) {
        //     $data[$key] = [
        //         'persona' => $value->grado.' '.$value->nombre.' '.$value->paterno.' '.$value->materno,
        //         'faltas' => DB::table('personal_faltas')->where('per_codigo',$value->per_codigo)->get() 
        //     ];
        // }
        
        
        // return response()->json($data);

        // $data = PersonalFalta::all();
        $data = DB::table('personal_faltas')
            ->select('id','per_codigo')
            ->orderBy('id','desc')
            ->where('f1_cod',1)
            ->get();

        return response()->json($data);
    }
}
