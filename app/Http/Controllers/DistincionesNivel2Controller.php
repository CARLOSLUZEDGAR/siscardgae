<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Distincion2;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class DistincionesNivel2Controller extends Controller
{
    public function ListarDistincion2(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '' ) {
            $distincion2 = DB::table('nivel2_distinciones as pd2')
            ->join('nivel1_distinciones as pd1','pd2.dist1_cod','pd1.id')
            ->select('pd2.id as id',
                    'pd2.dist1_cod as dist1_cod',
                    'pd2.descripcion as dest2_descripcion',
                    'pd2.distintivo as distintivo',
                    'pd2.observacion as observacion',
                    'pd2.estado as estado',
                    'pd1.id as id_dist1',
                    'pd1.descripcion as dest1_descripcion'
                    )
            ->orderBy('dest1_descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'descripcion'){
            $distincion2 = DB::table('nivel2_distinciones as pd2')
            ->join('nivel1_distinciones as pd1','pd2.dist1_cod','pd1.id')
            ->select('pd2.id as id',
                    'pd2.dist1_cod as dist1_cod',
                    'pd2.descripcion as dest2_descripcion',
                    'pd2.distintivo as distintivo',
                    'pd2.observacion as observacion',
                    'pd2.estado as estado',
                    'pd1.id as id_dist1',
                    'pd1.descripcion as dest1_descripcion'
                    )
            ->where('pd2.descripcion','like','%'.$buscar.'%')
            ->orderBy('dest1_descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'distintivo'){
            $distincion2 = DB::table('nivel2_distinciones as pd2')
            ->join('nivel1_distinciones as pd1','pd2.dist1_cod','pd1.id')
            ->select('pd2.id as id',
                    'pd2.dist1_cod as dist1_cod',
                    'pd2.descripcion as dest2_descripcion',
                    'pd2.distintivo as distintivo',
                    'pd2.observacion as observacion',
                    'pd2.estado as estado',
                    'pd1.id as id_dist1',
                    'pd1.descripcion as dest1_descripcion'
                    )
            ->where('pd2.distintivo','like','%'.$buscar.'%')
            ->orderBy('dest1_descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'observacion'){
            $distincion2 = DB::table('nivel2_distinciones as pd2')
            ->join('nivel1_distinciones as pd1','pd2.dist1_cod','pd1.id')
            ->select('pd2.id as id',
                    'pd2.dist1_cod as dist1_cod',
                    'pd2.descripcion as dest2_descripcion',
                    'pd2.distintivo as distintivo',
                    'pd2.observacion as observacion',
                    'pd2.estado as estado',
                    'pd1.id as id_dist1',
                    'pd1.descripcion as dest1_descripcion'
                    )
            ->where('pd2.observacion','like','%'.$buscar.'%')
            ->orderBy('dest1_descripcion','asc')
            ->paginate(10);
        }
        elseif ($criterio == 'institucion'){
            $distincion2 = DB::table('nivel2_distinciones as pd2')
            ->join('nivel1_distinciones as pd1','pd2.dist1_cod','pd1.id')
            ->select('pd2.id as id',
                    'pd2.dist1_cod as dist1_cod',
                    'pd2.descripcion as dest2_descripcion',
                    'pd2.distintivo as distintivo',
                    'pd2.observacion as observacion',
                    'pd2.estado as estado',
                    'pd1.id as id_dist1',
                    'pd1.descripcion as dest1_descripcion'
                    )
            ->where('pd1.descripcion','like','%'.$buscar.'%')
            ->orderBy('dest1_descripcion','asc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $distincion2->total(),
                'current_page'  => $distincion2->currentPage(),
                'per_page'      => $distincion2->perPage(),
                'last_page'     => $distincion2->lastPage(),
                'from'          => $distincion2->firstItem(),
                'to'            => $distincion2->lastItem(),
            
            ],
            'distincion2' => $distincion2
        ];
    }

    public function DesactivarDistincion2(Request $request)
    {
        $distincion2 = Distincion2::Where('id',$request->id)->first(); 
        $distincion2->update([
            'estado' => '0', 
        ]);
        return response()->json($distincion2); 
    }

    public function ActivarDistincion2(Request $request)
    {
        $distincion2 = Distincion2::Where('id',$request->id)->first();
        $distincion2->update([
            'estado' => '1', 
        ]);
        return response()->json($distincion2); 
    }

    public function listarInstitucion()
    {
        $institucion = DB::table('nivel1_distinciones')
                    ->select('id as id','descripcion as desc')
                    ->get();

        return response()->json($institucion);
    }

    public function RegistrarDistincion2(Request $request)
    {
        $distincion2 = Distincion2::create([
            'dist1_cod' => $request->institucion,
            'descripcion' => $request->descripcion, 
            'distintivo' => $request->distincion, 
            'ord_distintivo' => '0',
            'observacion' => $request->observacion, 
            'estado' => '1', 
        ]);
        return response()->json($distincion2);
    }

    public function ActualizarDistincion2(Request $request)
    {
        $distincion2 = DB::table('nivel2_distinciones')
              ->where('id', $request->id_dist2)
              ->update([
                    'dist1_cod' => $request->institucion,
                    'descripcion' => $request->descripcion,
                    'distintivo' => $request->distincion,
                    'ord_distintivo' => '0',
                    'observacion' => $request->observacion
              ]);

        return response()->json($distincion2);
        
    }

    public function DistincionesNivel2PDF(Request $request)
    {
        $distincionesNivel2 = DB::table("nivel2_distinciones as pd2")
            ->join('nivel1_distinciones as pd1','pd2.dist1_cod','pd1.id')
            ->select('pd1.descripcion as institucion',
                    'pd2.descripcion as tipo_distincion',
                    'pd2.distintivo as distintivo',
                    'pd2.observacion as observacion',
                    'pd2.estado as estado'
                    )
            ->where('pd2.estado',1)
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
        $reporte = 'DISTINCIONES NIVEL 2';

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("FECHA DE EMISION: $date\n REPORTE: $reporte");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.DistincionNivel2',['distincionesNivel2'=>$distincionesNivel2,'codigo'=>$codigo,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('DistincionesNivel2.pdf');

    }
}
