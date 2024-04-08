<?php

namespace App\Http\Controllers;
use App\Nacionalidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NacionalidadController extends Controller
{
    public function CrearNacionalidad(Request $request) //BASE
    {
        $nacionalidad = Nacionalidad::create([
            'pais' => mb_strtoupper($request->pais),
            'nacionalidad' => mb_strtoupper($request->nacionalidad),
            'abreviatura' => mb_strtoupper($request->abreviatura),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
    }

    public function EditarNacionalidad(Request $request) //BASE
    {
        
    }

    public function EliminarNacionalidad(Request $request) //BASE
    {
        
    }

    public function ListarNacionalidad(Request $request) //BASE
    {
        $nacionalidad = DB::table('nacionalidads')
                ->select('id', 'pais', 'nacionalidad', 'abreviatura')
                ->where('estado', 1)
                ->orderBy('nacionalidad', 'asc')
                ->get();
                return ['nacionalidades' => $nacionalidad];
    }
    
    // public function selectNacionalidad(Request $request) //BASE
    // {
    //     $nacionalidad = DB::table('nacionalidads')
    //             ->select('id', 'pais', 'nacionalidad', 'abreviatura')
    //             ->where('estado', 1)
    //             ->where('id', $request->id_nacionalidadA)
    //             // ->orderBy('nacionalidad', 'asc')
    //             ->first();
    //             return ['nacionalidades' => $nacionalidad];
    // }
}
