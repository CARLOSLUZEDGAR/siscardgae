<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalDistincion;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportePremiosDistincionesController extends Controller
{
    public function ListadoGeneral(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $tipo_reporte = $request->tipo_reporte;
        $promocion = $request->promocion;
        $institucion = $request->institucion;
        $distincion = $request->distincion;
        $tipo_distincion = $request->tipo_distincion;
        $datos = [];

        if ($tipo_reporte == "general") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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
        
        if ($tipo_reporte == "institucion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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
        
        if ($tipo_reporte == "distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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
        
        if ($tipo_reporte == "tipo_distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('pd.dist3_cod',$tipo_distincion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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

        if ($tipo_reporte == "promo_institucion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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

        if ($tipo_reporte == "promo_distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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

        if ($tipo_reporte == "promo_tipo_distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('pd.dist3_cod',$tipo_distincion)
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->paginate(10);

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
        
        else{
            return response()->json([
                
                'code' => 400
            ]);
        }
          
    }

    public function ReporteGralPremiosPDF(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $tipo_reporte = $request->tipo_reporte;
        $promocion = $request->promocion;
        $institucion = $request->institucion;
        $distincion = $request->distincion;
        $tipo_distincion = $request->tipo_distincion;
        $promo = 0;
        $institu = 0;
        $distin = 0;
        $distin2 = 0;
        $datos = [];

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

        if ($tipo_reporte == "general") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();
        }

        if ($tipo_reporte == "promocion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->join('promociones as prom','prom.cod_promo','p.per_promo')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $promo = DB::table("promociones as prom")
            ->select('prom.id as id',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('prom.cod_promo',$promocion)
            ->first();
        }

        if ($tipo_reporte == "institucion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->join('promociones as prom','prom.cod_promo','p.per_promo')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $institu = DB::table("nivel1_distinciones as dist1")
            ->select('dist1.id as id',
                    'dist1.descripcion as institucion'
                    )
            ->where('dist1.id',$institucion)
            ->first();
        }

        if ($tipo_reporte == "distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->join('promociones as prom','prom.cod_promo','p.per_promo')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $distin = DB::table("nivel2_distinciones as dist2")
            ->join('nivel1_distinciones as dist1','dist2.dist1_cod','dist1.id')
            ->select('dist2.id as id',
                    'dist1.descripcion as institucion',
                    'dist2.descripcion as distincion'
                    )
            ->where('dist1.id',$institucion)
            ->where('dist2.id',$distincion)
            ->first();
        }

        if ($tipo_reporte == "tipo_distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('pd.dist3_cod',$tipo_distincion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $distin2 = DB::table("nivel2_distinciones as dist2")
            ->join('nivel1_distinciones as dist1','dist2.dist1_cod','dist1.id')
            ->join('nivel3_distinciones as dist3','dist3.dist2_cod','dist2.id')
            ->select('dist3.id as id',
                    'dist1.descripcion as institucion',
                    'dist2.descripcion as distincion',
                    'dist3.descripcion as tipo_distincion'
                    )
            ->where('dist1.id',$institucion)
            ->where('dist2.id',$distincion)
            ->where('dist3.id',$tipo_distincion)
            ->first();
        }

        if ($tipo_reporte == "promo_institucion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->join('promociones as prom','prom.cod_promo','p.per_promo')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $institu = DB::table("nivel1_distinciones as dist1")
            ->select('dist1.id as id',
                    'dist1.descripcion as institucion'
                    )
            ->where('dist1.id',$institucion)
            ->first();

            $promo = DB::table("promociones as prom")
            ->select('prom.id as id',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('prom.cod_promo',$promocion)
            ->first();
        }

        if ($tipo_reporte == "promo_distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->join('promociones as prom','prom.cod_promo','p.per_promo')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $distin = DB::table("nivel2_distinciones as dist2")
            ->join('nivel1_distinciones as dist1','dist2.dist1_cod','dist1.id')
            ->select('dist2.id as id',
                    'dist1.descripcion as institucion',
                    'dist2.descripcion as distincion'
                    )
            ->where('dist1.id',$institucion)
            ->where('dist2.id',$distincion)
            ->first();

            $promo = DB::table("promociones as prom")
            ->select('prom.id as id',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('prom.cod_promo',$promocion)
            ->first();
        }

        if ($tipo_reporte == "promo_tipo_distincion") {
            $datos = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
            ->join('escalafones as e','e.id','pe.esca_cod')
            ->join('subescalafones as se','se.id','pe.subesc_cod')
            ->join('grados as g','g.id','pe.gra_cod')
            ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
            ->join('estudios as est','est.id','pest.est_cod')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno',
                    'g.abreviatura as grado',
                    'est.abreviatura as estudio'
                    )
            ->where('pd.dist1_cod',$institucion)
            ->where('pd.dist2_cod',$distincion)
            ->where('pd.dist3_cod',$tipo_distincion)
            ->where('p.per_promo',$promocion)
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->whereBetween('pd.fecha_distincion',[$fecha_inicio, $fecha_fin])
            ->orderBy('pd.id','desc')
            ->get();

            $distin2 = DB::table("nivel2_distinciones as dist2")
            ->join('nivel1_distinciones as dist1','dist2.dist1_cod','dist1.id')
            ->join('nivel3_distinciones as dist3','dist3.dist2_cod','dist2.id')
            ->select('dist3.id as id',
                    'dist1.descripcion as institucion',
                    'dist2.descripcion as distincion',
                    'dist3.descripcion as tipo_distincion'
                    )
            ->where('dist1.id',$institucion)
            ->where('dist2.id',$distincion)
            ->where('dist3.id',$tipo_distincion)
            ->first();

            $promo = DB::table("promociones as prom")
            ->select('prom.id as id',
                    'prom.instituto as instituto',
                    'prom.promocion as promocion'
                    )
            ->where('prom.cod_promo',$promocion)
            ->first();
        }

            $count = PersonalDistincion::count();
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;

            $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("REGISTRADOS: $count \n FECHA DE EMISION: $date \n DESDE: $fecha_inicio \n HASTA: $fecha_fin");
            $codigo = $qr;

            $pdf = PDF::loadView('reportes.ReporteGralPremios',['datos'=>$datos,'codigo'=>$codigo,'jefe_dpto'=>$jefe_dpto,'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_fin,'tipo_reporte'=>$tipo_reporte,'promo'=>$promo,'institu'=>$institu,'distin'=>$distin,'distin2'=>$distin2])
            ->setPaper('letter', 'landscape');
            //->setPaper('letter', 'portrait');
            return $pdf->stream('DenunciasFechas.pdf');
          
    }
}
