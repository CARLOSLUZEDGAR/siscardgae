<?php

namespace App\Http\Controllers;

use App\Personal;
use App\PersonalComponente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PersonalComponenteController extends Controller
{
    public function index(Request $request)
    {   
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
            ->whereIn('grados.id',[1,2,3,4,5])
            ->where('personal_estudios.estado',1)
            ->where('personals.per_cm','like','%'.$buscar.'%')
            ->orderBy('personals.per_cm','asc')
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
            ->whereIn('grados.id',[1,2,3,4,5])
            ->where('personal_estudios.estado',1)
            ->where('personals.per_paterno','like','%'.$buscar.'%')
            ->orderBy('personals.per_cm','asc')
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
            ->whereIn('grados.id',[1,2,3,4,5])
            ->where('personal_estudios.estado',1)
            ->where('personals.per_ci','like','%'.$buscar.'%')
            ->orderBy('personals.per_cm','asc')
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
            ->whereIn('grados.id',[1,2,3,4,5])
            ->where('personals.per_materno','like','%'.$buscar.'%')
            ->orderBy('personals.per_cm','asc')
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
            ->whereIn('grados.id',[1,2,3,4,5])
            ->where('personals.per_nombre','like','%'.$buscar.'%')
            ->orderBy('personals.per_cm','asc')
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

    public function listarComponente(Request $request){
        $id = $request->per_codigo;
       
        $componentesPersona = DB::table('personal_componentes')
        ->join('personals','personal_componentes.per_codigo','personals.per_codigo')
        ->join('componentes','personal_componentes.comp_cod','componentes.id')
        ->select('personal_componentes.id','personal_componentes.per_codigo','personal_componentes.comp_cod',
        'personal_componentes.ndoc','personal_componentes.documento','personal_componentes.fecha_doc',
        'personal_componentes.observacion','personal_componentes.estado','personal_componentes.sysuser',
        'componentes.id as id_componente','componentes.descripcion','componentes.puntaje')
        ->where('personal_componentes.per_codigo','=',$id)
        ->orderBy('personal_componentes.id','desc')
        ->get();

        return response()->json($componentesPersona);
      // return ['componentesPersona' => $componentesPersona];
        
    }

    public function store(Request $request){
        if (!$request->ajax()) return redirect('/');
        $personalComponente = new PersonalComponente();
        $personalComponente->per_codigo = $request->per_codigo;
        $personalComponente->comp_cod = $request->comp_cod;
        $personalComponente->ndoc = $request->ndoc;
        $personalComponente->documento = $request->documento;
        $personalComponente->fecha_doc = $request->fecha_doc;
        $personalComponente->observacion = $request->observacion;
        $personalComponente->estado = '1';
        $personalComponente->sysuser = Auth::user()->id;
        $personalComponente->save();
    }

    public function update(Request $request){
        if (!$request->ajax()) return redirect('/');
        // return response()->json($request);
        $personalComponente = PersonalComponente::findOrFail($request->id);
        $personalComponente->per_codigo = $request->per_codigo;
        $personalComponente->comp_cod = $request->comp_cod;
        $personalComponente->ndoc = $request->ndoc;
        $personalComponente->documento = $request->documento;
        $personalComponente->fecha_doc = $request->fecha_doc;
        $personalComponente->observacion = $request->observacion;
        $personalComponente->estado = '1';
        $personalComponente->sysuser = Auth::user()->id;
        $personalComponente->save();
    }

    public function PersonalComponenteReporte(Request $request){
        $id = $request->per_codigo;
        $componentesPersona = DB::table('personal_componentes')
            ->join('personals','personal_componentes.per_codigo','personals.per_codigo')
            ->join('componentes','personal_componentes.comp_cod','componentes.id')
            ->select('personal_componentes.id','personal_componentes.per_codigo','personal_componentes.comp_cod',
            'personal_componentes.ndoc','personal_componentes.documento','personal_componentes.fecha_doc',
            'personal_componentes.observacion','personal_componentes.estado','personal_componentes.sysuser',
            'componentes.id as id_componente','componentes.descripcion','componentes.puntaje')
            ->where('personal_componentes.per_codigo','=',$id)
            ->orderBy('personal_componentes.id','desc')
            ->get();
            
        $personal = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
            ->join('grados','personal_escalafones.gra_cod','=','grados.id')
            ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
            ->join('estudios','personal_estudios.est_cod','=','estudios.id')
            ->select('personals.per_codigo','personals.per_codigo as personal_id', 'personals.per_paterno','personals.per_nombre',
            'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.gra_cod',
           'personal_escalafones.per_codigo','grados.abreviatura as gra_abreviatura','estudios.abreviatura as estu_abreviatura',
           'personals.per_sexo','personals.per_foto')
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
        
        $pdf = PDF::loadView('reportes.certificadoComponenteCIES',[
            'componentePersona'=>$componentesPersona,
            'personal'=>$personal,
            'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])->setPaper('letter', 'portrait');
            
        return $pdf->stream('Componente_CIES.pdf');
    }

}

