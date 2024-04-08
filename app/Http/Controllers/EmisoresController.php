<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmisoresController extends Controller
{
    public function listarEmisores(Request $request)
    {
        if(!$request->ajax()) return view('/');

        $emi_cod = DB::table('emisores')
                    ->select('id','descripcion as nombreemisor')
                    ->where('estado','=','1')
                    ->orderBy('id','asc')
                    ->get();

        return ['emi_cod' => $emi_cod];
    }
}
