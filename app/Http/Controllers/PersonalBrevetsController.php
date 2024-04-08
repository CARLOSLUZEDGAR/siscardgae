<?php

namespace App\Http\Controllers;

use App\PersonalBrevets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalBrevetsController extends Controller
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

    public function listarBrevets(Request $request)
    {
        $id = $request->id;

        $PersonalBrevets = DB::table('personal_brevets as pb')
                            ->join('personals as p','pb.per_codigo','p.per_codigo')
                            ->join('brevets as b','pb.brevet_cod','b.id')
                            ->join('paises as pa','pb.pais_cod','pa.id')
                            ->select('pb.id as idPerBrev','pb.per_codigo','pb.brevet_cod','pb.pais_cod',
                                     'pb.fecha_imposicion','pb.ndoc','pb.tipodoc','pb.observacion',
                                     'pb.estado','b.id as idBrev','b.subesc_cod','b.descripcion',
                                     'b.puntaje','b.asignacion','b.clasificacion','pa.id','pa.nombre')
                            ->orderBy('pb.id','desc')
                            ->where('pb.per_codigo',$id)
                            ->get();

        return response()->json($PersonalBrevets);
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $personal_brevets                   =   new PersonalBrevets();

        $personal_brevets->per_codigo       =   $request->per_codigo;
        $personal_brevets->brevet_cod       =   $request->valorBrevet;
        $personal_brevets->pais_cod         =   $request->valorPais;
        $personal_brevets->fecha_imposicion =   $request->fecha_imposicion;
        $personal_brevets->ndoc             =   $request->ndoc;
        $personal_brevets->tipodoc          =   $request->valortipodoc;

        $val = $request->observacion;

        if($val == ''){
            $val = 'NINGUNA';
        }
        else{
            $val = $request->observacion;
        }

        $personal_brevets->observacion      =   $val;
        $personal_brevets->estado           =   1;
        $personal_brevets->sysuser          =   Auth::user()->id;

        $personal_brevets->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $personal_brevets                   =   PersonalBrevets::findOrFail($request->id);

        $personal_brevets->per_codigo       =   $request->percodigo;
        $personal_brevets->brevet_cod       =   $request->brevet_cod;
        $personal_brevets->pais_cod         =   $request->pais_cod;
        $personal_brevets->fecha_imposicion =   $request->fecha_imposicionA;
        $personal_brevets->ndoc             =   $request->ndocA;
        $personal_brevets->tipodoc          =   $request->tipodocA;
        $personal_brevets->observacion      =   $request->observacionA;
        $personal_brevets->sysuser          =   Auth::user()->id;

        $personal_brevets->save();
    }

    public function CambiarEstado(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $personal_brevets           = PersonalBrevets::findOrFail($request->pb);
        $personal_brevets->estado   = $request->estado;

        $personal_brevets->save();
    }
}
