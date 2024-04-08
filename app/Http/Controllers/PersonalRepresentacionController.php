<?php

namespace App\Http\Controllers;

use App\Personal;
use App\PersonalRepresentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonalRepresentacionController extends Controller
{
    public function ListarRepresentacion(Request $request)
    {
        
        $percodigo = $request->percodigo;
        $datos = [];

       
            $datos = DB::table('personal_representaciones as pr')
            ->join('personals as p','pr.per_codigo','p.per_codigo')
            ->join('representaciones as r','pr.repre_cod','r.id')
            ->select('pr.id as codigo','pr.estado','pr.repre_cod','pr.documento','pr.fecha',
                     'pr.nro_doc as nrodoc','pr.observacion','pr.descripcion','r.descripcion as representacion')
            ->where('pr.per_codigo',$percodigo)
            ->orderBy('pr.fecha','desc')
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

    public function ListarRepresentacionesCombo()
    {
        $representaciones = DB::table('representaciones')
            ->select('id','descripcion')
            ->where('estado',1)
            ->orderBy('id')
            ->get();
        
        return response()->json($representaciones);
    }

    public function RegistrarRepresentacion(Request $request)
    {
        $date = Carbon::parse($request->fechadoc);
        if ($request->nrodoc < 10) {
            $nrodoc ='0'.$request->nrodoc.'/'.$date->isoFormat('YY');
        } else {
            $nrodoc = $request->nrodoc.'/'.$date->isoFormat('YY');
        }
        
                  
        $representacion = PersonalRepresentacion::create([
            'per_codigo'=>$request->percodigo,
            'repre_cod'=>$request->reprecod,
            'descripcion'=>$request->descripcion,
            'documento'=>$request->documento,
            'nro_doc'=>$nrodoc,
            'fecha'=>$request->fecha,
            'observacion'=>$request->observacion,
            'estado'=>1,
            'sysuser'=>Auth::user()->id
        ]);
        return response()->json($representacion);
       
    }

    public function EditarRepresentacion(Request $request)
    {
        $repper = DB::table('personal_representaciones')
            ->where('id', $request->codigo)
            ->update([
                'repre_cod'=>$request->reprecod,
                'descripcion'=>$request->descripcion,
                'documento'=>$request->documento,
                'nro_doc'=>$request->nrodoc,
                'fecha'=>$request->fecha,
                'observacion'=>$request->observacion,
                'estado'=>1,
                'sysuser'=>Auth::user()->id
            ]);
        
        return response()->json($request);
    }

    public function DatosRepresentacionModificar(Request $request)
    {
        $reppercod = $request->reppercod;
             $datos = DB::table('personal_representaciones as pr')
            ->join('personals as p','pr.per_codigo','p.per_codigo')
            ->join('representaciones as r','pr.repre_cod','r.id')
            ->select('pr.id as codigo','pr.repre_cod as reprecod','pr.descripcion','pr.documento','pr.nro_doc as nrodoc',
                     'pr.fecha','pr.observacion','r.descripcion as nomrep')
            ->where('pr.id',$reppercod)
            ->first();
        return response()->json($datos);  
    }

    public function EliminarRepresentacion(Request $request)
    {
        DB::table('personal_representaciones')->where('id',$request->idrepre)->delete();
        return response()->json($request);
    }

    public function RepresentacionesPdf(Request $request)
    {
        $per_codigo = $request->per_codigo;

             $personal_representaciones = DB::table('personal_representaciones as pr')
            ->join('personals as p','pr.per_codigo','p.per_codigo')
            ->join('personal_escalafones as pe','pr.per_codigo','pe.per_codigo')
            ->join('grados as g','pe.gra_cod','g.id')
            ->join('personal_estudios as pes','pr.per_codigo','pes.per_codigo')
            ->join('estudios as e','pes.est_cod','e.id')
            ->join('representaciones as r','pr.repre_cod','r.id')
            ->select('p.per_codigo as codigo',
                     'p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm','p.per_foto as foto','p.per_ci as ci','p.per_expedido as expedido',
                    'g.abreviatura as grado','e.abreviatura as complemento',
                    'r.descripcion as representacion',
                    'pr.descripcion as descripcion',
                    'pr.documento as documento',
                    'pr.nro_doc as nrodoc',
                    'pr.fecha as fecha',                    
                    'pr.observacion as observacion'
                   )
            ->where('p.per_codigo',$per_codigo)
            ->where('pe.estado',1)
            ->where('pes.estado',1)
            ->orderBy('pr.id','asc')
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

        $pdf = PDF::loadView('reportes.reporteRepresentacionespdf',['personal_representaciones'=>$personal_representaciones,'codigo'=>$codigo,'personal'=>$personal,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('PersonalRepresentaciones.pdf');

    }

}
