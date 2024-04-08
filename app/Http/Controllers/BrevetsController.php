<?php

namespace App\Http\Controllers;

use App\Brevets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrevetsController extends Controller
{
    public function listarBrevets(Request $request)
    {
        //LISTANDO LOS BREVETS DE ACUERDO AL SUBESCA CODIGO
        if(!$request->ajax()) return view('/');

        $subesc = $request->subescalafon;
        $brevets = DB::table('brevets')
                        ->select('id','descripcion')
                        ->where('subesc_cod',$subesc)
                        ->where('estado','1')
                        ->get();

        return response()->json($brevets);
    }

    public function listadoBrevets(Request $request)
    {
        //LISTANDO LOS BREVETS DE LA TABLA DE BREVETS
        if(!$request->ajax()) return view('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $brevets = DB::table('brevets as b')
                            ->join('subescalafones as se','b.subesc_cod','se.id')
                            ->select('b.id as idb','b.subesc_cod','b.descripcion',
                                    'b.puntaje','b.asignacion','b.clasificacion',
                                    'b.observacion','b.estado','se.nombre')
                            ->where('b.estado','=','1')
                            ->orderBy('b.id','asc')
                            ->paginate(10);
        }
        else{
            $brevets = DB::table('brevets as b')
                            ->join('subescalafones as se','b.subesc_cod','se.id')
                            ->select('b.id as idb','b.subesc_cod','b.descripcion',
                                    'b.puntaje','b.asignacion','b.clasificacion',
                                    'b.observacion','b.estado','se.nombre')
                            ->where('b.estado','=','1')
                            ->where($criterio, 'like', '%'.$buscar.'%')
                            ->orderBy('b.id','asc')
                            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         =>  $brevets->total(),
                'current_page'  =>  $brevets->currentPage(),
                'per_page'      =>  $brevets->perPage(),
                'last_page'     =>  $brevets->lastPage(),
                'from'          =>  $brevets->firstItem(),
                'to'            =>  $brevets->lastItem(),
            ],
            'brevets'          =>  $brevets
        ];
    }

    //LISTA SUB ESCALAFONES EN LA TABLA DE CREAR UN NUEVO BREVET
    public function listarSubEsca(Request $request)
    {
       if(!$request->ajax()) return view('/');

        $subescalafones = DB::table('subescalafones')
                            ->select('id','nombre')
                            ->orWhere('id','2')
                            ->orWhere('id','3')
                            ->orWhere('id','4')
                            ->orWhere('id','5')
                            ->orWhere('id','6')
                            ->orWhere('id','21')
                            ->orderBy('id','asc')
                            ->get();

        return ['subescalafones' => $subescalafones];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $descripcionbrevet  = $request->descripcion;
        $SubEsc             = $request->valorSubEsc;

        $nuevo_brevet = Brevets::select('descripcion','subesc_cod')
                                ->where('descripcion',$descripcionbrevet)
                                ->where('subesc_cod',$SubEsc)
                                ->first();
        if(!empty($nuevo_brevet)){
            return response()->json("existe");
        }else{
            $nuevo_brevet                   =   new Brevets();

            $nuevo_brevet->descripcion      =   $request->descripcion;
            $nuevo_brevet->subesc_cod       =   $request->valorSubEsc;

            $val = $request->puntaje;

            if($val == ''){
                $val = 0;
            }
            else{
                $val = $request->puntaje;
            }

            $nuevo_brevet->puntaje          =   $val;
            $nuevo_brevet->asignacion       =   $request->asignacion;
            $nuevo_brevet->clasificacion    =   $request->clasificacion;

            $val1 = $request->observacion;

            if($val1 == ''){
                $val1 = 'NINGUNA';
            }
            else{
                $val1 = $request->observacion;
            }
            $nuevo_brevet->observacion      =   $val1;
            $nuevo_brevet->estado           =   1;
            $nuevo_brevet->sysuser          =   Auth::user()->id;


            $nuevo_brevet->save();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $id = $request->id;
        $descripcionbrevet = $request->descripcionA;
        $SubEsc = $request->subesc_cod;
        $nuevo_brevet = Brevets::select('descripcion','subesc_cod')
                                ->where('descripcion', $descripcionbrevet)
                                ->where('subesc_cod', $SubEsc)
                                ->whereNotIn('id', [$id])
                                ->first();
        if(!empty($nuevo_brevet)){
            return response()->json("existe");
        } else {
            $nuevo_brevet                   =   Brevets::findOrFail($request->id);

            $nuevo_brevet->descripcion      =   $request->descripcionA;
            $nuevo_brevet->subesc_cod       =   $request->subesc_cod;
            $nuevo_brevet->puntaje          =   $request->puntajeA;
            $nuevo_brevet->asignacion       =   $request->asignacionA;
            $nuevo_brevet->clasificacion    =   $request->clasificacionA;

            $val1 = $request->observacion;

            if($val1 == ''){
                $val1 = 'NINGUNA';
            }
            else{
                $val1 = $request->observacion;
            }
            $nuevo_brevet->observacion      =   $val1;

            $nuevo_brevet->sysuser          =   Auth::user()->id;

            $nuevo_brevet->save();
        }
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $nuevo_brevet         = Brevets::findOrFail($request->idb);
        $nuevo_brevet->estado = $request->estado;

        $nuevo_brevet->save();
    }
}
