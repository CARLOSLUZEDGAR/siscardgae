<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalEspecialidadesController extends Controller
{
    //
    public function selectBuscaEspePer(Request $request){
        
        $id = $request->per_codigo;
       
        $listarEspecialidadPersonal = DB::table('personal_especialidades')



        ->join('personals','personal_especialidades.per_codigo','personals.per_codigo')


        ->join('especialidades','personal_especialidades.espe_cod','especialidades.id')

        ->join('subespecialidades','personal_especialidades.subespe_cod','subespecialidades.id')


        ->select(
            'personal_especialidades.per_codigo', 
                'personal_especialidades.espe_cod', 
                'personal_especialidades.subespe_cod',
                'personal_especialidades.documento',
                'personal_especialidades.fecha_documento',
                'personal_especialidades.nrodoc',

                'especialidades.id',
                'especialidades.nombre as nombespe',
                'subespecialidades.id',
                'subespecialidades.espe_cod',
                'subespecialidades.nombre as nomsubespe'



        )

        ->where('personal_especialidades.estado' , '=',1)
        ->where('personal_especialidades.per_codigo','=',$id)
        ->get();

        //return response()->json($listarEspecialidadPersonal);
        return ['listarEspecialidadPersonal' => $listarEspecialidadPersonal];
        
    }
}
