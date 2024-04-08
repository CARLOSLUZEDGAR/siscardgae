<?php

namespace App\Http\Controllers;

use App\PersonalCursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalCursosController extends Controller
{
    public function DatosPersonales(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $datos  =    DB::table('personals as p')
                        ->join('personal_escalafones as peresca','p.per_codigo','peresca.per_codigo')
                        ->join('grados as g','peresca.gra_cod','g.id')
                        ->join('personal_estudios as estp','p.per_codigo','estp.per_codigo')
                        ->join('estudios as e','estp.est_cod','e.id')
                        ->join('escalafones as esc','peresca.esca_cod','esc.id')
                        ->select('g.abreviatura as grado','e.abreviatura as complemento','p.per_codigo','p.per_nombre as nombre',
                                'p.per_paterno as paterno','p.per_materno as materno','p.per_sexo','p.per_expedido','p.per_foto as foto',
                                'p.per_fecha_nacimiento','p.per_estado_civil','p.per_ci as ci','p.per_telefono','p.per_celular',
                                'p.per_mail','p.per_cm as cm','p.per_promo','peresca.subesc_cod as subescalafon')
                        ->where('peresca.per_codigo',$per_codigo)
                        ->where('peresca.estado',1)
                        ->where('estp.estado',1)
                        ->first();

        return response()->json($datos);
    }

    public function listadoCursos(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $id = $request->id;
        $personal_cursos = DB::table('personal_cursos as pc')
                                ->join('personals as p','pc.per_codigo','p.per_codigo')
                                ->join('cursos as c','pc.cur_cod','c.id')
                                ->join('tipo_cursos as tc','pc.tipcur_cod','tc.id')
                                ->join('desgloce_cursos as dc','pc.desgcur_cod','dc.id')
                                ->join('emisores as e','pc.emi_cod','e.id')
                                ->join('tipo_emisores as te','pc.tipemi_cod','te.id')
                                ->select('pc.id as idPerCur','c.id as idcourse','c.descripcion as nombrecurso',
                                        'tc.id as idtypcourse','tc.descripcion as tipocurso',
                                        'dc.id as iddesgcourse','dc.descripcion as desglocurso',
                                        'e.id as idemisor','e.descripcion as nombreemisor',
                                        'te.id as idtypemisor','te.descripcion as tipoemisor',
                                        'pc.descripcion','pc.fec_inicio','pc.fec_final',
                                        'pc.lugar','pc.documento','pc.fecha_otorgacion','pc.nro_doc','pc.posicion',
                                        'pc.costo','pc.observacion','pc.estado','pc.cur_cod','pc.tipcur_cod',
                                        'pc.desgcur_cod','pc.emi_cod','pc.tipemi_cod','pc.per_codigo','pc.periodo','pc.antiguedad')
                                ->where('pc.per_codigo',$id)
                                ->orderBy('pc.fecha_otorgacion','desc')
                                ->paginate(10);
        return [
            'pagination' => [
                'total'         =>  $personal_cursos->total(),
                'current_page'  =>  $personal_cursos->currentPage(),
                'per_page'      =>  $personal_cursos->perPage(),
                'last_page'     =>  $personal_cursos->lastPage(),
                'from'          =>  $personal_cursos->firstItem(),
                'to'            =>  $personal_cursos->lastItem(),
            ],
            'personal_cursos'   =>  $personal_cursos
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $personal_cursos                    =   new PersonalCursos();

        $personal_cursos->per_codigo        =   $request->per_codigo;
        $personal_cursos->cur_cod           =   $request->cur_cod;
        $personal_cursos->tipcur_cod        =   $request->tipcur_cod;
        $personal_cursos->desgcur_cod       =   $request->desglo_cod;
        $personal_cursos->emi_cod           =   $request->emi_cod;
        $personal_cursos->tipemi_cod        =   $request->tipemi_cod;
        $personal_cursos->descripcion       =   $request->descripcion;
        $personal_cursos->fec_inicio        =   $request->fec_inicio;
        $personal_cursos->fec_final         =   $request->fec_final;
        $personal_cursos->lugar             =   $request->lugar;
        $personal_cursos->documento         =   $request->documento;
        $personal_cursos->fecha_otorgacion  =   $request->fecha_otorgacion;
        $personal_cursos->nro_doc           =   $request->nro_doc;
        $personal_cursos->periodo           =   $request->periodo;
        $personal_cursos->antiguedad        =   $request->antiguedad;
        $personal_cursos->posicion          =  '0';

        $val = $request->costo;

        if($val == ''){
            $val = 0;
        }
        else{
            $val = $request->costo;
        }

        $personal_cursos->costo             =   $val;

        $val2 = $request->observacion;

        if($val2 == ''){
            $val2 = 'NINGUNA';
        }
        else{
            $val2 = $request->observacion;
        }

        $personal_cursos->observacion       =   $request->val2;
        $personal_cursos->estado            =   1;
        $personal_cursos->sysuser           =   Auth::user()->id;

        $personal_cursos->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $personal_cursos                    =   PersonalCursos::findOrFail($request->id);

        $personal_cursos->per_codigo        =   $request->per_codigo;
        $personal_cursos->cur_cod           =   $request->cur_cod;
        $personal_cursos->tipcur_cod        =   $request->tipcur_cod;
        $personal_cursos->desgcur_cod       =   $request->desglo_cod;
        $personal_cursos->emi_cod           =   $request->emi_cod;
        $personal_cursos->tipemi_cod        =   $request->tipemi_cod;
        $personal_cursos->descripcion       =   $request->descripcion;
        $personal_cursos->fec_inicio        =   $request->fec_inicio;
        $personal_cursos->fec_final         =   $request->fec_final;
        $personal_cursos->lugar             =   $request->lugar;
        $personal_cursos->documento         =   $request->documento;
        $personal_cursos->fecha_otorgacion  =   $request->fecha_otorgacion;
        $personal_cursos->nro_doc           =   $request->nro_doc;
        $personal_cursos->periodo           =   $request->periodo;
        $personal_cursos->antiguedad        =   $request->antiguedad;
        $personal_cursos->posicion          =  '0';

        $val = $request->costo;

        if($val == ''){
            $val = 0;
        }
        else{
            $val = $request->costo;
        }

        $personal_cursos->costo             =   $val;

        $val2 = $request->observacion;

        if($val2 == ''){
            $val2 = 'NINGUNA';
        }
        else{
            $val2 = $request->observacion;
        }

        $personal_cursos->observacion       =   $val2;
        $personal_cursos->estado            =   1;
        $personal_cursos->sysuser           =   Auth::user()->id;

        $personal_cursos->save();
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $personal_cursos         = PersonalCursos::findOrFail($request->pc);
        $personal_cursos->estado = $request->estado;

        $personal_cursos->save();
    }
}
