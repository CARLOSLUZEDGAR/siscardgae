<?php

namespace App\Http\Controllers;
use App\Instancia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstanciaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $instancias = Instancia::orderBy('id', 'asc')->paginate(20);
        }
        else{
            $instancias = Instancia::where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('id', 'asc')->paginate(20);
        }
        

        return [
            'pagination' => [
                'total'        => $instancias->total(),
                'current_page' => $instancias->currentPage(),
                'per_page'     => $instancias->perPage(),
                'last_page'    => $instancias->lastPage(),
                'from'         => $instancias->firstItem(),
                'to'           => $instancias->lastItem(),
            ],
            'instancias' => $instancias
        ];
    }

    public function selectInstancia(Request $request){
    
        //if (!$request->ajax()) return redirect('/');
        $instancias = Instancia::where('estado','=','1')
        ->select('id','instancia','postergacion')->orderBy('orden', 'asc')->get();
        return ['instancias' => $instancias];
    }
    
    public function store(Request $request){
        if(!$request->ajax()) return redirect('/');
        $instancia = $request->instancia;
        $instancia = Instancia::select('instancia')
        ->where('instancia', $instancia)
        ->first();
       //return response()->json($doc);
        if(!empty($instancia)){
            return response()->json("existe");
             //return "existe";
        } else {
            $instancia = new Instancia();
            $instancia->instancia = $request->instancia;
            $instancia->orden = $request->orden;
            $instancia->estado = '1';
            $instancia->observacion = $request->observacion;
            $instancia->postergacion ='0';
            $instancia->sysuser = Auth::user()->id;
            $instancia->save();
        }
       
    }

    public function update(Request $request){
        if (!$request->ajax()) return redirect('/');
        // return response()->json($request);
        $instancia = $request->instancia;
        $id = $request->id;
        $instancia = Instancia::select('instancia')
        ->where('instancia', $instancia)
        ->whereNotIn('id', [$id])
        ->first();
        if(!empty($instancia)){
           return response()->json("existe");
        } else {
            $instancia = Instancia::findOrFail($request->id);
            $instancia->instancia = $request->instancia;
            $instancia->orden = $request->orden;
            $instancia->estado = '1';
            $instancia->observacion = $request->observacion;
            $instancia->postergacion ='0';
            $instancia->sysuser = Auth::user()->id;
            $instancia->save();
       }
    }

    public function CambiarEstado(Request $request){
        if(!$request->ajax()) return redirect('/');
        $instancia           = Instancia::findOrFail($request->id);
        $instancia->estado   = $request->estado;
        $instancia->save();
    }
}
