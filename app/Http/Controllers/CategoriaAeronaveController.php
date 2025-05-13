<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaAeronaveController extends Controller
{
    public function CrearCategoriaAeronave(Request $request) //BASE
    {

    }

    public function EditarCategoriaAeronave(Request $request) //BASE
    {
        
    }

    public function EliminarCategoriaAeronave(Request $request) //BASE
    {
        
    }

    public function ListarCategoriaAeronave(Request $request) //BASE
    {
        $categoria_aeronave = DB::table('categoria_aeronave')
                ->select('id', 'categoria')
                ->where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();
                return ['categoria_aeronaves' => $categoria_aeronave];
    }
}
