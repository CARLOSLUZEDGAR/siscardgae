<?php

namespace App\Http\Controllers;
use App\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function CrearCategoria(Request $request) //BASE
    {

    }

    public function EditarCategoria(Request $request) //BASE
    {
        
    }

    public function EliminarCategoria(Request $request) //BASE
    {
        
    }

    public function ListarCategoria(Request $request) //BASE
    {
        $categoria = DB::table('categorias')
                ->select('id', 'categoria')
                ->where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();
                return ['categorias' => $categoria];
    }
}
