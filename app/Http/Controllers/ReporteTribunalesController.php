<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteTribunalesController extends Controller
{
    public function gendoctribunalpersonal(Request $request)
    {
        $id = $request->id;

        $tribunalpersonal = DB::table('personal_tribunales as pt')
                                ->join('personals as p','pt.per_codigo','p.per_codigo')
                                ->join('tribunales as trib','pt.tri_cod','trib.id')
                                ->select('p.per_nombre','p.per_paterno','p.per_materno',
                                         'trib.descripcion','trib.clasificacion','trib.subesc_cod','trib.puntaje','trib.observacion',
                                         'pt.per_codigo','pt.tri_cod','pt.documento','pt.nro_doc','pt.fecha',
                                         'pt.descripcion as ptdescripcion','pt.observacion','pt.id as idpertribunal')
                                ->distinct()
                                ->where('pt.estado','=',1)
                                ->where('pt.per_codigo',$id)
                                ->orderBy('pt.fecha','asc')
                                ->get();

        $nombrepersona = DB::table('personals as p')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as gra_abreviatura','e.abreviatura as estu_abreviatura',
                                     'p.per_nombre','p.per_paterno','p.per_materno','p.per_cm','p.per_sexo',
                                     'p.per_ci','p.per_expedido')
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('esc.nombre','=','ARMAS')
                            ->where('p.per_codigo',$id)
                            ->first();

        $bandera = Str::random(10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO I PERSONAL - EMGFAB GENERA INFORME DE $nombrepersona->gra_abreviatura $nombrepersona->estu_abreviatura $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido $bandera\nFECHA: $fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('reportes.tribunalpersonalpdf',['tribunalpersonal' => $tribunalpersonal, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])->setPaper('letter','portrait'); setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('tribunalpersonal.pdf');
    }

    public function generarRangofechasTribunales(Request $request)
    {
        $inicio = $request->inicio;
        $fin = $request->fin;

        $rangofechas = DB::table('personals as p')
                            ->join('personal_tribunales as pt','p.per_codigo','pt.per_codigo')
                            ->join('tribunales as trib','pt.tri_cod','trib.id')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as gra_abreviatura','e.abreviatura as estu_abreviatura','p.per_cm','p.per_nombre','p.per_paterno','p.per_materno',
                                     'trib.descripcion','trib.clasificacion','trib.subesc_cod','trib.puntaje','trib.observacion',
                                     'pt.per_codigo','pt.tri_cod','pt.documento','pt.nro_doc','pt.fecha',
                                     'pt.descripcion as ptdescripcion','pt.observacion','pt.id as idpertribunal','g.id')
                            ->distinct()
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('pt.fecha','>=',$inicio)
                            ->where('pt.fecha','<=',$fin)
                            ->orderBy('g.id','asc')
                            ->get();

        $pdf = PDF::loadView('reportes.rangofechasPersonalTribunal',['rangofechas' => $rangofechas])->setPaper('portrait','landscape'); setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('rangofechasPersonalTribunal.pdf');
    }
}
