<?php

namespace App\Http\Controllers;

use App\Tribunales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TribunalesController extends Controller
{
    public function listarMiembTrib(Request $request)
    {
        if(!$request->ajax()) return view('/');


        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $tribunales = DB::table('tribunales as t')
                            ->join('subescalafones as se','t.subesc_cod','se.id')
                            ->select('t.id','t.subesc_cod','t.descripcion','t.clasificacion',
                                    't.puntaje','t.observacion','t.estado','se.nombre')
                            ->orderBy('t.id','asc')
                            ->paginate(10);
        }
        else{
            $tribunales = DB::table('tribunales as t')
                            ->join('subescalafones as se','t.subesc_cod','se.id')
                            ->select('t.id','t.subesc_cod','t.descripcion','t.clasificacion',
                                    't.puntaje','t.observacion','t.estado','se.nombre')
                            ->where($criterio, 'like', '%'.$buscar.'%')
                            ->orderBy('t.id','asc')
                            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         =>  $tribunales->total(),
                'current_page'  =>  $tribunales->currentPage(),
                'per_page'      =>  $tribunales->perPage(),
                'last_page'     =>  $tribunales->lastPage(),
                'from'          =>  $tribunales->firstItem(),
                'to'            =>  $tribunales->lastItem(),
            ],
            'tribunales'          =>  $tribunales
        ];
    }

    public function listaSubEsca(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $subescalafones = DB::table('subescalafones')
                            ->select('id','nombre')
                            ->where('id','1')
                            ->orWhere('id','2')
                            ->orWhere('id','4')
                            ->orWhere('id','21')
                            ->orderBy('id','asc')
                            ->get();

        return response()->json($subescalafones);
    }

    public function listarMiembroTribunal(Request $request)
    {
       if(!$request->ajax()) return view('/');

        $subesc = $request->subescalafon;
        $tribunales = DB::table('tribunales')
                        ->select('id','descripcion as nombre')
                        ->where('subesc_cod',$subesc)
                        ->where('estado','1')
                        ->orderBy('descripcion','asc')
                        ->get();

       return response()->json($tribunales);
    //    return ['tribunales' => $tribunales];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        //validacion
        $this->validate($request, [
            "valorSubEsc"   =>  "required",
            "clasificacion" =>  "required"
        ]);

        $nuevo_tribunal                 =   new Tribunales();

        $nuevo_tribunal->descripcion    =   $request->descripcion;
        $nuevo_tribunal->clasificacion  =   $request->clasificacion;
        $nuevo_tribunal->subesc_cod     =   $request->valorSubEsc;

        $val2 = $request->puntaje;

        if($val2 == ''){
            $val2 = 0;
        }
        else{
            $val2 = $request->puntaje;
        }

        $nuevo_tribunal->puntaje        =   $val2;

        $val = $request->observacion;

        if($val == ''){
            $val = 'NINGUNA';
        }
        else{
            $val = $request->observacion;
        }

        $nuevo_tribunal->observacion    =   $val;
        $nuevo_tribunal->estado         =   1;
        $nuevo_tribunal->sysuser        =   Auth::user()->id;

        $nuevo_tribunal->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $nuevo_tribunal                 =   Tribunales::findOrFail($request->id);

        $nuevo_tribunal->descripcion    =   $request->descripcionA;
        $nuevo_tribunal->clasificacion  =   $request->clasificacionA;
        $nuevo_tribunal->subesc_cod     =   $request->valorSubEscA;
        $nuevo_tribunal->puntaje        =   $request->puntajeA;
        $nuevo_tribunal->observacion    =   $request->observacionA;
        $nuevo_tribunal->sysuser        =   Auth::user()->id;

        $nuevo_tribunal->save();
    }
}
