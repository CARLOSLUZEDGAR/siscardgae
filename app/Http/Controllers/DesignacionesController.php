<?php

namespace App\Http\Controllers;

use App\PersonalDesignaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DesignacionesController extends Controller
{
    public function RegistrarDesignacion(Request $request)  
    {
       
       $date = Carbon::parse($request->fecha);
        if ($request->nrodoc < 10) {
            $nrodoc ='0'.$request->nrodoc.'/'.$date->isoFormat('YY');
        } else {
            $nrodoc = $request->nrodoc.'/'.$date->isoFormat('YY');
        }
       
        $designacion = PersonalDesignaciones::create([
            'per_codigo'=>$request->percodigo,
            'documento'=>$request->documento,
            'nro_doc'=>$nrodoc,
            'fecha'=>$request->fecha,
            'descripcion'=>$request->descripcion,
            'observacion'=>$request->observacion,
            'estado'=>1,
            'sysuser'=>Auth::user()->id
        ]);
        return response()->json($designacion);
       
    }

    public function EditarDesignacion(Request $request)
    {
        $sitper = DB::table('personal_designaciones')
            ->where('id', $request->idsit)
            ->update([
                'documento'=>$request->documento,
                'nro_doc'=>$request->nrodoc,
                'fecha'=>$request->fecha,
                'descripcion'=>$request->descripcion,                
                'observacion'=>$request->observacion,
                'sysuser'=>Auth::user()->id
            ]);
        
        return response()->json($sitper);
    }

    public function DatosDesignacionModificar(Request $request)
    {
        $detpercod = $request->sitpercod;
             $datos = DB::table('personal_designaciones as pd')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->select('pd.id as codigo','pd.documento','pd.nro_doc as nrodoc','pd.fecha','pd.descripcion','pd.observacion')                     
            ->where('pd.id',$detpercod)
            ->first();
        return response()->json($datos);  
    }

    public function EliminarDesignacion(Request $request)
    {
        DB::table('personal_designaciones')->where('id',$request->idsit)->delete();
        return response()->json($request);
    }

    public function DesignacionesPdf(Request $request)
    {
        $per_codigo = $request->per_codigo;

             $personal_designaciones = DB::table('personal_designaciones as pd')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','pd.per_codigo','pe.per_codigo')
            ->join('grados as g','pe.gra_cod','g.id')
            ->join('personal_estudios as pes','pd.per_codigo','pes.per_codigo')
            ->join('estudios as e','pes.est_cod','e.id')
            ->select('p.per_codigo as codigo',
                     'p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm','p.per_foto as foto','p.per_ci as ci','p.per_expedido as expedido',
                    'g.abreviatura as grado','e.abreviatura as complemento',
                    'pd.documento as documento',
                    'pd.nro_doc as ndoc',
                    'pd.fecha as fecha',
                    'pd.descripcion as descripcion',
                    'pd.observacion as observacion')
            ->where('p.per_codigo',$per_codigo)
            ->where('pe.estado',1)
            ->where('pes.estado',1)
            ->orderBy('pd.id','asc')
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

        $pdf = PDF::loadView('reportes.reporteDesignacionespdf',['personal_designaciones'=>$personal_designaciones,'codigo'=>$codigo,'personal'=>$personal,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('PersonalDesignaciones.pdf');

    }
}
