<?php

namespace App\Http\Controllers;

use App\NivelProfesionals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Nivel_profesionalsController extends Controller
{

    //
    public function ListarNivelProfesionals(Request $request)
    {
        # code....
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        

        if ($buscar == '' ) {
            $niveprof = DB::table('nivel_profesionals as np')
            ->join('carreras as c', 'np.car_codigo', '=', 'c.id')// NO VA A DAR YO Q SEPA EXS CAR_COD esta asi va dar
            ->select('c.id AS id1', 'c.descripcion',
                        'np.id AS id2', 'np.car_codigo', 
                        'np.descripcion AS npdescrip', 'np.puntaje',
                        'np.clasificacion','np.observacion','np.estado')
            ->orderBy('c.descripcion','asc')
            ->orderBy('npdescrip','asc')
            ->where('c.estado','=',1)
            ->paginate(10);

        }
        else{
            $niveprof = DB::table('nivel_profesionals as np')
            ->join('carreras as c', 'np.car_codigo', '=', 'c.id')
            ->select('c.id AS id1', 'c.descripcion',
                        'np.id AS id2', 'np.car_codigo', 
                        'np.descripcion AS npdescrip', 'np.puntaje',
                        'np.clasificacion','np.observacion','np.estado')
            ->where($criterio,'like','%'.$buscar.'%')
            ->where('c.estado','=',1)
            ->orderBy('c.descripcion','asc')
            ->orderBy('npdescrip','asc')
            ->paginate(10);
        }
        
        //return response()->json($destino2);
        return [
            'pagination' => [
                'total'         => $niveprof->total(),
                'current_page'  => $niveprof->currentPage(),
                'per_page'      => $niveprof->perPage(),
                'last_page'     => $niveprof->lastPage(),
                'from'          => $niveprof->firstItem(),
                'to'            => $niveprof->lastItem(),
            
            ],
            'niveprof' => $niveprof
        ];
    }

    public function DesactivarNivelProfesionals(Request $request)//CUATRO_4
    {
        
        $niveprof = NivelProfesionals::Where('id',$request->id)->first();//con esta linea llamamos al per que es el per_Codigo de la persona
        
        $niveprof->update([
            'estado' => '0', 
        ]);

        return response()->json($request); 
    }

    public function ActivarNivelProfesionals(Request $request)//CUATRO_4
    {
        $niveprof = NivelProfesionals::Where('id',$request->id)->first(); //con esta linea llamamos al per que es el per_Codigo de la persona
        $niveprof->update([
            'estado' => '1', 
        ]);
        return response()->json($niveprof); 
    }

    public function RegistrarNivelProfesionals(Request $request) //CUATRO
    {
        $niveprof = NivelProfesionals::create([
            'car_codigo' =>$request->car_codigo,
            'descripcion' => $request->descripcion,
            'clasificacion' => $request->clasificacion, 
            'puntaje' => $request->puntaje, 
            'observacion' => $request->observacion,
            'estado' => '1', 
            'sysuser' => Auth::user()->id, 
 
        ]);
        return response()->json($niveprof); //Con esto podemos ver los datos que nos devuelve personal
    }

    public function EditarNivelProfesionals(Request $request)//CUATRO_4
    {
        $niveprof = NivelProfesionals::Where('id',$request->id2)->first(); //con esta linea llamamos al per que es el per_Codigo de la persona
        $niveprof->update([
            'car_codigo' =>$request->car_codigo,
            'descripcion' => $request->descripcion,
            'clasificacion' => $request->clasificacion, 
            'puntaje' => $request->puntaje, 
            'observacion' => $request->observacion,
            'estado' => '1', 
            'sysuser' => Auth::user()->id, 
        ]);
        
        return response()->json($niveprof); 
    }

    public function selectNivel_profesional(Request $request){
        // if(!$request->ajax()) return view('/');

        $buscar= $request->buscar;
         $nivel_profesional = NivelProfesionals::where('estado','=','1')
         ->select('id','descripcion')
         ->orderBy('descripcion','asc')->get();
         return['nivel_profesional' => $nivel_profesional];
    }

    
    public function selectbuscarNivelprofesional(Request $request){

        $id = $request->id;    
        // if (!$request->ajax()) return redirect('/');
        $datos = DB::table('nivel_profesionals')
        ->select('id','descripcion')
        ->where('car_codigo',$id)
        ->orderBy('descripcion', 'asc')
        ->get();
        return response()->json($datos);
    }
}
