<?php

namespace App\Http\Controllers;

use App\PersonalCargo;
use Illuminate\Http\Request;

class PersonalCargoController extends Controller
{
    //
    public function index(Request $request)
    {
        $personal_cargo = PersonalCargo::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'cod_dest' => $request->perdest_codigocambio,
            'per_codigo' => $request->perdest_destn1_codigo,
            'id_cargo' => $request->perdest_destn2_codigo,
            'nivel_cargo' => $request->perdest_destn3_codigo,
            'percar_estado' => $request->perdest_destn4_codigo,
            'percar_observaciones' => $request->perdest_nro_doc,
            'perdest_sysuser' => Auth::user()->id,
        ]);
        return response()->json($personal_cargo);
    }
}
