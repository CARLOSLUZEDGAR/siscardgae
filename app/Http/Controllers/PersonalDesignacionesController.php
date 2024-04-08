<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class PersonalDesignacionesController extends Controller
{
    public function ListarDesignaciones(Request $request)
    {
        
        $percodigo = $request->percodigo;
        $datos = [];

       
            $datos = DB::table('personal_designaciones as pd')
            ->join('personals as p','pd.per_codigo','p.per_codigo')
            ->select('pd.id as codigo','pd.documento','pd.nro_doc as nrodoc','pd.fecha',
                     'pd.descripcion','pd.observacion','pd.estado')
            ->where('pd.per_codigo',$percodigo)
            ->orderBy('pd.fecha','desc')
            ->paginate(10);

            return response()->json([
                'pagination' => [
                    'total'         => $datos->total(),
                    'current_page'  => $datos->currentPage(),
                    'per_page'      => $datos->perPage(),
                    'last_page'     => $datos->lastPage(),
                    'from'          => $datos->firstItem(),
                    'to'            => $datos->lastItem(),
                
                ],
                'datos' => $datos,
                'code' => 200
            ]);
            
        /*return response()->json($datos);  */
    }

    
}
