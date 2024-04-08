<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportePersonalCursosController extends Controller
{
    public function gendocpersonalcurso(Request $request)
    {
        $id = $request->id;

        $cursopersonal = DB::table('personal_cursos as pc')
                                ->join('personals as p','pc.per_codigo','p.per_codigo')
                                ->join('cursos as c','pc.cur_cod','c.id')
                                ->join('tipo_cursos as tc','pc.tipcur_cod','tc.id')
                                ->join('desgloce_cursos as dc','pc.desgcur_cod','dc.id')
                                ->join('emisores as e','pc.emi_cod','e.id')
                                ->join('tipo_emisores as te','pc.tipemi_cod','te.id')
                                ->select('p.per_cm','p.per_nombre','p.per_paterno','p.per_materno','c.descripcion as nombrecurso',
                                         'tc.descripcion as nombretipocurso','dc.descripcion as nombredesglocurso',
                                         'e.descripcion as nombreemisor','te.descripcion as nombretipoemisor','pc.descripcion',
                                         'pc.fec_inicio','pc.fec_final','pc.lugar','pc.documento','pc.fecha_otorgacion',
                                         'pc.per_codigo','pc.cur_cod','pc.tipcur_cod','pc.desgcur_cod','pc.emi_cod','pc.tipemi_cod',
                                         'pc.nro_doc','pc.costo','pc.observacion','c.id as idcurso','tc.id as idtipocurso',
                                         'dc.id as iddesglocurso','e.id as idemisor','te.id as idtipoemisor')
                                ->distinct()
                                ->where('pc.estado','=','1')
                                ->where('pc.per_codigo',$id)
                                ->get();

        $nombrepersona = DB::table('personals as p')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as gra_abreviatura','e.abreviatura as estu_abreviatura','p.per_expedido',
                                    'p.per_nombre','p.per_paterno','p.per_materno','p.per_cm','p.per_sexo','p.per_ci')
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('p.per_codigo',$id)
                            ->first();

        $bandera = Str::random(10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO I PERSONAL - EMGFAB GENERA INFORME DE $nombrepersona->gra_abreviatura $nombrepersona->estu_abreviatura $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido $bandera\nFECHA: $fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('reportes.cursopersonalpdf',['cursopersonal' => $cursopersonal, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])
                    ->setPaper('letter','Portrait');
                    setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('cursopersonal.pdf');
    }

    public function generarRangofechasPersonalCursos(Request $request)
    {
        $inicio = $request->inicio;
        $fin = $request->fin;

        $rangofechas = DB::table('personal_cursos as pc')
                            ->join('personals as p','pc.per_codigo','p.per_codigo')
                            ->join('cursos as c','pc.cur_cod','c.id')
                            ->join('tipo_cursos as tc','pc.tipcur_cod','tc.id')
                            ->join('desgloce_cursos as dc','pc.desgcur_cod','dc.id')
                            ->join('emisores as em','pc.emi_cod','em.id')
                            ->join('tipo_emisores as te','pc.tipemi_cod','te.id')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as gra_abreviatura','e.abreviatura as estu_abreviatura','p.per_cm','p.per_nombre','p.per_paterno','p.per_materno',
                                     'c.descripcion as nombrecurso','tc.descripcion as nombretipocurso','dc.descripcion as nombredesglocurso','em.descripcion as nombreemisor',
                                     'te.descripcion as nombretipoemisor','pc.descripcion','pc.fec_inicio','pc.fec_final','pc.lugar','pc.documento','pc.fecha_otorgacion',
                                     'pc.per_codigo','pc.cur_cod','pc.tipcur_cod','pc.desgcur_cod','pc.emi_cod','pc.tipemi_cod','pc.nro_doc','pc.costo','pc.observacion',
                                     'c.id as idcurso','tc.id as idtipocurso','dc.id as iddesglocurso','em.id as idemisor','te.id as idtipoemisor','g.id')
                            ->distinct()
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('pc.fec_inicio','>=',$inicio)
                            ->where('pc.fec_inicio','<=',$fin)
                            ->orderBy('g.id','asc')
                            ->get();

        $pdf = PDF::loadView('reportes.rangofechasPersonalCursos',['rangofechas' => $rangofechas])->setPaper('a4','landscape');//->setPaper('landscape','portrait');
        setlocale(LC_ALL, 'es_ES');
        return $pdf->stream('rangofechasPersonalCursos.pdf');
    }

    public function gendocdipsupsgtos($id){

        $cursopersonal = DB::table('personals as p')
                                ->join('personal_escalafones as pe','p.per_codigo','pe.per_codigo')
                                ->join('personal_cursos as pc','p.per_codigo','pc.per_codigo')
                                ->join('desgloce_cursos as dc','pc.desgcur_cod','dc.id')
                                ->join('tipo_cursos as tc','pc.tipcur_cod','tc.id')
                                ->join('cursos as c','pc.cur_cod','c.id')
                                ->join('emisores as e','pc.emi_cod','e.id')
                                ->join('tipo_emisores as te','pc.tipemi_cod','te.id')
                                ->join('grados as g','pe.gra_cod','g.id')
                                ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                                ->join('estudios as est','estp.est_cod','est.id')
                                ->select('dc.id','p.per_cm','g.abreviatura as grado','est.abreviatura as estu_abreviatura',
                                         'p.per_paterno','p.per_materno','p.per_nombre','c.descripcion as curso',
                                         'tc.id as idtipocurso','tc.descripcion as Diplomado','dc.descripcion as Diplomado2',
                                         'pc.fec_inicio','pc.fec_final','pc.lugar','pc.documento','pc.fecha_otorgacion',
                                         'pc.nro_doc','pc.estado')
                                ->where('pc.estado',1)
                                ->where('pe.estado',1)
                                ->whereIn('g.id',[10,11,12,13,14,15,16,17,131,133,134,135,164,165,166,168,169,170,171,172])
                                ->whereIn('tc.id',[19,20])
                                // ->whereOr('tc.id',[19,20])
                                // ->whereIn('dc.id',[27,28,29,30,31,32,33,34,35,36])
                                // ->whereOr('dc.id',[27,28,29,30,31,32,33,34,35,36])
                                ->where('tc.id',$id)
                                ->orderBy('g.id')
                                ->get();

        // return response()->json($cursopersonal);

        $pdf = PDF::loadView('reportes.diplosofsgtospdf',['cursopersonal' => $cursopersonal])
                    ->setPaper('letter','Portrait');
                    setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('diplosofsgtos.pdf');
    }
}
