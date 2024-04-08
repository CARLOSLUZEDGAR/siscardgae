<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subescalafon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubescalafonController extends Controller
{
    public function index(Request $request){
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;  
        if ($buscar==''){
            $subescalafones = DB::table('subescalafones as sbe')
            ->join('escalafones as e','sbe.esca_cod','=','e.id')
            ->select('sbe.id','sbe.esca_cod','sbe.nombre','sbe.orden',
            'sbe.observacion as subesca_obs','sbe.estado' ,'sbe.sysuser as subesca_user',
            'e.nombre as esca_nombre','e.estado as esca_estado','e.sysuser as esca_user')
            ->where('sbe.estado','1')->orderBy('sbe.id', 'asc')->paginate(10);
        }
        else{
            $subescalafones = DB::table('subescalafones as sbe')
            ->join('escalafones as e','sbe.esca_cod','=','e.id')
            ->select('sbe.id','sbe.esca_cod','sbe.nombre','sbe.orden',
            'sbe.observacion as subesca_obs','sbe.estado' ,'sbe.sysuser as subesca_user',
            'e.nombre as esca_nombre','e.estado as esca_estado','e.sysuser as esca_user')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('sbe.id', 'asc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $subescalafones->total(),
                'current_page' => $subescalafones->currentPage(),
                'per_page'     => $subescalafones->perPage(),
                'last_page'    => $subescalafones->lastPage(),
                'from'         => $subescalafones->firstItem(),
                'to'           => $subescalafones->lastItem(),
            ],
            'subescalafones' => $subescalafones
        ];
    }

    public function selectSubescalafon(Request $request){
        if (!$request->ajax()) return redirect('/');
        $subescalafones = Subescalafon::where('estado','=','1')
          ->select('id','nombre')->orderBy('orden', 'asc')->get();
          return ['subescalafones' => $subescalafones];
    }

    public function selectbuscarSubescalafon(Request $request){
        $buscar = $request->buscar;   
        if (!$request->ajax()) return redirect('/');
        $subescalafon = Subescalafon::where('esca_cod','=',$buscar)
        ->where('estado','=','1')
        ->select('id','nombre')->orderBy('orden', 'asc')->get();
        return ['subescalafon' => $subescalafon];
    }  

    public function store(Request $request){
        if(!$request->ajax()) return redirect('/');
        //return response()->json($request);
        $nombre = $request->nombre;
        $esca_cod = $request->esca_cod;
        $subescalafon = Subescalafon::select('nombre','esca_cod')
        ->where('nombre', $nombre)
        ->where('esca_cod', $esca_cod)
        ->first();
       //return response()->json($doc);
        if(!empty($subescalafon)){
            return response()->json("existe");
             //return "existe";
        } else {
            $subescalafon = new Subescalafon();
            $subescalafon->esca_cod= $request->esca_cod;
            $subescalafon->nombre = $request->nombre;
            $subescalafon->orden = $request->orden;
            $subescalafon->observacion = $request->subesca_obs;
            $subescalafon->estado = '1';
            $subescalafon->sysuser = Auth::user()->id;
            $subescalafon->save(); 
        }
       
    }

    public function update(Request $request){
        if (!$request->ajax()) return redirect('/');
        //return response()->json($request);
        $nombre = $request->nombre;
        $esca_cod = $request->esca_cod;
        $id = $request->id;
        $subescalafon = Subescalafon::select('nombre','esca_cod')
        ->where('nombre', $nombre)
        ->where('esca_cod', $esca_cod)
        ->whereNotIn('id', [$id])
        ->first();
      //  return response()->json($escalafon);
        if(!empty($subescalafon)){
            return response()->json("existe");
             //return "existe";
        } else {
            $subescalafon = Subescalafon::findOrFail($request->id);
            $subescalafon->nombre = $request->nombre;
            $subescalafon->esca_cod = $request->esca_cod;
            $subescalafon->orden = $request->orden;
            $subescalafon->observacion = $request->subesca_obs;
            $subescalafon->estado = '1';
            $subescalafon->sysuser = Auth::user()->id;
            $subescalafon->save();
        }
    }

    public function CambiarEstado(Request $request){
        if(!$request->ajax()) return redirect('/');
        $subescalafon           = Subescalafon::findOrFail($request->id);
        $subescalafon->estado   = $request->estado;
        $subescalafon->save();
    }
}
