<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Distincion1;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class DistincionesNivel1Controller extends Controller
{
    public function ListarDistincion1(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '' ) {
            $distincion1 = DB::table('nivel1_distinciones')
            ->orderBy('descripcion','asc')
            ->paginate(10);
        }
        else{
            $distincion1 = DB::table('nivel1_distinciones')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('descripcion','asc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $distincion1->total(),
                'current_page'  => $distincion1->currentPage(),
                'per_page'      => $distincion1->perPage(),
                'last_page'     => $distincion1->lastPage(),
                'from'          => $distincion1->firstItem(),
                'to'            => $distincion1->lastItem(),
            
            ],
            'distincion1' => $distincion1
        ];
    }

    public function DesactivarDistincion1(Request $request)
    {
        $distincion1 = Distincion1::Where('id',$request->id)->first(); 
        $distincion1->update([
            'estado' => '0', 
        ]);
        return response()->json($distincion1); 
    }

    public function ActivarDistincion1(Request $request)
    {
        $distincion1 = Distincion1::Where('id',$request->id)->first();
        $distincion1->update([
            'estado' => '1', 
        ]);
        return response()->json($distincion1); 
    }

    public function RegistrarDistincion1(Request $request)
    {
        $distincion1 = Distincion1::create([
            'descripcion' => $request->descripcion,
            'observacion' => $request->observacion, 
            'estado' => '1', 
        ]);
        return response()->json($distincion1);
    }

    public function ActualizarDistincion1(Request $request)
    {
        $distincion1 = DB::table('nivel1_distinciones')
              ->where('id', $request->id_dist1)
              ->update([
                    'descripcion' => $request->des,
                    'observacion' => $request->obs,
              ]);

        return response()->json($distincion1);
        
    }

    public function DistincionesNivel1PDF(Request $request)
    {
        $distincionesNivel1 = DB::table("nivel1_distinciones as pd1")
            ->select('pd1.descripcion as descripcion',
                    'pd1.observacion as observacion',
                    'pd1.estado as estado'
                    )
            ->where('pd1.estado',1)
            ->orderBy('pd1.descripcion','desc')
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
        $reporte = 'DISTINCIONES NIVEL 1';

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("FECHA DE EMISION: $date\n REPORTE: $reporte");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.DistincionNivel1',['distincionesNivel1'=>$distincionesNivel1,'codigo'=>$codigo,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('DistincionesNivel1.pdf');

    }
}
