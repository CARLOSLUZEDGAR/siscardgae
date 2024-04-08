<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\mc_table;
use DateTime;

class ReporteDatosPersonalesController extends mc_table
{
    public function createPDF(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '10240M');
        // $conn = pg_pconnect('host=192.168.3.81 port=5432 dbname=sipefab_prod user=postgres password=4$Ku8&_d@B/9in*0w%');
        $conn = pg_pconnect('host=127.0.0.1 port=5433 dbname=sipefabFinal user=postgres password=lu12ed29');

        $datos_personales = pg_query($conn,"SELECT
        personals.per_codigo,
        concat(grados.abreviatura,estudios.abreviatura,' ',personals.per_nombre,' ',personals.per_paterno,' ',personals.per_materno) as grado_nombre,
        concat(nivel2_destinos.descripcion,' <-> ',nivel3_destinos.descripcion) as destino_actual,
        concat(especialidades.nombre,' <-> ',subespecialidades.nombre) as especialidad_actual
        
        FROM  personals 
        left join personal_escalafones on personal_escalafones.per_codigo = personals.per_codigo
        join grados on personal_escalafones.gra_cod = grados.id
        left join personal_estudios ON personals.per_codigo = personal_estudios.per_codigo
        join estudios on personal_estudios.est_cod = estudios.id
        left join personal_situaciones ON personals.per_codigo = personal_situaciones.per_codigo 
        left join personal_destinos on personal_destinos.per_codigo = personals.per_codigo
        join nivel2_destinos on personal_destinos.d2_cod = nivel2_destinos.id
        join nivel3_destinos on personal_destinos.d3_cod = nivel3_destinos.id
        join nivel4_destinos on personal_destinos.d4_cod = nivel4_destinos.id
        left join personal_especialidades on personal_especialidades.per_codigo = personals.per_codigo
        join especialidades on personal_especialidades.espe_cod = especialidades.id
        join subespecialidades on personal_especialidades.subespe_cod = subespecialidades.id
        
        WHERE     (personal_escalafones.estado = 1) AND (personal_destinos.estado = 1) AND
        
                                (personal_situaciones.sit_cod  = '1') AND (personal_situaciones.detsit_cod = 1 OR
                                personal_situaciones.detsit_cod = 2 OR
                                personal_situaciones.detsit_cod = 4 OR
                                personal_situaciones.detsit_cod = 5 OR
                                personal_situaciones.detsit_cod = 8 OR
                                personal_situaciones.detsit_cod = 9 OR
                                personal_situaciones.detsit_cod = 11 OR
                                personal_situaciones.detsit_cod = 13 OR
                                personal_situaciones.detsit_cod = 14 OR
                                personal_situaciones.detsit_cod = 16 OR
                                personal_situaciones.detsit_cod = 17 OR
                                personal_situaciones.detsit_cod = 29 OR
                                personal_situaciones.detsit_cod = 30 OR
                                personal_situaciones.detsit_cod = 31 OR
                                personal_situaciones.detsit_cod = 32 OR
                                personal_situaciones.detsit_cod = 33) AND (personal_situaciones.estado = 1)
                                AND
                                (personal_destinos.estado = 1) AND (grados.fuerza = 'FAB')
                                AND personal_estudios.estado = 1 and personal_especialidades.estado = 1
        
        ORDER BY
            personal_escalafones.esca_cod,
            personal_escalafones.subesc_cod,
            personal_escalafones.gra_cod,
            personals.per_cm;");

        // $cantDatosPersonales = sizeof($datos_personales);
        $arrayDatosPersonales = pg_fetch_array($datos_personales);


        $pdf = new ReporteDatosPersonalesController ('L','mm','Letter');
        $title = 'DATOS PERSONAL';
        $pdf->SetTitle($title);
        $pdf->AddPage();
	    $pdf->SetMargins(20,30,20);
	    $pdf->AliasNbPages();

        $pdf->SetFont('Arial','B',8);
        $pdf->SetY(30);
        $pdf->SetX(20);
        $pdf->Cell(57,3,utf8_decode('FUERZA AÉREA BOLIVIANA'),0,0,'C');
        $pdf->SetY(33);
        $pdf->Cell(57,3,utf8_decode('DEPARTAMENTO I - PERSONAL EMGFAB'),0,0,'C');
        $pdf->SetY(36);
        $pdf->SetFont('Arial','BU',8);
        $pdf->Cell(57,3,utf8_decode('BOLIVIA'),0,0,'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',14);
        $pdf->SetX(20);
        $pdf->Cell(240,5,utf8_decode('DATOS PERSONALES'),0,0,'C');
        $pdf->Ln(10);
        $x = 0;
        $pdf->SetFont('Arial','',8);
        pg_result_seek($datos_personales, 0);
        while($con = pg_fetch_array($datos_personales)){
            $pdf->SetX(20);
            $pdf->SetFillColor(232,232,232);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetWidths(Array(10,60,60,60,50));
            $pdf->SetAligns(Array('C','L','L','L'));
            $pdf->SetLineHeight(5);
            $pdf->Cell(10,5,'NRO.',1,0,'C',1);
            $pdf->Cell(60,5,'GRADO, NOMBRES Y APELLIDOS',1,0,'C',1);
            $pdf->Cell(60,5,'DESTINO ACTUAL',1,0,'C',1);
            $pdf->Cell(60,5,'ESPECIALIDAD ACTUAL',1,0,'C',1);
            $pdf->Cell(50,5,'TIEMPO EN FRONTERA',1,0,'C',1);
            $pdf->Ln();
            $x = $x + 1;
            $destinos = pg_query($conn,"SELECT personals.per_codigo,
                                                personal_destinos.fecha_destino,
                                                nivel3_destinos.frontera 
                                        FROM personals 
                                        LEFT JOIN personal_destinos ON personal_destinos.per_codigo = personals.per_codigo
                                        JOIN nivel3_destinos ON nivel3_destinos.id = personal_destinos.d3_cod
                                        WHERE personals.per_codigo = $con[per_codigo]
                                        AND personal_destinos.flag = 1
                                        ORDER BY personal_destinos.fecha_destino;");
            $arrayDestinos = pg_fetch_all($destinos);
            $cantDestinos = pg_numrows($destinos);
            $fechaact = date('Y-m-d');
            $y = 0;
            $nume = 0;
            $dteNow = new DateTime('now');
            $dteDiff = new DateTime('now');
            for ($i=0; $i < $cantDestinos ; $i++) { 
                $y = $i + 1;
                if($arrayDestinos[$i]['frontera'] == 1){
                    if ($y<$cantDestinos){
                        $date1 = new DateTime($arrayDestinos[$i]['fecha_destino']);
                        $date2 = new DateTime($arrayDestinos[$y]['fecha_destino']);
                        $diffe = $date1->diff($date2);
                        $dteDiff->add($diffe);
                        //sacar la diferencia en dias
                        $diferencia = $diffe->days;
                    }else{
                        $date1 = new DateTime($arrayDestinos[$i]['fecha_destino']);
                        $date2 = new DateTime($fechaact);
                        $diffe = $date1->diff($date2);
                        $dteDiff->add($diffe);
                        $diferencia = $diffe->days;
                    }
                }
            }
            $tiempoTotalFrontera =  $dteDiff->diff($dteNow);
                $pdf->SetFont('Arial','',8);
                $pdf->Row(Array(
                    $x,
                    utf8_decode($con['grado_nombre']),
                    utf8_decode($con['destino_actual']),
                    utf8_decode($con['especialidad_actual']),
                    utf8_decode($tiempoTotalFrontera->y.' AÑO(S), '.$tiempoTotalFrontera->m.' MES(ES), '.$tiempoTotalFrontera->d.' DÍA(S)')
                ));
                $cursos = pg_query($conn,"SELECT personal_cursos.descripcion as percurdesc,
                                                personal_cursos.fecha_otorgacion
                                        FROM personals
                                        LEFT JOIN personal_cursos ON personal_cursos.per_codigo = personals.per_codigo
                                        WHERE personals.per_codigo = $con[per_codigo]
                                        AND personal_cursos.estado = 1
                                        AND personal_cursos.cur_cod in (2,3,4,5,6,7,8,9,13)
                                        ORDER BY personal_cursos.fecha_otorgacion");
                $cantCursos = pg_numrows($cursos);
                // $pdf->SetFont('Arial','B',8);
                // $pdf->Cell(240,5,'CURSO',1,0,'C',1);
                // $pdf->Ln();
                $pdf->SetX(20);
                $pdf->SetFillColor(232,232,232);
                $pdf->SetFont('Arial','B',8);
                $pdf->SetWidths(Array(240));
                $pdf->SetAligns(Array('L'));
                $pdf->SetLineHeight(5);
                $pdf->Cell(240,5,'CURSOS REALIZADOS',1,0,'C',1);
                $pdf->Ln();
                pg_result_seek($cursos, 0);
                if($cantCursos != 0){
                    while($cur = pg_fetch_array($cursos)){
                        $date = date_create($cur['fecha_otorgacion']);
                        $fechaotorgacion = date_format($date,"d/m/Y");
                        $pdf->SetFont('Arial','',8);
                        $pdf->Row(Array(  
                            utf8_decode($cur['percurdesc'].' DE FECHA '.$fechaotorgacion)
                        ));
                    }
                }else{
                    $pdf->SetFont('Arial','',8);
                    $pdf->Row(Array(  
                        utf8_decode('NO CUENTA CON REGISTROS.')
                    ));
                }
        }

        $pdf->SetX(20);
        ob_clean();
        $pdf->SetX(20);
        $pdf->Output();
        $pdf->SetX(20);
        exit;
    }
}
