<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerciasController extends Controller
{
    public function ListarPericiasPersonal(Request $request)
    {
        $data = DB::table('personal_pericias as pp')
            ->join('pericias as pe','pp.pericia','pe.id')
            ->select('pp.id','pp.fecha','pe.nivel_pericia as pericia','pe.descripcion','pp.estado')
            ->where('pp.per_codigo',$request->percodigo)
            ->get();
        
        return response()->json($data);
    }
}
