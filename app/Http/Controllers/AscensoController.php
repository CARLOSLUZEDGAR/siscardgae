<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ascenso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AscensoController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $ascensos= Ascenso::orderBy('id', 'desc')->paginate(10);
        }
        else
        {
            $ascensos= Ascenso::where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('id', 'desc')->paginate(10);
        }
        return[
            'pagination' => [
                'total'         => $ascensos->total(),
                'current_page'  => $ascensos->currentPage(),
                'per_page'      => $ascensos->perPage(),
                'last_page'     => $ascensos->lastPage(),
                'from'          => $ascensos->firstItem(),
                'to'            => $ascensos->lastItem(),
            ],
            'ascensos' => $ascensos
        ];
    }

    public function selectAscenso(Request $request){
        $ascensos = Ascenso::select(
            'id',
            'nrodocumento',
            'documento',
            'fechadocumento',
            'observacion',
            'estado')   
        ->where('estado','1')
        ->orderBy('id', 'desc')->get();
        $data = [];

        foreach ($ascensos as $key => $value) {
            $data[$key] = [
                'id' => $value->id,
                'descripcion' => $value->nrodocumento.' - '.$value->documento.' - '.$value->fechadocumento
            ];
        }
        return ['ascensos' => $data];
    }

    public function store(Request $request){
        if (!$request->ajax()) return redirect('/');
        $num = $request->nrodocumento;
        $document = $request->documento;
        $fechadocumento = $request->fechadocumento;
        $doc = Ascenso::select('nrodocumento','documento','fechadocumento')
        ->where('nrodocumento', $num)
        ->where('documento', $document)
        ->where('fechadocumento', $fechadocumento)
        ->first();
       //return response()->json($doc);
        if(!empty($doc)){
            return response()->json("existe");
             //return "existe";
        } else {
            $ascenso = new Ascenso();
            $ascenso->documento = $request->documento;
            $ascenso->nrodocumento = $request->nrodocumento;
            $ascenso->fechadocumento = $request->fechadocumento;
            $ascenso->observacion = $request->observacion;
            $ascenso->estado = '1';
            $ascenso->sysuser = Auth::user()->id;
            $ascenso->save(); 
        }  
    }
  
    public function update(Request $request){
        if (!$request->ajax()) return redirect('/');
        $num = $request->nrodocumento;
        $document = $request->documento;
        $fechadocumento = $request->fechadocumento;
        $id = $request->id;
        $doc = Ascenso::select('nrodocumento','documento','fechadocumento')
        ->where('nrodocumento', $num)
        ->where('documento', $document)
        ->where('fechadocumento', $fechadocumento)
        ->whereNotIn('id', [$id])
        ->first();
      //  return response()->json($doc);
        if(!empty($doc)){
            return response()->json("existe");
             //return "existe";
        } else {
            $ascenso = Ascenso::findOrFail($request->id);
            $ascenso->documento = $request->documento;
            $ascenso->nrodocumento = $request->nrodocumento;
            $ascenso->fechadocumento = $request->fechadocumento;
            $ascenso->observacion = $request->observacion;
            $ascenso->estado = '1';
            $ascenso->sysuser = Auth::user()->id;
            $ascenso->save();
        }   
    }

    public function CambiarEstado(Request $request){
        if(!$request->ajax()) return redirect('/');
        $docAsc           = Ascenso::findOrFail($request->id);
        $docAsc->estado   = $request->estado;
        $docAsc->save();
    }
}








