<?php

namespace App\Http\Controllers;

use App\Ascenso;
use Illuminate\Http\Request;
use App\AscensoPersonal;
use App\PersonalEscalafon;
use App\Personal_Ascenso_promocion;
use App\Grado;
use App\Personal;
use App\Instancia;
use App\Subescalafon;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AscensoPersonalController extends Controller
{

    public function index(Request $request){
        $id = $request->per_codigo;
        $listaascensos = DB::table('personal_ascenso_promociones')
        ->join('personals','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('ascensos','personal_ascenso_promociones.asc_cod','ascensos.id')
        ->join('grados','personal_ascenso_promociones.gra_cod','grados.id')
        ->join('instancia_ascensos','personal_ascenso_promociones.instasc_cod','instancia_ascensos.id')
        ->select('grados.abreviatura','grados.id as id_grado','ascensos.nrodocumento','ascensos.documento',
        'ascensos.fechadocumento','personal_ascenso_promociones.antiguedad',
        'personal_ascenso_promociones.codpromo','personal_ascenso_promociones.promoact',
        'personal_ascenso_promociones.antigfin','personal_ascenso_promociones.id',
        'personal_ascenso_promociones.asc_cod','personal_ascenso_promociones.instasc_cod as instancia',
        'personal_ascenso_promociones.observacion','personals.per_codigo',
        'personal_ascenso_promociones.fechasc','personal_ascenso_promociones.estado','instancia_ascensos.instancia')
        ->where('personal_ascenso_promociones.per_codigo','=',$id)
        ->where('personal_ascenso_promociones.flag',1)
        ->orderBy('personal_ascenso_promociones.gra_cod','asc')
        ->get();

        return response()->json($listaascensos);
    }

    public function datosEdit(Request $request){
        $id = $request->id;
        $listaascensos = DB::table('personal_ascenso_promociones')
        ->join('personals','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('ascensos','personal_ascenso_promociones.asc_cod','ascensos.id')
        ->join('grados','personal_ascenso_promociones.gra_cod','grados.id')
        ->select('grados.abreviatura','grados.id as id_grado','ascensos.nrodocumento','ascensos.documento',
        'ascensos.fechadocumento','personal_ascenso_promociones.antiguedad',
        'personal_ascenso_promociones.codpromo','personal_ascenso_promociones.promoact',
        'personal_ascenso_promociones.antigfin','personal_ascenso_promociones.id',
        'personal_ascenso_promociones.asc_cod','personal_ascenso_promociones.instasc_cod as instancia',
        'personal_ascenso_promociones.observacion','personals.per_codigo',
        'personal_ascenso_promociones.fechasc','personal_ascenso_promociones.estado')
        ->where('personal_ascenso_promociones.id','=',$id)
        ->get();

        return response()->json($listaascensos);

    }

    public function listarPersonalAscenso(Request $request)
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
                    'personal_escalafones.gra_cod',
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
                    'personal_escalafones.gra_cod',
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
                    'personal_escalafones.gra_cod',
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
                    'personal_escalafones.gra_cod',
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
                    'personal_escalafones.gra_cod',
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
                'personal_escalafones.gra_cod',
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
        ->where('personal_estudios.estado',1)
        ->where('personal_especialidades.estado',1)
       // ->orderBy('personals.per_codigo','desc')
        ->first();
        return response()->json(['personal_datos' => $personal_datos]);
    }

    public function masivo(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar!=''){

            $personals = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
            ->join('grados','personal_escalafones.gra_cod','=','grados.id')
            ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
            ->join('estudios','personal_estudios.est_cod','=','estudios.id')
            ->join('personal_ascenso_promociones','personals.per_codigo','=','personal_ascenso_promociones.per_codigo')
            ->join('personal_situaciones','personals.per_codigo','=','personal_situaciones.per_codigo')
            ->select('personals.per_codigo', 'personals.per_paterno','personals.per_nombre',
            'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.esca_cod',
            'personal_escalafones.subesc_cod','personal_escalafones.gra_cod','grados.abreviatura as gra_abreviatura',
            'personal_ascenso_promociones.antiguedad as anti','personal_ascenso_promociones.promoact',
            'personal_ascenso_promociones.antigfin','estudios.abreviatura as estu_abreviatura','personal_situaciones.detsit_cod')
            ->whereIn('personal_situaciones.detsit_cod',[1,2,4,5,8,9,10,29,30,31,33])
            ->where('personal_escalafones.estado','=',1)
            ->where('personal_estudios.estado','=',1)
            ->where($criterio, 'like', '%'.$buscar.'%')
            ->where('personal_ascenso_promociones.codpromo','=',$buscar)
            ->where('personal_ascenso_promociones.estado','=',1)
            ->where('personal_situaciones.estado','=',1)
            ->orderBy('personal_ascenso_promociones.antiguedad', 'asc')->paginate(150);
           // var_dump($personals);
            if($personals==NULL){
                $personals = DB::table('personals')
                ->join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
                ->join('grados','personal_escalafones.gra_cod','=','grados.id')
                ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
                ->join('estudios','personal_estudios.est_cod','=','estudios.id')
                ->join('personal_situaciones','personals.per_codigo','=','personal_situaciones.per_codigo')
                ->select('personals.per_codigo', 'personals.per_paterno','personals.per_nombre',
                'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.esca_cod',
                'personal_escalafones.subesc_cod','personal_escalafones.gra_cod','grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura','personal_situaciones.detsit_cod')
                ->whereIn('personal_situaciones.detsit_cod',[1,2,4,5,8,9,10,29,30,31,33])
                ->where('personal_escalafones.estado','=',1)
                ->where('personal_estudios.estado','=',1)
                ->where($criterio, 'like', '%'.$buscar.'%')
                ->where('personals.per_promo','=',$buscar)
                ->where('personal_situaciones.estado','=',1)
                ->orderBy('personals.per_cm', 'asc')->paginate(150);
            }

            return['personals' => $personals];
        }

    }

    public function AgregarDetalle(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar!=''){

            $personals = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
            ->join('grados','personal_escalafones.gra_cod','=','grados.id')
            ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
            ->join('estudios','personal_estudios.est_cod','=','estudios.id')
            ->join('personal_ascenso_promociones','personals.per_codigo','=','personal_ascenso_promociones.per_codigo')
            ->join('personal_situaciones','personals.per_codigo','=','personal_situaciones.per_codigo')
            ->select('personals.per_codigo', 'personals.per_paterno','personals.per_nombre',
            'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.esca_cod',
            'personal_escalafones.subesc_cod','personal_escalafones.gra_cod','grados.abreviatura as gra_abreviatura',
            'personal_ascenso_promociones.antiguedad as anti','personal_ascenso_promociones.promoact',
            'personal_ascenso_promociones.antigfin','estudios.abreviatura as estu_abreviatura','personal_situaciones.detsit_cod')
            ->whereIn('personal_situaciones.detsit_cod',[1,2,4,5,8,9,10,29,30,31,33])
            ->where('personal_escalafones.estado','=',1)
            ->where('personal_estudios.estado','=',1)
            ->where($criterio, 'like', '%'.$buscar.'%')
            ->where('personals.per_cm','=',$buscar)
            ->where('personal_ascenso_promociones.estado','=',1)
            ->where('personal_situaciones.estado','=',1)
            ->orderBy('personal_ascenso_promociones.antiguedad', 'asc')->paginate(200);
           return[

            'detalles' => $personals,
            'code'=>200
        ];

        }
        else
        {
           return [
               'code'=>400
           ];


        }

    }

    public function ListarPersonalsinAscenso(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){

            $personals= Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
            ->join('grados','personal_escalafones.gra_cod','=','grados.id')
            ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
            ->join('estudios','personal_estudios.est_cod','=','estudios.id')
            ->join('personal_ascenso_promociones','personals.per_codigo','=','personal_ascenso_promociones.per_codigo')
            ->select('personals.per_codigo as personal_id', 'personals.per_paterno','personals.per_nombre','personals.per_materno','personals.per_ci',
            'personals.per_cm','personals.per_promo','personal_escalafones.gra_cod','personal_escalafones.per_codigo','grados.abreviatura as gra_abreviatura','estudios.abreviatura as estu_abreviatura'
            )->where('personal_escalafones.estado','=',1)->where('personal_estudios.estado','=',1)->orderBy('personals.per_cm', 'asc')->paginate(10);
        }
        else
        {
            $personals = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
            ->join('grados','personal_escalafones.gra_cod','=','grados.id')
            ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
            ->join('estudios','personal_estudios.est_cod','=','estudios.id')
           ->select('personals.per_codigo as personal_id', 'personals.per_paterno','personals.per_nombre','personals.per_materno','personals.per_ci',
           'personals.per_cm','personals.per_promo','personal_escalafones.gra_cod','personal_escalafones.per_codigo','grados.abreviatura as gra_abreviatura','estudios.abreviatura as estu_abreviatura')
           ->where('personal_escalafones.estado','=',1)->where('personal_estudios.estado','=',1)->where($criterio, 'like', '%'.$buscar.'%')
           ->orderBy('per_cm', 'asc')->paginate(10);


        }
        return[
            'pagination' => [
                'total'         => $personals->total(),
                'current_page'  => $personals->currentPage(),
                'per_page'      => $personals->perPage(),
                'last_page'     => $personals->lastPage(),
                'from'          => $personals->firstItem(),
                'to'            => $personals->lastItem(),
            ],
            'personals' => $personals
        ];
    }

    public function store(Request $request){
       // return var_dump($request->escalafon);
        if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $instancia = $request->instasc_cod;
            if($instancia==6){
                $this->EstadoAscenso($request->per_codigo);
                $this->EstadoEscalafon($request->per_codigo);
                $ascensopersonal = new AscensoPersonal();
                $ascensopersonal->per_codigo = $request->per_codigo;
                $ascensopersonal->asc_cod = $request->asc_cod;
                $ascensopersonal->gra_cod = $request->gra_cod;
                $ascensopersonal->codpromo = $request->codpromo + 1;
                $ascensopersonal->promoact = $request->promoact + 1;
                $ascensopersonal->antiguedad = $request->antiguedad;
                $ascensopersonal->instasc_cod = $request->instasc_cod;
                $ascensopersonal->fechasc = $request->fechasc;
                $ascensopersonal->antigfin = $request->antiguedad.'/'.$request->total_promo;
                $ascensopersonal->observacion = $request->observacion;
                $ascensopersonal->estado = '1';
                $ascensopersonal->flag = '1';
                $ascensopersonal->sysuser = Auth::user()->id;
                $ascensopersonal->save();

                $escalafonpersonal = new PersonalEscalafon();
                $escalafonpersonal->per_codigo = $request->per_codigo;
                $escalafonpersonal->esca_cod = $request->escalafon;
                $escalafonpersonal->subesc_cod = $request->subesc;
                $escalafonpersonal->gra_cod = $request->gra_cod;
                $escalafonpersonal->documento = $request->documento;
                $escalafonpersonal->fecha_doc = $request->fechasc;
                $escalafonpersonal->fecha = $request->fechasc;
                $escalafonpersonal->cm = $request->cm;
                $escalafonpersonal->nro_doc = $request->nro_doc;
                $escalafonpersonal->observacion = $request->observacion;
                $escalafonpersonal->estado = '1';
                $escalafonpersonal->flag = '1';
                $escalafonpersonal->sysuser = Auth::user()->id;
                $escalafonpersonal->save();
            } else{
               // return var_dump($request->subesc);

                $this->EstadoAscenso($request->per_codigo);
                $this->EstadoEscalafon($request->per_codigo);
                $ascensopersonal = new AscensoPersonal();
                $ascensopersonal->per_codigo = $request->per_codigo;
                $ascensopersonal->asc_cod = $request->asc_cod;
                $ascensopersonal->gra_cod = $request->gra_cod;
                $ascensopersonal->codpromo = $request->codpromo;
                $ascensopersonal->promoact = $request->promoact;
                $ascensopersonal->antiguedad = $request->antiguedad;
                $ascensopersonal->instasc_cod = $request->instasc_cod;
                $ascensopersonal->fechasc = $request->fechasc;
                $ascensopersonal->antigfin = $request->antiguedad.'/'.$request->total_promo;
                $ascensopersonal->observacion = $request->observacion;
                $ascensopersonal->estado = '1';
                $ascensopersonal->flag = '1';
                $ascensopersonal->sysuser = Auth::user()->id;
                $ascensopersonal->save();

                $escalafonpersonal = new PersonalEscalafon();
                $escalafonpersonal->per_codigo = $request->per_codigo;
                $escalafonpersonal->esca_cod = $request->escalafon;
                $escalafonpersonal->subesc_cod = $request->subesc;
                $escalafonpersonal->gra_cod = $request->gra_cod;
                $escalafonpersonal->documento = $request->documento;
                $escalafonpersonal->fecha_doc = $request->fechasc;
                $escalafonpersonal->fecha = $request->fechasc;
                $escalafonpersonal->cm = $request->cm;
                $escalafonpersonal->nro_doc = $request->nro_doc;
                $escalafonpersonal->observacion = $request->observacion;
                $escalafonpersonal->estado = '1';
                $escalafonpersonal->flag = '1';
                $escalafonpersonal->sysuser = Auth::user()->id;
                $escalafonpersonal->save();
                }

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request){
        if(!$request->ajax()) return redirect('/');
        //return response()->json($request);
        $ascensopersonal = AscensoPersonal::findOrFail($request->id);
        $ascensopersonal->asc_cod = $request->asc_cod;
        $ascensopersonal->codpromo = $request->codpromo;
        $ascensopersonal->promoact = $request->promoact;
        $ascensopersonal->instasc_cod = $request->instancia;
        $ascensopersonal->antiguedad = $request->antiguedad;

        $ascensopersonal->observacion = $request->observacion;
        $ascensopersonal->antigfin = $request->antigfin;
        $ascensopersonal->save();


    }

    public function RegistroMasivo(Request $request){
        $arrayPersonal = $request->personal;

        try{
            DB::beginTransaction();
            foreach($arrayPersonal as $persona){
               // return var_dump($persona['esca_cod']);
                if($persona['gra_cod'] == 49){
                    $ascensopersonal = new AscensoPersonal();
                    $this->EstadoEscalafon($persona['per_codigo']);
                    $ascensopersonal->asc_cod = $request->asc_cod['id'];
                    $ascensopersonal->promoact = $request->promoact;
                    $ascensopersonal->instasc_cod = 1;
                    $ascensopersonal->fechasc = $request->fechasc;

                    $ascensopersonal->observacion = $request->observacion;
                    $ascensopersonal->estado = '1';
                    $ascensopersonal->flag = '1';
                    $ascensopersonal->sysuser = Auth::user()->id;
                    $ascensopersonal->gra_cod = $persona['gra_cod'] - 40;
                    $ascensopersonal->codpromo = $persona['per_promo'];
                    $ascensopersonal->per_codigo = $persona['per_codigo'];
                    $ascensopersonal->antiguedad = ( isset($persona['antiguedad']) ) ? $persona['antiguedad'] : 0;
                    $ascensopersonal->antigfin =  $persona['antiguedad'].'/'.$request->total;
                    $ascensopersonal->save();


                    $escalafonpersonal = new PersonalEscalafon();
                    $escalafonpersonal->per_codigo =   $persona['per_codigo'];
                    $escalafonpersonal->esca_cod = $persona['esca_cod'];
                    $escalafonpersonal->subesc_cod = $persona['subesc_cod']-1;
                    $escalafonpersonal->gra_cod = $persona['gra_cod'] - 40;
                    $escalafonpersonal->documento = $request->documento;
                    $escalafonpersonal->fecha_doc = $request->fechasc;
                    $escalafonpersonal->fecha = $request->fechasc;
                    $escalafonpersonal->cm = $persona['per_cm'];
                    $escalafonpersonal->nro_doc = $request->nro_doc;
                    $escalafonpersonal->observacion = $request->observacion;
                    $escalafonpersonal->estado = '1';
                    $escalafonpersonal->flag = '1';
                    $escalafonpersonal->sysuser = Auth::user()->id;
                    $escalafonpersonal->save();
                }
                if($persona['gra_cod'] == 50){
                    $ascensopersonal = new AscensoPersonal();
                    $this->EstadoEscalafon($persona['per_codigo']);
                    $ascensopersonal->asc_cod = $request->asc_cod['id'];
                    $ascensopersonal->promoact = $request->promoact;
                    $ascensopersonal->instasc_cod = 1;
                    $ascensopersonal->fechasc = $request->fechasc;

                    $ascensopersonal->observacion = $request->observacion;
                    $ascensopersonal->estado = '1';
                    $ascensopersonal->flag = '1';
                    $ascensopersonal->sysuser = Auth::user()->id;
                    $ascensopersonal->gra_cod = $persona['gra_cod'] - 33;
                    $ascensopersonal->codpromo = $persona['per_promo'];
                    $ascensopersonal->per_codigo = $persona['per_codigo'];
                    $ascensopersonal->antiguedad = ( isset($persona['antiguedad']) ) ? $persona['antiguedad'] : 0;
                    $ascensopersonal->antigfin =  $persona['antiguedad'].'/'.$request->total;
                    $ascensopersonal->save();

                    $escalafonpersonal = new PersonalEscalafon();
                    $escalafonpersonal->per_codigo =   $persona['per_codigo'];
                    $escalafonpersonal->esca_cod = $persona['esca_cod'];
                    $escalafonpersonal->subesc_cod = $persona['subesc_cod'];
                    $escalafonpersonal->gra_cod = $persona['gra_cod'] - 33;
                    $escalafonpersonal->documento = $request->documento;
                    $escalafonpersonal->fecha_doc = $request->fechasc;
                    $escalafonpersonal->fecha = $request->fechasc;
                    $escalafonpersonal->cm = $persona['per_cm'];
                    $escalafonpersonal->nro_doc = $request->nro_doc;
                    $escalafonpersonal->observacion = $request->observacion;
                    $escalafonpersonal->estado = '1';
                    $escalafonpersonal->flag = '1';
                    $escalafonpersonal->sysuser = Auth::user()->id;
                    $escalafonpersonal->save();
                }
                if($persona['gra_cod'] == 173){
                    $ascensopersonal = new AscensoPersonal();
                    $this->EstadoEscalafon($persona['per_codigo']);
                    $ascensopersonal->asc_cod = $request->asc_cod['id'];
                    $ascensopersonal->promoact = $request->promoact;
                    $ascensopersonal->instasc_cod = 1;
                    $ascensopersonal->fechasc = $request->fechasc;
                    $ascensopersonal->observacion = $request->observacion;
                    $ascensopersonal->estado = '1';
                    $ascensopersonal->flag = '1';
                    $ascensopersonal->sysuser = Auth::user()->id;
                    $ascensopersonal->gra_cod = $persona['gra_cod'] - 1;
                    $ascensopersonal->codpromo = $persona['per_promo'];
                    $ascensopersonal->per_codigo = $persona['per_codigo'];
                    $ascensopersonal->antiguedad = ( isset($persona['antiguedad']) ) ? $persona['antiguedad'] : 0;
                    $ascensopersonal->antigfin =  $persona['antiguedad'].'/'.$request->total;
                    $ascensopersonal->save();


                    $escalafonpersonal = new PersonalEscalafon();
                    $escalafonpersonal->per_codigo =   $persona['per_codigo'];
                    $escalafonpersonal->esca_cod = $persona['esca_cod'];
                    $escalafonpersonal->subesc_cod = $persona['subesc_cod'];
                    $escalafonpersonal->gra_cod = $persona['gra_cod'] - 1;
                    $escalafonpersonal->documento = $request->documento;
                    $escalafonpersonal->fecha_doc = $request->fechasc;
                    $escalafonpersonal->fecha = $request->fechasc;
                    $escalafonpersonal->cm = $persona['per_cm'];
                    $escalafonpersonal->nro_doc = $request->nro_doc;
                    $escalafonpersonal->observacion = $request->observacion;
                    $escalafonpersonal->estado = '1';
                    $escalafonpersonal->flag = '1';
                    $escalafonpersonal->sysuser = Auth::user()->id;
                    $escalafonpersonal->save();

                // return response()->json($ascensopersonal->asc_cod);
                }
                if($persona['gra_cod'] == 4 || $persona['gra_cod'] == 7 || $persona['gra_cod'] == 12 || $persona['gra_cod'] == 15){
                    $ascensopersonal = new AscensoPersonal();
                    $this->EstadoAscenso($persona['per_codigo']);
                    $this->EstadoEscalafon($persona['per_codigo']);
                    $ascensopersonal->asc_cod = $request->asc_cod['id'];
                    $ascensopersonal->promoact = $persona['promoact'];
                    $ascensopersonal->instasc_cod = 1;
                    $ascensopersonal->fechasc = $request->fechasc;

                    $ascensopersonal->observacion = $request->observacion;
                    $ascensopersonal->estado = '1';
                    $ascensopersonal->flag = '1';
                    $ascensopersonal->sysuser = Auth::user()->id;
                    $ascensopersonal->gra_cod = $persona['gra_cod'] - 1;
                    $ascensopersonal->codpromo = $persona['per_promo'];
                    $ascensopersonal->per_codigo = $persona['per_codigo'];
                    $ascensopersonal->antiguedad = ( isset($persona['antiguedad']) ) ? $persona['antiguedad'] : 0;
                    $ascensopersonal->antigfin =  $persona['antiguedad'].'/'.$request->total;
                    $ascensopersonal->save();


                    $escalafonpersonal = new PersonalEscalafon();
                    $escalafonpersonal->per_codigo =   $persona['per_codigo'];
                    $escalafonpersonal->esca_cod = $persona['esca_cod'];
                    $escalafonpersonal->subesc_cod = $persona['subesc_cod']-1;
                    $escalafonpersonal->gra_cod = $persona['gra_cod'] - 1;
                    $escalafonpersonal->documento = $request->documento;
                    $escalafonpersonal->fecha_doc = $request->fechasc;
                    $escalafonpersonal->fecha = $request->fechasc;
                    $escalafonpersonal->cm = $persona['per_cm'];
                    $escalafonpersonal->nro_doc = $request->nro_doc;
                    $escalafonpersonal->observacion = $request->observacion;
                    $escalafonpersonal->estado = '1';
                    $escalafonpersonal->flag = '1';
                    $escalafonpersonal->sysuser = Auth::user()->id;
                    $escalafonpersonal->save();

                } else {
                    $ascensopersonal = new AscensoPersonal();
                    $this->EstadoAscenso($persona['per_codigo']);
                    $this->EstadoEscalafon($persona['per_codigo']);
                    $ascensopersonal->asc_cod = $request->asc_cod['id'];
                    $ascensopersonal->promoact = $persona['promoact'];
                    $ascensopersonal->instasc_cod = 1;
                    $ascensopersonal->fechasc = $request->fechasc;

                    $ascensopersonal->observacion = $request->observacion;
                    $ascensopersonal->estado = '1';
                    $ascensopersonal->flag = '1';
                    $ascensopersonal->sysuser = Auth::user()->id;
                    $ascensopersonal->gra_cod = $persona['gra_cod'] - 1;
                    $ascensopersonal->codpromo = $persona['per_promo'];
                    $ascensopersonal->per_codigo = $persona['per_codigo'];
                    $ascensopersonal->antiguedad = ( isset($persona['antiguedad']) ) ? $persona['antiguedad'] : 0;
                    $ascensopersonal->antigfin =  $persona['antiguedad'].'/'.$request->total;
                    $ascensopersonal->save();


                    $escalafonpersonal = new PersonalEscalafon();
                    $escalafonpersonal->per_codigo =   $persona['per_codigo'];
                    $escalafonpersonal->esca_cod = $persona['esca_cod'];
                    $escalafonpersonal->subesc_cod = $persona['subesc_cod'];
                    $escalafonpersonal->gra_cod = $persona['gra_cod'] - 1;
                    $escalafonpersonal->documento = $request->documento;
                    $escalafonpersonal->fecha_doc = $request->fechasc;
                    $escalafonpersonal->fecha = $request->fechasc;
                    $escalafonpersonal->cm = $persona['per_cm'];
                    $escalafonpersonal->nro_doc = $request->nro_doc;
                    $escalafonpersonal->observacion = $request->observacion;
                    $escalafonpersonal->estado = '1';
                    $escalafonpersonal->flag = '1';
                    $escalafonpersonal->sysuser = Auth::user()->id;
                    $escalafonpersonal->save();
                }
            }
            DB::commit();
            return response()->json(200);
        } catch (Exception $e){
            DB::rollBack();
            return response()->json(400);
        }
    }

    public function NewEscalafonPer(Request $request){
       // if(!$request->ajax()) return redirect('/');
       // return response()->json($request);
        $this->flag($request->per_codigo);
        $escalafonpersonal = new PersonalEscalafon();
        $escalafonpersonal->per_codigo = $request->per_codigo;
        $escalafonpersonal->esca_codigo = $request->esca_codigo;
        $escalafonpersonal->subesc_codigo = $request->subesc_codigo;
        $escalafonpersonal->gra_cod = $request->gra_cod;
        $escalafonpersonal->escap_flag = '1';
        $escalafonpersonal->escap_documento = $request->escap_documento;
        $escalafonpersonal->escap_fecha_doc = $request->escap_fecha_doc;
        $escalafonpersonal->escap_fecha = $request->escap_fecha;
        $escalafonpersonal->escap_observaciones = $request->escap_observaciones;
        $escalafonpersonal->escap_cm = $request->escap_cm;
        $escalafonpersonal->nro_doc = $request->nro_doc;
        $escalafonpersonal->estado = '1';
        $escalafonpersonal->observacion = 'MIGRACION';
        $escalafonpersonal->sysuser = Auth::user()->id;
        $escalafonpersonal->save();

    }

    public function EstadoEscalafon($per_codigo){
        DB::table('personal_escalafones')
            ->where('per_codigo',$per_codigo)
            ->where('estado',1)
            ->update([
                'estado' => 0
            ]);
    }

    public function EstadoAscenso($per_codigo){
        AscensoPersonal::where('per_codigo', $per_codigo)
          ->where('estado', 1)
          ->update(['estado' => 0]);
    }

    public function RecuperarDatosDocumento(Request $request){
        //$documentacion = Ascenso::where('asc_cod',$request->id);
        $documentacion = DB::table('ascensos')
            ->where('id',$request->id)
            ->first();
        return response()->json($documentacion);
    }

    public function totalPromocion($codpromo){
        $cantidadPromo = DB::table('personals')
        ->join('personal_ascenso_promociones','personals.per_codigo','=','personal_ascenso_promociones.per_codigo')
        ->join('personal_situaciones','personals.per_codigo','=','personal_situaciones.per_codigo')
        ->where('personal_ascenso_promociones.codpromo','=',$codpromo)
        ->where('personal_ascenso_promociones.estado','=',1)
        ->where('personal_situaciones.estado','=',1)
        ->whereIn('personal_situaciones.detsit_cod',[1,2,4,5,8,9,10,11,29,30,31,33])
        ->count('codpromo');

        /*if ($cantidadPromo == 0) {
            //Consulta que pregunte a la tbla promciones y adquiera el valor de egresados

        }*/

        return $cantidadPromo;
    }

    public function gradoActual(Request $request){
        $id = $request->per_codigo;
        $gradoActual = DB::table('personal_ascenso_promociones')
        ->select('personal_ascenso_promociones.gra_cod', 'personal_ascenso_promociones.promoact as promocion','personal_ascenso_promociones.codpromo')
        ->where('personal_ascenso_promociones.per_codigo','=',$id)
        ->where('personal_ascenso_promociones.estado','=',1)
        ->first();

       if(empty($gradoActual)) {
        $gradoActual = DB::table('personals')
        ->join('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->join('personal_destinos','personals.per_codigo','personal_destinos.per_codigo')
        ->select('personal_escalafones.gra_cod','personal_destinos.promocion', 'personals.per_promo as codpromo')
        ->where('personal_escalafones.per_codigo','=',$id)
        ->where('personal_escalafones.estado','=',1)
        ->where('personal_destinos.estado','=',1)
        ->first();
        }
        if(empty($gradoActual)) {
            $gradoActual = DB::table('personals')
            ->join('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo','personals.per_promo as codpromo')
            ->select('personal_escalafones.gra_cod')
            ->where('personal_escalafones.per_codigo','=',$id)
            ->where('personal_escalafones.estado','=',1)
            ->first();
        }
        if($gradoActual->gra_cod == 49)
        {
            $gradoInmediatoSuperior = $gradoActual->gra_cod - 40;
            $g = Grado::select('id','nombre', 'subesc_cod')
            ->find($gradoInmediatoSuperior);
            $gradodesde = $gradoActual->gra_cod;
            $g_Actual = Grado::select('nombre')
            ->find($gradodesde);
            $escalafon = Subescalafon::select('esca_cod')->where('id',$g->subesc_cod)
            ->first()->esca_cod;
           return ['escalafon'=>$escalafon,'gradoAscensoInmediatoSuperior' =>$g, 'promoActual'=>$gradoActual, 'gradoActualDesde'=>$g_Actual];
            //return response()->json( $gradoActual);
        }
        if($gradoActual->gra_cod == 50)
        {
            $gradoInmediatoSuperior = $gradoActual->gra_cod - 33;
            $g = Grado::select('id','nombre', 'subesc_cod')
            ->find($gradoInmediatoSuperior);
            $gradodesde = $gradoActual->gra_cod;
            $g_Actual = Grado::select('nombre')
            ->find($gradodesde);
            $escalafon = Subescalafon::select('esca_cod')->where('id',$g->subesc_cod)
            ->first()->esca_cod;
           return ['escalafon'=>$escalafon,'gradoAscensoInmediatoSuperior' =>$g, 'promoActual'=>$gradoActual, 'gradoActualDesde'=>$g_Actual];
            //return response()->json( $gradoActual);
        } else {
            $gradoInmediatoSuperior = $gradoActual->gra_cod - 1;
            $g = Grado::select('id','nombre', 'subesc_cod')
            ->find($gradoInmediatoSuperior);
            $gradodesde = $gradoActual->gra_cod;
            $g_Actual = Grado::select('nombre')
            ->find($gradodesde);
            $escalafon = Subescalafon::select('esca_cod')->where('id',$g->subesc_cod)
                            ->first()->esca_cod;

           return ['escalafon'=>$escalafon,'gradoAscensoInmediatoSuperior' =>$g, 'promoActual'=>$gradoActual, 'gradoActualDesde'=>$g_Actual];
            //return response()->json( $gradoActual);
        }


    }

    public function ListarAscensoPersonaReporte(Request $request){
        $id = $request->per_codigo;
        $listaascensos = DB::table('personal_ascenso_promociones')
        ->join('personals','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('ascensos','personal_ascenso_promociones.asc_cod','ascensos.id')
        ->join('grados','personal_ascenso_promociones.gra_cod','grados.id')
        ->select('grados.abreviatura','grados.id as id_grado','ascensos.nrodocumento','ascensos.documento',
        'ascensos.fechadocumento','personal_ascenso_promociones.antiguedad',
        'personal_ascenso_promociones.codpromo','personal_ascenso_promociones.promoact',
        'personal_ascenso_promociones.antigfin','personal_ascenso_promociones.id',
        'personal_ascenso_promociones.asc_cod','personal_ascenso_promociones.instasc_cod as instancia',
        'personal_ascenso_promociones.observacion','personals.per_codigo',
        'personal_ascenso_promociones.fechasc','personal_ascenso_promociones.estado','grados.abreviatura as grado')
        ->where('personal_ascenso_promociones.per_codigo','=',$id)
        ->where('personal_ascenso_promociones.flag',1)
        ->orderBy('personal_ascenso_promociones.gra_cod','asc')
        ->get();

        $personal = Personal::join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
        ->join('grados','personal_escalafones.gra_cod','=','grados.id')
        ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
        ->join('estudios','personal_estudios.est_cod','=','estudios.id')
        ->select('personals.per_codigo','personals.per_codigo as personal_id', 'personals.per_paterno','personals.per_nombre',
        'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.gra_cod',
        'personal_escalafones.per_codigo','grados.abreviatura as grado','estudios.abreviatura as estudios','personals.per_sexo','personals.per_foto')
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

        $pdf = PDF::loadView('reportes.certificadoAscensosPersona',[
            'ascensosPersona'=>$listaascensos,
            'personal'=>$personal,
            'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])->setPaper('letter', 'portrait');

        return $pdf->stream('reporte_ascenso_individual.pdf');
    }

    public function AscensoReportePromocion(Request $request){
        $codpromo = $request->codpromo;

        $personals = DB::table('personals')
        ->join('personal_escalafones','personals.per_codigo','=','personal_escalafones.per_codigo')
        ->join('grados','personal_escalafones.gra_cod','=','grados.id')
        ->join('personal_estudios','personals.per_codigo','=','personal_estudios.per_codigo')
        ->join('estudios','personal_estudios.est_cod','=','estudios.id')
        ->join('personal_ascenso_promociones','personals.per_codigo','=','personal_ascenso_promociones.per_codigo')
        ->join('personal_situaciones','personals.per_codigo','=','personal_situaciones.per_codigo')
        ->select('personals.per_codigo', 'personals.per_paterno','personals.per_nombre',
        'personals.per_materno','personals.per_ci','personals.per_cm','personals.per_promo','personal_escalafones.esca_cod',
        'personal_escalafones.subesc_cod','personal_escalafones.gra_cod','grados.abreviatura as grados',
        'personal_ascenso_promociones.antiguedad as anti','personal_ascenso_promociones.promoact',
        'personal_ascenso_promociones.antigfin','estudios.abreviatura as estu_abreviatura','personal_situaciones.detsit_cod')
        ->whereIn('personal_situaciones.detsit_cod',[1,2,4,5,8,9,10,29,30,31,33])
        ->where('personal_escalafones.estado','=',1)
        ->where('personal_estudios.estado','=',1)
        ->where('personal_ascenso_promociones.codpromo','=',$codpromo)
        ->where('personal_ascenso_promociones.estado','=',1)
        ->where('personal_ascenso_promociones.flag','=',1)
        ->where('personal_situaciones.estado','=',1)
        ->orderBy('personal_ascenso_promociones.antiguedad', 'asc')->paginate(150);

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
        $qr = QrCode::encoding('UTF-8')->size(100)->generate("FECHA: $fecha_emision");
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.ascensoPromocion',[
            'ascensosPersona'=>$personals,

            'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])->setPaper('letter', 'portrait');


        return $pdf->stream('reporte.pdf');
    }

}
