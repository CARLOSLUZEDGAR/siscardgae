<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportesEspecialidadesController extends Controller
{
    public function ReporteEspecialidad(Request $request)
    {
        $especialidades = DB::table("especialidades")
        ->select(
                'id',
                'nombre',
                'observacion',
                'estado'
        )
        ->orderBy('estado','asc')
        ->orderBy('nombre','asc')
        ->get();
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate($fecha_emision);
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.especialidades',['especialidades'=>$especialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function ReporteSubespecialidad(Request $request)
    {
        $subespecialidades = DB::table("subespecialidades as s")
        ->join('especialidades as e','e.id','s.espe_cod')
        ->select(
                's.id',
                'e.nombre as nomespe',
                's.nombre as nomsubespe',
                's.observacion',
                's.estado'
        )
        ->orderBy('estado','asc')
        ->orderBy('nomespe','asc')
        ->orderBy('nomsubespe','asc')
        ->get();
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate($fecha_emision);
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.subespecialidades',['subespecialidades'=>$subespecialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function ReporteEspecialidadPromocion(Request $request)
    {
        $promocion = $request->promocion;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        
        if($especialidad == 0 || $subespecialidad == 0){
            if($especialidad != 0 && $subespecialidad == 0 ){
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
                ->get();
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
                ->orderBy('p.per_cm','asc')
                ->get();
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
            ->get();
        }

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate("FECHA DE EMISIÓN: $fecha_emision");
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporteEspecialidadPromocion',['promocion'=>$personal_especialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function ReporteEspecialidadGrado(Request $request)
    {
        $grado = $request->grado;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;

        if($especialidad == 0 || $subespecialidad == 0){
            if($especialidad != 0 && $subespecialidad == 0 ){
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
                // ->orderBy('p.per_cm','asc')
                ->orderBy('g.id','asc')
                ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                ->get();
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
                // ->orderBy('p.per_cm','asc')
                ->orderBy('g.id','asc')
                ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                ->get();
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
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->where('psit.estado',1)
            ->where('psit.sit_cod',1)
            ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
            // ->orderBy('p.per_cm','asc')
            ->orderBy('g.id','asc')
            ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
            ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
            ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
            ->get();
        }

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate($fecha_emision);
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporteEspecialidadGrado',['grado'=>$personal_especialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function ReporteEspecialidadEspecialidad(Request $request)
    {
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;
        if($especialidad != 0 && $subespecialidad == 0 ){
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
            // ->orderBy('p.per_cm','asc')
            ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
            ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
            ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
            ->get();
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
            // ->orderBy('p.per_cm','asc')
            ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
            ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
            ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
            ->get();
        }

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate($fecha_emision);
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporteEspecialidadEspecialidad',['especialidad'=>$personal_especialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function ReporteEspecialidadDestino(Request $request)
    {
        $entidad = $request->entidad;
        $gran_unidad = $request->gran_unidad;
        $reparticion = $request->reparticion;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;

        if($especialidad == 0 || $subespecialidad == 0){
            if($especialidad != 0 && $subespecialidad == 0 ){
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
                ->get();
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
                ->get();
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
            ->get();
        }

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate($fecha_emision);
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporteEspecialidadDestino',['destino'=>$personal_especialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function ReporteEspecialidadGenero(Request $request)
    {
        $genero = $request->genero;
        $especialidad = $request->especialidad;
        $subespecialidad = $request->subespecialidad;

        if($especialidad == 0 || $subespecialidad == 0){
            if($especialidad != 0 && $subespecialidad == 0 ){
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
                // ->orderBy('p.per_cm','asc')
                ->orderBy('g.id','asc')
                ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                ->get();
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
                // ->orderBy('p.per_cm','asc')
                ->orderBy('g.id','asc')
                ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
                ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
                ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
                ->get();
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
            ->where('pe.estado',1)
            ->where('pest.estado',1)
            ->where('psit.estado',1)
            ->where('psit.sit_cod',1)
            ->whereIn('psit.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
            // ->orderBy('p.per_cm','asc')
            ->orderBy('g.id','asc')
            ->orderBy(DB::raw('substr(p.per_cm, 1, 3)'))
            ->orderBy(DB::raw('substr(p.per_cm, 4, 2)'))
            ->orderBy(DB::raw('substr(p.per_cm, 7, 2)'))
            ->get();
        }

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate($fecha_emision);
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.reporteEspecialidadGenero',['genero'=>$personal_especialidades,
                                                        'qr'=>$codigo])

        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');
    }

    public function CuadroEfectivoEspecialidades(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '10240M');
        $categoria = $request->efectivo;
        switch ($categoria) {
            case 'O':
                $grados = DB::table('vista_grados_cant')
                    ->select('idgrado',
                        'abreviaturagrado',
                        'nombregrado',
                        'nivelgrado',
                        'cantidadgrado')
                    ->whereIn('idgrado',[1,2,3,4,5,6,7,8,9])
                    ->get();

                $especialidades = DB::table('vista_especialidad_cant')
                                ->select('idespe',
                                        'especialidad',
                                        'idsubespe',
                                        'subespecialidad',
                                        'escalafon',
                                        'total')
                                ->where('escalafon','like','%'.'O'.'%')
                                ->get(); 
                
                $especialidad_grado_cant = DB::table('vista_especialidad_grado_cant')
                                       ->select('idespe',
                                                'especialidad',
                                                'idsubespe',
                                                'subespecialidad',
                                                'idgrado',
                                                'grado',
                                                'nomgrado',
                                                'nivelgrado',
                                                'escalafon',
                                                'total')
                                        ->whereIn('idgrado',[1,2,3,4,5,6,7,8,9])
                                        ->get();
                break;
            case 'ST':
                $grados = DB::table('vista_grados_cant')
                    ->select('idgrado',
                        'abreviaturagrado',
                        'nombregrado',
                        'nivelgrado',
                        'cantidadgrado')
                    ->whereIn('idgrado',[10,11,12,13,14,15,16,17])
                    ->get();

                $especialidades = DB::table('vista_especialidad_cant')
                                ->select('idespe',
                                        'especialidad',
                                        'idsubespe',
                                        'subespecialidad',
                                        'escalafon',
                                        'total')
                                ->where('escalafon','like','%'.'S'.'%')
                                ->get(); 
                $especialidad_grado_cant = DB::table('vista_especialidad_grado_cant')
                                ->select('idespe',
                                         'especialidad',
                                         'idsubespe',
                                         'subespecialidad',
                                         'idgrado',
                                         'grado',
                                         'nomgrado',
                                         'nivelgrado',
                                         'escalafon',
                                         'total')
                                 ->whereIn('idgrado',[10,11,12,13,14,15,16,17])
                                 ->get();
                break;
            case 'SM':
                $grados = DB::table('vista_grados_cant')
                    ->select('idgrado',
                        'abreviaturagrado',
                        'nombregrado',
                        'nivelgrado',
                        'cantidadgrado')
                    ->whereIn('idgrado',[164,165,166,168,169,170,171,172])
                    ->get();
                
                $especialidades = DB::table('vista_especialidad_cant')
                    ->select('idespe',
                            'especialidad',
                            'idsubespe',
                            'subespecialidad',
                            'escalafon',
                            'total')
                    ->where('escalafon','like','%'.'S'.'%')
                    ->get(); 
                
                $especialidad_grado_cant = DB::table('vista_especialidad_grado_cant')
                    ->select('idespe',
                             'especialidad',
                             'idsubespe',
                             'subespecialidad',
                             'idgrado',
                             'grado',
                             'nomgrado',
                             'nivelgrado',
                             'escalafon',
                             'total')
                     ->whereIn('idgrado',[164,165,166,168,169,170,171,172])
                     ->get();
                break;
            case 'C':
                $grados = DB::table('vista_grados_cant')
                    ->select('idgrado',
                        'abreviaturagrado',
                        'nombregrado',
                        'nivelgrado',
                        'cantidadgrado')
                    ->where('nivelgrado',4)
                    ->get();
                
                $especialidades = DB::table('vista_especialidad_cant')
                    ->select('idespe',
                            'especialidad',
                            'idsubespe',
                            'subespecialidad',
                            'escalafon',
                            'total')
                    ->where('escalafon','like','%'.'C'.'%')
                    ->get();
                
                    $especialidad_grado_cant = DB::table('vista_especialidad_grado_cant')
                    ->select('idespe',
                             'especialidad',
                             'idsubespe',
                             'subespecialidad',
                             'idgrado',
                             'grado',
                             'nomgrado',
                             'nivelgrado',
                             'escalafon',
                             'total')
                    ->where('nivelgrado',4)
                    ->get();
                break;
            case 'T':
                $grados = DB::table('vista_grados_cant')
                    ->select('idgrado',
                        'abreviaturagrado',
                        'nombregrado',
                        'cantidadgrado')
                    ->get();
                
                $especialidades = DB::table('vista_especialidad_cant')
                    ->select('idespe',
                            'especialidad',
                            'idsubespe',
                            'subespecialidad',
                            'escalafon',
                            'total')
                    ->get();
                
                $especialidad_grado_cant = DB::table('vista_especialidad_grado_cant')
                    ->select('idespe',
                             'especialidad',
                             'idsubespe',
                             'subespecialidad',
                             'idgrado',
                             'grado',
                             'nomgrado',
                             'nivelgrado',
                             'escalafon',
                             'total')
                     ->get();
                break;
            default:

                break;
        }

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

        $pdf = PDF::loadView('reportes.cuadroEfectivosEspecialidad',['grados'=>$grados,
                                                                    'especialidades'=>$especialidades,
                                                                    'especialidades_grado_cant'=>$especialidad_grado_cant,
                                                                    'categoria'=>$categoria,
                                                                    'jefe_dpto'=>$jefe_dpto
        ]);
        if ($categoria != 'T') {
            return $pdf->setPaper('letter', 'portrait')->stream('reporte.pdf');   
        } else {
            return $pdf->setPaper(array(0, 0, 612.28, 935.43), 'landscape')->stream('reporte.pdf');   
        }
        
    }
}