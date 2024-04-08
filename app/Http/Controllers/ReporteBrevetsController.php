<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
//importando libreria Codigo Qr
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteBrevetsController extends Controller
{
    public function gendocbrevetpersonal(Request $request)
    {
        $id = $request->id;

        $brevetpersonal = DB::table('personal_brevets as pb')
                            ->join('personals as p','pb.per_codigo','p.per_codigo')
                            ->join('brevets as b','pb.brevet_cod','b.id')
                            ->join('paises as pa','pb.pais_cod','pa.id')
                            ->select('p.per_nombre','p.per_paterno','p.per_materno','pb.fecha_imposicion',
                                    'pb.pais_cod','pb.brevet_cod','pb.observacion','pb.ndoc',
                                    'pb.tipodoc','b.descripcion','b.puntaje','b.asignacion',
                                    'b.clasificacion','pa.id','pa.nombre','pb.id as idperbrevet')
                            ->distinct()
                            ->where('pb.per_codigo',$id)
                            ->where('pb.estado','1')
                            ->orderBy('pb.fecha_imposicion','desc')
                            ->get();

        $nombrepersona = DB::table('personals as p')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as gra_abreviatura','e.abreviatura as estu_abreviatura','p.per_ci',
                                    'p.per_nombre','p.per_paterno','p.per_materno','p.per_cm','p.per_sexo','p.per_expedido')
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('esc.nombre','=','ARMAS')
                            ->where('p.per_codigo',$id)
                            ->first();

        $bandera = Str::random(10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO I PERSONAL - EMGFAB GENERA INFORME DE: $nombrepersona->gra_abreviatura $nombrepersona->estu_abreviatura $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido $bandera\nFECHA:$fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('reportes.brevetpersonalpdf',['brevetpersonal' => $brevetpersonal, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])->setPaper('letter','Portrait'); setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('brevetpersonal.pdf');
    }

    public function generarRangofechas(Request $request)
    {
        $inicio = $request->inicio;
        $fin = $request->fin;

        $rangofechas = DB::table('personals as p')
                        ->join('personal_brevets as pb','p.per_codigo','pb.per_codigo')
                        ->join('brevets as b','pb.brevet_cod','b.id')
                        ->join('paises as pa','pb.pais_cod','pa.id')

                        ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                        ->join('grados as g','escap.gra_cod','g.id')
                        ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                        ->join('estudios as e','estp.est_cod','e.id')
                        ->join('escalafones as esc','escap.esca_cod','esc.id')
                        ->select('g.abreviatura as gra_abreviatura','e.abreviatura as estu_abreviatura',
                                'p.per_cm','p.per_nombre','p.per_paterno','p.per_materno',
                                'pb.fecha_imposicion','pb.pais_cod','pb.brevet_cod','pb.observacion',
                                'pb.ndoc','pb.tipodoc','b.descripcion','b.puntaje','b.asignacion','g.id',
                                'b.clasificacion','pa.id','pa.nombre','pb.id as idperbrevet')
                        ->distinct()
                        ->where('escap.estado','1')
                        ->where('estp.estado','1')
                        ->where('pb.fecha_imposicion','>=',$inicio)
                        ->where('pb.fecha_imposicion','<=',$fin)
                        ->where('pb.estado','1')
                        ->orderBy('g.id','asc')
                        ->get();

        $pdf = PDF::loadView('reportes.rangofechasPersonalBrevets',['rangofechas' => $rangofechas]);
                //->setPaper('letter','portrait');
                setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('rangofechasPersonalBrevets.pdf');
        // return $pdf->download('rangofechasPersonalBrevets.pdf');
    }
}
