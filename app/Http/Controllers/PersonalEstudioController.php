<?php

namespace App\Http\Controllers;

use App\PersonalEstudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalEstudioController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->per_codigo;
        $listarEstudioPersonal = DB::table('personal_estudios')
        ->join('personals','personal_estudios.per_codigo','personals.per_codigo')
        ->join('estudios','personal_estudios.est_cod','estudios.id')
        ->select('personal_estudios.id as id2', 'personal_estudios.per_codigo','personal_estudios.est_cod','personal_estudios.nrodoc',
        'personal_estudios.documento','personal_estudios.fecha_documento','personal_estudios.observacion','personal_estudios.estado',
        'estudios.id','estudios.abreviatura','estudios.descripcion','estudios.instituto'    
        )
        ->where('personal_estudios.per_codigo','=',$id)
        ->orderBy('personal_estudios.fecha_documento','desc')
        ->get();
        return response()->json($listarEstudioPersonal);
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $fecha_max_update = PersonalEstudio::
            where('per_codigo', $request->per_codigo)
            ->max('fecha_documento');

        if($request->fecha_documento >= $fecha_max_update)
        {
            $perest_est = '1';
            PersonalEstudio::where('per_codigo',$request->per_codigo)
                ->whereNotIn('fecha_documento',[$request->fecha_documento])
                ->update(['estado' => 0]);
        }
        else
        {
            $perest_est = '0';
        }

        PersonalEstudio::create([
            'per_codigo'        => $request->per_codigo,
            'est_cod'           => $request->est_cod,
            'nrodoc'           => $request->nrodoc,
            'documento'         => $request->documento,
            'fecha_documento'   => $request->fecha_documento,
            'observacion'       => $request->observacion,
            'estado'            => $perest_est,
            'sysuser'           => Auth::user()->id,
        ]);
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fecha_max_update = PersonalEstudio::
            where('per_codigo', $request->per_codigo)
            ->max('fecha_documento');

        $reg_estado_1 = PersonalEstudio::
            where('per_codigo', $request->per_codigo)
            ->where('fecha_documento', $fecha_max_update)
            ->first();

        $fecha_sub_max = PersonalEstudio::
            where('per_codigo', $request->per_codigo)
            ->where('estado', 0)
            ->max('fecha_documento');

        if($request->fecha_documento >= $fecha_max_update)
        {
            $perest_est = '1';
            PersonalEstudio::where('per_codigo',$request->per_codigo)
                ->whereNotIn('fecha_documento',[$request->fecha_documento])
                ->update(['estado' => 0]);
        }
        else
        {
            if ($reg_estado_1->id == $request->est_id_editA ){
                if ($request->fecha_documento >= $fecha_sub_max){
                    $perest_est = '1';
                    PersonalEstudio::
                        where('per_codigo', $request->per_codigo)
                        ->whereNotIn('fecha_documento', [$request->fecha_documento])
                        ->update(['estado' => 0]);
                }
                else{
                    PersonalEstudio::
                        where('per_codigo', $request->per_codigo)
                        ->where('fecha_documento', $fecha_sub_max)
                        ->update(['estado' => 1]);
                    $perest_est = '0';
                    
                }
            }
            else{
                PersonalEstudio::
                    where('per_codigo', $request->per_codigo)
                    ->where('fecha_documento', $fecha_max_update)
                    ->update(['estado' => 1]);
                $perest_est = '0';
            }
        }
        $per_estu = DB::table('personal_estudios',)
        ->where('id',$request->est_id_editA)
        ->update([
            'per_codigo'=>$request->per_codigo,
            'est_cod'=>$request->est_cod,
            'documento'=>$request->documento,
            'fecha_documento'=>$request->fecha_documento,
            'nrodoc'=>$request->nrodoc,
            'observacion'=>$request->observacion,
            'estado'=>$perest_est,
            'sysuser'=>Auth::user()->id
        ]);
        
        return response()->json($per_estu);
    }

    public function EliminarEstudio(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        
        $estudio = DB::table('personal_estudios')
        ->where('id', $request->idpr);
        $estudio->delete();  
    }

    public function DatosPersonalEstudioModificar(Request $request)
    {
        $per_estu = $request->per_estu;
        $datos = DB::table('personal_estudios')
            ->join('personals','personal_estudios.per_codigo','personals.per_codigo')
            ->join('estudios','personal_estudios.est_cod','estudios.id')
            ->select('personal_estudios.id as id2', 'personal_estudios.per_codigo','personal_estudios.est_cod','personal_estudios.nrodoc',
            'personal_estudios.documento','personal_estudios.fecha_documento','personal_estudios.observacion','personal_estudios.estado',
            'estudios.id','estudios.abreviatura','estudios.descripcion','estudios.instituto'    
            )
            ->where('personal_estudios.id', '=' , $per_estu)
            ->first();
        return response()->json($datos);  
    }

}
