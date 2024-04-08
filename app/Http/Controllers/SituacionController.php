<?php

namespace App\Http\Controllers;

use App\PersonalSituacion;
use App\Situacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SituacionController extends Controller
{
    public function ListarSituacionesCombo()
    {
        $situaciones = DB::table('situaciones')
            ->select('id','nombre')
            ->where('estado',1)
            ->orderBy('id')
            ->get();
        
        return response()->json($situaciones);
    }

    public function ListarDatosSubsituacionesCombo(Request $request)
    {
        $id = $request->id;
        $datos = DB::table('subsituaciones')
            ->select('id','nombre')
            ->where('estado',1)
            ->where('sit_cod',$id)
            ->get();

        return response()->json($datos);
    }

    public function ListarDatosDetalleSituacionesCombo(Request $request)
    {
        $id = $request->id;
        $datos = DB::table('detalle_situaciones')
            ->select('id','nombre')
            ->where('estado',1)
            ->where('subsit_cod',$id)
            ->get();

        return response()->json($datos);
    }

    public function RegistrarSituacion(Request $request)
    {
        $date = Carbon::parse($request->fechadoc);
        if ($request->nrodoc < 10) {
            $nrodoc ='0'.$request->nrodoc.'/'.$date->isoFormat('YY');
        } else {
            $nrodoc = $request->nrodoc.'/'.$date->isoFormat('YY');
        }
        $ultsit = PersonalSituacion::where('per_codigo',$request->percodigo)
                    ->where('estado',1)
                    ->first();
                    
        $ultsit->estado=0;
        $ultsit->save();        
        $situacion = PersonalSituacion::create([
            'per_codigo'=>$request->percodigo,
            'sit_cod'=>$request->situacion,
            'subsit_cod'=>$request->subsituacion,
            'detsit_cod'=>$request->detsituacion,
            'documento'=>$request->documento,
            'fecha_documento'=>$request->fechadoc,
            'fecha'=>$request->fecha,
            'nrodoc'=>$nrodoc,
            'ficticia'=>$request->fechadoc,
            'promo'=>'00000',
            'observacion'=>$request->observacion,
            'estado'=>1,
            'sysuser'=>Auth::user()->id
        ]);
        return response()->json($situacion);
       
    }
    public function EditarSituacionMilitar(Request $request)
    {
        $sitper = DB::table('personal_situaciones')
            ->where('id', $request->idsit)
            ->update([
                'sit_cod'=>$request->situacion,
                'subsit_cod'=>$request->subsituacion,
                'detsit_cod'=>$request->detsituacion,
                'documento'=>$request->documento,
                'fecha_documento'=>$request->fechadoc,
                'fecha'=>$request->fecha,
                'nrodoc'=>$request->nrodoc,
                'ficticia'=>$request->fechadoc,
                'promo'=>'00000',
                'observacion'=>$request->observacion,
                'sysuser'=>Auth::user()->id
            ]);
        
        return response()->json($sitper);
    }
    public function EliminarSituacionMilitar(Request $request)
    {
        DB::table('personal_situaciones')->where('id',$request->idsit)->delete();
        return response()->json($request);
    }

}
