<?php

namespace App\Http\Controllers;
use App\Grado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function CrearGrado(Request $request) //BASE
    {

    }

    public function EditarGrado(Request $request) //BASE
    {
        
    }

    public function EliminarGrado(Request $request) //BASE
    {
        
    }

    public function ListarGrado(Request $request) //BASE
    {
        $entidad = $request->id_entidad;
        // $entidad = 2;

        $grado = DB::table('grados')
                ->select('id', 'id_entidad', 'nombre', 'abreviatura')
                ->where('estado', 1)
                ->where('id_entidad', $entidad)
                ->orderBy('id', 'asc')
                ->get();
                return ['grados' => $grado];
    }
}
