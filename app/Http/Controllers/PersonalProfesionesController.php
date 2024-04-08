<?php

namespace App\Http\Controllers;

use App\PersonalProfesiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonalProfesionesController extends Controller
{
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/')

        $buscar = $request->per_codigo;
        $criterio = $request->criterio;

        if($buscar==''){
            $per_prof = PersonalProfesiones::join('carreras','carreras.id','=','personal_profesiones.car_codigo')
            ->join('nivel_profesionals','nivel_profesionals.id','=','personal_profesiones.nivprof_codigo')
           // -> leftjoin('profesion_libre','profesion_libre.id','=')
            ->join('personals','personals.per_codigo','=','personal_profesiones.per_codigo')
            ->select('carreras.descripcion as descripcion_carrera','nivel_profesionals.descripcion as niv_especialidad','personal_profesiones.lugar_estudio','personal_profesiones.fecha_egreso',
            
                     'personal_profesiones.id','personal_profesiones.per_codigo','personal_profesiones.nivprof_codigo','personal_profesiones.car_codigo','personal_profesiones.descripcion','personal_profesiones.estado','personal_profesiones.observacion','personal_profesiones.sysuser')
                
            ->orderBy('personal_profesiones.fecha_egreso','desc')->paginate(20);
        }
        else{
            $per_prof = PersonalProfesiones::join('carreras','carreras.id','=','personal_profesiones.car_codigo')
            ->join('nivel_profesionals','nivel_profesionals.id','=','personal_profesiones.nivprof_codigo')
           // ->join('profesion_libre','profesion_libre.id','=')
            ->join('personals','personals.per_codigo','=','personal_profesiones.per_codigo')
            ->select('carreras.descripcion as descripcion_carrera','nivel_profesionals.descripcion as niv_especialidad','personal_profesiones.lugar_estudio','personal_profesiones.fecha_egreso',
            
            'personal_profesiones.id','personal_profesiones.per_codigo','personal_profesiones.nivprof_codigo','personal_profesiones.car_codigo','personal_profesiones.descripcion','personal_profesiones.estado','personal_profesiones.observacion','personal_profesiones.sysuser')
            ->Where('personal_profesiones.estado','=','1')
            ->where('personals.per_codigo', '=' , $buscar)
             //->where('nivel_profesionals.clasificacion', '=' , $filtro)
             //->where('profesion_libre.clasificacion', '=' , $filtro)
             //->where('carrera.clasificacion', '=' , $filtro)
            ->orderBy('personal_profesiones.fecha_egreso','desc')->paginate(20);
        }

        //return response()->json(['per_prof' => $per_prof]);
        return [
            'pagination' => [
                'total'         => $per_prof->total(),
                'current_page'  => $per_prof->currentPage(),
                'per_page'      => $per_prof->perPage(),
                'last_page'     => $per_prof->lastPage(),
                'from'          => $per_prof->firstItem(),
                'to'            => $per_prof->lastItem(),
            
            ],
            'per_prof' => $per_prof
        ];
    }

    public function store(Request $request)
    {
        $profesion = PersonalProfesiones::create([
            'per_codigo'=>$request->per_codigo,
            'nivprof_codigo'=>$request->nivprof_codigo,
            'car_codigo'=>$request->car_codigo,
            'descripcion'=>$request->descripcion,
            'lugar_estudio'=>$request->lugar_estudio,
            'fecha_egreso'=>$request->fecha_egreso,
            'observacion'=>$request->observacion,
            'estado'=>1,
            'sysuser'=>Auth::user()->id
        ]);
        return response()->json($profesion);
    }


    public function update(Request $request)
    {
        //if(!$request->ajax()) return view('/');
        $per_prof = DB::table('personal_profesiones')
        ->where('id',$request->idper_prof)
        ->update([
            'per_codigo'=>$request->per_codigo,
            'nivprof_codigo'=>$request->nivprof_codigo,
            'car_codigo'=>$request->car_codigo,
            'descripcion'=>$request->descripcion,
            'lugar_estudio'=>$request->lugar_estudio,
            'fecha_egreso'=>$request->fecha_egreso,
            'observacion'=>$request->observacion,
            'estado'=>1,
            'sysuser'=>Auth::user()->id
        ]);
        
        return response()->json($per_prof);
        
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $per_prof = PersonalProfesiones::findOrFail($request->id);
        $per_prof->estado = '0';
        $per_prof->save();
    }

    public function DatosPersonalProfesionesModificar(Request $request)
    {
        $per_prof = $request->per_prof;
        $datos = DB::table('personal_profesiones as pp')
        ->join('personals as p','pp.per_codigo','p.per_codigo')
        ->join('carreras as c','pp.car_codigo','c.id')
        ->join('nivel_profesionals as np','pp.nivprof_codigo', 'np.id')
        ->select('c.descripcion as descripcion_carrera','np.descripcion as niv_especialidad','np.id','pp.lugar_estudio','pp.fecha_egreso',
        'pp.id','pp.per_codigo','pp.nivprof_codigo','pp.car_codigo','pp.descripcion','pp.estado','pp.observacion','pp.sysuser')
        ->Where('pp.estado','=','1')
        ->where('pp.id', '=' , $per_prof)
        ->orderBy('pp.fecha_egreso','desc')
        ->first();
        return response()->json($datos);  
    }
}

