<?php

namespace App\Http\Controllers;
use App\Habilitacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HabilitacionController extends Controller
{
    public function CrearHabilitacion(Request $request) //BASE
    {

    }

    public function EditarHabilitacion(Request $request) //BASE
    {
        
    }

    public function EliminarHabilitacion(Request $request) //BASE
    {
        
    }

    public function ListarHabilitacion(Request $request) //BASE
    {
        $licencia = $request->id_titlicencia;
        $habilitacion = DB::table('habilitacions')
                ->select('id', 'id_licencia', 'habilitacion')
                ->where('estado', 1)
                ->where('id_licencia',$licencia)
                ->orderBy('id', 'asc')
                ->get();
                return ['habilitaciones' => $habilitacion];
    }
}
