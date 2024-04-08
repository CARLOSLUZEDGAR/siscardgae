<?php

namespace App\Http\Controllers;

use App\PersonalProyectos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public function ListarProyectos(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $percodigo = $request->percodigo;
        if($buscar==""){
            $datos = DB::table('personal_proyectos as pp')

            ->join('proyectos as pr','pp.proy_cod','pr.id')
            ->select('pp.id','pr.descripcion as estado','pp.proy_cod','pp.descripcion','pp.fecha')
            ->orderBy('pp.id')
                    ->where('pp.per_codigo',$percodigo)
                    ->where('pp.estado',1)
                    ->paginate(15);

        } else{
            $datos = DB::table('personal_proyectos as pp')

            ->join('proyectos as pr','pp.proy_cod','pr.id')
            ->select('pp.id','pr.descripcion as estado','pp.proy_cod','pp.descripcion','pp.fecha')
            ->orderBy('pp.id')
                    ->where($criterio,'like','%'.$buscar.'%')
                    ->where('pp.per_codigo',$percodigo)
                    ->where('pp.estado',1)
                    ->paginate(15);
        }

        
        return response()->json([
            'pagination' => [
                'total'      => $datos->total(),
                'current_page' => $datos->currentPage(),
                'per_page' => $datos->perPage(),
                'last_page' => $datos->lastPage(),
                'from' => $datos->firstItem(),
                'to' => $datos->lastItem(),
            ],
            'datos' => $datos,
            'request' => $request
        ]);
        
    }

    public function MostrarPersona(Request $request)
    {
            $percodigo = $request->percodigo;
            $datos = DB::table('personal_escalafones as pe')
                ->join('personals as p','pe.per_codigo','p.per_codigo')
                ->join('personal_estudios as ps','p.per_codigo','ps.per_codigo')
                ->join('grados as g','pe.gra_cod','g.id')
                ->join('estudios as e','ps.est_cod','e.id')
               
                ->select('p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno',
                        'g.abreviatura as grado','e.abreviatura as complemento')

                ->where('p.per_codigo',$percodigo)
                ->where('ps.estado',1)
                ->where('pe.estado',1)
                ->first();

                return response()->json($datos);
    }

    public function EstadoProyecto()
    {
        $datos = DB::table('proyectos as pro')
                ->select('pro.id','pro.descripcion')
                ->where('pro.estado',1)
                ->get();
                
        return response()->json($datos);
                
    }

    public function EditarProyecto(Request $request)
    {
        PersonalProyectos::find($request->id)
              ->update([
                  'proy_cod' => $request->estado,
                  'descripcion' => $request->descripcion,
                  'fecha' => $request->fecha,
                ]);
        return response()->json($request);
    }
    
    public function AgregarProyecto(Request $request)
    {
        PersonalProyectos::create([
            'per_codigo'=>$request->percod,
            'proy_cod'=>$request->estado,
            'descripcion'=>$request->descripcion,
            'fecha'=>$request->fecha,
            'estado'=>1,
            'sysuser'=>Auth::user()->id,
        ]);
        return response()->json($request);
    }

    public function EliminarProyecto(Request $request)
    {
        // DB::table('personal_proyectos')
        //     ->where('id', $request->idpro)
        //     ->update([
        //         'estado' => 0,
        //     ]);
        $flight = PersonalProyectos::find($request->idpro);

        $flight->delete();
        return response()->json($flight);
    }

}
