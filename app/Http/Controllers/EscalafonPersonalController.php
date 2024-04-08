<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PersonalEscalafon;
use App\Personal;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EscalafonPersonalController extends Controller
{
    public function index(Request $request){
        $id = $request->per_codigo;
       
        $listarEscalafonPersonal = DB::table('personal_escalafones')
        ->join('personals','personal_escalafones.per_codigo','personals.per_codigo')
        ->join('grados','personal_escalafones.gra_cod','grados.id')
        ->join('escalafones','personal_escalafones.esca_cod','escalafones.id')
        ->join('subescalafones','personal_escalafones.subesc_cod','subescalafones.id') 
        ->select('grados.abreviatura as grados','grados.nombre as gra_nombre','grados.id', 'escalafones.nombre as escalafon_nombre',
        'escalafones.id as escalafon_id', 'subescalafones.nombre as subesc_nombre','subescalafones.id as subescaladon_id',
        'personal_escalafones.esca_cod','personal_escalafones.subesc_cod','personal_escalafones.gra_cod',
        'personal_escalafones.estado', 'personal_escalafones.documento','personal_escalafones.fecha_doc',
        'personal_escalafones.fecha','personal_escalafones.observacion','personal_escalafones.cm',
        'personal_escalafones.sysuser','personal_escalafones.nro_doc','personal_escalafones.id',
        'personals.per_codigo as personal_id')
        ->where('personal_escalafones.per_codigo','=',$id)
        ->where('personal_escalafones.flag','=',1)
        ->orderBy('personal_escalafones.fecha_doc','desc')
        ->get();

        return response()->json($listarEscalafonPersonal);
        
    }

    public function listarPersonalEscalafon(Request $request) // listador general
    {
        // if(!$request->ajax()) return redirect('/');//si la peticion no es tipo ajax que nos rerotne a la pagina prncipal
         $buscar = $request->buscar;
         $criterio = $request->criterio;
 
         if($criterio == 'per_cm'){
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
                     'personals.per_cm',
                     'grados.abreviatura as gra_abreviatura',
                     'estudios.abreviatura as estu_abreviatura',
                     'personal_escalafones.estado as escperestado',
                     'personal_estudios.id as estperestado')
             ->where('personal_escalafones.estado',1)
             ->where('personal_estudios.estado',1)
             ->where('personals.per_cm','like','%'.$buscar.'%')
             ->orderBy('grados.id','asc')
             ->take(1)
             ->paginate(10);
         }
         elseif($criterio == 'per_paterno'){
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
                     'personals.per_cm',
                     'grados.abreviatura as gra_abreviatura',
                     'estudios.abreviatura as estu_abreviatura',
                     'personal_escalafones.estado as escperestado',
                     'personal_estudios.id as estperestado')
             ->where('personal_escalafones.estado',1)
             ->where('personal_estudios.estado',1)
             ->where('personals.per_paterno','like','%'.$buscar.'%')
             ->orderBy('grados.id','asc')
             ->take(1)
             ->paginate(10);
         }
         elseif($criterio == 'per_ci'){
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
                     'personals.per_cm',
                     'grados.abreviatura as gra_abreviatura',
                     'estudios.abreviatura as estu_abreviatura',
                     'personal_escalafones.estado as escperestado',
                     'personal_estudios.id as estperestado')
             ->where('personal_escalafones.estado',1)
             ->where('personal_estudios.estado',1)
             ->where('personals.per_ci','like','%'.$buscar.'%')
             ->orderBy('grados.id','asc')
             ->take(1)
             ->paginate(10);
         }
         elseif($criterio == 'per_materno'){
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
                     'personals.per_cm',
                     'grados.abreviatura as gra_abreviatura',
                     'estudios.abreviatura as estu_abreviatura',
                     'personal_escalafones.estado as escperestado',
                     'personal_estudios.id as estperestado')
             ->where('personal_escalafones.estado',1)
             ->where('personal_estudios.estado',1)
             ->where('personals.per_materno','like','%'.$buscar.'%')
             ->orderBy('grados.id','asc')
             ->take(1)
             ->paginate(10);
         }
         elseif($criterio == 'per_nombre'){
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
                     'personals.per_cm',
                     'grados.abreviatura as gra_abreviatura',
                     'estudios.abreviatura as estu_abreviatura',
                     'personal_escalafones.estado as escperestado',
                     'personal_estudios.id as estperestado')
             ->where('personal_escalafones.estado',1)
             ->where('personal_estudios.estado',1)
             ->where('personals.per_nombre','like','%'.$buscar.'%')
             ->orderBy('grados.id','asc')
             ->take(1)
             ->paginate(10);
         }
         return [
             'pagination' => [
                 'total'         => $personal->total(),
                 'current_page'  => $personal->currentPage(),
                 'per_page'      => $personal->perPage(),
                 'last_page'     => $personal->lastPage(),
                 'from'          => $personal->firstItem(),
                 'to'            => $personal->lastItem(),
 
             ],
             'personal' => $personal
         ];
         return response()->json($personal);
    }

    public function  DatosPersonalesAscenso(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $personal_datos = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_especialidades','personal_especialidades.per_codigo','personals.per_codigo')
        ->leftjoin('especialidades','especialidades.id','personal_especialidades.espe_cod')
        ->leftjoin('subespecialidades','subespecialidades.id','personal_especialidades.subespe_cod')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'especialidades.nombre as nomespe',
                'subespecialidades.nombre as nomsubespe',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'subescalafones.nombre as subesca_nombre',
                'grados.nombre as gra_nombre')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_escalafones.flag',1)
        ->where('personal_estudios.estado',1)
        ->where('personal_especialidades.estado',1)
       // ->orderBy('personals.per_codigo','desc')
        ->first();
        return response()->json(['personal_datos' => $personal_datos]);
    }

    public function store(Request $request){
        if(!$request->ajax()) return redirect('/');
       // return response()->json($request);
       $escalafon = $request->esca_cod;
       $subesc = $request->subesc_cod;
       $grado = $request->gra_cod;
       $documento = $request->documento;
       $nro_doc = $request->nro_doc;
       $escalafonpersonal = PersonalEscalafon::select('esca_cod','subesc_cod','gra_cod','documento','nro_doc')
       ->where('esca_cod', $escalafon)
       ->where('subesc_cod', $subesc)
       ->where('gra_cod', $grado)
       ->where('documento', $documento)
       ->where('nro_doc', $nro_doc)
       ->first();
       if(!empty($escalafonpersonal)){
           return response()->json("existe");
            //return "existe";
       } else {
            $this->EstadoEscalafon($request->per_codigo);
            $escalafonpersonal = new PersonalEscalafon();
            $escalafonpersonal->per_codigo = $request->per_codigo;
            $escalafonpersonal->esca_cod = $request->esca_cod;
            $escalafonpersonal->subesc_cod = $request->subesc_cod;
            $escalafonpersonal->gra_cod = $request->gra_cod;
            $escalafonpersonal->documento = $request->documento;
            $escalafonpersonal->fecha_doc = $request->fecha_doc;
            $escalafonpersonal->fecha = $request->fecha_doc;
            $escalafonpersonal->observacion = $request->observacion;
            $escalafonpersonal->cm = $request->cm;
            $escalafonpersonal->nro_doc = $request->nro_doc;
            $escalafonpersonal->estado = '1';
            $escalafonpersonal->sysuser = Auth::user()->id; 
            $escalafonpersonal->flag = '1';
            $escalafonpersonal->save(); 
       } 
       
    }

    public function update(Request $request){
        if (!$request->ajax()) return redirect('/');
       // return response()->json($request);
       $id = $request->id;
       $escalafon = $request->esca_cod;
       $subesc = $request->subesc_cod;
       $grado = $request->gra_cod;
       $documento = $request->documento;
       $nro_doc = $request->nro_doc;
       $fecha_doc = $request->fecha_doc;
       $escalafonpersonal = PersonalEscalafon::select('esca_cod','subesc_cod','gra_cod','documento','nro_doc','fecha_doc')
       ->where('esca_cod', $escalafon)
       ->where('subesc_cod', $subesc)
       ->where('gra_cod', $grado)
       ->where('documento', $documento)
       ->where('nro_doc', $nro_doc)
       ->where('fecha_doc', $fecha_doc)
       ->whereNotIn('id', [$id])
       ->first();
       if(!empty($escalafonpersonal)){
           return response()->json("existe");
            //return "existe";
       } else {
            $escalafonpersonal = PersonalEscalafon::findOrFail($request->id);
            $escalafonpersonal->per_codigo = $request->per_codigo;
            $escalafonpersonal->esca_cod = $request->esca_cod;
            $escalafonpersonal->subesc_cod = $request->subesc_cod;
            $escalafonpersonal->gra_cod = $request->gra_cod;
            $escalafonpersonal->documento = $request->documento;
            $escalafonpersonal->fecha_doc = $request->fecha_doc;
            $escalafonpersonal->fecha = $request->fecha_doc;
            $escalafonpersonal->observacion = $request->observacion;
            $escalafonpersonal->nro_doc = $request->nro_doc;
            $escalafonpersonal->estado = '1';
            $escalafonpersonal->sysuser = Auth::user()->id;
            $escalafonpersonal->save();  
       }
    }

    public function EstadoEscalafon($per_codigo){
        PersonalEscalafon::where('per_codigo', $per_codigo)
          ->where('estado', 1)
          ->update(['estado' => 0]);
    }

    public function EscalafonPersonalActual($id){
        //$id = $request->per_codigo;
        $listarEscalafon = DB::table('personal_escalafones')
            ->where('personal_escalafones.per_codigo','=',1481)
            ->where('personal_escalafones.estado','=',1)
            ->first();
            return $listarEscalafon;
        //return response()->json($listarEscalafon);
        
    }

    public function EscalafonPersonaReporte(Request $request){
        $id = $request->per_codigo;
        $listarEscalafonPersonal = DB::table('personal_escalafones')
        ->join('personals','personal_escalafones.per_codigo','personals.per_codigo')
        ->join('grados','personal_escalafones.gra_cod','grados.id')
        ->join('escalafones','personal_escalafones.esca_cod','escalafones.id')
        ->join('subescalafones','personal_escalafones.subesc_cod','subescalafones.id') 
        ->select('grados.abreviatura as grados','grados.id', 'escalafones.nombre as escalafon_nombre',
        'escalafones.id as escalafon_id', 'subescalafones.nombre as subesc_nombre','subescalafones.id as subescaladon_id',
        'personal_escalafones.esca_cod','personal_escalafones.subesc_cod','personal_escalafones.gra_cod',
        'personal_escalafones.estado', 'personal_escalafones.documento','personal_escalafones.fecha_doc',
        'personal_escalafones.fecha','personal_escalafones.observacion','personal_escalafones.cm',
        'personal_escalafones.sysuser','personal_escalafones.nro_doc','personal_escalafones.id',
        'personals.per_codigo as personal_id')
        ->where('personal_escalafones.per_codigo','=',$id)
        ->where('personal_escalafones.flag','=',1)
        ->orderBy('personal_escalafones.id','desc')
        ->get();
            
        $personal = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
            ->join('grados','personal_escalafones.gra_cod','=','grados.id')
            ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
            ->join('estudios','personal_estudios.est_cod','=','estudios.id')
            ->select('personals.per_codigo','personals.per_codigo as personal_id', 'personals.per_paterno','personals.per_nombre',
            'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.gra_cod','personals.per_foto',
            'personal_escalafones.per_codigo','grados.abreviatura as gra_abreviatura','estudios.abreviatura as estu_abreviatura','personals.per_sexo')
            ->where('personal_escalafones.estado','=',1)->where('personal_estudios.estado','=',1)->where('personals.per_codigo','=',$id)
            ->first();
         //return response()->json($personals);

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
          /*$qr = QrCode::format('png')->size(100)->margin(0)->merge('../public/assets/img/qr.png')->generate("NRO: $numDoc\n NOMBRE: $datosQr\n FECHA: $date\n ANTECEDENTE $casoQr");
            $codigo = $qr;*/
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        $codigo = $qr; 
        
        $pdf = PDF::loadView('reportes.certificadoEscalafonPersona',[
            'escalafonPersona'=>$listarEscalafonPersonal,
            'personal'=>$personal,
            'jefe_dpto'=>$jefe_dpto,
            'qr'=>$codigo])->setPaper('letter', 'portrait');
            
        return $pdf->stream('reporte.pdf');
    }
    
}
