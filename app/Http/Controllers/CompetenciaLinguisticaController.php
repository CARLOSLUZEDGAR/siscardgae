<?php

namespace App\Http\Controllers;
use App\CompetenciaLinguistica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompetenciaLinguisticaController extends Controller
{
    public function CrearCompetenciaLinguistica(Request $request) //BASE
    {

    }

    public function EditarCompetenciaLinguistica(Request $request) //BASE
    {
        
    }

    public function EliminarCompetenciaLinguistica(Request $request) //BASE
    {
        
    }

    public function ListarCompetenciaLinguistica(Request $request) //BASE
    {
        $comp_linguistica = DB::table('competencia_linguisticas')
                ->select('id', 'nivel', 'observacion')
                ->where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();
                return ['comp_linguisticas' => $comp_linguistica];
    }
}
