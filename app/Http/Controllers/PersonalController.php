<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Personal;
use App\PersonalDocumento;
use App\PersonalLicencia;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PersonalController extends Controller
{
    public function CrearPersonal(Request $request) //DGAE
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

            $fileName = $request->fech_emision.'_'.($request->ci).'.'.$extension;
            $path = public_path().'/img/personal/'.$fileName;
            file_put_contents($path, $decoded);

        } else {
            $fileName = 'avatar.png';
        }

        $personal = Personal::create([
            'per_foto' => $fileName,
            'id_nacionalidad' => $request->nacionalidad,
            'per_ci' => $request->ci,
            'per_cm' => $request->cm,
            'per_nombre' => mb_strtoupper($request->nombre),
            'per_paterno' =>  mb_strtoupper($request->ap_paterno),
            'per_materno' => mb_strtoupper($request->ap_materno),
            'per_sexo' => $request->sexo,
            'per_celular' => $request->celular,
            'per_mail' => $request->email,
            'per_fecha_nacimiento' => $request->fech_nac,
            'per_direccion'=> mb_strtoupper($request->direccion),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);

        $personal_licencia = PersonalLicencia::create([
            'id_personal' => $personal->id,
            'id_categoria' => $request->categoria,
            'id_entidad' => $request->entidad,
            'id_grado' => $request->grado,
            'id_licencia' => $request->tit_licencia,
            'id_habilitacion' => $request->habilitacion,
            'id_comp_linguistica' => $request->linguistica,
            'observacion' => mb_strtoupper($request->observacion),
            'fecha_emision' => $request->fech_emision,
            'fecha_expiracion' => $request->fech_expiracion,
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);

        $documentos = array($request->doc_carnet_identidad,
                            $request->doc_cert_nacimineto,
                            $request->doc_cert_egreso,
                            $request->doc_cert_espe,
                            $request->doc_cert_medico,
                            $request->doc_dip_titulo,
                            $request->doc_lib_mil,
                            $request->doc_exa_aprobacion);
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
                $documentName = $x.'_'.($request->ci).'.'.$extension;
                $path = public_path().'/document/personal/'.$documentName;
                file_put_contents($path, $decoded);
                $x++;
                $personal_documento = PersonalDocumento::create([
                    'id_personal' => $personal->id,
                    'id_licencia' => $personal_licencia->id,
                    'documento' => $documentName,
                    'estado' => '1',
                    'sysuser' => Auth::user()->id
                ]);
            }
            else{
                $x++;
            }
        }

        return ['personal' => $personal_licencia];
    }
    /**
     * FUNCION PARA EL LISTADOR DE PERSONAL EN TIEMPO REALs
     */

    public function ListarPersonal(Request $request) //DGAE
    {
        $buscar = $request->buscar;
        if ($request->buscar == '') {
            $personal = DB::table('personals as p')
                    ->join('nacionalidads as n','n.id','p.id_nacionalidad')
                    ->join('personal_licencias as pl','pl.id_personal','p.id')
                    ->join('categorias as c','c.id','pl.id_categoria')
                    ->join('entidads as e','e.id','pl.id_entidad')
                    ->join('grados as g','g.id','pl.id_grado')
                    ->join('licencias as l','l.id','pl.id_licencia')
                    ->join('habilitacions as h','h.id','pl.id_habilitacion')
                    ->join('competencia_linguisticas as cl','cl.id','pl.id_comp_linguistica')
                    ->select('p.id',
                            'c.id as id_categoria',
                            'c.categoria',
                            'n.id as id_nacionalidad',
                            'n.nacionalidad',
                            'e.id as id_entidad',
                            'e.entidad',
                            'g.id as id_grado',
                            'g.nombre',
                            'g.abreviatura',
                            'p.per_foto',
                            'p.per_ci',
                            'p.per_cm',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'p.per_sexo',
                            'p.per_celular',
                            'p.per_mail',
                            'p.per_fecha_nacimiento',
                            'p.per_direccion',
                            'l.id as id_licencia',
                            'l.licencia',
                            'h.id as id_habilitacion',
                            'h.habilitacion',
                            'cl.id as id_complinguistica',
                            'cl.nivel',
                            'pl.observacion')
                    ->where('pl.estado',1)
                    ->orderBy('p.id', 'desc')
                    ->paginate(10);
        } else {
            $personal = DB::table('personals as p')
                    ->join('nacionalidads as n','n.id','p.id_nacionalidad')
                    ->join('personal_licencias as pl','pl.id_personal','p.id')
                    ->join('categorias as c','c.id','pl.id_categoria')
                    ->join('entidads as e','e.id','pl.id_entidad')
                    ->join('grados as g','g.id','pl.id_grado')
                    ->join('licencias as l','l.id','pl.id_licencia')
                    ->join('habilitacions as h','h.id','pl.id_habilitacion')
                    ->join('competencia_linguisticas as cl','cl.id','pl.id_comp_linguistica')
                    ->select('p.id',
                            'c.id as id_categoria',
                            'c.categoria',
                            'n.id as id_nacionalidad',
                            'n.nacionalidad',
                            'e.id as id_entidad',
                            'e.entidad',
                            'g.id as id_grado',
                            'g.nombre',
                            'g.abreviatura',
                            'p.per_foto',
                            'p.per_ci',
                            'p.per_cm',
                            'p.per_nombre',
                            'p.per_paterno',
                            'p.per_materno',
                            'p.per_sexo',
                            'p.per_celular',
                            'p.per_mail',
                            'p.per_fecha_nacimiento',
                            'p.per_direccion',
                            'l.id as id_licencia',
                            'l.licencia',
                            'h.id as id_habilitacion',
                            'h.habilitacion',
                            'cl.id as id_complinguistica',
                            'cl.nivel',
                            'pl.observacion')
                    ->where(function($q) use ($buscar){
                        $q->where('p.per_ci','LIKE','%'.$buscar.'%')
                        ->orWhere('p.per_paterno','LIKE','%'.$buscar.'%')
                        ->orWhere('p.per_materno','LIKE','%'.$buscar.'%')
                        ->orWhere('p.per_nombre','LIKE','%'.$buscar.'%');
                    }) 
                    ->where('pl.estado',1)
                    ->orderBy('p.id', 'desc')
                    ->paginate(10);
        }
        
        

        return response()->json([
            'pagination' => [
                'total'         => $personal->total(),
                'current_page'  => $personal->currentPage(),
                'per_page'      => $personal->perPage(),
                'last_page'     => $personal->lastPage(),
                'from'          => $personal->firstItem(),
                'to'            => $personal->lastItem(),
            
            ],
            'personal' => $personal
        ]); 
    }

    public function DatosPersonal(Request $request)//DGAE
    {
        $personal = DB::table('personals as p')
                    ->join('personal_licencias as pl','p.id','pl.id_personal')
                    ->join('nacionalidads as n','p.id_nacionalidad','n.id')
                    ->join('categorias as c','pl.id_categoria','c.id')
                    ->join('entidads as e','pl.id_entidad','e.id')
                    ->join('grados as g','pl.id_grado','g.id')
                    ->join('licencias as l','pl.id_licencia','l.id')
                    ->join('habilitacions as h','pl.id_habilitacion','h.id')
                    ->join('competencia_linguisticas as cl','pl.id_comp_linguistica','cl.id')
                    ->select('p.id as id_personal',
                        'n.id as idnacionalidad',
                        'n.nacionalidad',
                        'n.pais',
                        'p.per_foto',
                        'p.per_nombre',
                        'p.per_paterno',
                        'p.per_materno',
                        'p.per_ci',
                        'p.per_cm',
                        'p.per_sexo',
                        'p.per_fecha_nacimiento',
                        'p.per_celular',
                        'p.per_direccion',
                        'p.per_mail',
                        'pl.id as id_licencia',
                        'pl.id_categoria',
                        'pl.id_entidad',
                        'pl.id_grado',
                        'pl.id_licencia',
                        'pl.id_habilitacion',
                        'pl.id_comp_linguistica',
                        'e.entidad',
                        'g.abreviatura',
                        'l.licencia',
                        'l.traduccion',
                        'h.habilitacion',
                        'h.traduccion as htraduccion',
                        'cl.id as idlinguistica',
                        'cl.nivel',
                        'cl.traduccion as cltraduccion',
                        'pl.observacion',
                        'pl.fecha_emision',
                        'pl.fecha_expiracion'
                        )
                    ->where('p.id',$request->personal_id)
                    ->where('pl.estado',1)
                    ->first();
        return ['personal' => $personal];
    }

    public function RenovarPersonal(Request $request) //DGAE
    {
        $personal_foto = Personal::select('per_foto')
                    ->where('id',$request->id_personal)
                    ->first();

        if($personal_foto->per_foto == $request->foto){
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
                $fileName = $request->fech_emision.'_'.($request->ci).'.'.$extension;
                $path = public_path().'/img/personal/'.$fileName;
                file_put_contents($path, $decoded);
    
            } else {
                $fileName = 'avatar.png';
            }
        }

        $personal = Personal::where('id',$request->id_personal)
                    ->first();
        $personal -> update([
            'per_foto' => $fileName,
            'per_ci' => $request->ci,
            'per_cm' => $request->cm,
            'per_nombre' => mb_strtoupper($request->nombre),
            'per_paterno' =>  mb_strtoupper($request->ap_paterno),
            'per_materno' => mb_strtoupper($request->ap_materno),
            'per_sexo' => $request->sexo,
            'per_celular' => $request->celular,
            'per_mail' => $request->email,
            'per_direccion' => mb_strtoupper($request->direccion),
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);

        $id_personal_max = PersonalLicencia::where('id_personal',$request->id_personal)
                            ->max('id');
        
        $personal_licencia = PersonalLicencia::where('id',$id_personal_max)
                            -> update([
                            'estado' => '0'
                            ]);

        $personal_licencia = PersonalLicencia::create([
            'id_personal' => $request->id_personal,
            'id_categoria' => $request->categoria,
            'id_entidad' => $request->entidad,
            'id_grado' => $request->grado,
            'id_licencia' => $request->tit_licencia,
            'id_habilitacion' => $request->habilitacion,
            'id_comp_linguistica' => $request->linguistica,
            'observacion' => mb_strtoupper($request->observacion),
            'fecha_emision' => $request->fech_emision,
            'fecha_expiracion' => $request->fech_expiracion,
            'estado' => '1',
            'sysuser' => Auth::user()->id
        ]);

        return ['personal' => $personal_licencia];
    }

    //////////////////////////////////////////////////////////////

    /***************FUNCIONES PARA ACCESO DE SISTEMA********************* */
    
    public function DatosPersonalesAcceso(Request $request)
    {
        $percodigo = $request->percodigo;
        $datos = DB::table('personal_escalafones as ep')
            ->join('personals as p','ep.per_codigo','p.per_codigo')
            ->join('grados as g','ep.gra_cod','g.id')
            ->join('personal_estudios as epe','p.per_codigo','epe.per_codigo')
            ->join('estudios as e','epe.est_cod','e.id')
            ->join('personal_situaciones as ps','p.per_codigo','ps.per_codigo')
            ->join('subsituaciones as ss','ps.subsit_cod','ss.id')
            ->join('personal_destinos as pd','p.per_codigo','pd.per_codigo')
            ->join('nivel3_destinos as nd3','pd.d3_cod','nd3.id')
            ->join('nivel2_destinos as nd2','pd.d2_cod','nd2.id')
            ->select('p.per_codigo as percodigo','p.per_foto as foto','p.per_nombre as nombre','p.per_paterno as paterno','p.per_materno as materno','p.per_cm as cm',
                        'p.per_ci as ci', 'p.per_expedido as expedido', 'p.per_mail as email','g.abreviatura as grado','e.abreviatura as complemento',
                        'ss.nombre as situacion','nd2.descripcion as des2','nd3.descripcion as des3')
            ->where('ep.per_codigo',$percodigo)
            ->where('ps.estado',1)
            ->where('ep.estado',1)
            ->where('epe.estado',1)
            ->where('pd.estado',1)
            ->first();

            return response()->json($datos);
    }
}
