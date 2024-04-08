<?php

namespace App\Http\Controllers;

use App\DesgloseCursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesgloseCursosController extends Controller
{
    public function listDesgloseCurso(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $desglose_cursos = DB::table('desgloce_cursos as dc')
                                    ->join('tipo_cursos as tc','dc.tipcur_cod','tc.id')
                                    ->select('dc.id as iddc','dc.descripcion','dc.puntaje','dc.estado',
                                             'dc.tipcur_cod','tc.id as idtc','tc.descripcion as nombretipocurso')
                                    ->orderBy('dc.id','asc')
                                    ->paginate(10);
        }
        else{
            $desglose_cursos = DB::table('desgloce_cursos as dc')
                                    ->join('tipo_cursos as tc','dc.tipcur_cod','tc.id')
                                    ->select('dc.id as iddc','dc.descripcion','dc.puntaje','dc.estado',
                                             'dc.tipcur_cod','tc.id as idtc','tc.descripcion as nombretipocurso')
                                    ->where($criterio, 'like', '%'.$buscar.'%')
                                    ->orderBy('dc.id','asc')
                                    ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         =>  $desglose_cursos->total(),
                'current_page'  =>  $desglose_cursos->currentPage(),
                'per_page'      =>  $desglose_cursos->perPage(),
                'last_page'     =>  $desglose_cursos->lastPage(),
                'from'          =>  $desglose_cursos->firstItem(),
                'to'            =>  $desglose_cursos->lastItem(),
            ],
            'desglose_cursos'          =>  $desglose_cursos
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $descripciondesglosecurso = $request->descripcion;

        $nuevo_desglose_cursos = DesgloseCursos::select('descripcion')
                                                ->where('descripcion',$descripciondesglosecurso)
                                                ->first();
        if(!empty($nuevo_desglose_cursos)){
            return response()->json("existe");
        }else{
            $nuevo_desglose_cursos              =   new DesgloseCursos();

            $nuevo_desglose_cursos->tipcur_cod  =   $request->valorTipoCurso;
            $nuevo_desglose_cursos->descripcion =   $request->descripcion;

            $val = $request->puntaje;

            if($val == ''){
                $val = 0;
            }
            else{
                $val = $request->puntaje;
            }

            $nuevo_desglose_cursos->puntaje     =   $val;
            $nuevo_desglose_cursos->estado      =   1;
            $nuevo_desglose_cursos->sysuser     =   Auth::user()->id;

            $nuevo_desglose_cursos->save();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $id = $request->id;
        $descripciondesglosecurso   = $request->descripcionA;
        $nuevo_desglose_cursos      = DesgloseCursos::select('descripcion')
                                                    ->where('descripcion', $descripciondesglosecurso)
                                                    ->whereNotIn('id', [$id])
                                                    ->first();
        if(!empty($nuevo_desglose_cursos)){
            return response()->json("existe");
        } else {
            $nuevo_desglose_cursos              =   DesgloseCursos::findOrFail($request->id);

            $nuevo_desglose_cursos->tipcur_cod  =   $request->tipcur_cod;
            $nuevo_desglose_cursos->descripcion =   $request->descripcionA;

            $val = $request->puntajeA;

            if($val == ''){
                $val = 0;
            }
            else{
                $val = $request->puntajeA;
            }

            $nuevo_desglose_cursos->puntaje     =   $val;
            $nuevo_desglose_cursos->estado      =   1;
            $nuevo_desglose_cursos->sysuser     =   Auth::user()->id;

            $nuevo_desglose_cursos->save();
        }
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $nuevo_desglose_cursos         = DesgloseCursos::findOrFail($request->iddc);
        $nuevo_desglose_cursos->estado = $request->estado;

        $nuevo_desglose_cursos->save();
    }

    public function selectbuscarDesgloCursos(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $desglo_cursos = DB::table('desgloce_cursos')
                            ->select('id','descripcion as nombredesglocurso')
                            ->where('tipcur_cod',$id)
                            ->where('estado','=','1')
                            ->orderBy('id','asc')
                            ->get();

        return['desglo_cursos' => $desglo_cursos];
    }

    public function searchDesgloCursos(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $desglo_cursos = DB::table('desgloce_cursos')
                            ->select('id','tipcur_cod','descripcion as nombredesglocurso')
                            ->where('tipcur_cod',$id)
                            ->where('estado','=','1')
                            ->orderBy('id','asc')
                            ->get();

        return response()->json($desglo_cursos);
    }
}
