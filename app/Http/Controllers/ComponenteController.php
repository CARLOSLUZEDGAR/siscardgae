<?php

namespace App\Http\Controllers;

use App\Componente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComponenteController extends Controller
{
    public function index(Request $request){
        //  if (!$request->ajax()) return redirect('/');
  
          $buscar = $request->buscar;
          $criterio = $request->criterio;
          
          if ($buscar==''){
              $componentes = Componente::orderBy('id', 'asc')->paginate(7);
          }
          else{
              $componentes = Componente::where($criterio, 'like', '%'. $buscar . '%')
              ->orderBy('id', 'asc')->paginate(7);
          }
          
  
          return [
              'pagination' => [
                  'total'        => $componentes->total(),
                  'current_page' => $componentes->currentPage(),
                  'per_page'     => $componentes->perPage(),
                  'last_page'    => $componentes->lastPage(),
                  'from'         => $componentes->firstItem(),
                  'to'           => $componentes->lastItem(),
              ],
              'componentes' => $componentes
          ];
      }
  
      public function selectComponente(Request $request){
        if (!$request->ajax()) return redirect('/');
        $componentes = Componente::where('estado','=','1')
        ->select('id','descripcion')->orderBy('descripcion', 'asc')->get();
        return ['componentes' => $componentes];
      }
  
      public function store(Request $request){
          if(!$request->ajax()) return redirect('/');
          $componente = new Componente();
          $componente->descripcion = $request->descripcion;
          $componente->puntaje = $request->puntaje;
          $componente->clasificacion = $request->clasificacion;
          $componente->observacion = $request->observacion;
          $componente->estado = '1';
          $componente->sysuser = Auth::user()->id;
          $componente->save();
         
      }
  
      public function update(Request $request){
          if (!$request->ajax()) return redirect('/');
          //return response()->json($request);
          $componente = Componente::findOrFail($request->id);
          $componente->descripcion = $request->descripcion;
          $componente->puntaje = $request->puntaje;
          $componente->clasificacion = $request->clasificacion;
          $componente->observacion = $request->observacion;
          $componente->estado = '1';
          $componente->sysuser = Auth::user()->id;
          $componente->save();
      }
  
      public function CambiarEstado(Request $request){
          if(!$request->ajax()) return redirect('/');
          $componente           = Componente::findOrFail($request->id);
          $componente->estado   = $request->estado;
          $componente->save();
      }
}
