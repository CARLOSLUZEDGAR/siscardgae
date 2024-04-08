<?php

namespace App\Http\Controllers;

use App\Datos_familiares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosFamiliaresController extends Controller
{
    //

    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');//si la peticion no es tipo ajax que nos rerotne a la pagina prncipal
        //$usuarios = Usuario::all(); //con esta sentencia obtenemos todos los valores de la tabla usuario
        //return $usuarios; //con esto retornamos los valores

        $buscar = $request->per_codigo;
        $criterio = $request->criterio;

        if($buscar==''){
            $datos_familiares = Datos_familiares::orderBy('id','desc')->get();
        }
        else{
            $datos_familiares = Datos_familiares::Where('per_codigo','=',$buscar)
            ->Where('estado','=','1')
            ->orderBy('id','desc')->get();
        }

        return response()->json(['datos_familiares' => $datos_familiares]);
    }

    public function store(Request $request) /* New registro */
    {
        if(!$request->ajax()) return view('/');
        $datos_familiares = new Datos_familiares();        
        $datos_familiares->per_codigo         = $request->datfam_percodigo;
        $datos_familiares->cinstitucional    = $request->datfam_cinstitucional;
        $datos_familiares->nombre            = $request->datfam_nombre;
        $datos_familiares->paterno           = $request->datfam_paterno;
        $datos_familiares->materno           = $request->datfam_materno;
        $datos_familiares->fecha_nac            = $request->datfam_fecnac;
        $datos_familiares->parentesco        = $request->datfam_parentesco;
        $datos_familiares->sexo              = $request->datfam_sexo;
        $datos_familiares->domicilio         = $request->datfam_domicilio;
        $datos_familiares->telefono          = $request->datfam_telefono;
        $datos_familiares->celular           = $request->datfam_celular; 
        $datos_familiares->cossmil           = $request->datfam_cossmil;
        $datos_familiares->cidentidad        = $request->datfam_cidentidad;
        $datos_familiares->expedido          = $request->datfam_expedido;
        $datos_familiares->profesion         = $request->datfam_profesion;
        $datos_familiares->profmil           = $request->datfam_profmil;
        $datos_familiares->profdesc          = $request->datfam_profdesc;
        $datos_familiares->proflugar            = $request->datfam_telfof;
        $datos_familiares->gs                = $request->datfam_gs;
        $datos_familiares->depa_cod           = $request->famdepa_codigo;
        $datos_familiares->prov_cod           = $request->famprov_codigo;
        $datos_familiares->loca_cod           = $request->famloca_codigo;
        $datos_familiares->estado = '1';
        $datos_familiares->observacion = $request->observacion;
        $datos_familiares->sysuser = Auth::user()->id;
        
        $datos_familiares->save();
    }


    public function update(Request $request)
    {

        if(!$request->ajax()) return view('/');
        $datos_familiares = Datos_familiares::findOrFail($request->id);
        $datos_familiares->per_codigo         = $request->datfam_percodigo;
        $datos_familiares->cinstitucional    = $request->datfam_cinstitucional;
        $datos_familiares->nombre            = $request->datfam_nombre;
        $datos_familiares->paterno           = $request->datfam_paterno;
        $datos_familiares->materno           = $request->datfam_materno;
        $datos_familiares->fecha_nac            = $request->datfam_fecnac;
        $datos_familiares->parentesco        = $request->datfam_parentesco;
        $datos_familiares->sexo              = $request->datfam_sexo;
        $datos_familiares->domicilio         = $request->datfam_domicilio;
        $datos_familiares->telefono          = $request->datfam_telefono;
        $datos_familiares->celular           = $request->datfam_celular; 
        $datos_familiares->cossmil           = $request->datfam_cossmil;
        $datos_familiares->cidentidad        = $request->datfam_cidentidad;
        $datos_familiares->expedido          = $request->datfam_expedido;
        $datos_familiares->profesion         = $request->datfam_profesion;
        $datos_familiares->profmil           = $request->datfam_profmil;
        $datos_familiares->profdesc          = $request->datfam_profdesc;
        $datos_familiares->proflugar            = $request->datfam_telfof;
        $datos_familiares->gs                = $request->datfam_gs;
        $datos_familiares->depa_cod           = $request->famdepa_codigo;
        $datos_familiares->prov_cod           = $request->famprov_codigo;
        $datos_familiares->loca_cod           = $request->famloca_codigo;
        $datos_familiares->estado = '1';
        $datos_familiares->observacion = $request->observacion;
        $datos_familiares->sysuser = Auth::user()->id;
        
        $datos_familiares->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datos_familiares = Datos_familiares::findOrFail($request->id);
        $datos_familiares->estado = '0';
        $datos_familiares->save();
    }

    public function excluirDatosFamiliares(Request $request)
    {
        $fecha_max_update= Datos_familiares::
      
        where('datfam_percodigo', $request->datfam_percodigo)
        ->max('updated_at');
        //return ['postulantes' => $postulantes];

       /* $post_notin = DB::table('postulante_estados')->select('id_postulante','fecha_doc')
        ->whereNotIn('fecha_doc', [$postulantes])
        ->where('id_postulante', '=', 31)
        ->get();*/

        $excluir = Datos_familiares::
        where('datfam_percodigo', $request->datfam_percodigo)
        ->where('datfam_parentesco','=','ESPOSO(A)')
       ->whereNotIn('updated_at', [$fecha_max_update])
        ->update(['estado' => 0]);
        
    }

    

    
}
