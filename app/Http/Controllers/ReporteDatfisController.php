<?php

namespace App\Http\Controllers;

use App\Datos_fisicos;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteDatfisController extends Controller
{
    public function generareportdatfispersonal(Request $request)
    {
        $id = $request->STXWTQ2HH3835NR;
        $datos_fisicos = Datos_fisicos::Where('per_codigo','=',$id)
            ->Where('estado','=','1')
            ->orderBy('id','desc')->first();
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
                            //->where('esc.nombre','=','ARMAS')
                            ->where('p.per_codigo',$id)
                            ->first();
        $bandera = Str::random(10);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO I PERSONAL - EMGFAB GENERA INFORME DE: $nombrepersona->gra_abreviatura $nombrepersona->estu_abreviatura $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido $bandera\nFECHA:$fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('reportes.datfispersonalpdf',['datos_fisicos' => $datos_fisicos, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])
                    ->setPaper('letter','portrait');
                    setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('datfispersonal.pdf');
    }


}

