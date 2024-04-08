<?php

namespace App\Http\Controllers;

use App\PersonalEspecialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalEspecialidadController extends Controller
{
    public function selectBuscaEspePer(Request $request){
        
        $id = $request->per_codigo;
       
        $listarEspecialidadPersonal = DB::table('personal_especialidades')



        ->join('personals','personal_especialidades.per_codigo','personals.per_codigo')


        ->join('especialidades','personal_especialidades.espe_cod','especialidades.id')

        ->join('subespecialidades','personal_especialidades.subespe_cod','subespecialidades.id')


        ->select(
            'personal_especialidades.per_codigo', 
                'personal_especialidades.espe_cod', 
                'personal_especialidades.subespe_cod',
                'personal_especialidades.documento',
                'personal_especialidades.fecha_documento',
                'personal_especialidades.nrodoc',

                'especialidades.id',
                'especialidades.nombre as nombespe',
                'subespecialidades.id',
                'subespecialidades.espe_cod',
                'subespecialidades.nombre as nomsubespe'



        )

        ->where('personal_especialidades.estado' , '=',1)
        ->where('personal_especialidades.per_codigo','=',$id)
        ->get();

        //return response()->json($listarEspecialidadPersonal);
        return ['listarEspecialidadPersonal' => $listarEspecialidadPersonal];
        
    }
    
    public function index(Request $request)
    {
        $per_codigo = $request->per_codigo;

        if($per_codigo==''){
            $personal_especialidades = DB::table("personal_especialidades")
            ->orderBy('personal_especialidades.id','desc')
            ->paginate(10);     
        }
        else
        {
            $personal_especialidades = DB::table("personal_especialidades as pe")
            ->join('personals as p','p.per_codigo','=','pe.per_codigo')
            ->join('especialidades as e','e.id','=','pe.espe_cod')
            ->join('subespecialidades as s','s.id','=','pe.subespe_cod')
            ->select('pe.id as idpersonal_especialidades',
                    'p.per_codigo',
                    'p.per_nombre',
                    'p.per_paterno',
                    'p.per_materno',
                    'pe.documento',
                    'pe.fecha_documento',
                    'pe.fecha',
                    'pe.nrodoc',
                    'pe.observacion',
                    'pe.estado',
                    'e.id as idespe',
                    'e.nombre as nomespe',
                    's.id as idsubespe',
                    's.nombre as nomsubespe'
                    )
                    
            ->where('pe.per_codigo', '=', $per_codigo)
            ->whereNotIn('pe.estado',[2])
                    //->orWhere('pe.estado',0)
            
            ->orderBy('pe.fecha_documento','desc')
            ->paginate(10);
           return response()->json(['especialidad'=>$personal_especialidades]);
        }    
    }

    public function storePerEspecialidad(Request $request)
    {
        $obs = strtoupper($request->observacion);
        // PARA DEFINIR EL ESTADO
        $fecha_max_update = PersonalEspecialidades::
        where('per_codigo', $request->per_codigo)
        //->where('flag',1)
        ->max('fecha_documento');

        if ($request->fecha_documento >= $fecha_max_update)
            {
                $perespe_estado = '1';

                $excluir = PersonalEspecialidades::
                where('per_codigo', $request->per_codigo)
                ->whereNotIn('fecha_documento', [$request->fecha_documento])
                ->update(['estado' => 0]);

            }
        else
            {
           
            $mayor_dest = PersonalEspecialidades::
                where('per_codigo', $request->per_codigo)
                ->where('fecha_documento', $fecha_max_update)
                //->where('flag',1)
                ->update(['estado' => 1]);
                $perespe_estado = '0';
            }
        //FIN DEFINIR ESTADO
        $personal_especialidad = PersonalEspecialidades::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'per_codigo' => $request->per_codigo,
            'espe_cod' => $request->espe_cod,
            'subespe_cod' => $request->subespe_cod,
            'documento' => $request->documento,
            'fecha_documento' => $request->fecha_documento,
            'fecha' => $request->fecha,
            'nrodoc' => $request->nrodoc,
            'observacion' => $obs,
            'estado' => $perespe_estado,
            'sysuser' => Auth::user()->id 
        ]);
        return response()->json($personal_especialidad);
    }

    public function updatePerEspecialidad(Request $request)
    {
        $obs = strtoupper($request->observacion);

        // PARA DEFINIR EL ESTADO
        $fecha_max_update = PersonalEspecialidades::
        where('per_codigo', $request->per_codigo)
        //->where('flag',1)
        ->max('fecha_documento');

        if ($request->fecha_documento >= $fecha_max_update)
            {
                $perespe_estado = '1';

                $excluir = PersonalEspecialidades::
                where('per_codigo', $request->per_codigo)
                ->whereNotIn('fecha_documento', [$request->fecha_documento])
                ->update(['estado' => 0]);

            }
        else
            {
           
            $mayor_dest = PersonalEspecialidades::
                where('per_codigo', $request->per_codigo)
                ->where('fecha_documento', $fecha_max_update)
                //->where('flag',1)
                ->update(['estado' => 1]);
                $perespe_estado = '0';
            }
        //FIN DEFINIR ESTADO

        $personal_especialidades = PersonalEspecialidades::where('id',$request->id)
                    ->first();
        $personal_especialidades -> update([
            'per_codigo' => $request->per_codigo,
            'espe_cod' => $request->espe_cod,
            'subespe_cod' => $request->subespe_cod,
            'documento' => $request->documento,
            'fecha_documento' => $request->fecha_documento,
            'fecha' => $request->fecha_documento,
            'nrodoc' => $request->nrodoc,
            'observacion' => $obs,
            'estado' => $perespe_estado,
            'sysuser' => Auth::user()->id
        ]);
        return response()->json($personal_especialidades);
    }

    public function desactivarPerEspecialidad(request $request)
    {
        $fecha_documento = $request->fecha_documento;
        $fecha_max_uno = PersonalEspecialidades::
        where('per_codigo', $request->per_codigo)
        ->where('estado',1)
        ->max('fecha_documento');
        
        
        if ($fecha_documento == $fecha_max_uno)
        {
            $personal_especialidades = PersonalEspecialidades::findOrFail($request->idPersonalEspecialidad);
            $personal_especialidades->estado = 2;
            $personal_especialidades->save();

            $fecha_max_cero = PersonalEspecialidades::
            where('per_codigo', $request->per_codigo)
            ->whereNotIn('estado',[1,2])
            ->max('fecha_documento');
            
            $mayor_espe = PersonalEspecialidades::
            where('per_codigo', $request->per_codigo)
            ->where('fecha_documento', $fecha_max_cero)
            ->where('estado',0)
            ->update(['estado' => 1]);

            return response()->json([$personal_especialidades,$fecha_max_uno,$fecha_max_cero,$mayor_espe]);
        }
        else 
        {
            $personal_especialidades = PersonalEspecialidades::findOrFail($request->idPersonalEspecialidad);
            $personal_especialidades->estado = 2;
            $personal_especialidades->save();

            return response()->json([$personal_especialidades,$fecha_max_uno]);
        }
        //if(!$request->ajax()) return redirect('/');

        // return response()->json([$personal_especialidades,$fecha_max_uno,$fecha_max_cero,$mayor_espe]);
    }

    public function SelectEspeGrado(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $grados = DB::table('grados')
        ->where('estado','=','1') //filtramos a todas las categorias que estan activas
        ->whereIn('id', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48])
        ->select('id','nombre')
        ->orderBy('id','asc')
        ->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado
        return ['grados' => $grados]; //mandamos todo el listado en la variable listado
    }

    public function showPerPromo(Request $request)
    {
        $promocion = $request->promocion;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        
        if($promocion != ''){
            if($especialidad == 0 || $subespecialidad == 0){
                if($especialidad != 0 && $subespecialidad == 0){
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('p.per_cm','LIKE',"$promocion%")
                    ->where('e.id',$especialidad)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    ->orderBy('p.per_cm','asc')
                    ->take(1)
                    ->paginate(10);
                }else{
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('p.per_cm','LIKE',"$promocion%")
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    ->orderBy('p.per_cm','asc')
                    ->take(1)
                    ->paginate(10);
                }
            }else{
                $personal_especialidades = DB::table('personal_especialidades as pe')
                ->join('personals as p','p.per_codigo','pe.per_codigo')
                ->join('especialidades as e','e.id','pe.espe_cod')
                ->join('subespecialidades as s','s.id','pe.subespe_cod')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('grados as g','g.id','pesc.gra_cod')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                ->select('p.per_cm',
                        'g.abreviatura as grado',
                        'est.abreviatura as complemento',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'e.nombre as nomespe',
                        's.nombre as nomsubespe')
                ->where('p.per_cm','LIKE',"$promocion%")
                ->where('e.id',$especialidad)
                ->where('s.id',$subespecialidad)
                ->where('pesc.estado',1)
                ->where('pe.estado',1)
                ->where('pest.estado',1)
                ->where('psit.estado',1)
                ->where('psit.sit_cod',1)
                ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                ->orderBy('p.per_cm','asc')
                ->take(1)
                ->paginate(10);
            }
            return [
                    'pagination' => [
                        'total'         => $personal_especialidades->total(),
                        'current_page'  => $personal_especialidades->currentPage(),
                        'per_page'      => $personal_especialidades->perPage(),
                        'last_page'     => $personal_especialidades->lastPage(),
                        'from'          => $personal_especialidades->firstItem(),
                        'to'            => $personal_especialidades->lastItem(),

                    ],
                    'personal_especialidades' => $personal_especialidades
                ];
                return response()->json($personal_especialidades);
        }
    }

    public function showPerGrado(Request $request)
    {
        $grado = $request->grado;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        if($grado != 0){
            if($especialidad == 0 || $subespecialidad == 0){
                if($especialidad != 0 && $subespecialidad == 0){
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('g.id',$grado)
                    ->where('e.id',$especialidad)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    ->orderBy('p.per_cm','asc')
                    ->take(1)
                    ->paginate(10);
                }else{
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('g.id',$grado)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    ->orderBy('p.per_cm','asc')
                    ->take(1)
                    ->paginate(10);
                }
            }else{
                $personal_especialidades = DB::table('personal_especialidades as pe')
                ->join('personals as p','p.per_codigo','pe.per_codigo')
                ->join('especialidades as e','e.id','pe.espe_cod')
                ->join('subespecialidades as s','s.id','pe.subespe_cod')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('grados as g','g.id','pesc.gra_cod')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                ->select('p.per_cm',
                        'g.abreviatura as grado',
                        'est.abreviatura as complemento',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'e.nombre as nomespe',
                        's.nombre as nomsubespe')
                ->where('g.id',$grado)
                ->where('e.id',$especialidad)
                ->where('s.id',$subespecialidad)
                ->where('pesc.estado',1)
                ->where('psit.estado',1)
                ->where('psit.sit_cod',1)
                ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                ->where('pe.estado',1)
                ->where('pest.estado',1)
                ->orderBy('p.per_cm','asc')
                ->take(1)
                ->paginate(10);
            }
            return [
                'pagination' => [
                    'total'         => $personal_especialidades->total(),
                    'current_page'  => $personal_especialidades->currentPage(),
                    'per_page'      => $personal_especialidades->perPage(),
                    'last_page'     => $personal_especialidades->lastPage(),
                    'from'          => $personal_especialidades->firstItem(),
                    'to'            => $personal_especialidades->lastItem(),

                ],
                'personal_especialidades' => $personal_especialidades
            ];
            return response()->json($personal_especialidades);
        }
    }

    public function showPerEspecialidad(Request $request)
    {
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        if($especialidad != 0){
            if($especialidad != 0 && $subespecialidad == 0){
                $personal_especialidades = DB::table('personal_especialidades as pe')
                ->join('personals as p','p.per_codigo','pe.per_codigo')
                ->join('especialidades as e','e.id','pe.espe_cod')
                ->join('subespecialidades as s','s.id','pe.subespe_cod')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('grados as g','g.id','pesc.gra_cod')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                ->select('p.per_cm',
                        'g.abreviatura as grado',
                        'est.abreviatura as complemento',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'e.nombre as nomespe',
                        's.nombre as nomsubespe')
                ->where('e.id',$especialidad)
                // ->where('s.id',$subespecialidad)
                ->where('pesc.estado',1)
                ->where('pe.estado',1)
                ->where('pest.estado',1)
                ->where('psit.estado',1)
                ->where('psit.sit_cod',1)
                ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                ->orderBy('pesc.esca_cod')
                ->orderBy('pesc.subesc_cod')
                ->orderBy('pesc.gra_cod')
                ->orderBy('p.per_cm')
                ->take(1)
                ->paginate(10);
            }else{
                $personal_especialidades = DB::table('personal_especialidades as pe')
                ->join('personals as p','p.per_codigo','pe.per_codigo')
                ->join('especialidades as e','e.id','pe.espe_cod')
                ->join('subespecialidades as s','s.id','pe.subespe_cod')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('grados as g','g.id','pesc.gra_cod')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                ->select('p.per_cm',
                        'g.abreviatura as grado',
                        'est.abreviatura as complemento',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'e.nombre as nomespe',
                        's.nombre as nomsubespe')
                ->where('e.id',$especialidad)
                ->where('s.id',$subespecialidad)
                ->where('pesc.estado',1)
                ->where('pe.estado',1)
                ->where('pest.estado',1)
                ->where('psit.estado',1)
                ->where('psit.sit_cod',1)
                ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                ->orderBy('pesc.esca_cod')
                ->orderBy('pesc.subesc_cod')
                ->orderBy('pesc.gra_cod')
                ->orderBy('p.per_cm','asc')
                ->take(1)
                ->paginate(10);
            }
            return [
                'pagination' => [
                    'total'         => $personal_especialidades->total(),
                    'current_page'  => $personal_especialidades->currentPage(),
                    'per_page'      => $personal_especialidades->perPage(),
                    'last_page'     => $personal_especialidades->lastPage(),
                    'from'          => $personal_especialidades->firstItem(),
                    'to'            => $personal_especialidades->lastItem(),
    
                ],
                'personal_especialidades' => $personal_especialidades
            ];
            return response()->json($personal_especialidades);
        }
    }

    public function showPerDestino(Request $request)
    {
        $entidad = $request->entidad;
        $gran_unidad = $request->gran_unidad;
        $reparticion = $request->reparticion;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        if($entidad != 0){
            if($especialidad == 0 || $subespecialidad == 0){
                if($especialidad != 0 && $subespecialidad == 0){
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_destinos as pd','pd.per_codigo','p.per_codigo')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('pd.d1_cod',$entidad)
                    ->where('pd.d2_cod',$gran_unidad)
                    ->where('pd.d3_cod',$reparticion)
                    ->where('e.id',$especialidad)
                    // ->where(DB::raw('substring(p.per_cm, 0, 2'),'312'))
                    ->where('pd.estado',1)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    // ->orderBy('pesc.id','asc')
                    ->orderBy('g.id','asc')
                    ->orderBy('pd.promocion','asc')
                    ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                    ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                    ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                    ->take(1)
                    ->paginate(10);
                }else{
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_destinos as pd','pd.per_codigo','p.per_codigo')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('pd.d1_cod',$entidad)
                    ->where('pd.d2_cod',$gran_unidad)
                    ->where('pd.d3_cod',$reparticion)
                    // ->where(DB::raw('substring(p.per_cm, 0, 2'),'312'))
                    ->where('pd.estado',1)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    // ->orderBy('pesc.id','asc')
                    ->orderBy('g.id','asc')
                    ->orderBy('pd.promocion','asc')
                    ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                    ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                    ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                    ->take(1)
                    ->paginate(10);
                }
            }else{
                $personal_especialidades = DB::table('personal_especialidades as pe')
                ->join('personals as p','p.per_codigo','pe.per_codigo')
                ->join('especialidades as e','e.id','pe.espe_cod')
                ->join('subespecialidades as s','s.id','pe.subespe_cod')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('grados as g','g.id','pesc.gra_cod')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('personal_destinos as pd','pd.per_codigo','p.per_codigo')
                ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                ->select('p.per_cm',
                        'g.abreviatura as grado',
                        'est.abreviatura as complemento',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'e.nombre as nomespe',
                        's.nombre as nomsubespe')
                ->where('pd.d1_cod',$entidad)
                ->where('pd.d2_cod',$gran_unidad)
                ->where('pd.d3_cod',$reparticion)
                ->where('e.id',$especialidad)
                ->where('s.id',$subespecialidad)
                // ->where(DB::raw('substr(p.per_cm, 4, 2)'),'08')
                ->where('pd.estado',1)
                ->where('pesc.estado',1)
                ->where('pe.estado',1)
                ->where('pest.estado',1)
                ->where('psit.estado',1)
                ->where('psit.sit_cod',1)
                ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                // ->orderBy('pesc.id','asc')
                ->orderBy('g.id','asc')
                ->orderBy('pd.promocion','asc')
                ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                ->take(1)
                ->paginate(10); 
            }
        
            return [
                'pagination' => [
                    'total'         => $personal_especialidades->total(),
                    'current_page'  => $personal_especialidades->currentPage(),
                    'per_page'      => $personal_especialidades->perPage(),
                    'last_page'     => $personal_especialidades->lastPage(),
                    'from'          => $personal_especialidades->firstItem(),
                    'to'            => $personal_especialidades->lastItem(),

                ],
                'personal_especialidades' => $personal_especialidades
            ];
            return response()->json($personal_especialidades);
        }
    } 

    public function showPerGenero(Request $request)
    {
        $genero = $request->genero;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        if($genero != ''){
            if($especialidad == 0 || $subespecialidad == 0){
                if($especialidad != 0 && $subespecialidad == 0){
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('p.per_sexo',$genero)
                    ->where('e.id',$especialidad)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    ->orderBy('p.per_cm','asc')
                    ->take(1)
                    ->paginate(10);
                }else{
                    $personal_especialidades = DB::table('personal_especialidades as pe')
                    ->join('personals as p','p.per_codigo','pe.per_codigo')
                    ->join('especialidades as e','e.id','pe.espe_cod')
                    ->join('subespecialidades as s','s.id','pe.subespe_cod')
                    ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                    ->join('grados as g','g.id','pesc.gra_cod')
                    ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                    ->join('estudios as est','est.id','pest.est_cod')
                    ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                    ->select('p.per_cm',
                            'g.abreviatura as grado',
                            'est.abreviatura as complemento',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'e.nombre as nomespe',
                            's.nombre as nomsubespe')
                    ->where('p.per_sexo',$genero)
                    ->where('pesc.estado',1)
                    ->where('pe.estado',1)
                    ->where('pest.estado',1)
                    ->where('psit.estado',1)
                    ->where('psit.sit_cod',1)
                    ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                    ->orderBy('p.per_cm','asc')
                    ->take(1)
                    ->paginate(10);
                }
            }else{
                $personal_especialidades = DB::table('personal_especialidades as pe')
                ->join('personals as p','p.per_codigo','pe.per_codigo')
                ->join('especialidades as e','e.id','pe.espe_cod')
                ->join('subespecialidades as s','s.id','pe.subespe_cod')
                ->join('personal_escalafones as pesc','pesc.per_codigo','p.per_codigo')
                ->join('grados as g','g.id','pesc.gra_cod')
                ->join('personal_estudios as pest','pest.per_codigo','p.per_codigo')
                ->join('estudios as est','est.id','pest.est_cod')
                ->join('personal_situaciones as psit','psit.per_codigo','p.per_codigo')
                ->select('p.per_cm',
                        'g.abreviatura as grado',
                        'est.abreviatura as complemento',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'e.nombre as nomespe',
                        's.nombre as nomsubespe')
                ->where('p.per_sexo',$genero)
                ->where('e.id',$especialidad)
                ->where('s.id',$subespecialidad)
                ->where('pesc.estado',1)
                ->where('psit.estado',1)
                ->where('psit.sit_cod',1)
                ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
                ->where('pe.estado',1)
                ->where('pest.estado',1)
                ->orderBy('p.per_cm','asc')
                ->take(1)
                ->paginate(10);
            }
            return [
                'pagination' => [
                    'total'         => $personal_especialidades->total(),
                    'current_page'  => $personal_especialidades->currentPage(),
                    'per_page'      => $personal_especialidades->perPage(),
                    'last_page'     => $personal_especialidades->lastPage(),
                    'from'          => $personal_especialidades->firstItem(),
                    'to'            => $personal_especialidades->lastItem(),

                ],
                'personal_especialidades' => $personal_especialidades
            ];
            return response()->json($personal_especialidades);
        }


        // return response()->json($request);
    }
}
