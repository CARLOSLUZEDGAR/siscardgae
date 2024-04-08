<?php

namespace App\Http\Controllers;
use App\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EspecialidadController extends Controller
{
    public function ListarEspecialidad(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ""){
        $especialidad = DB::table('especialidades')
        ->select('id','nombre','observacion','estado')
        ->orderBy('nombre','asc')
        ->paginate(10);
        }
        elseif($criterio == 'nombre'){
            $especialidad = DB::table('especialidades')
            ->select('id','nombre','observacion','estado')
            ->where('nombre','like','%'.$buscar.'%')
            ->orderBy('nombre','asc')
            ->paginate(10);
        }
        elseif($criterio == 'observacion'){
            $especialidad = DB::table('especialidades')
            ->select('id','nombre','observacion','estado')
            ->where('observacion','like','%'.$buscar.'%')
            ->orderBy('nombre','asc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $especialidad->total(),
                'current_page'  => $especialidad->currentPage(),
                'per_page'      => $especialidad->perPage(),
                'last_page'     => $especialidad->lastPage(),
                'from'          => $especialidad->firstItem(),
                'to'            => $especialidad->lastItem(),
            
            ],
            'especialidad' => $especialidad
        ];
    }

    public function SelectEspecialidad(Request $request){

        $filtro = $request->filtro;

        if ($filtro==1 || $filtro==2 || $filtro==3)
            {
                $especialidad = DB::table('especialidades')
                ->select('id','nombre')
                ->where('observacion','like', '%' . 'O'.  '%')
                ->where('estado','=','1') //filtramos a todas las categorias que estan activas
                ->orderBy('nombre','asc')
                ->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado
                return ['especialidad' => $especialidad]; //mandamos todo el listado en la variable listado
            }
            else if ($filtro==4 || $filtro==5 || $filtro==6 || $filtro==21)
            {
                $especialidad = DB::table('especialidades')
                ->select('id','nombre')
                ->where('observacion','like', '%' . 'S'.  '%')
                ->where('estado','=','1') //filtramos a todas las categorias que estan activas
                ->orderBy('nombre','asc')
                ->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado
                return ['especialidad' => $especialidad]; //mandamos todo el listado en la variable listado
            }
            else if ($filtro==7 || $filtro==8 || $filtro==9 || $filtro==10 || $filtro==11 || $filtro==12)
            {
                $especialidad = DB::table('especialidades')
                ->select('id','nombre')
                ->where('observacion','like', '%' . 'C'.  '%')
                ->where('estado','=','1') //filtramos a todas las categorias que estan activas
                ->orderBy('nombre','asc')
                ->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado
                return ['especialidad' => $especialidad]; //mandamos todo el listado en la variable listado
            }
            
        else{
            $especialidad = DB::table('especialidades')
            ->select('id','nombre')
            ->where('estado','=','1') //filtramos a todas las categorias que estan activas
            ->orderBy('nombre','asc')
            ->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado
            return ['especialidad' => $especialidad]; //mandamos todo el listado en la variable listado
        }
    }

    public function storeEspecialidad(Request $request)
    {
        $especialidad = Especialidades::create([
            'nombre' => $request->nombre,
            'observacion' => $request->observacion,
            'estado' => 1,
            'sysuser' => Auth::user()->id
        ]);
        return response()->json($especialidad);       
    }
    public function updateEspecialidad(Request $request)
    {
        $especialidad = Especialidades::where('id',$request->id)
                    ->first();
        $especialidad -> update([
            'nombre' => $request->nombre,
            'observacion' => $request->observacion,
            'estado' => 1,
            'sysuser' => Auth::user()->id
        ]);
        return response()->json($especialidad);       
    }
    public function desactivarEspecialidad(request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $especialidad = Especialidades::findOrFail($request->id);
        $especialidad->estado = '0';
        $especialidad->save();
        return response()->json($especialidad);
    }
    public function activarEspecialidad(request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $especialidad = Especialidades::findOrFail($request->id);
        $especialidad->estado = '1';
        $especialidad->save();
        return response()->json($especialidad);
    }
}
