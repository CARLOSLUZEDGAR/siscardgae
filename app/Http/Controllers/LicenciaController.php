<?php

namespace App\Http\Controllers;
use App\Licencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LicenciaController extends Controller
{
    public function CrearLicencia(Request $request) //BASE
    {

    }

    public function EditarLicencia(Request $request) //BASE
    {
        
    }

    public function EliminarLicencia(Request $request) //BASE
    {
        
    }

    public function ListarLicencia(Request $request) //BASE
    {
        $entidad = $request->id_entidad;
        $categoria = $request->id_categoria;
        // $suma = $entidad + $categoria;
        if($entidad == 1 && $categoria == 1){
            $licencia = DB::table('licencias')
            ->select('id', 'id_categoria', 'licencia', 'observacion')
            ->where('estado', 1)
            ->where('id_categoria', $categoria)
            ->where('observacion', 'FAB')
            ->orderBy('id', 'asc')
            ->get();
            return ['licencias' => $licencia];
        }else{
            $licencia = DB::table('licencias')
            ->select('id', 'id_categoria', 'licencia', 'observacion')
            ->where('estado', 1)
            ->where('id_categoria', $categoria)
            ->where('observacion', 'OTROS')
            ->orderBy('id', 'asc')
            ->get();
            return ['licencias' => $licencia]; 
        }
        // return ['licencias' =>$suma];
    }
}
