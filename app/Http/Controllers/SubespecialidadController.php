<?php

namespace App\Http\Controllers;
use App\Subespecialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubespecialidadController extends Controller
{
    public function ListarSubespecialidad(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ""){
            //if (!$request->ajax()) return redirect('/');
            $subespecialidad = DB::table('subespecialidades as s')
            ->join('especialidades as e','e.id','s.espe_cod')
            ->select('s.id as idsubespe','s.nombre as nomsubespe','s.observacion','s.estado','e.id as idespe', 'e.nombre as nomespe', 's.observacion')
            ->orderBy('e.nombre','asc')
            ->orderBy('s.nombre','asc')
            ->paginate(10);
        }

        elseif($criterio == 'nombre'){
            //if (!$request->ajax()) return redirect('/');
            $subespecialidad = DB::table('subespecialidades as s')
            ->join('especialidades as e','e.id','s.espe_cod')
            ->select('s.id as idsubespe','s.nombre as nomsubespe','s.observacion','s.estado','e.id as idespe', 'e.nombre as nomespe', 's.observacion')
            ->where('s.nombre','like','%'.$buscar.'%')
            ->orderBy('e.nombre','asc')
            ->orderBy('s.nombre','asc')
            ->paginate(10);
        }

        return [
            'pagination' => [
                'total'         => $subespecialidad->total(),
                'current_page'  => $subespecialidad->currentPage(),
                'per_page'      => $subespecialidad->perPage(),
                'last_page'     => $subespecialidad->lastPage(),
                'from'          => $subespecialidad->firstItem(),
                'to'            => $subespecialidad->lastItem(),
            
            ],
            'subespecialidad' => $subespecialidad
        ];
    }

    public function selectSubespecialidad(Request $request)
    {
        // if(!$request->ajax()) return view('/');
         $subespecialidad = DB::table('subespecialidades')
         ->where('estado','=','1')
         ->select('id','nombre')
         ->orderBy('nombre','asc')
         ->get();
         return['subespecialidad' => $subespecialidad];
    }

    public function selectbuscarSubespecialidad(Request $request)
    {
        $buscar = $request->buscar;
        // if (!$request->ajax()) return redirect('/');
        $subespecialidad = DB::table('subespecialidades')      
        ->where('espe_cod','=',$buscar)
        ->where('estado','=','1')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')
        ->get();
        return ['subespecialidad' => $subespecialidad];
    }

    public function storeSubespecialidad(Request $request)
    {
        $obs = strtoupper($request->observacion);
        $subespecialidad = Subespecialidades::create([
            'nombre' => $request->nombre,
            'espe_cod' => $request->especialidad,
            'observacion' => $obs,
            'estado' => 1,
            'sysuser' => Auth::user()->id 
        ]);
        return response()->json($subespecialidad);       
    }
    
    public function updateSubespecialidad(Request $request)
    {
        $obs = strtoupper($request->observacion);
        $subespecialidad = Subespecialidades::where('id',$request->id)
                    ->first();
        $subespecialidad -> update([
            'nombre' => $request->nombre,
            'espe_cod' => $request->especialidad,
            'observacion' => $obs,
            'estado' => 1,
            'sysuser' => Auth::user()->id
        ]);
        return response()->json($subespecialidad);       
    }
    public function desactivarSubespecialidad(request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $subespecialidad = Subespecialidades::findOrFail($request->id);
        $subespecialidad->estado = '0';
        $subespecialidad->save();
        return response()->json($subespecialidad);
    }
    public function activarSubespecialidad(request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $subespecialidad = Subespecialidades::findOrFail($request->id);
        $subespecialidad->estado = '1';
        $subespecialidad->save();
        return response()->json($subespecialidad);
    }
}
