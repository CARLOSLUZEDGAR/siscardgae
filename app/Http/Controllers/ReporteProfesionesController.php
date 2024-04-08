<?php

namespace App\Http\Controllers;

use App\PersonalProfesiones;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteProfesionesController extends Controller
{
    public function ListadoGeneral(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $tipo_reporte = $request->tipo_reporte;
        $grado = $request->grado;
        $promocion = $request->promocion;
        $carrera = $request->carrera;
        $gradoAcademico = $request->gradoAcademico;
        $emi = $request->emi;
        $datos = [];

        if ($tipo_reporte == "general") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->paginate(20);
            
                return response()->json([
                    'pagination' => [
                        'total'         => $datos->total(),
                        'current_page'  => $datos->currentPage(),
                        'per_page'      => $datos->perPage(),
                        'last_page'     => $datos->lastPage(),
                        'from'          => $datos->firstItem(),
                        'to'            => $datos->lastItem(),
                    ],
                    'datos' => $datos,
                    'code' => 200
                ]);
        }

        if ($tipo_reporte == "grado") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('g.id',$grado)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->paginate(20);
            
                return response()->json([
                    'pagination' => [
                        'total'         => $datos->total(),
                        'current_page'  => $datos->currentPage(),
                        'per_page'      => $datos->perPage(),
                        'last_page'     => $datos->lastPage(),
                        'from'          => $datos->firstItem(),
                        'to'            => $datos->lastItem(),
                    ],
                    'datos' => $datos,
                    'code' => 200
                ]);
        }


        if ($tipo_reporte == "promocion") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera','carreras.id',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('p.per_promo',$promocion)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->paginate(20);
            
                return response()->json([
                    'pagination' => [
                        'total'         => $datos->total(),
                        'current_page'  => $datos->currentPage(),
                        'per_page'      => $datos->perPage(),
                        'last_page'     => $datos->lastPage(),
                        'from'          => $datos->firstItem(),
                        'to'            => $datos->lastItem(),
                    ],
                    'datos' => $datos,
                    'code' => 200
                ]);
        }

        if ($tipo_reporte == "gradoAcademico") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera','carreras.id',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('carreras.id',$gradoAcademico)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->paginate(20);
            
                return response()->json([
                    'pagination' => [
                        'total'         => $datos->total(),
                        'current_page'  => $datos->currentPage(),
                        'per_page'      => $datos->perPage(),
                        'last_page'     => $datos->lastPage(),
                        'from'          => $datos->firstItem(),
                        'to'            => $datos->lastItem(),
                    ],
                    'datos' => $datos,
                    'code' => 200
                ]);
        }

        if ($tipo_reporte == "carrera") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera','carreras.id',
                        'nivel_profesionals.descripcion as niv_especialidad','nivel_profesionals.id',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('nivel_profesionals.id',$carrera)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->paginate(20);
            
                return response()->json([
                    'pagination' => [
                        'total'         => $datos->total(),
                        'current_page'  => $datos->currentPage(),
                        'per_page'      => $datos->perPage(),
                        'last_page'     => $datos->lastPage(),
                        'from'          => $datos->firstItem(),
                        'to'            => $datos->lastItem(),
                    ],
                    'datos' => $datos,
                    'code' => 200
                ]);
        }

        if ($tipo_reporte == "emi") {
            if ($gradoAcademico == 0 || $carrera == 0){
                if ($gradoAcademico != 0 && $carrera == 0){
                    $datos = DB::table('personal_profesiones as pp')
                        ->join('personals as p','pp.per_codigo','p.per_codigo')
                        ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                        ->join('escalafones as esc','pesc.esca_cod','esc.id')
                        ->join('subescalafones as se','pesc.subesc_cod','se.id')
                        ->join('grados as g','pesc.gra_cod','g.id')
                        ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                        ->join('estudios as est','est.id','pest.est_cod')
                        ->join('carreras','carreras.id','=','pp.car_codigo')
                        ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                        ->select('g.abreviatura as grado','est.abreviatura as estudios',
                                'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                                'carreras.descripcion as descripcion_carrera',
                                'nivel_profesionals.descripcion as niv_especialidad',
                                'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                        )
                        //->where('pp.lugar_estudio',$emi)
                        ->where('carreras.id',$gradoAcademico)
                        ->where('pp.lugar_estudio','LIKE','ESCUELA MILITAR DE ING%' )
                        ->where('pesc.estado',1)
                        ->where('pest.estado',1)
                        ->Where('pp.estado','=','1')
                        //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                        //->orderBy('den.fecha_denuncia', 'desc')
                        ->orderBy('pesc.esca_cod')
                        ->orderBy('se.orden')
                        ->orderBy('g.orden')
                        ->orderBy('p.per_cm')
                        ->paginate(20);
                }else{
                    $datos = DB::table('personal_profesiones as pp')
                        ->join('personals as p','pp.per_codigo','p.per_codigo')
                        ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                        ->join('escalafones as esc','pesc.esca_cod','esc.id')
                        ->join('subescalafones as se','pesc.subesc_cod','se.id')
                        ->join('grados as g','pesc.gra_cod','g.id')
                        ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                        ->join('estudios as est','est.id','pest.est_cod')
                        ->join('carreras','carreras.id','=','pp.car_codigo')
                        ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                        ->select('g.abreviatura as grado','est.abreviatura as estudios',
                                'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                                'carreras.descripcion as descripcion_carrera',
                                'nivel_profesionals.descripcion as niv_especialidad',
                                'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                        )
                        //->where('pp.lugar_estudio',$emi)
                        ->where('pp.lugar_estudio','LIKE','ESCUELA MILITAR DE ING%' )
                        ->where('pesc.estado',1)
                        ->where('pest.estado',1)
                        ->Where('pp.estado','=','1')
                        //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                        //->orderBy('den.fecha_denuncia', 'desc')
                        ->orderBy('pesc.esca_cod')
                        ->orderBy('se.orden')
                        ->orderBy('g.orden')
                        ->orderBy('p.per_cm')
                        ->paginate(20);
                }
            }else{
                $datos = DB::table('personal_profesiones as pp')
                    ->join('personals as p','pp.per_codigo','p.per_codigo')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('escalafones as esc','pesc.esca_cod','esc.id')
                    ->join('subescalafones as se','pesc.subesc_cod','se.id')
                    ->join('grados as g','pesc.gra_cod','g.id')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('carreras','carreras.id','=','pp.car_codigo')
                    ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                    ->select('g.abreviatura as grado','est.abreviatura as estudios',
                            'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                            'carreras.descripcion as descripcion_carrera',
                            'nivel_profesionals.descripcion as niv_especialidad',
                            'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                    )
                    //->where('pp.lugar_estudio',$emi)
                    ->where('carreras.id',$gradoAcademico)
                    ->where('nivel_profesionals.id',$carrera)
                    ->where('pp.lugar_estudio','LIKE','ESCUELA MILITAR DE ING%' )
                    ->where('pesc.estado',1)
                    ->where('pest.estado',1)
                    ->Where('pp.estado','=','1')
                    //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                    //->orderBy('den.fecha_denuncia', 'desc')
                    ->orderBy('pesc.esca_cod')
                    ->orderBy('se.orden')
                    ->orderBy('g.orden')
                    ->orderBy('p.per_cm')
                    ->paginate(20);
            }
            
            
            return response()->json([
                'pagination' => [
                    'total'         => $datos->total(),
                    'current_page'  => $datos->currentPage(),
                    'per_page'      => $datos->perPage(),
                    'last_page'     => $datos->lastPage(),
                    'from'          => $datos->firstItem(),
                    'to'            => $datos->lastItem(),
                ],
                'datos' => $datos,
                'code' => 200
            ]);
        }


    }

    public function ReportePerProfPdf(Request $request)
    {
        
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $tipo_reporte = $request->tipo_reporte;
        $grado = $request->grado;
        $promocion = $request->promocion;
        $carrera = $request->carrera;
        $gradoAcademico = $request->gradoAcademico;
        $datos = [];
        $carr = '';
        $gradac = '';
        $grad = '';


        if ($tipo_reporte == "general") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera',
                        'nivel_profesionals.descripcion as niv_especialidad','pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                        )
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                    ->orderBy('se.orden')
                    ->orderBy('g.orden')
                    ->orderBy('p.per_cm')
                ->get();
        }

        if ($tipo_reporte == "grado") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('g.id',$grado)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->get();

            $grad = DB::table("grados as grad")
                ->select('grad.id as id',
                        'grad.nombre as grad_nombre'
                        )
                ->where('grad.id',$grado)
                ->first();
        }

        if ($tipo_reporte == "promocion") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera','carreras.id',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('p.per_promo',$promocion)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->get();
        }

        if ($tipo_reporte == "gradoAcademico") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera','carreras.id',
                        'nivel_profesionals.descripcion as niv_especialidad',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('carreras.id',$gradoAcademico)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->get();

            $gradac = DB::table("carreras as gradac")
                ->select('gradac.id as id',
                        'gradac.descripcion as gradac_descripcion'
                        )
                ->where('gradac.id',$gradoAcademico)
                ->first();

        }

        if ($tipo_reporte == "carrera") {
            $datos = DB::table('personal_profesiones as pp')
                ->join('personals as p','pp.per_codigo','p.per_codigo')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('escalafones as esc','pesc.esca_cod','esc.id')
                ->join('subescalafones as se','pesc.subesc_cod','se.id')
                ->join('grados as g','pesc.gra_cod','g.id')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('carreras','carreras.id','=','pp.car_codigo')
                ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                ->select('g.abreviatura as grado','est.abreviatura as estudios',
                        'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                        'carreras.descripcion as descripcion_carrera','carreras.id',
                        'nivel_profesionals.descripcion as niv_especialidad','nivel_profesionals.id',
                        'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                )
                ->where('nivel_profesionals.id',$carrera)
                ->where('pesc.estado',1)
                ->where('pest.estado',1)
                ->Where('pp.estado','=','1')
                //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                //->orderBy('den.fecha_denuncia', 'desc')
                ->orderBy('pesc.esca_cod')
                ->orderBy('se.orden')
                ->orderBy('g.orden')
                ->orderBy('p.per_cm')
                ->get();
            
            $carr = DB::table("nivel_profesionals as carr")
                ->select('carr.id as id',
                        'carr.descripcion as carr_descripcion'
                        )
                ->where('carr.id',$carrera)
                ->first();

        }

        $jefe_dpto = DB::table('personals')
            ->join('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
            ->join('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
            ->join('escalafones','escalafones.id','personal_escalafones.esca_cod')
            ->join('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
            ->join('grados','grados.id','personal_escalafones.gra_cod')
            ->join('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
            ->join('estudios','estudios.id','personal_estudios.est_cod')
            ->join('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
            ->join('nivel4_destinos','nivel4_destinos.id','personal_destinos.d4_cod')
            ->join('personal_cargos','personal_cargos.dest_cod','personal_destinos.id')
            ->join('cargos','cargos.id','personal_cargos.car_cod')
            ->select('personals.per_codigo',
                    'personals.per_paterno',
                    'personals.per_materno',
                    'personals.per_nombre',
                    'personals.per_sexo',
                    'personals.per_ci',
                    'personals.per_cm',
                    'personals.per_foto',
                    'grados.abreviatura as gra_abreviatura',
                    'estudios.abreviatura as estu_abreviatura',
                    'personal_escalafones.estado as escperestado',
                    'personal_estudios.id as estperestado')
            ->where('nivel3_destinos.id',22)
            ->where('nivel4_destinos.id',69)
            ->where('cargos.id',68)
            ->where('personal_escalafones.estado',1)
            ->where('personal_estudios.estado',1)
            ->where('personal_cargos.nivel_cargo',1)
            ->orderBy('personal_destinos.fecha_destino','desc')
            ->first();



        $count = PersonalProfesiones::count();
        $year = Carbon::now();

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("REGISTRADOS: $count\n FECHA DE EMISION: $year");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.ReporteProfesiones',['datos'=>$datos,
                                                            'jefe_dpto'=>$jefe_dpto,
                                                            'codigo'=>$codigo,
                                                            'fecha_inicio'=>$fecha_inicio,
                                                            'fecha_fin'=>$fecha_fin,
                                                            'tipo_reporte'=>$tipo_reporte,
                                                            'gradac'=>$gradac,
                                                            'carr'=>$carr,
                                                            'grad'=>$grad
                                                            ])
        ->setPaper('letter', 'landscape');
        //->setPaper('letter', 'portrait');
        return $pdf->stream('ReporteProfesiones.pdf');


    }

    public function ReportePerProfEmiPdf(Request $request)
    {
        $tipo_reporte = $request->tipo_reporte;
        $carrera = $request->carrera;
        $gradoAcademico = $request->gradoAcademico;
        $emi = 'EMI';
        $datos = [];
        $carr = '';
        $gradac = '';
        $grad = '';

        if ($tipo_reporte == "emi") {
            if ($gradoAcademico == 0 || $carrera == 0){
                if ($gradoAcademico != 0 && $carrera == 0){
                    $datos = DB::table('personal_profesiones as pp')
                        ->join('personals as p','pp.per_codigo','p.per_codigo')
                        ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                        ->join('escalafones as esc','pesc.esca_cod','esc.id')
                        ->join('subescalafones as se','pesc.subesc_cod','se.id')
                        ->join('grados as g','pesc.gra_cod','g.id')
                        ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                        ->join('estudios as est','est.id','pest.est_cod')
                        ->join('carreras','carreras.id','=','pp.car_codigo')
                        ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                        ->select('g.abreviatura as grado','est.abreviatura as estudios',
                                'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                                'carreras.descripcion as descripcion_carrera',
                                'nivel_profesionals.descripcion as niv_especialidad',
                                'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                        )
                        //->where('pp.lugar_estudio',$emi)
                        ->where('carreras.id',$gradoAcademico)
                        ->where('pp.lugar_estudio','LIKE','ESCUELA MILITAR DE ING%' )
                        ->where('pesc.estado',1)
                        ->where('pest.estado',1)
                        ->Where('pp.estado','=','1')
                        //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                        //->orderBy('den.fecha_denuncia', 'desc')
                        ->orderBy('pesc.esca_cod')
                        ->orderBy('se.orden')
                        ->orderBy('g.orden')
                        ->orderBy('p.per_cm')
                        ->get();
                }else{
                    $datos = DB::table('personal_profesiones as pp')
                        ->join('personals as p','pp.per_codigo','p.per_codigo')
                        ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                        ->join('escalafones as esc','pesc.esca_cod','esc.id')
                        ->join('subescalafones as se','pesc.subesc_cod','se.id')
                        ->join('grados as g','pesc.gra_cod','g.id')
                        ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                        ->join('estudios as est','est.id','pest.est_cod')
                        ->join('carreras','carreras.id','=','pp.car_codigo')
                        ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                        ->select('g.abreviatura as grado','est.abreviatura as estudios',
                                'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                                'carreras.descripcion as descripcion_carrera',
                                'nivel_profesionals.descripcion as niv_especialidad',
                                'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                        )
                        //->where('pp.lugar_estudio',$emi)
                        ->where('pp.lugar_estudio','LIKE','ESCUELA MILITAR DE ING%' )
                        ->where('pesc.estado',1)
                        ->where('pest.estado',1)
                        ->Where('pp.estado','=','1')
                        //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                        //->orderBy('den.fecha_denuncia', 'desc')
                        ->orderBy('pesc.esca_cod')
                        ->orderBy('se.orden')
                        ->orderBy('g.orden')
                        ->orderBy('p.per_cm')
                        ->get();
                }
            }else{
                $datos = DB::table('personal_profesiones as pp')
                    ->join('personals as p','pp.per_codigo','p.per_codigo')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('escalafones as esc','pesc.esca_cod','esc.id')
                    ->join('subescalafones as se','pesc.subesc_cod','se.id')
                    ->join('grados as g','pesc.gra_cod','g.id')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('carreras','carreras.id','=','pp.car_codigo')
                    ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

                    ->select('g.abreviatura as grado','est.abreviatura as estudios',
                            'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                            'carreras.descripcion as descripcion_carrera',
                            'nivel_profesionals.descripcion as niv_especialidad',
                            'pp.lugar_estudio','pp.fecha_egreso','pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
                    )
                    //->where('pp.lugar_estudio',$emi)
                    ->where('carreras.id',$gradoAcademico)
                    ->where('nivel_profesionals.id',$carrera)
                    ->where('pp.lugar_estudio','LIKE','ESCUELA MILITAR DE ING%' )
                    ->where('pesc.estado',1)
                    ->where('pest.estado',1)
                    ->Where('pp.estado','=','1')
                    //->whereBetween('den.fecha_denuncia',[$fecha_inicio, $fecha_fin])
                    //->orderBy('den.fecha_denuncia', 'desc')
                    ->orderBy('pesc.esca_cod')
                    ->orderBy('se.orden')
                    ->orderBy('g.orden')
                    ->orderBy('p.per_cm')
                    ->get();
            }

        }


        $jefe_dpto = DB::table('personals')
            ->join('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
            ->join('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
            ->join('escalafones','escalafones.id','personal_escalafones.esca_cod')
            ->join('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
            ->join('grados','grados.id','personal_escalafones.gra_cod')
            ->join('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
            ->join('estudios','estudios.id','personal_estudios.est_cod')
            ->join('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
            ->join('nivel4_destinos','nivel4_destinos.id','personal_destinos.d4_cod')
            ->join('personal_cargos','personal_cargos.dest_cod','personal_destinos.id')
            ->join('cargos','cargos.id','personal_cargos.car_cod')
            ->select('personals.per_codigo',
                    'personals.per_paterno',
                    'personals.per_materno',
                    'personals.per_nombre',
                    'personals.per_sexo',
                    'personals.per_ci',
                    'personals.per_cm',
                    'personals.per_foto',
                    'grados.abreviatura as gra_abreviatura',
                    'estudios.abreviatura as estu_abreviatura',
                    'personal_escalafones.estado as escperestado',
                    'personal_estudios.id as estperestado')
            ->where('nivel3_destinos.id',22)
            ->where('nivel4_destinos.id',69)
            ->where('cargos.id',68)
            ->where('personal_escalafones.estado',1)
            ->where('personal_estudios.estado',1)
            ->where('personal_cargos.nivel_cargo',1)
            ->orderBy('personal_destinos.fecha_destino','desc')
            ->first();



        $count = PersonalProfesiones::count();
        $year = Carbon::now();

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("REGISTRADOS: $count\n FECHA DE EMISION: $year");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.ReporteProfesionesEmi',['datos'=>$datos,
                                                            'jefe_dpto'=>$jefe_dpto,
                                                            'codigo'=>$codigo,
                                                            'tipo_reporte'=>$tipo_reporte,
                                                            ])
        ->setPaper('letter', 'landscape');
        //->setPaper('letter', 'portrait');
        return $pdf->stream('ReporteProfesionesEmi.pdf');


    }

    public function ReporteProfesion(Request $request)
    {
        $per_codigo = $request->per_codigo;


        $profesion = DB::table('personal_profesiones as pp')
            ->join('personals as p','pp.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
            ->join('escalafones as esc','pesc.esca_cod','esc.id')
            ->join('subescalafones as se','pesc.subesc_cod','se.id')
            ->join('grados as g','pesc.gra_cod','g.id')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->join('carreras','carreras.id','=','pp.car_codigo')
            ->join('nivel_profesionals','nivel_profesionals.id','=','pp.nivprof_codigo')

            ->select('g.abreviatura as grado','est.abreviatura as estudios',
                'p.per_cm as percm','p.per_ci as ciper','p.per_expedido as exper','p.per_nombre as pnombre','p.per_paterno as ppaterno','p.per_materno as pmaterno',
                'carreras.descripcion as descripcion_carrera',
                'nivel_profesionals.descripcion as niv_especialidad',
                'pp.id','pp.lugar_estudio','pp.fecha_egreso','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser'
            )
            ->where('pp.per_codigo', '=', $per_codigo)
            ->where('pesc.estado',1)
            ->where('pest.estado',1)
            ->Where('pp.estado','=','1')
            ->orderBy('pp.fecha_egreso','desc')
            ->orderBy('pesc.esca_cod')
            ->orderBy('se.orden')
            ->orderBy('g.orden')
            ->orderBy('p.per_cm')
            ->get();


        $personal = DB::table('personals')
            ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
            ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
            ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
            ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
            ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
            ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
            ->select('personals.per_codigo',
                    'personals.per_paterno',
                    'personals.per_materno',
                    'personals.per_nombre',
                    'personals.per_sexo',
                    'personals.per_ci',
                    'personals.per_expedido',
                    'personals.per_cm',
                    'personals.per_foto',
                    'grados.abreviatura as gra_abreviatura',
                    'estudios.abreviatura as estu_abreviatura',
                    'personal_escalafones.estado as escperestado',
                    'personal_estudios.id as estperestado')
            ->where('personals.per_codigo',$per_codigo)
            ->where('personal_escalafones.estado',1)
            ->where('personal_estudios.estado',1)
            ->first();
        
        $jefe_dpto = DB::table('personals')
            ->join('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
            ->join('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
            ->join('escalafones','escalafones.id','personal_escalafones.esca_cod')
            ->join('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
            ->join('grados','grados.id','personal_escalafones.gra_cod')
            ->join('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
            ->join('estudios','estudios.id','personal_estudios.est_cod')
            ->join('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
            ->join('nivel4_destinos','nivel4_destinos.id','personal_destinos.d4_cod')
            ->join('personal_cargos','personal_cargos.dest_cod','personal_destinos.id')
            ->join('cargos','cargos.id','personal_cargos.car_cod')
            ->select('personals.per_codigo',
                    'personals.per_paterno',
                    'personals.per_materno',
                    'personals.per_nombre',
                    'personals.per_sexo',
                    'personals.per_ci',
                    'personals.per_cm',
                    'personals.per_foto',
                    'grados.abreviatura as gra_abreviatura',
                    'estudios.abreviatura as estu_abreviatura',
                    'personal_escalafones.estado as escperestado',
                    'personal_estudios.id as estperestado')
            ->where('nivel3_destinos.id',22)
            ->where('nivel4_destinos.id',69)
            ->where('cargos.id',68)
            ->where('personal_escalafones.estado',1)
            ->where('personal_estudios.estado',1)
            ->where('personal_cargos.nivel_cargo',1)
            ->orderBy('personal_destinos.fecha_destino','desc')
            ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporteProfesionPersonal',['profesion'=>$profesion,
                                                    'personal'=>$personal,
                                                    'jefe_dpto'=>$jefe_dpto,
                                                    'qr'=>$codigo])
        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('ReportePersonalProfesion.pdf');
    }
}
