<?php

namespace App\Http\Controllers;

use App\Carreras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarrerasController extends Controller
{
    //
    public function ListarCarreras(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '' ) {
            $carrera = Carreras::Select('id','descripcion','clasificacion','observacion','estado','sysuser')
            ->orderBy('id','asc')
            ->paginate(10);
        }
        else{
            $carrera = Carreras::Select('id','descripcion','clasificacion','observacion','estado','sysuser')
            ->where($criterio, 'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $carrera->total(),
                'current_page'  => $carrera->currentPage(),
                'per_page'      => $carrera->perPage(),
                'last_page'     => $carrera->lastPage(),
                'from'          => $carrera->firstItem(),
                'to'            => $carrera->lastItem(),
            
            ],
            'carrera' => $carrera
        ];
    }

    public function DesactivarCarreras(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $carrera = Carreras::Where('id',$request->id)->first(); 
        $carrera->update([
            'estado' => '0', 
        ]);
        return response()->json($carrera); 
    }

    public function ActivarCarreras(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $carrera = Carreras::Where('id',$request->id)->first();
        $carrera->update([
            'estado' => '1', 
        ]);
        return response()->json($carrera); 
    }

    public function EditarCarreras(Request $request)
    {
        $carrera = Carreras::Where('id',$request->id)->first();
        $carrera->update([
            'descripcion' => $request->descripcion,
            'clasificacion' => $request->clasificacion, 
            'observacion' => $request->observacion,
            'estado' => '1', 
            'sysuser' => Auth::user()->id,
        ]);
        return response()->json($carrera); 
    }

    public function RegistrarCarreras(Request $request)
    {
        $carrera = Carreras::create([
            'descripcion' => $request->descripcion,
            'clasificacion' => $request->clasificacion, 
            'observacion' => $request->observacion,
            'estado' => '1', 
            'sysuser' => Auth::user()->id,
        ]);
        return response()->json($carrera);
    }

    public function SelectCarreras(){
        //if (!$request->ajax()) return redirect('/');
        $carrera = DB::table('carreras')
        ->select('id','descripcion')
        ->where('estado','=','1') //filtramos a todas las categorias que estan activas
        ->orderBy('descripcion','asc')->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado

        //return ['carrera' => $carrera]; //mandamos todo el listado en la variable listado
        return response()->json($carrera);
    }
}
