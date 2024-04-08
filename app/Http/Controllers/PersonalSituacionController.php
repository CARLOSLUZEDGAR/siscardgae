<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;


class PersonalSituacionController extends Controller
{
    public function DatosPersonales(Request $request)
    {
        $percodigo = $request->percodigo;
        $datos = DB::table('personal_situaciones as ps')
            ->join('personals as p','ps.per_codigo','p.per_codigo')
            ->join('situaciones as s','ps.sit_codigo','s.id')
            ->join('subsituaciones as sb','ps.subsit_codigo','sb.id')
            ->join('detalle_situaciones as ds','ps.detsit_codigo','ds.id')
            ->select('p.per_codigo as codigo','p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm',
                        'p.per_fecha_nacimiento as fechaNacimiento','p.per_sexo as genero', 'p.per_ci as ci', 'p.per_expedido as expedido', 'p.per_celular as celular', 
                        'p.per_estado_civil as estadoCivil', 'p.per_seguro as seguro', 'p.per_serv_mil as servMil', 'p.per_religion as religion',
                        'p.per_mail as email','g.gra_abreviatura as grado','e.estu_abreviatura as complemento')
            ->where('ps.per_codigo',$percodigo)
            ->where('ps.estado',1)
            ->where('epe.estado',1)
            ->first();
        
            return response()->json($datos);
    }

    public function DatosPersonalesSituacion(Request $request)
    {
        $percodigo = $request->percodigo;
        
        $datos = DB::table('personal_situaciones as ps')
            ->join('personals as p','ps.per_codigo','p.per_codigo')
            ->join('situaciones as s','ps.sit_cod','s.id')
            ->join('subsituaciones as sb','ps.subsit_cod','sb.id')
            ->join('detalle_situaciones as ds','ps.detsit_cod','ds.id')
            ->join('personal_escalafones as pe','ps.per_codigo','pe.per_codigo')
            ->join('grados as g','pe.gra_cod','g.id')
            ->join('personal_estudios as pes','ps.per_codigo','pes.per_codigo')
            ->join('estudios as e','pes.est_cod','e.id')
            ->select('p.per_codigo as codigo','p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm','p.per_foto as foto','p.per_ci as ci','p.per_expedido as expedido',
                    'g.abreviatura as grado','e.abreviatura as complemento','s.nombre as nombsit','sb.nombre as nombsub','ds.nombre as nombdet')
            ->where('p.per_codigo',$percodigo)
            ->where('ps.estado',1)
            ->where('pe.estado',1)
            ->where('pes.estado',1)
            ->first();
           // $datos = DB::table('personals')->where('per_codigo',$percodigo)->first();
            
            return response()->json($datos);
    }

    public function ListarSituacionMilitar(Request $request)
    {
        
        $percodigo = $request->percodigo;
        $datos = [];

       
            $datos = DB::table('personal_situaciones as ps')
            ->join('personals as p','ps.per_codigo','p.per_codigo')
            ->join('situaciones as s','ps.sit_cod','s.id')
            ->join('subsituaciones as sb','ps.subsit_cod','sb.id')
            ->join('detalle_situaciones as ds','ps.detsit_cod','ds.id')
            ->select('ps.id as codigo','ps.estado','ps.sit_cod','ps.subsit_cod','ps.detsit_cod','ps.documento','ps.fecha_documento as fechdoc',
                     'ps.fecha','ps.nrodoc','ps.ficticia','ps.promo',
                     'ps.observacion','s.nombre as nombsit','sb.nombre as nombsub','ds.nombre as nombdet')
            ->where('ps.per_codigo',$percodigo)
            ->orderBy('ps.fecha_documento','desc')
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
            
        /*return response()->json($datos);  */
    }

    public function DatosSituacionMilitarModificar(Request $request)
    {
        $sitpercod = $request->sitpercod;
             $datos = DB::table('personal_situaciones as ps')
            ->join('personals as p','ps.per_codigo','p.per_codigo')
            ->join('situaciones as s','ps.sit_cod','s.id')
            ->join('subsituaciones as sb','ps.subsit_cod','sb.id')
            ->join('detalle_situaciones as ds','ps.detsit_cod','ds.id')
            ->select('ps.id as codigo','ps.sit_cod','ps.subsit_cod','ps.detsit_cod','ps.documento','ps.fecha_documento as fechdoc',
                     'ps.fecha','ps.nrodoc','ps.ficticia','ps.promo',
                     'ps.observacion','s.nombre as nombsit','sb.nombre as nombsub','ds.nombre as nombdet')
            ->where('ps.id',$sitpercod)
            ->first();
        return response()->json($datos);  
    }

    public function SituacionesPdf(Request $request)
    {
        $per_codigo = $request->per_codigo;

             $personal_situaciones = DB::table('personal_situaciones as ps')
            ->join('personals as p','ps.per_codigo','p.per_codigo')
            ->join('situaciones as s','ps.sit_cod','s.id')
            ->join('subsituaciones as sb','ps.subsit_cod','sb.id')
            ->join('detalle_situaciones as ds','ps.detsit_cod','ds.id')
            ->join('personal_escalafones as pe','ps.per_codigo','pe.per_codigo')
            ->join('grados as g','pe.gra_cod','g.id')
            ->join('personal_estudios as pes','ps.per_codigo','pes.per_codigo')
            ->join('estudios as e','pes.est_cod','e.id')
            ->select('p.per_codigo as codigo',
                     'p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm','p.per_foto as foto','p.per_ci as ci','p.per_expedido as expedido',
                    'g.abreviatura as grado','e.abreviatura as complemento',
                    's.nombre as nombsit',
                    'sb.nombre as nombsub',
                    'ds.nombre as nombdet',
                    'ps.documento as documento',
                    'ps.nrodoc as ndoc',
                    'ps.fecha_documento as fecha',
                    'ps.observacion as observacion')
            ->where('p.per_codigo',$per_codigo)
            ->where('pe.estado',1)
            ->where('pes.estado',1)
            ->orderBy('ps.id','asc')
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
                    'grados.abreviatura as grabrev_j',
                    'estudios.abreviatura as estbrev_j',
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
                    'grados.abreviatura as grabrev',
                    'estudios.abreviatura as estbrev',
                    'personal_escalafones.estado as escperestado',
                    'personal_estudios.id as estperestado')
            ->where('personals.per_codigo',$per_codigo)
            ->where('personal_escalafones.estado',1)
            ->where('personal_estudios.estado',1)
            ->first();

            $datosQr = $personal->grabrev.' '.$personal->estbrev.' '.$personal->per_nombre.' '.$personal->per_paterno.' '.$personal->per_materno;
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("NOMBRE: $datosQr\n FECHA DE EMISION: $date");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.personalSituaciones',['personal_situaciones'=>$personal_situaciones,'codigo'=>$codigo,'personal'=>$personal,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('PersonalSituaciones.pdf');

    }
    
    public function SituacionesPorFechaPdf(Request $request)
    {

        $fechainicio = $request->fechainicio;
        $fechafin=$request->fechafin;
        $detcodigo = $request->detcodigo;
        $nombdet=DB::table('detalle_situaciones')
                     ->select('nombre')
                     ->where('id',$detcodigo)
                     ->first();

             $personal_situaciones = DB::table('personal_situaciones as ps')
            ->join('personals as p','ps.per_codigo','p.per_codigo')
            ->join('situaciones as s','ps.sit_cod','s.id')
            ->join('subsituaciones as sb','ps.subsit_cod','sb.id')
            ->join('detalle_situaciones as ds','ps.detsit_cod','ds.id')
            ->join('personal_escalafones as pe','ps.per_codigo','pe.per_codigo')
            ->join('grados as g','pe.gra_cod','g.id')
            ->join('personal_estudios as pes','ps.per_codigo','pes.per_codigo')
            ->join('estudios as e','pes.est_cod','e.id')
            ->select('p.per_codigo as codigo',
                     'p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm','p.per_ci as ci','p.per_expedido as expedido',
                    'g.abreviatura as grado','e.abreviatura as complemento',
                    's.nombre as nombsit',
                    'sb.nombre as nombsub',
                    'ds.nombre as nombdet',
                    'ps.documento as documento',
                    'ps.nrodoc as ndoc',
                    'ps.fecha_documento as fecha',
                    'ps.observacion as observacion')
            ->where('ds.id',$detcodigo)
            ->whereBetween('ps.fecha_documento', [$fechainicio,$fechafin])
            ->where('pe.estado',1)
            ->where('pes.estado',1)
            ->orderBy('ps.fecha_documento','desc')
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
                    'grados.abreviatura as grabrev_j',
                    'estudios.abreviatura as estbrev_j',
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

            
            $datosQr = $nombdet->nombre;
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("NOMBRE: $datosQr\n FECHA DE EMISION: $date");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.personalSituacionesFechas',['personal_situaciones'=>$personal_situaciones,'codigo'=>$codigo,'jefe_dpto'=>$jefe_dpto,'nombredet'=>$nombdet])
        ->setPaper('letter', 'landscape');
        //->setPaper('letter', 'portrait');
        return $pdf->stream('PersonalSituacionesFecha.pdf');

    }
}
