<?php

namespace App\Http\Controllers;

use App\PersonalTribunales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalTribunalesController extends Controller
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

    public function listarTribunales(Request $request)
    {
        $id = $request->id;

        $personaltribunal = DB::table('personal_tribunales as pt')
                                ->join('personals as p','pt.per_codigo','p.per_codigo')
                                ->join('tribunales as trib','pt.tri_cod','trib.id')
                                ->select('pt.fecha','pt.tri_cod as tribunal','pt.observacion',
                                         'pt.nro_doc','pt.documento','pt.descripcion',
                                         'pt.estado','trib.descripcion as nombretribunal',
                                         'trib.puntaje','trib.clasificacion','pt.id')
                                ->orderBy('pt.id','asc')
                                ->where('pt.per_codigo',$id)
                                ->paginate(10);
        return [
            'pagination' => [
                'total'         =>  $personaltribunal->total(),
                'current_page'  =>  $personaltribunal->currentPage(),
                'per_page'      =>  $personaltribunal->perPage(),
                'last_page'     =>  $personaltribunal->lastPage(),
                'from'          =>  $personaltribunal->firstItem(),
                'to'            =>  $personaltribunal->lastItem(),
            ],
            'personaltribunal'   =>  $personaltribunal
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $personal_tribunal              =   new PersonalTribunales();

        $personal_tribunal->per_codigo  =   $request->per_codigo;
        $personal_tribunal->tri_cod     =   $request->valorTribunal;
        $personal_tribunal->documento   =   $request->valordocumento;
        $personal_tribunal->nro_doc     =   $request->nro_doc;
        $personal_tribunal->fecha       =   $request->fecha;
        $personal_tribunal->descripcion =   $request->descripcion;

        $val = $request->observacion;

        if($val == ''){
            $val = 'NINGUNA';
        }
        else{
            $val = $request->observacion;
        }

        $personal_tribunal->observacion =   $val;
        $personal_tribunal->estado      =   1;
        $personal_tribunal->sysuser     =   Auth::user()->id;

        $personal_tribunal->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $personal_tribunal              =   PersonalTribunales::findOrFail($request->id);

        $personal_tribunal->per_codigo  =   $request->percodigo;
        $personal_tribunal->tri_cod     =   $request->tri_cod;
        $personal_tribunal->documento   =   $request->documentoA;
        $personal_tribunal->nro_doc     =   $request->nro_docA;
        $personal_tribunal->fecha       =   $request->fechaA;
        $personal_tribunal->descripcion =   $request->descripcionA;
        $personal_tribunal->observacion =   $request->observacionA;
        $personal_tribunal->estado      =   1;
        $personal_tribunal->sysuser     =   Auth::user()->id;

        $personal_tribunal->save();
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $personal_tribunal         = PersonalTribunales::findOrFail($request->id);
        $personal_tribunal->estado = $request->estado;

        $personal_tribunal->save();
    }
}
