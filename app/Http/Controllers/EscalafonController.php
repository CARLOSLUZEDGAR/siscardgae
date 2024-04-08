<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escalafon;
use Illuminate\Support\Facades\Auth;

class EscalafonController extends Controller
{
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $escalafones = Escalafon::orderBy('id', 'asc')->paginate(7);
        }
        else{
            $escalafones = Escalafon::where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('id', 'asc')->paginate(7);
        }
        

        return [
            'pagination' => [
                'total'        => $escalafones->total(),
                'current_page' => $escalafones->currentPage(),
                'per_page'     => $escalafones->perPage(),
                'last_page'    => $escalafones->lastPage(),
                'from'         => $escalafones->firstItem(),
                'to'           => $escalafones->lastItem(),
            ],
            'escalafones' => $escalafones
        ];
    }

    public function selectEscalafon(Request $request){
        if (!$request->ajax()) return redirect('/');
        $escalafones = Escalafon::where('estado','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['escalafones' => $escalafones];
    }

    public function store(Request $request){
        if(!$request->ajax()) return redirect('/');
        $nombre = $request->nombre;
        $escalafon = Escalafon::select('nombre')
        ->where('nombre', $nombre)
        ->first();
       //return response()->json($doc);
        if(!empty($escalafon)){
            return response()->json("existe");
             //return "existe";
        } else {
            $escalafon = new Escalafon();
            $escalafon->nombre = $request->nombre;
            $escalafon->observacion = $request->observacion;
            $escalafon->estado = '1';
            $escalafon->sysuser = Auth::user()->id;
            $escalafon->save();
        }     
    }

    public function update(Request $request){
        if (!$request->ajax()) return redirect('/');
        //return response()->json($request);
        $nombre = $request->nombre;
        $id = $request->id;
        $escalafon = Escalafon::select('nombre')
        ->where('nombre', $nombre)
        ->whereNotIn('id', [$id])
        ->first();
        if(!empty($escalafon)){
            return response()->json("existe");
             //return "existe";
        } else {
            $escalafon = Escalafon::findOrFail($request->id);
            $escalafon->nombre = $request->nombre;
            $escalafon->observacion = $request->observacion;
            $escalafon->estado = '1';
            $escalafon->sysuser = Auth::user()->id;
            $escalafon->save();
        }
    }

    public function CambiarEstado(Request $request){
        if(!$request->ajax()) return redirect('/');
        $escalafon           = Escalafon::findOrFail($request->id);
        $escalafon->estado   = $request->estado;
        $escalafon->save();
    }
}
