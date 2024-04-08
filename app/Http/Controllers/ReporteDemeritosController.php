<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DatosController;
use App\Personal;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteDemeritosController extends Controller
{
    public function Reporte($id)
    {

        // $per_codigo = "1053";
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        // $demerito = 12;
        $datos = DB::table('personal_faltas as pf')
            ->join('personals as p','pf.per_codigo','p.per_codigo')
            ->join('grados as g','pf.gra_cod','g.id')
            ->join('estudios as e','pf.estu_id','e.id')
            ->join('nivel3_destinos as nd3','pf.d3_cod','nd3.id')
            ->join('nivel1_faltas as nf1','pf.f1_cod','nf1.id')
            ->join('nivel2_faltas as nf2','pf.f2_cod','nf2.id')
            ->join('sanciones as s','pf.san_cod','s.id')
            ->select('p.per_nombre as nombre', 'p.per_paterno as paterno', 'p.per_materno as materno','pf.ndoc','pf.fecha_sancion as fecha','g.id as gid',
                    'g.nombre as grado','g.abreviatura as gabre', 'e.abreviatura as complemento','nd3.descripcion as dest3','pf.dias','nf2.descripcion as f2',
                    'pf.observacion','pf.sancionador','s.horas as tipoSan' ,'pf.unidad','pf.cargo','pf.documento','nd3.abreviatura as abreD3',
                    's.descripcion as sancion')

            ->where('pf.id',$id)
            ->first();
        $gid = $datos->gid;
        // $gid = 44;
        if ($gid >= 10 && $gid <=14) {
            $ng = 'SUBOFICIAL';
        } elseif ($gid >= 15 && $gid <=17) {
            $ng = 'SARGENTO';
        } elseif ($gid >= 164 && $gid <=169) {
            $ng = 'SUBOFICIAL';
        } elseif ($gid >= 170 && $gid <=172) {
            $ng = 'SARGENTO';
        } elseif ($gid >= 29 && $gid <= 33) {
            $ng = 'PROFESIONAL';
        } elseif ($gid >= 34 && $gid <= 38) {
            $ng = 'TECNICO';
        } elseif ($gid >= 39 && $gid <= 43) {
            $ng = 'ADMINISTRATIVO';
        } elseif ($gid >= 44 && $gid <=48) {
            $ng = 'APOYO ADMINISTRATIVO';
        }
        else {
            $ng = $datos->grado;
        }

        
        
        $date = Carbon::parse($datos->fecha);
         
        $año = $date->isoFormat('YYYY');
        $mes = $date->isoFormat('MM');
        $dia = $date->isoFormat('D');
        $fecha = $meses[$mes-1].' '.$dia.' de '.$año;

        if ($datos->tipoSan == 1) {
            if ($datos->dias > 3) {
                $castigo = $datos->dias." dias de arresto" ;
            } else {
                $dias = $datos->dias * 24;
                $castigo = $dias." horas de arresto";
            }
        } else {
            $castigo = $datos->sancion;
        }
        
        
        
     $unidad = DB::table('personal_destinos as pd')
                ->join('nivel3_destinos as d3','pd.d3_cod','d3.id')
                ->join('departamentos as d','d3.depa_cod','d.id')
                ->select('d3.descripcion','d3.id','d3.abreviatura','d.nombre as departamento')
                ->where('pd.per_codigo',Auth::user()->percod)
                ->where('pd.estado',1)
                ->first();
    
        $usuario = strtolower(Auth::user()->nick);
        $pdf = \PDF::loadView('DemeritoPDF.memorandum',[
             'datos' => $datos,
             'fecha'=>$fecha,
             'departamento'=> strtolower($unidad->departamento),
             'user' => substr($usuario,0,3),
             'nomGra' => strtolower($ng),
             'unidad' => $unidad,
             'castigo' => $castigo
            
        ])->setPaper('letter','portrait');

        return $pdf->stream();
    }

    public function RecordIndividual(Request $request)
    {
        $id = $request->id;
        $personal = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
        ->join('grados','personal_escalafones.gra_cod','=','grados.id')
        ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
        ->join('estudios','personal_estudios.est_cod','=','estudios.id')
        ->join('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->join('subsituaciones','subsituaciones.id','personal_situaciones.subsit_cod')
        ->join('detalle_situaciones','detalle_situaciones.id','personal_situaciones.detsit_cod')
        ->select('personals.per_codigo','personals.per_codigo as personal_id', 'personals.per_paterno','personals.per_nombre',
        'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.gra_cod',
        'personal_escalafones.per_codigo','grados.abreviatura as grado','estudios.abreviatura as estudios','personals.per_sexo','personals.per_foto','subsituaciones.nombre as subsit','detalle_situaciones.nombre as detsit')
        ->where('personal_escalafones.estado','=',1)
        ->where('personal_estudios.estado','=',1)
        ->where('personals.per_codigo','=',$id)
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

         $faltas = DB::table('personal_faltas as pf')
            ->join('nivel1_faltas as nf1','pf.f1_cod','nf1.id')
            ->join('nivel2_faltas as nf2','pf.f2_cod','nf2.id')
            ->join('sanciones as s','pf.san_cod','s.id')
            ->select('pf.fecha_sancion as fecha','nf1.descripcion as tipo','nf2.descripcion as articulo','s.descripcion as sancion','pf.observacion','pf.sancionador','pf.dias','pf.documento','pf.ndoc')
            ->where('pf.per_codigo',$id)
            ->where('pf.estado',1)
            ->orderBy('pf.fecha_sancion')
            ->get();

         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
         $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
         $codigo = $qr;

         $pdf = \PDF::loadView('DemeritoPDF.RecordIndividual',[
            'faltas'=>$faltas,
            'personal'=>$personal,
            'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])->setPaper('letter', 'portrait');
            
        return $pdf->stream('reporte_ascenso_individual.pdf');
    }

    public function RecordPromocion(Request $request)
    {
        $data = DB::table('personal_faltas as pf')
            ->join('personals as p','pf.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pef','p.per_codigo','pef.per_codigo')
            ->join('grados as g','pef.gra_cod','g.id')
            ->join('personal_estudios as pes','pes.per_codigo','p.per_codigo')
            ->join('estudios as e','pes.est_cod','e.id')
            ->join('nivel3_destinos as nd3','pf.d3_cod','nd3.id')
            ->join('nivel1_faltas as nf1','pf.f1_cod','nf1.id')
            ->join('nivel2_faltas as nf2','pf.f2_cod','nf2.id')
            ->join('sanciones as s','pf.san_cod','s.id')            
            ->join('personal_situaciones as ps', 'p.per_codigo','ps.per_codigo')
            ->select('p.per_codigo','p.per_nombre as nombre', 'p.per_paterno as paterno', 'p.per_materno as materno','p.per_cm','g.abreviatura as gabre', 'e.abreviatura as complemento','pf.fecha_sancion as fecha','nf1.descripcion as tipo','nf2.descripcion as articulo','s.descripcion as sancion','pf.observacion','pf.sancionador','pf.dias','pf.documento','pf.ndoc')
            ->whereBetween('pf.fecha_sancion', [$request->fechainicio, $request->fechafin])
            ->where('p.per_cm','like',$request->cm.'%')
            ->where('pef.estado',1)
            ->where('pes.estado',1)
            ->where('ps.estado',1)
            ->where('pf.estado',1)
            ->whereIn('ps.detsit_cod',[1,2,4,5,8,9,13,14,16,17,29,30,31,32,33])
            ->orderBy('p.per_cm')
            ->orderBy('pf.fecha_sancion')
            ->get();
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
        $qr = QrCode::encoding('UTF-8')->size(100)->generate("PROMOCION: $request->cm\nFECHA EMISION: $fecha_emision\nFECHAS DE REQUERIMIENTO: $request->fechainicio al $request->fechafin");
        $codigo = $qr;

        $pdf = \PDF::loadView('DemeritoPDF.RecordPromocion',[
            'data'=>$data,
            'fecha_inicio'=>$request->fechainicio,
            'fecha_final' =>$request->fechafin,
            'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])->setPaper('letter','landscape');
        
            return $pdf->stream('ReportePromocion.pdf');
        
    }
}
