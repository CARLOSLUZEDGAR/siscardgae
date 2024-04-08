<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CUADRO DE EFECTIVO TOTAL</title>
    <!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> --}}
<style>
        @page{
            /*margin: 0rem;
            margin-top:0rem;
            padding: 1rem;*/
            margin: 0cm 0cm;
        }
        body {
            /*margin: 0px;*/
            margin-top: 2cm;
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 3cm;
            margin-right: 2cm;
            
            /* border: 1px solid #C00; */
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 2cm;
            
            color: black;
            text-align: right;
            /*line-height: 10px;
            font-size: 9px;*/
            /* border: 1px solid #C00; */
            /* padding-top: 5px;
            padding-bottom: 0px; */
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 3cm;
            right: 2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            /*text-align: right;*/
            line-height: 24px;
            /*font-size: 9px;*/
            /* border: 1px solid #C00; */
        }


        * {
            font-family: verdana, arial, sans-serif;
        }
        
        .rotate {
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            width: 1.5em;
        }
        .rotate div {
            -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
            -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
            -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
            filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
        }
    </style>
</head>
<body>

<header>        
    
</header> 

<footer>
    <div>
        <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            /* border: black 1px; */
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 9pt; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: 
                            <?php

use PHPUnit\Util\Json;

                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 9pt; text-align: right; font-weight: bold;">
                        <span>Desarrollado por la: DIGETIC - 
                            <?php
                                $gestion_act = date("Y");
                                echo $gestion_act;
                             ?>
                        </span>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
</footer>
    <main>  
        <div class="cabecera">                    
            <div style="padding-top: 0px; padding-bottom: 0px;">
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                                <div style="text-align: center; width: 266px; font-size: 10pt; /*border: 1px solid #C00;*/ padding: 0px;">
                                    <p style="margin: 0px; /*border: 1px solid #C00;*/">FUERZA AÉREA BOLIVIANA</p>
                                    <p style="margin: 0px; /*border: 1px solid #C00;*/">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                                    <p style="margin: 0px; /*border: 1px solid #C00;*/"><u><strong>BOLIVIA</strong></u></p>
                                </div>
                            </td>
                        </tr>  
                    </tbody>
                </table>
            </div>
            <?php
                $gestion = date('Y');                               
            ?>
            <div style="padding-top: 0.2cm; padding-bottom: 0.1cm; text-align: center; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                
                <p style="margin: 0px;"><u>CUADRO DE EFECTIVOS DEL PERSONAL DE ARMAS Y PERSONAL CIVIL DE LA FUERZA AÉREA BOLIVIANA GESTIÓN <?php echo $gestion; ?></u></p>               
            </div>

            <?php
                $cantSubescGradoGen = sizeof($subescalafon_genero);
                $cantGenero = sizeof($genero);
                $cantFemenino = sizeof($femenino);
                $cantMasculino = sizeof($masculino);
                $cantSubescalafonCant = sizeof($subescalafon_cant);
                $cantGeneroCant = sizeof($genero_cant);

                $arraySubescGradoGen = json_decode($subescalafon_genero,true);
                $arrayGenero = json_decode($genero,true);
                $arrayFemenino = json_decode($femenino,true);
                $arrayMasculino = json_decode($masculino,true);
                $arraySubescalafonCant = json_decode($subescalafon_cant,true);
                $arrayGeneroCant = json_decode($genero_cant,true);

                // $arrayGenero = json_decode($genero,true);
            ?>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px;" class="table table-bordered table-striped">
                    <tr>
                        <td colspan="4" style="/*border: 1px solid #000;*/ padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div></div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 8pt; text-align: center; font-weight: bold;"><div>DAMAS</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 8pt; text-align: center; font-weight: bold;"><div>VARONES</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 8pt; text-align: center; font-weight: bold;"><div>TOTAL</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 8pt; text-align: center; font-weight: bold;"><div>TOTAL GRAL.</div></td>
                    </tr>
                    <tr>
                        <td rowspan="25" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 12pt; text-align: center; font-weight: bold;" class="rotate"><div>PERSONAL DE CUADROS</div></td>
                        <td rowspan="9" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>OFICIALES</div></td>
                        <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>OFICIALES<br>GENERALES</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>FUERZA</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 1){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 1){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotalgf = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotalgf.'</td>';

                            
                            // echo '<td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; font-weight: bold;"><div>'.$gradoTotalg.'</div></td>';
                        ?>
                        @foreach($subescalafon_cant as $row)
                            @if($row->idsubescalafon == 1)
                                <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>{{$row->cantidad}}</div></td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>DIVISIÓN</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 2){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 2){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotalgd = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotalgd.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>BRIGADA</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 3){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 3){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotalgb = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotalgb.'</td>';


                        ?>
                    </tr>
                    <tr>
                        <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>OFICIALES<br>SUPERIORES</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>CORONEL</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 4){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 4){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                        @foreach($subescalafon_cant as $row)
                            @if($row->idsubescalafon == 2)
                                <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>{{$row->cantidad}}</div></td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>TENIENTE CORONEL</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 5){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 5){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>MAYOR</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 6){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 6){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>   
                    </tr>
                    <tr>
                        <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>OFICIALES<br>SUBALTERNOS</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>CAPITAN</div></td>
                        
                        <?php
                           $ifem = 0;
                           $totalfem = 0;
                           while ($ifem < $cantFemenino) { 
                               if ($arrayFemenino[$ifem]['idgrado'] == 7){
                                   echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                   $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                   $ifem = $cantFemenino + 1;
                                   break;
                               }else{
                                   $ifem++;
                               }
                           }  
                           
                           $jmasc = 0;
                           $totalmasc = 0;
                           while ($jmasc < $cantMasculino) { 
                               if ($arrayMasculino[$jmasc]['idgrado'] == 7){
                                   if ($ifem == $cantFemenino){
                                       echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                       echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                       $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                       $jmasc = $cantMasculino + 1;
                                       break;
                                   }else{
                                       echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                       $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                       $jmasc = $cantMasculino + 1;
                                       break; 
                                   }
                               }else{
                                   $jmasc++; 
                               }
                           }
                           //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                           if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                               echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                               echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                           }
                           $gradoTotal = $totalfem + $totalmasc;
                           echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                        @foreach($subescalafon_cant as $row)
                            @if($row->idsubescalafon == 3)
                                <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>{{$row->cantidad}}</div></td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>TENIENTE</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 8){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 8){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBTENIENTE</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 9){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 9){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td rowspan="8" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>TECNICOS</div></td>
                        <td rowspan="5" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>SUBOFICIALES</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL MAESTRE</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 10){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 10){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';

                            $subescalafon_total = 0;
                            $k = 0;
                            while ($k < $cantSubescalafonCant) { 
                                if ($arraySubescalafonCant[$k]['idsubescalafon'] == 4 || $arraySubescalafonCant[$k]['idsubescalafon'] == 5){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $subescalafon_total = $subescalafon_total + $arraySubescalafonCant[$k]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $k++;
                                    
                                }else{
                                    $k++;
                                }
                            }  
                            echo '<td rowspan="5" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>'.$subescalafon_total.'</div></td>';

                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL MAYOR</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 11){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 11){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL PRIMERO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 12){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 12){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                        
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL SEGUNDO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 13){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 13){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL INICIAL</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 14){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 14){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>SARGENTOS</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTO PRIMERO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 15){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 15){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                        @foreach($subescalafon_cant as $row)
                            @if($row->idsubescalafon == 6)
                                <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>{{$row->cantidad}}</div></td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTO SEGUNDO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 16){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 16){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTO INICIAL</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 17){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 17){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td rowspan="8" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>DE MUSICA</div></td>
                        <td rowspan="5" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>SUBOFICIALES</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL MAESTRE</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 164){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 164){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';

                            $subescalafon_total = 0;
                            $k = 0;
                            while ($k < $cantSubescGradoGen) { 
                                if ($arraySubescGradoGen[$k]['idgrado'] == 164 || $arraySubescGradoGen[$k]['idgrado'] == 165 || $arraySubescGradoGen[$k]['idgrado'] == 166 || $arraySubescGradoGen[$k]['idgrado'] == 168 || $arraySubescGradoGen[$k]['idgrado'] == 169){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $subescalafon_total = $subescalafon_total + $arraySubescGradoGen[$k]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $k++;
                                    
                                }else{
                                    $k++;
                                }
                            }  
                            echo '<td rowspan="5" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>'.$subescalafon_total.'</div></td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL MAYOR</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 165){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 165){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL PRIMERO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 166){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 166){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL SEGUNDO</div></td>
                        <?php
                           $ifem = 0;
                           $totalfem = 0;
                           while ($ifem < $cantFemenino) { 
                               if ($arrayFemenino[$ifem]['idgrado'] == 168){
                                   echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                   $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                   $ifem = $cantFemenino + 1;
                                   break;
                               }else{
                                   $ifem++;
                               }
                           }  
                           
                           $jmasc = 0;
                           $totalmasc = 0;
                           while ($jmasc < $cantMasculino) { 
                               if ($arrayMasculino[$jmasc]['idgrado'] == 168){
                                   if ($ifem == $cantFemenino){
                                       echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                       echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                       $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                       $jmasc = $cantMasculino + 1;
                                       break;
                                   }else{
                                       echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                       $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                       $jmasc = $cantMasculino + 1;
                                       break; 
                                   }
                               }else{
                                   $jmasc++; 
                               }
                           }
                           //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                           if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                               echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                               echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                           }
                           $gradoTotal = $totalfem + $totalmasc;
                           echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIAL INICIAL</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 169){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 169){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 5pt; text-align: center; /*font-weight: bold;*/" class="rotate"><div>SARGENTOS</div></td>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTO PRIMERO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 170){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 170){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';

                            $subescalafon_total = 0;
                            $k = 0;
                            while ($k < $cantSubescGradoGen) { 
                                if ($arraySubescGradoGen[$k]['idgrado'] == 170 || $arraySubescGradoGen[$k]['idgrado'] == 171 || $arraySubescGradoGen[$k]['idgrado'] == 172){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $subescalafon_total = $subescalafon_total + $arraySubescGradoGen[$k]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $k++;
                                    
                                }else{
                                    $k++;
                                }
                            }  
                            echo '<td rowspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>'.$subescalafon_total.'</div></td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTO SEGUNDO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 171){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 171){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTO INICIAL</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 172){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 172){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>


                    <tr>
                        <td rowspan="8" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; padding-left: 0.5cm; padding-right: 0.5cm; font-size: 12pt; text-align: center; font-weight: bold;" class="rotate"><div>PERSONAL CIVIL</div></td>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>OFICIALES DE SERVICIO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 18 || $arrayFemenino[$ifem]['idgrado'] == 19 || $arrayFemenino[$ifem]['idgrado'] == 20){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 18 || $arrayMasculino[$jmasc]['idgrado'] == 19 || $arrayMasculino[$jmasc]['idgrado'] == 20){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';

                            $subescalafon_total = 0;
                            $k = 0;
                            while ($k < $cantSubescalafonCant) { 
                                if ($arraySubescalafonCant[$k]['idsubescalafon'] == 7 || $arraySubescalafonCant[$k]['idsubescalafon'] == 8 || $arraySubescalafonCant[$k]['idsubescalafon'] == 9 || $arraySubescalafonCant[$k]['idsubescalafon'] == 10 || $arraySubescalafonCant[$k]['idsubescalafon'] == 11 || $arraySubescalafonCant[$k]['idsubescalafon'] == 12){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $subescalafon_total = $subescalafon_total + $arraySubescalafonCant[$k]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $k++;
                                    
                                }else{
                                    $k++;
                                }
                            }  
                            echo '<td rowspan="8" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>'.$subescalafon_total.'</div></td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SUBOFICIALES DE SERVICIO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 24 || $arrayFemenino[$ifem]['idgrado'] == 25){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 24 || $arrayMasculino[$jmasc]['idgrado'] == 25){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTOS DE SERVICIO</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 28){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 28){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>PROFESIONALES</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 29 || $arrayFemenino[$ifem]['idgrado'] == 30 || $arrayFemenino[$ifem]['idgrado'] == 31 || $arrayFemenino[$ifem]['idgrado'] == 32 || $arrayFemenino[$ifem]['idgrado'] == 33){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 29 || $arrayMasculino[$jmasc]['idgrado'] == 30 || $arrayMasculino[$jmasc]['idgrado'] == 31 || $arrayMasculino[$jmasc]['idgrado'] == 32 || $arrayMasculino[$jmasc]['idgrado'] == 33){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>TECNICOS</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 34 || $arrayFemenino[$ifem]['idgrado'] == 35 || $arrayFemenino[$ifem]['idgrado'] == 36 || $arrayFemenino[$ifem]['idgrado'] == 37 || $arrayFemenino[$ifem]['idgrado'] == 38){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 34 || $arrayMasculino[$jmasc]['idgrado'] == 35 || $arrayMasculino[$jmasc]['idgrado'] == 36 || $arrayMasculino[$jmasc]['idgrado'] == 37 || $arrayMasculino[$jmasc]['idgrado'] == 38){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>ADMINISTRATIVOS</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 39 || $arrayFemenino[$ifem]['idgrado'] == 40 || $arrayFemenino[$ifem]['idgrado'] == 41 || $arrayFemenino[$ifem]['idgrado'] == 42 || $arrayFemenino[$ifem]['idgrado'] == 43){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 39 || $arrayMasculino[$jmasc]['idgrado'] == 40 || $arrayMasculino[$jmasc]['idgrado'] == 41 || $arrayMasculino[$jmasc]['idgrado'] == 42 || $arrayMasculino[$jmasc]['idgrado'] == 43){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>APOYO ADMINISTRATIVOS</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 44 || $arrayFemenino[$ifem]['idgrado'] == 45 || $arrayFemenino[$ifem]['idgrado'] == 46 || $arrayFemenino[$ifem]['idgrado'] == 47 || $arrayFemenino[$ifem]['idgrado'] == 48){
                                    // echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $ifem++;
                                    
                                }else{
                                    $ifem++;
                                }
                            }  
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalfem.'</td>';

                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 44 || $arrayMasculino[$jmasc]['idgrado'] == 45 || $arrayMasculino[$jmasc]['idgrado'] == 46 || $arrayMasculino[$jmasc]['idgrado'] == 47 || $arrayMasculino[$jmasc]['idgrado'] == 48){
                                    $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                    // $ifem = $cantFemenino + 1;
                                    $jmasc++;
                                    
                                }else{
                                    $jmasc++; 
                                }
                            }
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$totalmasc.'</td>';
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3" style="border: 1px solid #000; padding-top: 4.7pt; padding-bottom: 4.7pt; font-size: 5pt; text-align: center; /*font-weight: bold;*/"><div>SARGENTOS INVALIDOS</div></td>
                        <?php
                            $ifem = 0;
                            $totalfem = 0;
                            while ($ifem < $cantFemenino) { 
                                if ($arrayFemenino[$ifem]['idgrado'] == 157){
                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayFemenino[$ifem]['cantidad'].'</td>';
                                    $totalfem = $totalfem + $arrayFemenino[$ifem]['cantidad'];
                                    $ifem = $cantFemenino + 1;
                                    break;
                                }else{
                                    $ifem++;
                                }
                            }  
                            
                            $jmasc = 0;
                            $totalmasc = 0;
                            while ($jmasc < $cantMasculino) { 
                                if ($arrayMasculino[$jmasc]['idgrado'] == 157){
                                    if ($ifem == $cantFemenino){
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break;
                                    }else{
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayMasculino[$jmasc]['cantidad'].'</td>';
                                        $totalmasc = $totalmasc + $arrayMasculino[$jmasc]['cantidad'];
                                        $jmasc = $cantMasculino + 1;
                                        break; 
                                    }
                                }else{
                                    $jmasc++; 
                                }
                            }
                            //CUANDO NO EXISTA PERSONAL EN ESE GRADO Y PONER CERO EN CANTIDAD
                            if ($ifem == $cantFemenino && $jmasc == $cantMasculino) {
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">0</td>';
                            }
                            $gradoTotal = $totalfem + $totalmasc;
                            echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$gradoTotal.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td colspan="4" style="border: 1px solid #000; padding-top: 0pt; padding-bottom: 0pt; font-size: 8pt; text-align: center; font-weight: bold;"><div>TOTAL</div></td>
                        
                        <?php
                        $total_gen = 0;
                        for ($i=0; $i < $cantGeneroCant ; $i++) { 
                            echo '<td style="border: 1px solid #000; padding-top: 0pt; padding-bottom: 0pt; font-size: 8pt; font-weight: bold; text-align: center;">'.$arrayGeneroCant[$i]['cantidad'].'</td>';
                            $total_gen = $total_gen + $arrayGeneroCant[$i]['cantidad'];
                        }
                        echo '<td style="border: 1px solid #000; padding-top: 0pt; padding-bottom: 0pt; font-size: 8pt; font-weight: bold; text-align: center;">'.$total_gen.'</td>';
                        echo '<td style="border: 1px solid #000; padding-top: 0pt; padding-bottom: 0pt; /*padding-left: 0.5cm; padding-right: 0.5cm;*/ font-size: 12pt; text-align: center; font-weight: bold;"><div>'.$total_gen.'</div></td>';
                        ?>
                    </tr>                  
            </table>
            <div><p><?php /*echo 'cantidad registro:'.$cantFemenino.'   '.$ifem;*/ ?></p></div>

            <div><p><?php /*var_dump($arrayGenero);*/ ?></p></div>
        </div>

    </main>
    
    <script type="text/php">
    if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(310, 760, "$PAGE_NUM - $PAGE_COUNT", $font, 9);
                ');
            }
    </script>

</body>

</html>
