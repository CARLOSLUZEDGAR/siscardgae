<?php

namespace App\Http\Controllers;

use App\AeronaveMotor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AeronaveMotorController extends Controller
{
    public function CrearAeronaveMotor(Request $request) //BASE
    {
        $aeronave_motor = AeronaveMotor::create([
            'id_nacionalidad' => $request->pais,
            'entidad' => mb_strtoupper($request->entidad),
            'sigla' => mb_strtoupper($request->sigla),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);
    }

    public function EditarAeronaveMotor(Request $request) //BASE
    {
        
    }

    public function EliminarAeronaveMotor(Request $request) //BASE
    {
        
    }

    public function ListarAeronaveMotor(Request $request) //BASE
    {
        $aeronave = $request->id_aeronave;
        
        $motor = DB::table('aeronave_motors')
                ->select('id', 'id_aeronave', 'posicion', 'fabricacion', 'modelo', 'serie')
                ->where('estado', 1)
                ->where('id_aeronave', $aeronave)
                ->orderBy('posicion', 'asc')
                ->get();
                return ['motores' => $motor];
    }
}
