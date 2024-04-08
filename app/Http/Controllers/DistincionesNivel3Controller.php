<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Distincion2;
use App\Distincion3;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class DistincionesNivel3Controller extends Controller
{
    public function ListarDistincion3(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '' ) {
            $distincion3 = DB::table('nivel3_distinciones as pd3')
            ->join('nivel2_distinciones as pd2','pd3.dist2_cod','pd2.id')
            ->join('nivel1_distinciones as pd1','pd1.id','pd2.dist1_cod')
            ->select('pd3.id as id',
                    'pd3.dist2_cod as dist2_cod',
                    'pd3.descripcion as descripcion',
                    'pd3.asignacion as clasificacion',
                    'pd3.puntaje as puntaje',
                    'pd3.observacion as observacion',
                    'pd3.estado as estado',
                    'pd2.id as id_dist2',
                    'pd2.descripcion as dest2_descripcion',
                    'pd1.descripcion as institucion'
                    )
            ->orderBy('pd1.descripcion','asc')
            ->orderBy('pd2.descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'institucion'){
            $distincion3 = DB::table('nivel3_distinciones as pd3')
            ->join('nivel2_distinciones as pd2','pd3.dist2_cod','pd2.id')
            ->join('nivel1_distinciones as pd1','pd1.id','pd2.dist1_cod')
            ->select('pd3.id as id',
                    'pd3.dist2_cod as dist2_cod',
                    'pd3.descripcion as descripcion',
                    'pd3.puntaje as puntaje',
                    'pd3.observacion as observacion',
                    'pd3.estado as estado',
                    'pd2.id as id_dist2',
                    'pd2.descripcion as dest2_descripcion',
                    'pd1.descripcion as institucion'
                    )
            ->where('pd1.descripcion','like','%'.$buscar.'%')
            ->orderBy('pd1.descripcion','asc')
            ->orderBy('pd2.descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'descripcion'){
            $distincion3 = DB::table('nivel3_distinciones as pd3')
            ->join('nivel2_distinciones as pd2','pd3.dist2_cod','pd2.id')
            ->join('nivel1_distinciones as pd1','pd1.id','pd2.dist1_cod')
            ->select('pd3.id as id',
                    'pd3.dist2_cod as dist2_cod',
                    'pd3.descripcion as descripcion',
                    'pd3.puntaje as puntaje',
                    'pd3.observacion as observacion',
                    'pd3.estado as estado',
                    'pd2.id as id_dist2',
                    'pd2.descripcion as dest2_descripcion',
                    'pd1.descripcion as institucion'
                    )
            ->where('pd2.descripcion','like','%'.$buscar.'%')
            ->orderBy('pd1.descripcion','asc')
            ->orderBy('pd2.descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'distintivo'){
            $distincion3 = DB::table('nivel3_distinciones as pd3')
            ->join('nivel2_distinciones as pd2','pd3.dist2_cod','pd2.id')
            ->join('nivel1_distinciones as pd1','pd1.id','pd2.dist1_cod')
            ->select('pd3.id as id',
                    'pd3.dist2_cod as dist2_cod',
                    'pd3.descripcion as descripcion',
                    'pd3.puntaje as puntaje',
                    'pd3.observacion as observacion',
                    'pd3.estado as estado',
                    'pd2.id as id_dist2',
                    'pd2.descripcion as dest2_descripcion',
                    'pd1.descripcion as institucion'
                    )
            ->where('pd3.descripcion','like','%'.$buscar.'%')
            ->orderBy('pd1.descripcion','asc')
            ->orderBy('pd2.descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'observacion'){
            $distincion3 = DB::table('nivel3_distinciones as pd3')
            ->join('nivel2_distinciones as pd2','pd3.dist2_cod','pd2.id')
            ->join('nivel1_distinciones as pd1','pd1.id','pd2.dist1_cod')
            ->select('pd3.id as id',
                    'pd3.dist2_cod as dist2_cod',
                    'pd3.descripcion as descripcion',
                    'pd3.puntaje as puntaje',
                    'pd3.observacion as observacion',
                    'pd3.estado as estado',
                    'pd2.id as id_dist2',
                    'pd2.descripcion as dest2_descripcion',
                    'pd1.descripcion as institucion'
                    )
            ->where('pd3.observacion','like','%'.$buscar.'%')
            ->orderBy('pd1.descripcion','asc')
            ->orderBy('pd2.descripcion','asc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $distincion3->total(),
                'current_page'  => $distincion3->currentPage(),
                'per_page'      => $distincion3->perPage(),
                'last_page'     => $distincion3->lastPage(),
                'from'          => $distincion3->firstItem(),
                'to'            => $distincion3->lastItem(),
            
            ],
            'distincion3' => $distincion3
        ];
    }

    public function DesactivarDistincion3(Request $request)
    {
        $distincion3 = Distincion3::Where('id',$request->id)->first(); 
        $distincion3->update([
            'estado' => '0', 
        ]);
        return response()->json($distincion3); 
    }

    public function ActivarDistincion3(Request $request)
    {
        $distincion3 = Distincion3::Where('id',$request->id)->first();
        $distincion3->update([
            'estado' => '1', 
        ]);
        return response()->json($distincion3); 
    }

    public function listarDist2()
    {
        $dist2 = DB::table('nivel2_distinciones')
                    ->select('id as id','descripcion as desc')
                    ->get();

        return response()->json($dist2);
    }

    public function RegistrarDistincion3(Request $request)
    {
        $distincion3 = Distincion3::create([
            'dist2_cod' => $request->dist2_cod,
            'descripcion' => $request->descripcion, 
            'puntaje' => $request->puntaje, 
            'asignacion' => $request->clasificacion,
            'area' => '1',
            'observacion' => $request->observacion, 
            'estado' => '1', 
        ]);
        return response()->json($distincion3);
    }

    public function ActualizarDistincion3(Request $request)
    {
        $distincion3 = DB::table('nivel3_distinciones')
              ->where('id', $request->id_dist3)
              ->update([
                    'dist2_cod' => $request->tipo_dist,
                    'descripcion' => $request->distincion,
                    'puntaje' => $request->puntaje,
                    'asignacion' => $request->asignacion,
                    'area' => '1',
                    'observacion' => $request->observacion
              ]);

        return response()->json($distincion3);
        
    }

    public function DistincionesNivel3PDF(Request $request)
    {
        $distincionesNivel3 = DB::table('nivel3_distinciones as pd3')
            ->join('nivel2_distinciones as pd2','pd3.dist2_cod','pd2.id')
            ->join('nivel1_distinciones as pd1','pd1.id','pd2.dist1_cod')
            ->select('pd1.descripcion as institucion',
                    'pd2.descripcion as tipo_distincion',
                    'pd2.distintivo as distintivo',
                    'pd3.descripcion as descripcion',
                    'pd3.puntaje as puntaje',
                    'pd3.observacion as observacion',
                    'pd3.estado as estado'
                    )
            ->where('pd3.estado',1)
            ->orderBy('pd1.descripcion','asc')
            ->orderBy('pd2.descripcion','asc')
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
        $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
        $reporte = 'DISTINCIONES NIVEL 3';

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("FECHA DE EMISION: $date\n REPORTE: $reporte");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.DistincionNivel3',['distincionesNivel3'=>$distincionesNivel3,'codigo'=>$codigo,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('DistincionesNivel3.pdf');

    }
}
