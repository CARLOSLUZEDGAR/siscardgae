<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TIEMPO TOTAL SERVICIO</title>
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
                // $dateinc = date_create($situacion_militar->fecha_documento);
                // $fechaincorporacion = date_format($dateinc,"d/m/Y"); 
                $cantSituacion = sizeof($situacion_militar);
                $arraySituacion=json_decode($situacion_militar,true);                    
            ?>
            <div style="padding-top: 1cm; padding-bottom: 1cm; text-align: center; font-size: 14pt; font-weight: bold; /*border: 1px solid #C00;*/">
                
                <p style="margin: 0px;"><u>CALCULO DEL TIEMPO DE SERVICIO</u></p>               
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                 <?php
                    if($cantSituacion > 1){
                        for ($i=0; $i < $cantSituacion; $i++) {
                            switch ($arraySituacion[$i]['detsit_cod']) {
                                case 1:
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechainc = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">1.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechainc.'</p>';
                                    break;

                                case 20:
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechasit = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">2.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechasit.'</p>';
                                    break;

                                case 2 :
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechasit = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">3.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechasit.'</p>';
                                    break;

                                case 31 :
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechasit = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">3.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechasit.'</p>';
                                    break;

                                case 12 :
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechasit = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">3.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechasit.'</p>';
                                    break;

                                case 19 :
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechasit = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">3.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechasit.'</p>';
                                    break;
                                
                                default:
                                    $date = date_create('now');
                                    $fechafin = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">FECHA ACTUAL</p>';
                                    echo  '<p style="margin: 1px">'.$fechafin.'</p>';
                                    break;
                            }
                        }
                    }else{
                        for ($i=0; $i < $cantSituacion; $i++) {
                            switch ($arraySituacion[$i]['detsit_cod']) {
                                case 1:
                                    $date = date_create($arraySituacion[$i]['fecha_documento']);
                                    $fechainc = date_format($date,"d/m/Y");
                                    echo  '<p style="margin: 1px">1.'.$arraySituacion[$i]['nombre'].'</p>';
                                    echo  '<p style="margin: 1px">'.$fechainc.'</p>';
                                    break;
                            }
                        }
                        $date = date_create('now');
                        $fechafin = date_format($date,"d/m/Y");
                        echo  '<p style="margin: 1px">FECHA ACTUAL</p>';
                        echo  '<p style="margin: 1px">'.$fechafin.'</p>';
                    }    
                ?> 
                       
                    
            </div>

            <div><p><?php /*echo 'cantidad registro:'.$cantSituacion;*/ ?></p></div>

            <div><p><?php /*var_dump($arraySituacion);*/ ?></p></div>

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 12pt; font-weight: bold; border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 12pt;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 12pt; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
            </div>

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