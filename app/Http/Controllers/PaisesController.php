<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisesController extends Controller
{
    public function listarPaises()
    {
        $paises = DB::table('paises')
                    ->select('id','nombre')
                    ->get();

        return response()->json($paises);
    }
}
