<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportesPersonalController extends Controller
{
    public function CurriculumComanjefe(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $notafojas = $request->nota_fojas;
        $rubrica = $request->rubrica;
        $promedioact = $request->promedioact;
        $meritoact = $request->meritoact;
        $promediodip = $request->promediodip;
        $meritodip = $request->meritodip;
        $observacion = strtoupper($request->observacion);

        $personal = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->leftjoin('situaciones','situaciones.id','personal_situaciones.sit_cod')
        ->leftjoin('subsituaciones','subsituaciones.id','personal_situaciones.subsit_cod')
        ->leftjoin('detalle_situaciones','detalle_situaciones.id','personal_situaciones.detsit_cod')
        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
        ->leftjoin('personal_especialidades','personal_especialidades.per_codigo','personals.per_codigo')
        ->leftjoin('especialidades','especialidades.id','personal_especialidades.espe_cod')
        ->leftjoin('subespecialidades','subespecialidades.id','personal_especialidades.subespe_cod')
        ->leftjoin('personal_cargos','personal_cargos.per_codigo','personals.per_codigo')
        ->leftjoin('cargos','cargos.id','personal_cargos.car_cod')
        ->leftjoin('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
        ->leftjoin('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_fecha_nacimiento',
                'personals.per_estado_civil',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'grados.division',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'escalafones.id as idesc',
                'subescalafones.nombre as subesca_nombre',
                'subescalafones.id as idsubesc',
                'grados.nombre as gra_nombre',
                'departamentos.nombre as depanombre',
                'especialidades.nombre as espenombre',
                'subespecialidades.nombre as subespenombre',
                'cargos.descripcion',
                'nivel3_destinos.descripcion as n3nom',
                'personal_situaciones.detsit_cod',
                'personal_situaciones.fecha_documento')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
        ->where('personal_especialidades.estado',1)
        ->where('personal_cargos.estado',1)
        ->where('personal_cargos.nivel_cargo',1)
        ->where('personal_destinos.estado',1)
        ->where('personal_situaciones.estado',1)
        ->first();

        $situacion = DB::table('personals')
        ->join('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->select('personal_situaciones.fecha_documento')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_situaciones.detsit_cod',1)
        ->first();

        $datos_familiares = DB::table('personals')
        ->join('datos_familiares','datos_familiares.per_codigo','personals.per_codigo')
        ->select('datos_familiares.nombre as datfamnombre',
                'datos_familiares.paterno',
                'datos_familiares.materno',
                'datos_familiares.parentesco')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('datos_familiares.parentesco',['ESPOSO(A)','HIJO(A)'])
        ->get();

        $institutos = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[1,12])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $cur_mil = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[2,3,4,5,6,7,8,9,13])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $otro_cur = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[8,10])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $destinos = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->join('grados','grados.id','personal_destinos.gra_cod')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino',
                    'nivel3_destinos.frontera',
                    'grados.id',
                    'grados.abreviatura')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        // ->where('nivel3_destinos.frontera',1)
        ->where('personal_destinos.flag',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $destinos_front = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->join('grados','grados.id','personal_destinos.gra_cod')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino',
                    'nivel3_destinos.frontera',
                    'grados.abreviatura')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        ->where('nivel3_destinos.frontera',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $felicitacion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                DB::raw('count(nivel2_distinciones.descripcion) as cantfel'))
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[2,7,13,20,25,30,35,40,46])
        ->groupBy('nivel2_distinciones.id','nivel2_distinciones.descripcion')
        // ->orderBy('nivel2_distinciones.id')
        ->orderByRaw("case when nivel2_distinciones.id = 2 then 1 
                        when nivel2_distinciones.id = 46 then 2 
                        when nivel2_distinciones.id = 7 then 3 
                        when nivel2_distinciones.id = 20 then 4 
                        when nivel2_distinciones.id = 13 then 5 
                        when nivel2_distinciones.id = 25 then 6 
                        when nivel2_distinciones.id = 30 then 7 
                        when nivel2_distinciones.id = 35 then 8 
                        when nivel2_distinciones.id = 40 then 9 
                        end;")
        ->get();

        $condecoracion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[1,6,12,19,24,29,34,39,45])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $plaqueta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[4,10,16,22,27,32,37,43])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $diploma = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[3,8,14,21,26,31,36,41])
        ->orderBY('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $otros = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[5,11,18,23,28,33,38,44])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $abanderado_escolta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[9,15,42])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $representacion = DB::table('personals')
        ->join('personal_representaciones','personal_representaciones.per_codigo','personals.per_codigo')
        ->join('representaciones','representaciones.id','personal_representaciones.repre_cod')
        ->select('representaciones.descripcion as repdesc',
                'personal_representaciones.descripcion as perrepdesc',
                'personal_representaciones.nro_doc',
                'personal_representaciones.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_representaciones.fecha')
        ->get();

        $constancia = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',17)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $bre_ins = DB::table('personals')
        ->join('personal_brevets','personal_brevets.per_codigo','personals.per_codigo')
        ->join('brevets','brevets.id','personal_brevets.brevet_cod')
        ->join('paises','paises.id','personal_brevets.pais_cod')
        ->select('brevets.descripcion',
                'personal_brevets.fecha_imposicion',
                'paises.nombre',
                'personal_brevets.ndoc')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_brevets.fecha_imposicion')
        ->get();

        $ascenso = DB::table('personals')
        ->join('personal_ascenso_promociones','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('grados','grados.id','personal_ascenso_promociones.gra_cod')
        ->select('personal_ascenso_promociones.fechasc',
                'grados.nombre',
                'personal_ascenso_promociones.antigfin')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_ascenso_promociones.flag',1)
        ->orderBy('personal_ascenso_promociones.fechasc')
        ->get();
        
        $sancion = DB::table('personals')
                ->join('personal_faltas','personal_faltas.per_codigo','personals.per_codigo')
                ->join('sanciones','sanciones.id','personal_faltas.san_cod')
                ->select('dias',
                        'horas',
                        DB::raw('count (san_cod) as cant_sancion'))
                ->whereIn('san_cod',[1,2,3,4,5,6,7,8,9,10,11,12,26,27,28])
                ->where('personal_faltas.per_codigo',$per_codigo)
                ->groupBy('dias')
                ->groupBy('horas')
                ->orderBy('dias','desc')
                ->get();

        $sumario = DB::table('personals')
                ->join('personal_faltas','personal_faltas.per_codigo','personals.per_codigo')
                ->join('nivel1_faltas','personal_faltas.f1_cod','nivel1_faltas.id')
                ->join('nivel2_faltas','personal_faltas.f2_cod','nivel2_faltas.id')
                ->join('sanciones','personal_faltas.san_cod','sanciones.id')
                ->select('nivel1_faltas.descripcion as f1',
                        'nivel2_faltas.descripcion as f2',
                        'sanciones.descripcion as sandesc',
                        'personal_faltas.ndoc',
                        'personal_faltas.documento',
                        'personal_faltas.fecha_sancion',
                        'personal_faltas.observacion')
                ->whereNotIn('san_cod',[1,2,3,4,5,6,7,8,9,10,11,12,26,27,28])
                ->where('personal_faltas.per_codigo',$per_codigo)
                ->orderBy('personal_faltas.fecha_sancion','asc')
                ->get();


        // $listar_grado = DB::table('grados')
        //         ->select('id',
        //                 'abreviatura',
        //                 'nombre',
        //                 'division')
        //         ->where('division',$personal->division)
        //         ->orderBy('id','desc')
        //         ->get();
        
        $listar_grado = DB::table('personal_destinos')
                                ->join('grados','grados.id','personal_destinos.gra_cod')
                                ->select('grados.id',
                                        'grados.nombre',
                                        DB::raw('count (grados.id) as cantidad'))
                                ->where('personal_destinos.per_codigo',$per_codigo)
                                ->where('personal_destinos.flag',1)
                                ->groupBy('grados.id')
                                ->groupBy('grados.nombre')
                                ->orderBy('grados.id','desc')
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
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.curriculumComanjefe',['personal'=>$personal,
                                                            'datosfam'=>$datos_familiares,
                                                            'instituto'=>$institutos,
                                                            'cursomil'=>$cur_mil,
                                                            'otrocur'=>$otro_cur,
                                                            'destinos'=>$destinos,
                                                            'destinosfront'=>$destinos_front,
                                                            'abanescol'=>$abanderado_escolta,
                                                            'condecoracion'=>$condecoracion,
                                                            'plaqueta'=>$plaqueta,
                                                            'diploma'=>$diploma,
                                                            'constancia'=>$constancia,
                                                            'otro'=>$otros,
                                                            'situacion'=>$situacion,
                                                            'breins'=>$bre_ins,
                                                            'ascenso'=>$ascenso,
                                                            'jefe_dpto'=>$jefe_dpto,
                                                            'felicitacion'=>$felicitacion,
                                                            'representacion'=>$representacion,
                                                            'notafojas'=>$notafojas,
                                                            'rubrica'=>$rubrica,
                                                            'promedioact'=>$promedioact,
                                                            'meritoact'=>$meritoact,
                                                            'promediodip'=>$promediodip,
                                                            'meritodip'=>$meritodip,
                                                            'observacion'=>$observacion,
                                                            'sancion'=>$sancion,
                                                            'sumario'=>$sumario,
                                                            'grados'=>$listar_grado
                                                          ])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function CurriculumExtendido(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $personal = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_fecha_nacimiento',
                'personals.per_estado_civil',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'subescalafones.nombre as subesca_nombre',
                'grados.nombre as gra_nombre',
                'departamentos.nombre as depanombre')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
        ->first();

        $datos_familiares = DB::table('personals')
        ->join('datos_familiares','datos_familiares.per_codigo','personals.per_codigo')
        ->select('datos_familiares.nombre as datfamnombre',
                'datos_familiares.paterno',
                'datos_familiares.materno',
                'datos_familiares.parentesco',)
        ->where('personals.per_codigo',$per_codigo)
        ->get();

        $cursos = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $profesion_libre = DB::table('personals')
        ->join('personal_profesiones','personal_profesiones.per_codigo','personals.per_codigo')
        ->join('carreras','carreras.id','personal_profesiones.car_codigo')
        ->join('nivel_profesionals','nivel_profesionals.id','personal_profesiones.nivprof_codigo')
        ->select('carreras.descripcion as cardesc',
                    'nivel_profesionals.descripcion as nivprofdesc',
                    'personal_profesiones.lugar_estudio',
                    'personal_profesiones.fecha_egreso')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_profesiones.fecha_egreso')
        ->get();

        $destinos = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $abanderado_escolta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[9,15,42])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $condecoracion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[1,6,12,19,24,29,34,39,45])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $constancia = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',17)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $diploma = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[3,8,14,21,26,31,36,41])
        ->orderBY('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $felicitacion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[2,7,13,20,25,30,35,40,46])
        ->orderBY('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $otros = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[5,11,18,23,28,33,38,44])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $plaqueta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[4,10,16,22,27,32,37,43])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $bre_ins = DB::table('personals')
        ->join('personal_brevets','personal_brevets.per_codigo','personals.per_codigo')
        ->join('brevets','brevets.id','personal_brevets.brevet_cod')
        ->join('paises','paises.id','personal_brevets.pais_cod')
        ->select('brevets.descripcion',
                'personal_brevets.fecha_imposicion',
                'paises.nombre',
                'personal_brevets.ndoc')
        ->where('personals.per_codigo',$per_codigo)
        ->where('brevets.clasificacion','BR')
        ->orderBy('personal_brevets.fecha_imposicion')
        ->get();

        $representacion = DB::table('personals')
        ->join('personal_representaciones','personal_representaciones.per_codigo','personals.per_codigo')
        ->join('representaciones','representaciones.id','personal_representaciones.repre_cod')
        ->select('representaciones.descripcion as repdesc',
                'personal_representaciones.descripcion as perrepdesc',
                'personal_representaciones.nro_doc',
                'personal_representaciones.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_representaciones.fecha')
        ->get();

        $designacion = DB::table('personals')
        ->join('personal_designaciones','personal_designaciones.per_codigo','personals.per_codigo')
        ->select('personal_designaciones.descripcion',
                'personal_designaciones.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_designaciones.fecha')
        ->get();
               
        $tribunal = DB::table('personals')
        ->join('personal_tribunales','personal_tribunales.per_codigo','personals.per_codigo')
        ->join('tribunales','tribunales.id','personal_tribunales.tri_cod')
        ->select('tribunales.descripcion as tridesc',
                'personal_tribunales.descripcion',
                'personal_tribunales.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('tribunales.id')
        ->orderBy('personal_tribunales.fecha')
        ->get();

        $componente = DB::table('personals')
        ->join('personal_componentes','personal_componentes.per_codigo','personals.per_codigo')
        ->join('componentes','componentes.id','personal_componentes.comp_cod')
        ->select('componentes.descripcion',
                'personal_componentes.fecha_doc')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_componentes.fecha_doc')
        ->get();

        $revistas = DB::table('personals')
        ->join('personal_revistas','personal_revistas.per_codigo','personals.per_codigo')
        ->select('personal_revistas.compania',
                'personal_revistas.lugar',
                'personal_revistas.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_revistas.fecha')
        ->get();

        $publicacion = DB::table('personals')
        ->join('personal_publicaciones','personal_publicaciones.per_codigo','personals.per_codigo')
        ->join('publicaciones','publicaciones.id','personal_publicaciones.pub_cod')
        ->select('publicaciones.descripcion as pubdesc',
                'personal_publicaciones.descripcion as perpubdesc',
                'personal_publicaciones.fecha_doc')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_publicaciones.fecha_doc')
        ->get();

        $proyecto = DB::table('personals')
        ->join('personal_proyectos','personal_proyectos.per_codigo','personals.per_codigo')
        ->join('proyectos','proyectos.id','personal_proyectos.proy_cod')
        ->select('proyectos.descripcion as prodesc',
                'personal_proyectos.descripcion as perprodesc',
                'personal_proyectos.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('proyectos.id')
        ->orderBy('personal_proyectos.fecha')
        ->get();



        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.curriculumGeneral',['personal'=>$personal,
                                                            'datosfam'=>$datos_familiares,
                                                            'cursos'=>$cursos,
                                                            'proflibre'=>$profesion_libre,
                                                            'destinos'=>$destinos,
                                                            'abanescol'=>$abanderado_escolta,
                                                            'condecoracion'=>$condecoracion,
                                                            'constancia'=>$constancia,
                                                            'diploma'=>$diploma,
                                                            'felicitacion'=>$felicitacion,
                                                            'otro'=>$otros,
                                                            'plaqueta'=>$plaqueta,
                                                            'breins'=>$bre_ins,
                                                            'representacion'=>$representacion,
                                                            'designacion'=>$designacion,
                                                            'tribunal'=>$tribunal,
                                                            'componente'=>$componente,
                                                            'revista'=>$revistas,
                                                            'publicacion'=>$publicacion,
                                                            'proyecto'=>$proyecto
                                                          ])
        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function CurriculumResumen(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $personal = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
        ->leftjoin('personal_especialidades','personal_especialidades.per_codigo','personals.per_codigo')
        ->leftjoin('especialidades','especialidades.id','personal_especialidades.espe_cod')
        ->leftjoin('subespecialidades','subespecialidades.id','personal_especialidades.subespe_cod')
        ->leftjoin('personal_cargos','personal_cargos.per_codigo','personals.per_codigo')
        ->leftjoin('cargos','cargos.id','personal_cargos.car_cod')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_fecha_nacimiento',
                'personals.per_estado_civil',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'subescalafones.nombre as subesca_nombre',
                'grados.nombre as gra_nombre',
                'departamentos.nombre as depanombre',
                'especialidades.nombre as espenombre',
                'subespecialidades.nombre as subespenombre',
                'cargos.descripcion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
        ->where('personal_especialidades.estado',1)
        ->where('personal_cargos.estado',1)
        ->where('personal_cargos.nivel_cargo',1)
        ->first();

        $datos_familiares = DB::table('personals')
        ->join('datos_familiares','datos_familiares.per_codigo','personals.per_codigo')
        ->select('datos_familiares.nombre as datfamnombre',
                'datos_familiares.paterno',
                'datos_familiares.materno',
                'datos_familiares.parentesco',)
        ->where('personals.per_codigo',$per_codigo)
        ->get();

        $institutos = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[1,12])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $cur_mil = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[2,3,4,5,6,7,8,9,13])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $otro_cur = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[10])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $destinos = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $condecoracion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',1)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $plaqueta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',16)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $abanderado_escolta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',9)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $constancia = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',17)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $otros = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',11)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $bre_ins = DB::table('personals')
        ->join('personal_brevets','personal_brevets.per_codigo','personals.per_codigo')
        ->join('brevets','brevets.id','personal_brevets.brevet_cod')
        ->join('paises','paises.id','personal_brevets.pais_cod')
        ->select('brevets.descripcion',
                'personal_brevets.fecha_imposicion',
                'paises.nombre',
                'personal_brevets.ndoc')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_brevets.fecha_imposicion')
        ->get();

        $ascenso = DB::table('personals')
        ->join('personal_ascenso_promociones','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('grados','grados.id','personal_ascenso_promociones.gra_cod')
        ->select('personal_ascenso_promociones.fechasc',
                'grados.nombre',
                'personal_ascenso_promociones.antigfin')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_ascenso_promociones.flag',1)
        ->orderBy('personal_ascenso_promociones.fechasc')
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
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.curriculumResumen',['personal'=>$personal,
                                                            'datosfam'=>$datos_familiares,
                                                            'instituto'=>$institutos,
                                                            'cursomil'=>$cur_mil,
                                                            'otrocur'=>$otro_cur,
                                                            'destinos'=>$destinos,
                                                            'abanescol'=>$abanderado_escolta,
                                                            'condecoracion'=>$condecoracion,
                                                            'constancia'=>$constancia,
                                                            'otro'=>$otros,
                                                            'plaqueta'=>$plaqueta,
                                                            'breins'=>$bre_ins,
                                                            'ascenso'=>$ascenso,
                                                            'jefe_dpto'=>$jefe_dpto
                                                          ])
        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function CertificadoTrabajo(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $nro_doc = $request->nro_doc;
        $rubrica = $request->rubrica;
        $motivo = strtoupper($request->motivo);
        $personal = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
        ->leftjoin('nivel2_destinos','nivel2_destinos.id','personal_destinos.d2_cod')
        ->leftjoin('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
        ->leftjoin('personal_cargos','personal_destinos.id','personal_cargos.dest_cod')
        ->leftjoin('cargos','cargos.id','personal_cargos.car_cod')
        ->leftjoin('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->leftjoin('detalle_situaciones','detalle_situaciones.id','personal_situaciones.detsit_cod')
        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_fecha_nacimiento',
                'personals.per_estado_civil',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.id as escid',
                'escalafones.nombre as esca_nombre',
                'subescalafones.nombre as subesca_nombre',
                'grados.nombre as gra_nombre',
                'departamentos.nombre as depanombre',
                'personal_situaciones.fecha_documento',
                'nivel2_destinos.descripcion as d2nom',
                'nivel3_destinos.descripcion as d3nom',
                'cargos.descripcion as cardesc',
                'detalle_situaciones.id as detsitid',
                'detalle_situaciones.nombre as detsitnom',
                'personal_situaciones.documento',
                'personal_situaciones.nrodoc')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
        ->where('personal_situaciones.estado',1)
        ->where('personal_destinos.estado',1)
        ->where('personal_cargos.nivel_cargo',1)
        ->first();

        // $primer_grado = DB::table('personal_escalafones')
        //                 ->join('grados','grados.id','personal_escalafones.gra_cod')
        //                 ->select(DB::raw('max(personal_escalafones.gra_cod) as gradoinicialid'),
        //                         DB::raw('min(grados.nombre) as grado_inicial'))
        //                 ->where('personal_escalafones.per_codigo',$per_codigo)
        //                 ->first();
        $primer_grado = DB::table('personal_ascenso_promociones')
                        ->join('grados','grados.id','personal_ascenso_promociones.gra_cod')
                        ->select('personal_ascenso_promociones.gra_cod',
                                'grados.nombre',
                                'personal_ascenso_promociones.fechasc')
                        ->where('personal_ascenso_promociones.per_codigo',$per_codigo)
                        ->orderBy('personal_ascenso_promociones.fechasc','asc')
                        ->first();

        
        $incorporacion = DB::table('personals')
        ->join('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->select('personal_situaciones.fecha_documento',
                'personal_situaciones.documento',
                'personal_situaciones.nrodoc')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_situaciones.detsit_cod',1)
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
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.certificadoTrabajo',['personal'=>$personal,
                                                            'primergrado'=>$primer_grado,
                                                            'incorporacion'=>$incorporacion,
                                                            'jefe_dpto'=>$jefe_dpto,
                                                            'nro_doc'=>$nro_doc,
                                                            'motivo'=>$motivo,
                                                            'rubrica'=>$rubrica
                                                          ])
        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function CurriculumVitae(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $rubrica = $request->rubrica;

        $personal = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
        ->leftjoin('personal_especialidades','personal_especialidades.per_codigo','personals.per_codigo')
        ->leftjoin('especialidades','especialidades.id','personal_especialidades.espe_cod')
        ->leftjoin('subespecialidades','subespecialidades.id','personal_especialidades.subespe_cod')
        ->leftjoin('personal_cargos','personal_cargos.per_codigo','personals.per_codigo')
        ->leftjoin('cargos','cargos.id','personal_cargos.car_cod')
        ->leftjoin('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
        ->leftjoin('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_fecha_nacimiento',
                'personals.per_estado_civil',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'escalafones.id as idesc',
                'subescalafones.nombre as subesca_nombre',
                'subescalafones.id as idsubesc',
                'grados.nombre as gra_nombre',
                'departamentos.nombre as depanombre',
                'especialidades.nombre as espenombre',
                'subespecialidades.nombre as subespenombre',
                'cargos.descripcion',
                'nivel3_destinos.descripcion as n3nom')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
        ->where('personal_especialidades.estado',1)
        ->where('personal_cargos.estado',1)
        ->where('personal_cargos.nivel_cargo',1)
        ->where('personal_destinos.estado',1)
        ->first();

        $situacion = DB::table('personals')
        ->join('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->select('personal_situaciones.fecha_documento')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_situaciones.detsit_cod',1)
        ->first();

        $datos_familiares = DB::table('personals')
        ->join('datos_familiares','datos_familiares.per_codigo','personals.per_codigo')
        ->select('datos_familiares.nombre as datfamnombre',
                'datos_familiares.paterno',
                'datos_familiares.materno',
                'datos_familiares.parentesco')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('datos_familiares.parentesco',['ESPOSO(A)','HIJO(A)'])
        ->get();

        // $institutos = DB::table('personals')
        // ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        // ->join('cursos','cursos.id','personal_cursos.cur_cod')
        // ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        // ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        // ->select('cursos.descripcion as curdesc',
        //         'tipo_cursos.descripcion as tipcurdesc',
        //         'desgloce_cursos.descripcion as descurdesc',
        //         'personal_cursos.nro_doc',
        //         'personal_cursos.documento',
        //         'personal_cursos.fecha_otorgacion')
        // ->where('personals.per_codigo',$per_codigo)
        // ->whereIn('personal_cursos.cur_cod',[1,12])
        // ->orderBy('personal_cursos.fecha_otorgacion')
        // ->get();

        $institutos = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[12])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $cur_mil = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[1,2,3,4,5,6,7,8,9,13])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $otro_cur = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[8,10])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $destinos = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        // ->where('nivel3_destinos.frontera',0)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $destinos_front = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        ->where('nivel3_destinos.frontera',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $felicitacion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                DB::raw('count(nivel2_distinciones.descripcion) as cantfel'))
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[2,7,13,20,25,30,35,40,46])
        ->groupBy('nivel2_distinciones.id','nivel2_distinciones.descripcion')
        ->orderBy('nivel2_distinciones.id')
        ->get();

        $condecoracion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[1,6,12,19,24,29,34,39,45])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $plaqueta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[4,10,16,22,27,32,37,43])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $diploma = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[3,8,14,21,26,31,36,41])
        ->orderBY('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $otros = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[5,11,18,23,28,33,38,44])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $abanderado_escolta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[9,15,42])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $representacion = DB::table('personals')
        ->join('personal_representaciones','personal_representaciones.per_codigo','personals.per_codigo')
        ->join('representaciones','representaciones.id','personal_representaciones.repre_cod')
        ->select('representaciones.descripcion as repdesc',
                'personal_representaciones.descripcion as perrepdesc',
                'personal_representaciones.nro_doc',
                'personal_representaciones.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_representaciones.fecha')
        ->get();

        $constancia = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',17)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $bre_ins = DB::table('personals')
        ->join('personal_brevets','personal_brevets.per_codigo','personals.per_codigo')
        ->join('brevets','brevets.id','personal_brevets.brevet_cod')
        ->join('paises','paises.id','personal_brevets.pais_cod')
        ->select('brevets.descripcion',
                'personal_brevets.fecha_imposicion',
                'paises.nombre',
                'personal_brevets.ndoc')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_brevets.fecha_imposicion')
        ->get();

        $ascenso = DB::table('personals')
        ->join('personal_ascenso_promociones','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('grados','grados.id','personal_ascenso_promociones.gra_cod')
        ->select('personal_ascenso_promociones.fechasc',
                'grados.nombre',
                'personal_ascenso_promociones.antigfin')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_ascenso_promociones.flag',1)
        ->orderBy('personal_ascenso_promociones.fechasc')
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
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.curriculumVitae',['personal'=>$personal,
                                                            'datosfam'=>$datos_familiares,
                                                            'instituto'=>$institutos,
                                                            'cursomil'=>$cur_mil,
                                                            'otrocur'=>$otro_cur,
                                                            'destinos'=>$destinos,
                                                            'destinosfront'=>$destinos_front,
                                                            'abanescol'=>$abanderado_escolta,
                                                            'condecoracion'=>$condecoracion,
                                                            'plaqueta'=>$plaqueta,
                                                            'diploma'=>$diploma,
                                                            'constancia'=>$constancia,
                                                            'otro'=>$otros,
                                                            'situacion'=>$situacion,
                                                            'breins'=>$bre_ins,
                                                            'ascenso'=>$ascenso,
                                                            'jefe_dpto'=>$jefe_dpto,
                                                            'felicitacion'=>$felicitacion,
                                                            
                                                            'representacion'=>$representacion,
                                                            'rubrica'=>$rubrica
                                                          ])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function HojaVida(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $horavuelo = $request->horavuelo;
        $rubrica = $request->rubrica;
        $observacion = strtoupper($request->observacion);

        $personal = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
        ->leftjoin('personal_especialidades','personal_especialidades.per_codigo','personals.per_codigo')
        ->leftjoin('especialidades','especialidades.id','personal_especialidades.espe_cod')
        ->leftjoin('subespecialidades','subespecialidades.id','personal_especialidades.subespe_cod')
        ->leftjoin('personal_cargos','personal_cargos.per_codigo','personals.per_codigo')
        ->leftjoin('cargos','cargos.id','personal_cargos.car_cod')
        ->leftjoin('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
        ->leftjoin('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_fecha_nacimiento',
                'personals.per_estado_civil',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'escalafones.id as idesc',
                'subescalafones.nombre as subesca_nombre',
                'subescalafones.id as idsubesc',
                'grados.nombre as gra_nombre',
                'departamentos.nombre as depanombre',
                'especialidades.nombre as espenombre',
                'subespecialidades.nombre as subespenombre',
                'cargos.descripcion',
                'nivel3_destinos.descripcion as n3nom')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
        ->where('personal_especialidades.estado',1)
        ->where('personal_cargos.estado',1)
        ->where('personal_cargos.nivel_cargo',1)
        ->where('personal_destinos.estado',1)
        ->first();

        $situacion = DB::table('personals')
        ->join('personal_situaciones','personal_situaciones.per_codigo','personals.per_codigo')
        ->select('personal_situaciones.fecha_documento')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_situaciones.detsit_cod',1)
        ->first();

        $datos_familiares = DB::table('personals')
        ->join('datos_familiares','datos_familiares.per_codigo','personals.per_codigo')
        ->select('datos_familiares.nombre as datfamnombre',
                'datos_familiares.paterno',
                'datos_familiares.materno',
                'datos_familiares.parentesco')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('datos_familiares.parentesco',['ESPOSO(A)','HIJO(A)'])
        ->get();

        $institutos = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[1,12])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $cur_mil = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.descripcion as percurdesc',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[2,3,4,5,6,7,8,9,13])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $otro_cur = DB::table('personals')
        ->join('personal_cursos','personal_cursos.per_codigo','personals.per_codigo')
        ->join('cursos','cursos.id','personal_cursos.cur_cod')
        ->join('tipo_cursos','tipo_cursos.id','personal_cursos.tipcur_cod')
        ->join('desgloce_cursos','desgloce_cursos.id','personal_cursos.desgcur_cod')
        ->select('cursos.descripcion as curdesc',
                'tipo_cursos.descripcion as tipcurdesc',
                'desgloce_cursos.descripcion as descurdesc',
                'personal_cursos.nro_doc',
                'personal_cursos.documento',
                'personal_cursos.fecha_otorgacion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('personal_cursos.cur_cod',[8,10])
        ->orderBy('personal_cursos.fecha_otorgacion')
        ->get();

        $destinos = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino',
                    'nivel3_destinos.frontera')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        // ->where('nivel3_destinos.frontera',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $destinos_front = DB::table('personals')
        ->join('personal_destinos','personal_destinos.per_codigo','=','personals.per_codigo')
        // ->join('nivel1_destinos','personal_destinos.d1_cod','=','nivel1_destinos.id')
        // ->join('nivel2_destinos','personal_destinos.d2_cod','=','nivel2_destinos.id')
        ->join('nivel3_destinos','personal_destinos.d3_cod','=','nivel3_destinos.id')
        ->join('nivel4_destinos','personal_destinos.d4_cod','=','nivel4_destinos.id')
        ->join('personal_cargos','personal_destinos.id','=','personal_cargos.dest_cod')
        ->join('cargos','personal_cargos.car_cod','=','cargos.id')
        ->select('nivel3_destinos.descripcion as n3desc',
                    'cargos.descripcion as cargdesc',
                    'personal_destinos.fecha_destino',
                    'nivel3_destinos.frontera')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_cargos.nivel_cargo',1)
        ->where('nivel3_destinos.frontera',1)
        ->orderBy('personal_destinos.fecha_destino')
        ->get();

        $felicitacion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                DB::raw('count(nivel2_distinciones.descripcion) as cantfel'))
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[2,7,13,20,25,30,35,40,46])
        ->groupBy('nivel2_distinciones.id','nivel2_distinciones.descripcion')
        ->orderBy('nivel2_distinciones.id')
        ->get();

        $condecoracion = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[1,6,12,19,24,29,34,39,45])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $plaqueta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[4,10,16,22,27,32,37,43])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $diploma = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[3,8,14,21,26,31,36,41])
        ->orderBY('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $otros = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[5,11,18,23,28,33,38,44])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $abanderado_escolta = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->whereIn('nivel2_distinciones.id',[9,15,42])
        ->orderBy('nivel2_distinciones.id')
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();
        
        $representacion = DB::table('personals')
        ->join('personal_representaciones','personal_representaciones.per_codigo','personals.per_codigo')
        ->join('representaciones','representaciones.id','personal_representaciones.repre_cod')
        ->select('representaciones.descripcion as repdesc',
                'personal_representaciones.descripcion as perrepdesc',
                'personal_representaciones.nro_doc',
                'personal_representaciones.fecha')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_representaciones.fecha')
        ->get();

        $constancia = DB::table('personals')
        ->join('personal_distinciones','personal_distinciones.per_codigo','personals.per_codigo')
        ->join('nivel2_distinciones','nivel2_distinciones.id','personal_distinciones.dist2_cod')
        ->join('nivel3_distinciones','nivel3_distinciones.id','personal_distinciones.dist3_cod')
        ->select('nivel2_distinciones.descripcion as n2disdesc',
                'nivel3_distinciones.descripcion as n3disdesc',
                    'personal_distinciones.descripcion as pdisdesc',
                    'personal_distinciones.ndoc',
                    'personal_distinciones.fecha_distincion')
        ->where('personals.per_codigo',$per_codigo)
        ->where('nivel2_distinciones.id',17)
        // ->orwhere('nivel2_distinciones.id',15)
        // ->orwhere('nivel2_distinciones.id',42)
        ->orderBy('personal_distinciones.fecha_distincion')
        ->get();

        $bre_ins = DB::table('personals')
        ->join('personal_brevets','personal_brevets.per_codigo','personals.per_codigo')
        ->join('brevets','brevets.id','personal_brevets.brevet_cod')
        ->join('paises','paises.id','personal_brevets.pais_cod')
        ->select('brevets.descripcion',
                'personal_brevets.fecha_imposicion',
                'paises.nombre',
                'personal_brevets.ndoc')
        ->where('personals.per_codigo',$per_codigo)
        ->orderBy('personal_brevets.fecha_imposicion')
        ->get();

        $ascenso = DB::table('personals')
        ->join('personal_ascenso_promociones','personal_ascenso_promociones.per_codigo','personals.per_codigo')
        ->join('grados','grados.id','personal_ascenso_promociones.gra_cod')
        ->select('personal_ascenso_promociones.fechasc',
                'grados.nombre',
                'personal_ascenso_promociones.antigfin')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_ascenso_promociones.flag',1)
        ->orderBy('personal_ascenso_promociones.fechasc')
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
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.hojaVida',['personal'=>$personal,
                                                            'datosfam'=>$datos_familiares,
                                                            'instituto'=>$institutos,
                                                            'cursomil'=>$cur_mil,
                                                            'otrocur'=>$otro_cur,
                                                            'destinos'=>$destinos,
                                                            'destinosfront'=>$destinos_front,
                                                            'abanescol'=>$abanderado_escolta,
                                                            'condecoracion'=>$condecoracion,
                                                            'plaqueta'=>$plaqueta,
                                                            'diploma'=>$diploma,
                                                            'constancia'=>$constancia,
                                                            'otro'=>$otros,
                                                            'situacion'=>$situacion,
                                                            'breins'=>$bre_ins,
                                                            'ascenso'=>$ascenso,
                                                            'jefe_dpto'=>$jefe_dpto,
                                                            'felicitacion'=>$felicitacion,
                                                            
                                                            'representacion'=>$representacion,
                                                            'horavuelo'=>$horavuelo,
                                                            'rubrica'=>$rubrica,
                                                            'observacion'=>$observacion,
                                                          ])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function TiempoServicio(Request $request)
    {
        $per_codigo = $request->per_codigo;

        $situacion_militar = DB::table('personal_situaciones')
                                ->join('detalle_situaciones','personal_situaciones.detsit_cod','detalle_situaciones.id')
                                ->select('personal_situaciones.per_codigo',
                                        'personal_situaciones.sit_cod',
                                        'personal_situaciones.subsit_cod',
                                        'personal_situaciones.detsit_cod',
                                        'personal_situaciones.fecha_documento',
                                        'personal_situaciones.estado',
                                        'detalle_situaciones.nombre')
                                ->where('per_codigo',$per_codigo)
                                ->orderBy('fecha_documento','asc')
                                ->get();
        
        $personal = DB::table('personals')
                        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
                        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
                        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
                        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
                        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
                        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
                        ->leftjoin('personal_localidades','personal_localidades.per_codigo','personals.per_codigo')
                        ->leftjoin('departamentos','departamentos.id','personal_localidades.depa_codigo')
                        ->leftjoin('personal_especialidades','personal_especialidades.per_codigo','personals.per_codigo')
                        ->leftjoin('especialidades','especialidades.id','personal_especialidades.espe_cod')
                        ->leftjoin('subespecialidades','subespecialidades.id','personal_especialidades.subespe_cod')
                        ->leftjoin('personal_cargos','personal_cargos.per_codigo','personals.per_codigo')
                        ->leftjoin('cargos','cargos.id','personal_cargos.car_cod')
                        ->leftjoin('personal_destinos','personal_destinos.per_codigo','personals.per_codigo')
                        ->leftjoin('nivel3_destinos','nivel3_destinos.id','personal_destinos.d3_cod')
                        ->select('personals.per_codigo',
                                'personals.per_paterno',
                                'personals.per_materno',
                                'personals.per_nombre',
                                'personals.per_sexo',
                                'personals.per_ci',
                                'personals.per_expedido',
                                'personals.per_fecha_nacimiento',
                                'personals.per_estado_civil',
                                'personals.per_cm',
                                'personals.per_promo',
                                'personals.per_foto',
                                'grados.id as idgrado',
                                'grados.abreviatura as gra_abreviatura',
                                'estudios.abreviatura as estu_abreviatura',
                                'subescalafones.id as subescid',
                                'subescalafones.nombre',
                                'personal_escalafones.estado as escperestado',
                                'personal_estudios.estado as estperestado',
                                'escalafones.nombre as esca_nombre',
                                'escalafones.id as idesc',
                                'subescalafones.nombre as subesca_nombre',
                                'subescalafones.id as idsubesc',
                                'grados.nombre as gra_nombre',
                                'departamentos.nombre as depanombre',
                                'especialidades.nombre as espenombre',
                                'subespecialidades.nombre as subespenombre',
                                'cargos.descripcion',
                                'nivel3_destinos.descripcion as n3nom')
                        ->where('personals.per_codigo',$per_codigo)
                        ->where('personal_escalafones.estado',1)
                        ->where('personal_estudios.estado',1)
                        ->where('personal_especialidades.estado',1)
                        ->where('personal_cargos.estado',1)
                        ->where('personal_cargos.nivel_cargo',1)
                        ->where('personal_destinos.estado',1)
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
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("GRADO: $personal->gra_abreviatura$personal->estu_abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nC.M.: $personal->per_cm\nC.I.: $personal->per_ci $personal->per_expedido\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.tiempoServicio',['personal'=>$personal,
                                                'situacion_militar'=>$situacion_militar,
                                                'jefe_dpto'=>$jefe_dpto                                                      
                                                ])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }
}
