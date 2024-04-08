<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PersonalRevistas;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class RevistasController extends Controller
{
    public function ListarPersonalx(Request $request)
    {

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $personal = [];

        if ($buscar == "") {


        $personal = DB::table('personals as p')
            ->join('personal_escalafones as escaper','p.per_codigo','escaper.per_codigo')
            ->join('grados as g','escaper.gra_cod','g.id')
            ->join('personal_estudios as estuper','p.per_codigo','estuper.per_codigo')
            ->join('estudios as e','estuper.est_cod','e.id')
            ->join('subescalafones as se','escaper.subesc_cod','se.id')
            ->join('personal_situaciones as ps','p.per_codigo','ps.per_codigo')
            ->select('g.id as gid','g.abreviatura as grado','p.per_codigo','p.per_nombre','p.per_paterno','p.per_materno',
                     'p.per_fecha_nacimiento','p.per_ci','p.per_estado_civil','p.per_sexo','p.per_expedido',
                     'p.per_telefono','p.per_celular','p.per_mail','p.per_cm',
                     'p.per_promo','e.abreviatura as complemento')

            ->where('estuper.estado','1')
            ->where('escaper.estado','1')
            ->whereIn('ps.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
            ->where('g.fuerza', 'FAB')
            ->where('ps.estado',1)
            ->orderBy('escaper.esca_cod')
            ->orderBy('se.orden')
            ->orderBy('g.orden')
            ->paginate(10);



        }

        else{

            $personal = DB::table('personals as p')
            ->join('personal_escalafones as escaper','p.per_codigo','escaper.per_codigo')
            ->join('grados as g','escaper.gra_cod','g.id')
            ->join('personal_estudios as estuper','p.per_codigo','estuper.per_codigo')
            ->join('estudios as e','estuper.est_cod','e.id')
            ->join('subescalafones as se','escaper.subesc_cod','se.id')
            ->join('personal_situaciones as ps','p.per_codigo','ps.per_codigo')
            ->select('g.id as gid','g.abreviatura as grado','p.per_codigo','p.per_nombre','p.per_paterno','p.per_materno',
                     'p.per_fecha_nacimiento','p.per_ci','p.per_estado_civil','p.per_sexo','p.per_expedido',
                     'p.per_telefono','p.per_celular','p.per_mail','p.per_cm',
                     'p.per_promo','e.abreviatura as complemento')

            ->where($criterio,'like','%'.$buscar.'%')
            ->where('estuper.estado','1')
            ->where('escaper.estado','1')
            ->whereIn('ps.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
            ->where('g.fuerza', 'FAB')
            ->where('ps.estado',1)
            ->orderBy('escaper.esca_cod')
            ->orderBy('se.orden')
            ->orderBy('g.orden')
            ->paginate(10);

        }

        return response()->json([
            'pagination' => [
                'total'         => $personal->total(),
                'current_page'  => $personal->currentPage(),
                'per_page'      => $personal->perPage(),
                'last_page'     => $personal->lastPage(),
                'from'          => $personal->firstItem(),
                'to'            => $personal->lastItem(),
            ],
            'personal'          => $personal
            ]);

    }


    public function listar(Request $request)
    {
        $pcod=$request->dato;

        $per = DB::table('personal_revistas as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            ->select('ep.id as idpr', 'ep.per_codigo', 'ep.cod_rev', 'ep.lugar', 'ep.compania',
                     'ep.nro_doc','ep.fecha','ep.delegado_revistante','ep.funcion',
                     'ep.observacion', 'ep.estado')
            //->limit(10)

            ->where('ep.per_codigo',$pcod)
            ->get();

        return response()->json($per);
    }

    public function DatosPersonales(Request $request)
    {
        $percodigo = $request->percodigo;
        $datos = DB::table('personal_escalafones as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            ->join('grados as g','ep.gra_cod','g.id')
            ->join('personal_estudios as epe','p.per_codigo','epe.per_codigo')
            ->join('estudios as e','epe.est_cod','e.id')
            ->select('p.per_codigo as codigo','p.per_nombre as nombre','p.per_paterno as paterno',
            'p.per_materno as materno','g.abreviatura as grado','e.abreviatura as complemento', 'p.per_ci as ci', 'p.per_expedido  as expedido', 'p.per_cm as cm','p.per_foto as foto')
            ->where('ep.per_codigo',$percodigo)
            ->where('ep.estado',1)
            ->where('epe.estado',1)
            ->first();

            return response()->json($datos);
    }

    public function Revistante()
    {
        $personal = DB::table('personals as p')
            ->join('personal_escalafones as escaper','p.per_codigo','escaper.per_codigo')
            ->join('grados as g','escaper.gra_cod','g.id')
            ->join('personal_estudios as estuper','p.per_codigo','estuper.per_codigo')
            ->join('estudios as e','estuper.est_cod','e.id')
            ->join('subescalafones as se','escaper.subesc_cod','se.id')
            ->join('personal_situaciones as ps','p.per_codigo','ps.per_codigo')
            ->select('g.id as gid','g.abreviatura as grado','p.per_codigo','p.per_nombre','p.per_paterno','p.per_materno',
                     'p.per_fecha_nacimiento','p.per_ci','p.per_estado_civil','p.per_sexo','p.per_expedido',
                     'p.per_telefono','p.per_celular','p.per_mail','p.per_cm',
                     'p.per_promo','e.abreviatura as complemento')

            ->where('estuper.estado','1')
            ->where('escaper.estado','1')
            ->whereIn('ps.detsit_cod',[1,2,4,5,8,9,11,13,14,16,17,29,30,31,32,33])
            ->whereIn('escaper.gra_cod',[4,5,6])
            ->where('g.fuerza', 'FAB')
            ->where('ps.estado',1)
            ->orderBy('escaper.esca_cod')
            ->orderBy('se.orden')
            ->orderBy('g.orden')
            ->get();
            $data = [];
            foreach ($personal as $key => $value) {
                $data[$key] = [
                    'nombre'=> $value->grado.' '.$value->complemento.' '.$value->per_nombre.' '.$value->per_paterno.' '.$value->per_materno,
                    'id'=> $value->per_codigo
                ];

            }

            return response()->json($data);

    }

    public function NuevaRevista(Request $request)
    {

      $revista = PersonalRevistas::create([

            'per_codigo' => $request->per,
            'cod_rev' => $request -> c,
            'lugar' => $request -> l,
            'compania' => $request -> com,
            'nro_doc'=> $request ->nm,
            'fecha' => $request -> fr,
            'delegado_revistante'=> $request -> dr,
            'funcion'=> $request -> f,
            'observacion' => $request -> ob,
            'estado'=> '1',
            'sysuser'=>'jChejo'




       ]);

        return $revista;
    }

    public function EditarRevista(Request $request)
    {

        $revista = DB::table('personal_revistas')
              ->where('id', $request->id)
              ->update([
                'per_codigo' => $request->per,
                'cod_rev' => $request ->c,
                'lugar' => $request ->l,
                'compania' => $request ->com,
                'nro_doc'=> $request ->nm,
                'fecha' => $request ->fr,
                'delegado_revistante'=> $request ->dr,
                'funcion'=> $request ->f,
                'observacion' => $request ->ob,
                'estado'=> '1',
                'sysuser'=>'jChejo'
              ]);

        //return request();
       return response()->json($request);
    }

    public function EliminarRevista(Request $request)
    {
      $revista = PersonalRevistas::where('per_codigo', $request->per)
                                  ->first();
        $revista->delete();
    }

    public function cambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $revista = DB::table('personal_revistas')
                    ->where('id', $request->idpr);

        $revista->delete();
    }

    public function mostrarReporteDestino(Request $request)
    {
        $id=$request->id;

        $revistapersonal = DB::table('personal_revistas as ep')
                            ->join('personals as p','ep.per_codigo','p.per_codigo')
                            ->where('ep.per_codigo',$id)
                            ->get();

        $nombrepersona = DB::table('personals as p')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as grado','e.abreviatura as complemento','p.per_ci',
                                    'p.per_nombre','p.per_paterno','p.per_materno','p.per_cm','p.per_sexo','p.per_expedido')
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('esc.nombre','=','ARMAS')
                            ->where('p.per_codigo',$id)
                            ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO III OPERACIONES - EMGFAB GENERA REPORTE DE: $nombrepersona->grado $nombrepersona->complemento $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido\nFECHA:$fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('pdfrevista.revistapdf',['revistapersonal' => $revistapersonal, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])
                    ->setPaper('letter','Portrait');
                    setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('revistapersonal.pdf');
    }

    public function mostrarReporteDestino2(Request $request)
    {
        $id=$request->id;

        $revistapersonal = DB::table('personal_revistas as ep')
                            ->join('personals as p','ep.per_codigo','p.per_codigo')
                            ->where('ep.per_codigo',$id)
                            ->get();

        $nombrepersona = DB::table('personals as p')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as grado','e.abreviatura as complemento','p.per_ci',
                                    'p.per_nombre','p.per_paterno','p.per_materno','p.per_cm','p.per_sexo','p.per_expedido')
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('esc.nombre','=','ARMAS')
                            ->where('p.per_codigo',$id)
                            ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO III OPERACIONES - EMGFAB GENERA REPORTE DE: $nombrepersona->grado $nombrepersona->complemento $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido\nFECHA:$fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('pdfrevista.revistapdf2',['revistapersonal' => $revistapersonal, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])
                    ->setPaper('letter','Portrait');
                    setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('revistapersonal2.pdf');
    }

    public function listarPdf(Request $request)
    {
        $pcod=$request->dato;

        $per = DB::table('personal_revistas as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            //->limit(10)

            ->where('ep.per_codigo',$pcod)
            ->get();

        $pdf = PDF::loadView('pdf.revistaspdf', ['per'=>$per]);
        return $pdf->download('revistaspdf');
    }

    public function listarPdf2(Request $request)
    {
        $pcod=$request->dato;

        $per = DB::table('personal_revistas as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            //->limit(10)

            ->where('ep.per_codigo',$pcod)
            ->get();

        $pdf = PDF::loadView('pdf.revistaspdf', ['per'=>$per]);
        return $pdf->download('revistaspdf2');
    }

    public function generarRangofechasR(Request $request)
    {
        $inicio = $request->inicio;
        $fin = $request->fin;
        $id=$request->id;


        $personal = DB::table('personals as p')
                        ->join('personal_escalafones as escaper','p.per_codigo','escaper.per_codigo')
                        ->join('grados as g','escaper.gra_cod','g.id')
                        ->join('personal_estudios as estuper','p.per_codigo','estuper.per_codigo')
                        ->join('estudios as e','estuper.est_cod','e.id')
                        ->select('g.abreviatura as grado','p.per_codigo','p.per_nombre','p.per_paterno','p.per_materno',
                                'p.per_fecha_nacimiento','p.per_ci','p.per_estado_civil','p.per_sexo','p.per_expedido',
                                'p.per_cm',
                                'p.per_promo','e.abreviatura as complemento')
                        ->where('estuper.estado','=','1')
                        ->where('escaper.estado','=','1')
                        ->where('p.per_codigo', $id)
                        ->orderBy('p.per_codigo','asc')
                        ->get();

        $datosQr =  DB::table('personals as p')
                        ->join('personal_escalafones as escaper','p.per_codigo','escaper.per_codigo')
                        ->join('grados as g','escaper.gra_cod','g.id')
                        ->join('personal_estudios as estuper','p.per_codigo','estuper.per_codigo')
                        ->join('estudios as e','estuper.est_cod','e.id')
                        ->select('g.abreviatura as grado','p.per_codigo','p.per_nombre','p.per_paterno','p.per_materno',
                                'p.per_fecha_nacimiento','p.per_ci','p.per_estado_civil','p.per_sexo','p.per_expedido',
                                'p.per_cm',
                                'p.per_promo','e.abreviatura as complemento')
                        ->where('estuper.estado','=','1')
                        ->where('escaper.estado','=','1')
                        ->where('p.per_codigo', $id)
                        ->orderBy('p.per_codigo','asc')
                        ->get();

        $revistapersonal = DB::table('personal_revistas as ep')
                            ->join('personals as p','ep.per_codigo','p.per_codigo')
                            ->where('ep.estado', 1)
                            ->where('ep.per_codigo',$id)
                            ->whereBetween('ep.fecha', [$inicio,$fin])
                            ->get();

        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO III OPERACIONES - EMGFAB");
        $qrband = $Qr;

        $pdf = PDF::loadView('pdfrevista.rangofechasRevistas',['personal' => $personal,'revistapersonal' => $revistapersonal, 'inicio' => $inicio, 'fin' => $fin], ['qrband' => $qrband]);
        //->setPaper('letter','portrait');
        setlocale(LC_ALL, 'es_ES');
        return $pdf->stream('rangofechasRevistas.pdf');
    }

    public function listarPdfR(Request $request)
    {
        $pcod=$request->dato;

        $per = DB::table('personal_revistas as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            //->limit(10)

            ->where('ep.per_codigo',$pcod)
            ->get();

        $pdf = PDF::loadView('pdf.rangofechasRevistas', ['per'=>$per]);
        return $pdf->download('rangofechasRevistas');
    }

    public function CertRev(Request $request)
    {
        $id=$request->id;

        $revistapersonal = DB::table('personal_revistas as ep')
                            ->join('personals as p','ep.per_codigo','p.per_codigo')
                            ->where('ep.per_codigo',$id)
                            ->get();

        $nombrepersona = DB::table('personals as p')
                            ->join('personal_escalafones as escap','p.per_codigo','escap.per_codigo')
                            ->join('grados as g','escap.gra_cod','g.id')
                            ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                            ->join('estudios as e','estp.est_cod','e.id')
                            ->join('escalafones as esc','escap.esca_cod','esc.id')
                            ->select('g.abreviatura as grado','e.abreviatura as complemento','p.per_ci',
                                    'p.per_nombre','p.per_paterno','p.per_materno','p.per_cm','p.per_sexo','p.per_expedido','p.per_foto')
                            ->where('escap.estado','1')
                            ->where('estp.estado','1')
                            ->where('esc.nombre','=','ARMAS')
                            ->where('p.per_codigo',$id)
                            ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $Qr = QrCode::encoding('UTF-8')->size(100)->generate("DEPARTAMENTO III OPERACIONES - EMGFAB GENERA REPORTE DE: $nombrepersona->grado $nombrepersona->complemento $nombrepersona->per_nombre $nombrepersona->per_paterno $nombrepersona->per_materno C.M.: $nombrepersona->per_cm\nC.I.: $nombrepersona->per_ci $nombrepersona->per_expedido\nFECHA:$fecha_emision");
        $qrband = $Qr;
        $pdf = PDF::loadView('pdfrevista.certificado',['revistapersonal' => $revistapersonal, 'nombrepersona' => $nombrepersona],['qrband' => $qrband])
                    ->setPaper('letter','Portrait');
                    setlocale(LC_ALL, 'es_ES');

        return $pdf->stream('certificado.pdf');
    }

    public function listarCert(Request $request)
    {
        $pcod=$request->dato;

        $per = DB::table('personal_revistas as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            //->limit(10)

            ->where('ep.per_codigo',$pcod)
            ->get();

        $pdf = PDF::loadView('pdf.certificado', ['per'=>$per]);
        return $pdf->download('certificado');
    }




}
