<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aeronave;
use App\AeronaveDesignacion;
use App\AeronaveDocumento;
use App\AeronaveMotor;
use App\PersonalDocumento;
use App\PersonalLicencia;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AeronaveController extends Controller
{
    public function CrearAeronave(Request $request) //DGAE
    {
        if ($request->foto != "") {
            $exploded = explode(',', $request->foto);
            $decoded = base64_decode($exploded[1]);
            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }
            // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            // $charactersLength = strlen($characters);
            // $randomString = '';
            // for ($i=0; $i < 10; $i++) {
            //    $randomString .= $characters[rand(0,$charactersLength - 1)];
            // }

            $fileName = mb_strtoupper($request->matricula).'_'.mb_strtoupper($request->serie).'.'.$extension;
            $path = public_path().'/img/aeronave/'.$fileName;
            file_put_contents($path, $decoded);

        } else {
            $fileName = 'avatar_aeronave.png';
        }

        try {
            DB::beginTransaction();
            $aeronave = Aeronave::create([
                'fabrica' => mb_strtoupper($request->fabrica),
                'modelo' => mb_strtoupper($request->modelo),
                'serie' => mb_strtoupper($request->serie),
                'id_tipo_aeronave' => $request->categoria,
                'id_categoria_aeronave' => $request->tipo,
                'id_condicion_aeronave' => $request->condicion,
                'fotografia' => $fileName,
                'estado' => 1, 
                'sysuser' => Auth::user()->id
            ]);

            $aeronave_designacion = AeronaveDesignacion::create([
                'id_aeronave' => $aeronave->id,
                'matricula' => mb_strtoupper($request->matricula),
                'id_entidad' => $request->entidad,
                'id_g_unidad' => $request->g_unidad,
                'id_unidad' => $request->unidad,
                'fecha_designacion' => $request->fech_ingreso,
                'documento' => mb_strtoupper($request->doc_ingreso),
                'nro_documento' => $request->nro_doc_ingreso,
                'observacion' => 'SIN OBSERVACION',
                'estado' => 1,
                'sysuser' => Auth::user()->id
            ]);

            foreach ($request->motores as $motor) {
                $aeronave_motor = AeronaveMotor::create([
                    'id_aeronave' => $aeronave->id,
                    'posicion' => $motor['posicion_motor'],
                    'fabrica' => mb_strtoupper($motor['fabrica_motor']),
                    'modelo' => mb_strtoupper($motor['modelo_motor']),
                    'serie' => mb_strtoupper($motor['serie_motor']),
                    'estado_motor' => mb_strtoupper($motor['estado_motor']),
                    'observacion' => 'SIN OBSERVACION',
                    'estado' => 1,
                    'sysuser' => Auth::user()->id
                ]);
            }

            $documentos = array($request->cert_matricula,
                                $request->cert_aeronavegabilidad);
            $cantDocument = sizeof($documentos);
            $x = 1;
            for ($i=0; $i < $cantDocument ; $i++) { 
                if($documentos[$i] != ""){
                    $exploded = explode(',', $documentos[$i]);
                    $decoded = base64_decode($exploded[1]);
                    if (Str::contains($exploded[0], 'pdf')) {
                        $extension = 'pdf';
                    } else {
                        $extension = 'pdf';
                    }
                    $documentName = $x.'_'.mb_strtoupper($request->matricula).'_'.mb_strtoupper($request->serie).'.'.$extension;
                    $path = public_path().'/document/aeronave/'.$documentName;
                    file_put_contents($path, $decoded);
                    $x++;
                    $aeronave_documento = AeronaveDocumento::create([
                        'id_aeronave' => $aeronave->id,
                        'documento' => $documentName,
                        'observacion' => 'SIN OBSERVACION',
                        'estado' => 1,
                        'sysuser' => Auth::user()->id
                    ]);
                }
                else{
                    $x++;
                }
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Aeronave registrada correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al registrar la Aeronave.', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function ListarAeronave(Request $request) //DGAE
    {
        $buscar = $request->buscar;
        if ($request->buscar == '') {
            $aeronave = DB::table('aeronaves as a')
                        ->join('aeronave_designacions as ad', 'ad.id_aeronave', 'a.id')
                        ->select('a.id',
                                'ad.matricula',
                                'a.modelo',
                                'a.serie',
                                'a.fotografia')
                        ->where('a.estado',1)
                        ->where('ad.estado', 1)
                        ->orderBy('a.id', 'desc')
                        ->paginate(10);
            // $aeronave = DB::table('personals as p')
            //         ->join('nacionalidads as n','n.id','p.id_nacionalidad')
            //         ->join('personal_licencias as pl','pl.id_personal','p.id')
            //         ->join('categorias as c','c.id','pl.id_categoria')
            //         ->join('entidads as e','e.id','pl.id_entidad')
            //         ->join('grados as g','g.id','pl.id_grado')
            //         ->join('licencias as l','l.id','pl.id_licencia')
            //         ->join('habilitacions as h','h.id','pl.id_habilitacion')
            //         ->join('competencia_linguisticas as cl','cl.id','pl.id_comp_linguistica')
            //         ->select('p.id',
            //                 'c.id as id_categoria',
            //                 'c.categoria',
            //                 'n.id as id_nacionalidad',
            //                 'n.nacionalidad',
            //                 'e.id as id_entidad',
            //                 'e.entidad',
            //                 'g.id as id_grado',
            //                 'g.nombre',
            //                 'g.abreviatura',
            //                 'p.per_foto',
            //                 'p.per_ci',
            //                 'p.per_cm',
            //                 'p.per_nombre',
            //                 'p.per_paterno',
            //                 'p.per_materno',
            //                 'p.per_sexo',
            //                 'p.per_celular',
            //                 'p.per_mail',
            //                 'p.per_fecha_nacimiento',
            //                 'p.per_direccion',
            //                 'l.id as id_licencia',
            //                 'l.licencia',
            //                 'h.id as id_habilitacion',
            //                 'h.habilitacion',
            //                 'cl.id as id_complinguistica',
            //                 'cl.nivel',
            //                 'pl.observacion')
            //         ->where('pl.estado',1)
            //         ->orderBy('p.id', 'desc')
            //         ->paginate(10);
        } else {
            $aeronave = DB::table('aeronaves as a')
                        ->join('aeronave_designacions as ad', 'ad.id_aeronave', 'a.id')
                        ->select('a.id',
                                'ad.matricula',
                                'a.modelo',
                                'a.serie',
                                'a.fotografia')
                        ->where(function($q) use ($buscar){
                            $q->where('ad.matricula','LIKE','%'.$buscar.'%')
                            ->orWhere('a.modelo','LIKE','%'.$buscar.'%')
                            ->orWhere('a.serie','LIKE','%'.$buscar.'%');
                            // ->orWhere('a.per_nombre','LIKE','%'.$buscar.'%');
                        }) 
                        ->where('a.estado',1)
                        ->where('ad.estado', 1)
                        ->orderBy('a.id', 'desc')
                        ->paginate(10);
            // $aeronave = DB::table('personals as p')
            //         ->join('nacionalidads as n','n.id','p.id_nacionalidad')
            //         ->join('personal_licencias as pl','pl.id_personal','p.id')
            //         ->join('categorias as c','c.id','pl.id_categoria')
            //         ->join('entidads as e','e.id','pl.id_entidad')
            //         ->join('grados as g','g.id','pl.id_grado')
            //         ->join('licencias as l','l.id','pl.id_licencia')
            //         ->join('habilitacions as h','h.id','pl.id_habilitacion')
            //         ->join('competencia_linguisticas as cl','cl.id','pl.id_comp_linguistica')
            //         ->select('p.id',
            //                 'c.id as id_categoria',
            //                 'c.categoria',
            //                 'n.id as id_nacionalidad',
            //                 'n.nacionalidad',
            //                 'e.id as id_entidad',
            //                 'e.entidad',
            //                 'g.id as id_grado',
            //                 'g.nombre',
            //                 'g.abreviatura',
            //                 'p.per_foto',
            //                 'p.per_ci',
            //                 'p.per_cm',
            //                 'p.per_nombre',
            //                 'p.per_paterno',
            //                 'p.per_materno',
            //                 'p.per_sexo',
            //                 'p.per_celular',
            //                 'p.per_mail',
            //                 'p.per_fecha_nacimiento',
            //                 'p.per_direccion',
            //                 'l.id as id_licencia',
            //                 'l.licencia',
            //                 'h.id as id_habilitacion',
            //                 'h.habilitacion',
            //                 'cl.id as id_complinguistica',
            //                 'cl.nivel',
            //                 'pl.observacion')
            //         ->where(function($q) use ($buscar){
            //             $q->where('p.per_ci','LIKE','%'.$buscar.'%')
            //             ->orWhere('p.per_paterno','LIKE','%'.$buscar.'%')
            //             ->orWhere('p.per_materno','LIKE','%'.$buscar.'%')
            //             ->orWhere('p.per_nombre','LIKE','%'.$buscar.'%');
            //         }) 
            //         ->where('pl.estado',1)
            //         ->orderBy('p.id', 'desc')
            //         ->paginate(10);
        }
        
        return response()->json([
            'pagination' => [
                'total'         => $aeronave->total(),
                'current_page'  => $aeronave->currentPage(),
                'per_page'      => $aeronave->perPage(),
                'last_page'     => $aeronave->lastPage(),
                'from'          => $aeronave->firstItem(),
                'to'            => $aeronave->lastItem(),
            
            ],
            'aeronave' => $aeronave
        ]); 
    }

    public function DatosAeronave(Request $request)//DGAE
    {
        $aeronave = DB::table('aeronaves as a')
                    ->select('a.id',
                            'a.matricula',
                            'a.modelo',
                            'a.nombre',
                            'a.fotografia')
                    ->where('a.id',$request->aeronave_id)
                    ->where('a.estado',1)
                    ->first();
        
        $aeronave_documento = DB::table('aeronave_documentos as ad')
                    ->select('documento')
                    ->where('id_aeronave',$request->aeronave_id)
                    ->where('estado',1)
                    ->get();

        return ['aeronave' => $aeronave, 'aeronave_documento' => $aeronave_documento];           
    }

    public function RenovarAeronave(Request $request) //DGAE
    {
        $aeronave_foto = Aeronave::select('fotografia')
                    ->where('id',$request->id_aeronave)
                    ->first();

        if($aeronave_foto->fotografia == $request->foto){
            $fileName = $request->foto;
        }
        else{
            if ($request->foto != "") {
                $exploded = explode(',', $request->foto);
                $decoded = base64_decode($exploded[1]);
                if (Str::contains($exploded[0], 'jpeg')) {
                    $extension = 'jpg';
                } else {
                    $extension = 'png';
                }
                // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                // $charactersLength = strlen($characters);
                // $randomString = '';
                // for ($i=0; $i < 10; $i++) {
                //    $randomString .= $characters[rand(0,$charactersLength - 1)];
                // }
                
                $fileName = $request->matricula.'_'.($request->nombre).'.'.$extension;
                $path = public_path().'/img/aeronave/'.$fileName;
                file_put_contents($path, $decoded);
    
            } else {
                $fileName = 'avatar_aeronave.png';
            }
        }

        $aeronave = Aeronave::where('id',$request->id_aeronave)
                    ->first();
        $aeronave -> update([
            'fotografia' => $fileName,
            'matricula' => mb_strtoupper($request->matricula),
            'modelo' => mb_strtoupper($request->modelo),
            'nombre' => mb_strtoupper($request->nombre),
            // 'per_nombre' => mb_strtoupper($request->nombre),
            // 'per_paterno' =>  mb_strtoupper($request->ap_paterno),
            // 'per_materno' => mb_strtoupper($request->ap_materno),
            // 'per_sexo' => $request->sexo,
            // 'per_celular' => $request->celular,
            // 'per_mail' => $request->email,
            // 'per_direccion' => mb_strtoupper($request->direccion),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);

        // $id_personal_max = PersonalLicencia::where('id_personal',$request->id_personal)
        //                     ->max('id');
        
        // $personal_licencia = PersonalLicencia::where('id',$id_personal_max)
        //                     -> update([
        //                     'estado' => '0'
        //                     ]);

        // $personal_licencia = PersonalLicencia::create([
        //     'id_personal' => $request->id_personal,
        //     'id_categoria' => $request->categoria,
        //     'id_entidad' => $request->entidad,
        //     'id_grado' => $request->grado,
        //     'id_licencia' => $request->tit_licencia,
        //     'id_habilitacion' => $request->habilitacion,
        //     'id_comp_linguistica' => $request->linguistica,
        //     'observacion' => mb_strtoupper($request->observacion),
        //     'fecha_emision' => $request->fech_emision,
        //     'fecha_expiracion' => $request->fech_expiracion,
        //     'estado' => '1',
        //     'sysuser' => Auth::user()->id
        // ]);

        return ['aeronave' => $aeronave];
    }
}
