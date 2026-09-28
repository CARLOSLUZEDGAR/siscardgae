<?php

namespace App\Http\Controllers;

use App\Entidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EntidadController extends Controller
{
    public function CrearEntidad(Request $request) //BASE
    {
        try {
            $request->validate([
                // 'id_nacionalidad'   => 'required',
                'entidad'           => 'required',
                'sigla'             => 'required'
            ]);

            // VERIFICAR SI LA ENTIDAD YA EXISTE

            $existeEntidad = DB::table('entidads')
                    ->where('entidad', $request->entidad)
                    ->exists();
            
            if ($existeEntidad) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'La entidad ya se encuentra registrada.'
                ], 200);
            }

            DB::beginTransaction();

            Entidad::create([
                'id_nacionalidad' => $request->pais,
                'entidad' => mb_strtoupper($request->entidad),
                'sigla' => mb_strtoupper($request->sigla),
                'estado' => '1',
                'sysuser' => Auth::user()->id
            ]);

            // CONFIRMAR
             DB::commit();

             return response()->json([
                    'success' => true,
                    'mensaje' => 'Entidad registrada correctamente.'
             ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'mensaje' => 'Ocurrió un error al registrar la entidad',
                'error'   => $e->getMessage()
            ], 500);
        }  
    }

    public function EditarEntidad(Request $request) //BASE
    {
        
    }

    public function EliminarEntidad(Request $request) //BASE
    {
        
    }

    public function ListarEntidad(Request $request) //BASE
    {
        $nacionalidad = $request->id_nacionalidad;
        
        $entidad = DB::table('entidads')
                ->select('id', 'id_nacionalidad', 'entidad', 'sigla')
                ->where('estado', 1)
                ->where('id_nacionalidad', $nacionalidad)
                ->orderBy('entidad', 'asc')
                ->get();
                return ['entidades' => $entidad];
    }
}
