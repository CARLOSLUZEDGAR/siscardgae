<?php

namespace App\Http\Controllers;

use App\PersonalCargo;
use App\PersonalDestinos;
use App\PersonalDistincion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class PremiosDistincionesController extends Controller
{
    public function index(Request $request)
    {
        $per_codigo = $request->per_codigo;

        if($per_codigo==''){
            $personal_premios = DB::table("personal_distinciones")
            ->orderBy('personal_distinciones.id','desc')
            ->paginate(10);     
        }
        else
        {
            $personal_premios = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->select('pd.id as id',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd.estado as estado',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno'
                    )
            ->where('pd.per_codigo', '=', $per_codigo)
            ->orderBy('pd.fecha_distincion','asc')
            ->paginate(10);
        }

        return [
            'pagination' => [
                'total'          => $personal_premios->total(),
                'current_page'   => $personal_premios->currentPage(),
                'per_page'       => $personal_premios->perPage(),
                'last_page'      => $personal_premios->lastPage(),
                'from'           => $personal_premios->firstItem(),
                'to'             => $personal_premios->lastItem(),
            ],
            'premio' => $personal_premios
        ];
    }

    public function ActualizarDistincion(Request $request)
    {
        $distincion = DB::table('personal_distinciones')
              ->where('id', $request->id_dist)
              ->update([
                    'ndoc' => $request->nro_doc,
                    'tipodoc' => $request->tipo_doc,
                    'fecha_distincion' => $request->fecha_distincion,
                    'pais_cod' => $request->pais,
                    'dist1_cod' => $request->dist1,
                    'dist2_cod' => $request->dist2,
                    'dist3_cod' => $request->dist3,
                    'descripcion' => $request->descripcion,
              ]);

        return response()->json($distincion);
        
    }

    public function SelectInstitucion(Request $request){
        $institucion = DB::table('nivel1_distinciones')
        ->select('id','descripcion')
        ->where('estado',1)
        ->orderBy('descripcion','asc')->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado

        return ['institucion' => $institucion]; //mandamos todo el listado en la variable listado
    }

    public function selectDistincion2(Request $request){
        $buscar = $request->buscar;
        $distincion2 = DB::table('nivel2_distinciones')
        ->select('id','descripcion')
        ->where('dist1_cod','=',$buscar)
        ->where('estado',1)
        ->orderBy('descripcion','asc')->get();
        return ['distincion2' => $distincion2];
    }

    public function selectDistincion3(Request $request){
        $buscar = $request->buscar;
        $distincion3 = DB::table('nivel3_distinciones')
        ->select('id','descripcion')
        ->where('dist2_cod','=',$buscar)
        ->where('estado',1)
        
        ->orderBy('descripcion','asc')->get();
        return ['distincion3' => $distincion3];
    }

    public function RegistrarDistincion(Request $request)
    {
        $date = date('y');
        $nro = $request->nro_doc;
        $numero = $nro.'/'.$date;
        
        $distincion = PersonalDistincion::create([
            'per_codigo' => $request->per_codigo,
            'ndoc' => $numero,
            'tipodoc' => $request->tipo_doc,
            'descripcion' => $request->descripcion,
            'fecha_distincion' => $request->fecha_distincion,
            'pais_cod' => $request->pais,
            'dist1_cod' => $request->id_distincion1,
            'dist2_cod' => $request->id_distincion2,
            'dist3_cod' => $request->id_distincion3,
            'estado' => $request->estado
        ]);
       
    }

    public function DistincionesPdf(Request $request)
    {
        $per_codigo = $request->per_codigo;

        $personal_premios = DB::table("personal_distinciones as pd")
            ->join('nivel1_distinciones as pd1','pd.dist1_cod','pd1.id')
            ->join('nivel2_distinciones as pd2','pd.dist2_cod','pd2.id')
            ->join('nivel3_distinciones as pd3','pd.dist3_cod','pd3.id')
            ->join('paises as pais','pd.pais_cod','pais.id')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->select('pd.id as id_distincion',
                    'pd.ndoc as nro_doc',
                    'pd.tipodoc as tipo_doc',
                    'pd.descripcion as descripcion',
                    'pd.fecha_distincion as fecha_distincion',
                    'pd1.descripcion as descripcion1',
                    'pd1.id as dist1_id',
                    'pd2.descripcion as descripcion2',
                    'pd2.id as dist2_id',
                    'pd3.descripcion as descripcion3',
                    'pd3.id as dist3_id',
                    'pais.nombre as pais',
                    'pais.id as id_pais',
                    'p.per_nombre as nombre',
                    'p.per_codigo as per_codigo',
                    'p.per_paterno as paterno',
                    'p.per_materno as materno'
                    )
            ->where('pd.per_codigo', '=', $per_codigo)
            ->where('pd.estado',1)
            ->orderBy('pd.id','desc')
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

            $personal = DB::table('personals')
            ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
            ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
            ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
            ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
            ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
            ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
            ->select('personals.per_codigo',
                    'personals.per_paterno',
                    'personals.per_materno',
                    'personals.per_nombre',
                    'personals.per_sexo',
                    'personals.per_ci',
                    'personals.per_expedido',
                    'personals.per_cm',
                    'personals.per_foto',
                    'grados.abreviatura as gra_abreviatura',
                    'estudios.abreviatura as estu_abreviatura',
                    'personal_escalafones.estado as escperestado',
                    'personal_estudios.id as estperestado')
            ->where('personals.per_codigo',$per_codigo)
            ->where('personal_escalafones.estado',1)
            ->where('personal_estudios.estado',1)
            ->first();

            $datosQr = $personal->gra_abreviatura.' '.$personal->estu_abreviatura.' '.$personal->per_nombre.' '.$personal->per_paterno.' '.$personal->per_materno;
            $c_militar = $personal->per_cm;
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;

        $qr = QrCode::size(100)->margin(0)/*->merge('../public/assets/img/qr.png')*/->generate("NOMBRE: $datosQr\n FECHA DE EMISION: $date\n C. MILITAR: $c_militar");
           $codigo = $qr;

        $pdf = PDF::loadView('reportes.PersonalPremiosDistinciones',['personal_premios'=>$personal_premios,'codigo'=>$codigo,'personal'=>$personal,'jefe_dpto'=>$jefe_dpto])
        //->setPaper('letter', 'landscape');
        ->setPaper('letter', 'portrait');
        return $pdf->stream('PersonalDistinciones.pdf');

    }

    public function DesactivarDistincion(Request $request)
    {
        $distincion = PersonalDistincion::Where('id',$request->id)->first(); 
        $distincion->update([
            'estado' => '0', 
        ]);
        return response()->json($distincion); 
    }

    public function ActivarDistincion(Request $request)
    {
        $distincion = PersonalDistincion::Where('id',$request->id)->first();
        $distincion->update([
            'estado' => '1', 
        ]);
        return response()->json($distincion); 
    }
}


