<?php

namespace App\Http\Controllers;

use App\TipoCursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TipoCursosController extends Controller
{
    public function listTipoCurso(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $tipo_cursos = DB::table('tipo_cursos as tc')
                                ->join('cursos as c','tc.cur_cod','c.id')
                                ->select('tc.id as idtc','c.descripcion as nombrecurso','tc.descripcion',
                                        'tc.observacion','tc.estado','tc.abreviatura','tc.cur_cod','c.id as ic',
                                        'tc.clasificacion','tc.puntaje','tc.pertenece','tc.area',
                                        'tc.pertenece_2','tc.orden_dip')
                                ->orderBy('tc.id','asc')
                                ->paginate(10);
        }
        else{
            $tipo_cursos = DB::table('tipo_cursos as tc')
                                ->join('cursos as c','tc.cur_cod','c.id')
                                ->select('tc.id as idtc','c.descripcion as nombrecurso','tc.descripcion',
                                        'tc.observacion','tc.estado','tc.abreviatura','tc.cur_cod','c.id as ic',
                                        'tc.clasificacion','tc.puntaje','tc.pertenece','tc.area',
                                        'tc.pertenece_2','tc.orden_dip')
                                ->where($criterio, 'like', '%'.$buscar.'%')
                                ->orderBy('tc.id','asc')
                                ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         =>  $tipo_cursos->total(),
                'current_page'  =>  $tipo_cursos->currentPage(),
                'per_page'      =>  $tipo_cursos->perPage(),
                'last_page'     =>  $tipo_cursos->lastPage(),
                'from'          =>  $tipo_cursos->firstItem(),
                'to'            =>  $tipo_cursos->lastItem(),
            ],
            'tipo_cursos'          =>  $tipo_cursos
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $descripciontipocurso = $request->descripcion;

        $nuevo_tipo_curso = TipoCursos::select('descripcion')
                                        ->where('descripcion',$descripciontipocurso)
                                        ->first();

        if(!empty($nuevo_tipo_curso)){
            return response()->json("existe");
        }else{
            $nuevo_tipo_curso                   =   new TipoCursos();

            $nuevo_tipo_curso->cur_cod          =   $request->valorCurso;
            $nuevo_tipo_curso->descripcion      =   $request->descripcion;

            //PARA ABREVIATURA
            $val = $request->abreviatura;

            if($val == ''){
                $val = '.';
            }
            else{
                $val = $request->abreviatura;
            }

            $nuevo_tipo_curso->abreviatura      =   $val;
            $nuevo_tipo_curso->clasificacion    =   $request->clasificacion;

            //PARA PUNTAJE
            $val2 = $request->puntaje;

            if($val2 == ''){
                $val2 = 0;
            }
            else{
                $val2 = $request->puntaje;
            }

            $nuevo_tipo_curso->puntaje          =   $val2;

            //PARA OBSERVACION
            $val3 = $request->observacion;

            if($val3 == ''){
                $val3 = 'NINGUNA';
            }
            else{
                $val3 = $request->observacion;
            }

            $nuevo_tipo_curso->observacion      =   $val3;
            $nuevo_tipo_curso->estado           =   1;
            $nuevo_tipo_curso->sysuser          =   Auth::user()->id;

            $nuevo_tipo_curso->save();
        }


    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $id = $request->id;
        $descripcioncurso = $request->descripcionA;
        $nuevo_tipo_curso = TipoCursos::select('descripcion')
                                ->where('descripcion', $descripcioncurso)
                                ->whereNotIn('id', [$id])
                                ->first();
        if(!empty($nuevo_tipo_curso)){
            return response()->json("existe");
        } else {
            $nuevo_tipo_curso                   =   TipoCursos::findOrFail($request->id);

            $nuevo_tipo_curso->cur_cod          =   $request->cur_cod;
            $nuevo_tipo_curso->descripcion      =   $request->descripcionA;

            //PARA ABREVIATURA
            $val = $request->abreviaturaA;

            if($val == ''){
                $val = '.';
            }
            else{
                $val = $request->abreviaturaA;
            }

            $nuevo_tipo_curso->abreviatura      =   $request->abreviaturaA;
            $nuevo_tipo_curso->clasificacion    =   $request->clasificacionA;

            //PARA PUNTAJE
            $val2 = $request->puntajeA;

            if($val2 == ''){
                $val2 = 0;
            }
            else{
                $val2 = $request->puntajeA;
            }

            $nuevo_tipo_curso->puntaje          =   $request->puntajeA;

            //PARA OBSERVACION
            $val3 = $request->observacionA;

            if($val3 == ''){
                $val3 = 'NINGUNA';
            }
            else{
                $val3 = $request->observacionA;
            }

            $nuevo_tipo_curso->observacion      =   $val3;
            $nuevo_tipo_curso->estado           =   1;
            $nuevo_tipo_curso->sysuser          =   Auth::user()->id;

            $nuevo_tipo_curso->save();
        }
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $nuevo_tipo_curso         = TipoCursos::findOrFail($request->idtc);
        $nuevo_tipo_curso->estado = $request->estado;

        $nuevo_tipo_curso->save();
    }

    public function ListarTipoCursos()
    {
        $tipo_cursos = DB::table('tipo_cursos')
                            ->select('id','descripcion as nombretipocurso')
                            ->where('estado','=','1')
                            ->orderBy('id','asc')
                            ->get();

        return response()->json($tipo_cursos);
    }

    public function selectbuscarTipoCursos(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $tipo_cursos = DB::table('tipo_cursos')
                            ->select('id','cur_cod','descripcion as nombretipocurso')
                            ->where('cur_cod',$id)
                            ->where('estado','=','1')
                            ->orderBy('id','asc')
                            ->get();

        return['tipo_cursos' => $tipo_cursos];
    }

    public function searchTipoCursos(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $id = $request->id;
        $tipo_cursos = DB::table('tipo_cursos')
                        ->select('id','cur_cod','descripcion as nombretipocurso')
                        ->where('cur_cod',$id)
                        ->orderBy('id','asc')
                        ->get();
        return response()->json($tipo_cursos);
    }
}
