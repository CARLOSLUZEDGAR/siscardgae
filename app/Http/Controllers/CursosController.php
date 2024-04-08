<?php

namespace App\Http\Controllers;

use App\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    public function listCurso(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $cursos = DB::table('cursos as c')
                        ->select('c.id as idc','c.descripcion','c.observacion','c.estado')
                        ->orderBy('c.id','asc')
                        ->paginate(10);
        }
        else{
            $cursos = DB::table('cursos as c')
                        ->select('c.id as idc','c.descripcion','c.observacion','c.estado')
                        ->where($criterio, 'like', '%'.$buscar.'%')
                        ->orderBy('c.id','asc')
                        ->paginate(10);
        }

        return [
            'pagination' => [
                'total'         =>  $cursos->total(),
                'current_page'  =>  $cursos->currentPage(),
                'per_page'      =>  $cursos->perPage(),
                'last_page'     =>  $cursos->lastPage(),
                'from'          =>  $cursos->firstItem(),
                'to'            =>  $cursos->lastItem(),
            ],
            'cursos'          =>  $cursos
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $descripcioncurso = $request->descripcion;

        $nuevo_curso = Cursos::select('descripcion')
                                ->where('descripcion',$descripcioncurso)
                                ->first();
        if(!empty($nuevo_curso)){
            return response()->json("existe");
        }else{
            $nuevo_curso                =   new Cursos();

            $nuevo_curso->descripcion   =   $request->descripcion;

            $val = $request->observacion;

            if($val == ''){
                $val = 'NINGUNA';
            }
            else{
                $val = $request->observacion;
            }

            $nuevo_curso->observacion   =   $val;
            $nuevo_curso->estado        =   1;
            $nuevo_curso->sysuser       =   Auth::user()->id;

            $nuevo_curso->save();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $id = $request->id;
        $descripcioncurso = $request->descripcionA;
        $nuevo_curso = Cursos::select('descripcion')
                                ->where('descripcion', $descripcioncurso)
                                ->whereNotIn('id', [$id])
                                ->first();
        if(!empty($nuevo_curso)){
            return response()->json("existe");
        } else {
            $nuevo_curso                =   Cursos::findOrFail($request->id);

            $nuevo_curso->descripcion   =   $request->descripcionA;

            $val = $request->observacionA;

            if($val == ''){
                $val = 'NINGUNA';
            }
            else{
                $val = $request->observacionA;
            }

            $nuevo_curso->observacion   =   $val;
            $nuevo_curso->sysuser       =   Auth::user()->id;

            $nuevo_curso->save();
        }
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $nuevo_curso         = Cursos::findOrFail($request->idc);
        $nuevo_curso->estado = $request->estado;

        $nuevo_curso->save();
    }

    public function ListarCursos()
    {
        $cursos = DB::table('cursos')
                        ->select('id','descripcion as nombrecurso')
                        ->where('estado','=','1')
                        ->orderBy('id','asc')
                        ->get();

        return ['cursos' => $cursos];
    }
}
