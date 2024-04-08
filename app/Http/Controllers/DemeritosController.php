<?php

namespace App\Http\Controllers;

use App\Demerito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use App\Http\Controllers\DatosController;
use App\LevantamientoSancion;
use App\PersonalCargo;
use Illuminate\Support\Facades\Auth;

class DemeritosController extends Controller
{
    public function GuardarFalta(Request $request)
    {
        $date = Carbon::parse($request->fecha);
        if ($request->ndoc < 10) {
            $nrodoc ='0'.$request->ndoc.'/'.$date->isoFormat('YY');
        } else {
            $nrodoc = $request->ndoc.'/'.$date->isoFormat('YY');
        }       
        
        Demerito::create([
            'per_codigo' => $request->per_codigo, 
            'f1_cod' => $request->falta1, 
            'f2_cod' => $request->falta2, 
            'san_cod' => $request->sancion, 
            'gra_cod' => $request->grado, 
            'estu_id' => $request->complemento,
            'd1_cod' => $request->dest1, 
            'd2_cod' => $request->dest2, 
            'd3_cod' => $request->dest3,
            'd4_cod' => $request->dest4,
            'unidad' => $request->unidad,
            'ndoc' => $nrodoc, 
            'documento' => $request->doc, 
            'fecha_sancion' => $request->fecha, 
            'sancionador' => $request->sancionador, 
            'dias' => $request->dias,
            'externo' => $request->externo,
            'cargo' => $request->cargo,
            'observacion' => $request->observacion,
            'estado' => $request->estado,
            'faltuni' => $request->faltuni,
            'sysuser' => Auth::user()->id
        ]);

        // return response()->json([
        //     'code' => 200,
        // ]);
        return response()->json($request);

    }

    public function ListaDemeritos(Request $request)
    {
        $per_codigo = $request->per_codigo;
        $demeritos = DB::table('personal_faltas as pf')
            ->join('nivel1_faltas as nf1','pf.f1_cod','nf1.id')
            ->join('nivel2_faltas as nf2','pf.f2_cod','nf2.id')
            ->join('sanciones as s', 'pf.san_cod','s.id')
            ->select('pf.externo','pf.id','pf.ndoc', 'pf.documento', 'nf1.descripcion as f1', 'pf.estado','s.descripcion as sancion','nf2.descripcion as f2', 'pf.fecha_sancion as fecha')
            ->where('pf.per_codigo', $per_codigo)
            // ->where('pf.estado','<',2)
            ->where('pf.faltuni','>',$request->faltuni)  
            ->orderBy('pf.id','desc')
            ->get();

        // return [
        //     'pagination' => [
        //         'total'         => $demeritos->total(),
        //         'current_page'  => $demeritos->currentPage(),
        //         'per_page'      => $demeritos->perPage(),
        //         'last_page'     => $demeritos->lastPage(),
        //         'from'          => $demeritos->firstItem(),
        //         'to'            => $demeritos->lastItem(),
            
        //     ],
        //     'demeritos' => $demeritos
        // ];
        return response()->json($demeritos);
            
    }

    /**
     * LISTA DE DEMERITOS TOTALES POR UNIDAD
     */
    //FALTA DE EXTERNO A LA UNIDAD, NO FAB
    public function ListaDemeritosExternos(Request $request)
    {
        $unidad = DB::table('personal_destinos as pd')
                ->join('nivel3_destinos as d3','pd.d3_cod','d3.id')
                ->select('d3.descripcion')
                ->where('pd.per_codigo',Auth::user()->percod)
                ->where('pd.estado',1)
                ->first();
        
        $per_codigo = $request->per_codigo;
        $demeritos = DB::table('personal_faltas as pf')
            ->join('nivel1_faltas as nf1','pf.f1_cod','nf1.id')
            ->join('nivel2_faltas as nf2','pf.f2_cod','nf2.id')
            ->join('sanciones as s', 'pf.san_cod','s.id')
            ->select('pf.per_codigo','pf.externo','pf.id','pf.ndoc', 'pf.documento', 'nf1.descripcion as f1', 'pf.estado','s.descripcion as sancion','nf2.descripcion as f2', 'pf.fecha_sancion as fecha')
            ->where('pf.per_codigo', $per_codigo)
            ->where('pf.estado','>',0)
            ->where('pf.externo',1)
            ->where('pf.unidad',$unidad->descripcion)
            ->orderBy('pf.id','desc')
            ->get();

        return response()->json($demeritos);
            

    }
    
    public function LstaDemeritosValidar(Request $request)
    {
        $demeritos = DB::table('personal_faltas as pf')
            ->join('personals as p','pf.per_codigo','p.per_codigo')
            ->join('personal_escalafones as ep','p.per_codigo','ep.per_codigo')
            ->join('grados as g','ep.gra_cod','g.id')
            ->join('personal_estudios as epe','p.per_codigo','epe.per_codigo')
            ->join('estudios as e','epe.est_cod','e.id')
            ->select('pf.per_codigo','pf.externo','pf.id','pf.ndoc','pf.documento','pf.fecha_sancion','pf.sancionador','p.per_nombre as nombre','p.per_paterno as paterno',
                    'p.per_materno as materno','g.abreviatura as grado','e.abreviatura as complemento')
            ->where('pf.d1_cod',$request->dest1)
            ->where('pf.d2_cod',$request->dest2)
            ->where('pf.d3_cod',$request->dest3)
            ->where('epe.estado',1)
            ->where('ep.estado',1)
            ->where('pf.estado',2)
            ->orderBy('pf.id','desc')
            ->get();
        
        return response()->json($demeritos);

    }

    //FUNCION PARA VALIDAR FALTA

    public function ValidarFalta(Request $request)
    {
        Demerito::find($request->id)
            ->update([
                'estado' => 1
            ]);
    }

    /**
     * FUNCION PARA OBTENER TODOS LOS DATOS CON RESPECTO A UNA FALTA
     */
    public function DatosFalta(Request $request)
    {
        $id = $request->id;
        $datos = DB::table('personal_faltas as pf')
            ->join('nivel1_faltas as nf1','pf.f1_cod','nf1.id')
            ->join('nivel2_faltas as nf2','pf.f2_cod','nf2.id')
            ->join('sanciones as s', 'pf.san_cod','s.id')
            ->join('nivel1_destinos as nd1','pf.d1_cod','nd1.id')
            ->join('nivel2_destinos as nd2','pf.d2_cod','nd2.id')
            ->join('nivel3_destinos as nd3','pf.d3_cod','nd3.id')
            ->join('nivel4_destinos as nd4','pf.d4_cod','nd4.id')
            ->join('grados as g','pf.gra_cod','g.id')
            ->join('estudios as e','pf.estu_id','e.id')
             ->select('e.abreviatura as compleSanc','pf.id','pf.unidad','pf.externo','pf.f1_cod','pf.f2_cod','pf.san_cod','pf.cargo','pf.ndoc','pf.documento','pf.fecha_sancion','pf.sancionador','pf.observacion','pf.dias','g.abreviatura as grado',
                    'nd1.descripcion as d1','nd2.descripcion as d2','nd3.descripcion as d3','nd4.descripcion as d4','nf1.descripcion as f1',
                    's.descripcion as sancion','g.id as gracod','nf2.descripcion as f2','pf.d1_cod','pf.d2_cod','pf.d3_cod','pf.d4_cod')
            ->where('pf.id',$id)
            ->first();
        return response()->json($datos);
    }
    
    public function EditarFalta(Request $request)
    {
        Demerito::find($request->id)
            ->update([
                // 'per_cod', 
                'f1_cod' => $request->falta1, 
                'f2_cod' => $request->falta2, 
                'san_cod' => $request->sancion, 
                'gra_cod' => $request->grado, 
                'd1_cod' => $request->dest1, 
                'd2_cod' => $request->dest2, 
                'd3_cod' => $request->dest3,
                'd4_cod' => $request->dest4,
                'unidad' => $request->unidad,
                'ndoc' => $request->ndoc, 
                'documento' => $request->documento, 
                'fecha_sancion' => $request->fecha, 
                'sancionador' => $request->sancionador,
                'dias' => $request->dias,
                'externo' => $request->externo,
                'cargo' => $request->cargo, 
                'observacion' => $request->observacion,
            ]);
        return response()->json($request);
    }

    public function DejarSinEfectoSancion(Request $request)
    {
        try {
            DB::beginTransaction();

            $date = Carbon::parse($request->fechalev);
            if ($request->ndoclev < 10) {
                $nrodoc ='0'.$request->ndoclev.'/'.$date->isoFormat('YY');
            } else {
                $nrodoc = $request->ndoclev.'/'.$date->isoFormat('YY');
            }  
            Demerito::find($request->id)
                ->update([
                    'estado' => 2
                ]);
            
            LevantamientoSancion::create([
                'id_dem' => $request->id,
                'nombre' => $request->nomlev,
                'cargo' => $request->carlev,
                'destino' => $request->destlev,
                'ndoc' => $nrodoc,
                'tipodoc' => $request->doclev,
                'fecha' => $request->fechalev,
                'descripcion' => $request->observacionlev,
                'sysuser' => Auth::user()->percod
            ]);
            DB::commit();

            return response()->json(['code' => 200, 'mensaje' => 'Se dejo sin efecto la sancion.','tipo' => 'success', 'titulo'=>'Aceptado']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['code' => 400, 'mensaje' => 'Ocurrio un error al momento de realizar la acción.','tipo' => 'error', 'titulo'=>'Error']);
        }

        return response()->json($request);
    }

    public function VerSancionSinEfecto(Request $request)
    {
        $data = LevantamientoSancion::where('id_dem',$request->id)
                ->where('estado',1)
                ->first();
        
        return response()->json($data);
    }
}
