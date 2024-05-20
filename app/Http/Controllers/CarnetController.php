<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;


class CarnetController extends Controller
{
    public function GenerarCarnet(Request $request)
    {
        $personal = DB::table('personals as p')
                    ->join('personal_licencias as pl','p.id','pl.id_personal')
                    ->join('nacionalidads as n','p.id_nacionalidad','n.id')
                    ->join('entidads as e','pl.id_entidad','e.id')
                    ->join('grados as g','pl.id_grado','g.id')
                    ->join('licencias as l','pl.id_licencia','l.id')
                    ->join('habilitacions as h','pl.id_habilitacion','h.id')
                    ->join('competencia_linguisticas as cl','pl.id_comp_linguistica','cl.id')
                    ->select('p.id as id_personal',
                        'n.nacionalidad',
                        'n.pais',
                        'p.per_foto',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'p.per_ci',
                        'p.per_sexo',
                        'p.per_fecha_nacimiento',
                        'pl.id as id_licencia',
                        'pl.id_entidad',
                        'e.entidad',
                        'g.abreviatura',
                        'l.licencia',
                        'l.traduccion',
                        'h.habilitacion',
                        'h.traduccion as htraduccion',
                        'cl.nivel',
                        'cl.traduccion as cltraduccion',
                        'pl.observacion',
                        'pl.fecha_emision',
                        'pl.fecha_expiracion'
                        )
                    ->where('p.id',$request->id_p)
                    ->where('pl.estado',1)
                    ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')."/".date('n')."/".date('Y');
        $qr = QrCode::encoding('UTF-8')->size(100)->generate( "No. LICENCIA: $personal->per_ci\nGRADO: $personal->abreviatura\nAPELLIDO(S): $personal->per_paterno $personal->per_materno\nNOMBRE(S): $personal->per_nombre\nTITULO: $personal->licencia\nHABILITACION: $personal->habilitacion\nFECHA: $fecha_emision");
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.carnet',['personal'=>$personal,
                                                'qr'=>$codigo
                                                ])
        //8.3cm 5cm
        ->setPaper(array(0, 0, 235.276, 141.732), 'portrait');                                               
        
        return $pdf->stream($personal->id_licencia.'-'.$personal->per_ci.'.pdf');
        // return $pdf->download($personal->id_licencia.'-'.$personal->per_ci.'.pdf');

    }
}
