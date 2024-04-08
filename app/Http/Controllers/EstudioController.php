<?php

namespace App\Http\Controllers;

use App\Estudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstudioController extends Controller
{
    //
    public function ListarEstudio(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '' ) {
            $estudio = DB::table('estudios')
            ->orderBy('id','asc')
            ->paginate(10);
        }
        else{
            $estudio = DB::table('estudios')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $estudio->total(),
                'current_page'  => $estudio->currentPage(),
                'per_page'      => $estudio->perPage(),
                'last_page'     => $estudio->lastPage(),
                'from'          => $estudio->firstItem(),
                'to'            => $estudio->lastItem(),
            
            ],
            'estudio' => $estudio
        ];
    }

    public function RegistrarEstudio(Request $request)
    {
        $estudio = Estudio::create([
            'abreviatura' => $request->abreviatura,
            'descripcion' => $request->descripcion, 
            'correlativo' => $request->correlativo,
            'instituto' => $request->instituto,
            'observacion' => $request->observacion,
            'estado' => '1', 
            'sysuser' => Auth::user()->id
        ]);
        return response()->json($estudio);
    }

    public function EditarEstudio(Request $request)
    {
        //return response()->json($request);
        $estudio = Estudio::Where('id',$request->id)->first();
        $estudio->update([
            'abreviatura' => $request->abreviatura,
            'descripcion' => $request->descripcion, 
            'correlativo' => $request->correlativo,
            'instituto' => $request->instituto,
            'observacion' => $request->observacion,
            'estado' => '1', 
            'sysuser' => Auth::user()->id,
        ]);
        return response()->json($estudio); 
    }

    public function DesactivarEstudio(Request $request)
    {
        $estudio = Estudio::Where('id',$request->id)->first(); 
        $estudio->update([
            'estado' => '0', 
        ]);
        return response()->json($estudio); 
    }

    public function ActivarEstudio(Request $request)
    {
        $estudio = Estudio::Where('id',$request->id)->first();
        $estudio->update([
            'estado' => '1', 
        ]);
        return response()->json($estudio); 
    }

    public function SelectEstudio(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $estudio = DB::table('estudios')
        ->where('estado','=','1') //filtramos a todas las categorias que estan activas
        ->select('id','abreviatura', 'descripcion')
        ->orderBy('id','asc')->get();//seleecionamos los campos id, nombre  con get() se obtiene el listado

        return ['estudio' => $estudio]; //mandamos todo el listado en la variable listado
    }

    // public function GenerarPdfNivel1Destino(Request $request)
    // {
    //     $destino1 = DB::table('nivel1_destinos')
    //     ->orderBy('descripcion','asc')
    //     ->get();

    //     $cont = Nivel1Destino::count();

    //     $pdf = PDF::loadView('reportes.listardestino1', compact('destino1', 'cont'))
    //     ->setPaper('DEFAULT_PDF_PAPER_SIZE', 'portrait')
    //     ->setWarnings(false);
        
    //     return $pdf->download(date('Ymd-H-i-s').'Destino1'.'.pdf');
    // }
}
