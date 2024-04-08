<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICADO DESTINOS FRONTERA</title>
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
            margin-top: 3cm;
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 2cm;
            margin-right: 1cm;
            /**border: 1px solid #C00;*/
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 3cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            /*line-height: 10px;
            font-size: 9px;
            border: 1px solid #C00;*/
            padding-top: 5px;
            padding-bottom: 0px;
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
            /*font-size: 9px;
            border: 1px solid #C00;*/
        }


        * {
            font-family: verdana, arial, sans-serif;
        }
        .cabecera {
            background-color: #FEFEFE;
            color: #000000;
            padding: 2rem;
            padding-top: .2rem;
            padding-bottom: 0px;
        }
        .cabecera .logo{
            margin: 5px;
        }
        .cabecera table {
            padding: 1px;
            margin-bottom: .2rem;
        }
        table {
            font-size: x-small
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        /* #watermark {
            position: fixed;

            /** 
                Establece una posición en la página para tu imagen
                Esto debería centrarlo verticalmente
            **/
            /* bottom:   10cm;
            left:     5.5cm;

            /** Cambiar las dimensiones de la imagen **/
            /* width:    8cm;
            height:   8cm; */

            /** Tu marca de agua debe estar detrás de cada contenido **/
            /* z-index:  -1000; */
        /* } */

    </style>
</head>
<body>

<header>        
    <div style="padding-top: 22px; padding-bottom: 1px;">
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/margin-bottom: 0px; " class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ vertical-align: bottom;">
                        <div style="text-align: center; width: 230px; font-size: 11.5px; /*border: 1px solid #C00;*/">
                            <p style="margin: 1px;">FUERZA AÉREA BOLIVIANA</p>
                            <p style="margin: 1px;">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                            <p style="margin: 1px;"><u><strong>BOLIVIA</strong></u></p>
                        </div>
                    </td>
                    <td style="/*border: 1px solid #000;*/ vertical-align: bottom;">
                        <div style="padding-top: 0px; padding-bottom: 0px; text-align: right;">
                            <img style="/*border: 1px solid #C00;*/ width: 58; height: 58" src="data:image/png;base64, {!! base64_encode($qr) !!} ">
                        </div>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
</header> 

<footer>
    <div>
        <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            /* border: black 1px; */
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10px; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: 
                            <?php
                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold;">
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
        <!--border: 1px solid #C00;-->
                <!--<div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm; /*border: 1px solid #C00;*/">
                    <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
                    <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                    <p style="margin: 0px 0px;"><u><strong>BOLIVIA</strong></u></p>
                </div>-->

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: right; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$nro_doc}}</p>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">EL JEFE DEL DEPARTAMENTO   I  PERSONAL DEL ESTADO MAYOR GENERAL DE LA FUERZA AÉREA BOLIVIANA</p>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CERTIFICA:</p>
            </div>

            <?php
            
            // $long = sizeof($destino_frontera);
            // echo 'CANTIDAD ELEMENTOS '.$long.'<br>';
            // $array=json_decode($destino_frontera,true);
            // //  var_dump($array);
            // $fechaact = date('Y-m-d');
            // $totalfrontera = 0;  
            // for ($i=0; $i < $long ; $i++) { 
            //     $x = $i + 1;
            //     if($array[$i]['frontera'] == 1){
            //         if ($x<$long){
            //             $date1 = new DateTime($array[$i]['fecha_destino']);
            //             $date2 = new DateTime($array[$x]['fecha_destino']);
            //             $diff = $date1->diff($date2);
            //             $diferencia = $diff->days;
            //             // if($diferencia >= 181){
            //                 echo $x.'.- '.$diferencia.' dias'.' frontera '.$array[$i]['frontera'];
            //                 echo '<br>';
            //                 $totalfrontera = $totalfrontera + $diferencia;
            //             // }
            //         }
            //         else{
            //             $date1 = new DateTime($array[$i]['fecha_destino']);
            //             $date2 = new DateTime($fechaact);
            //             $diff = $date1->diff($date2);
            //             $diferencia = $diff->days;
            //             // if($diferencia >= 181){
            //                 echo $x.'.- '.$diferencia.' dias'.' frontera '.$array[$i]['frontera'];
            //                 echo '<br>';
            //                 $totalfrontera = $totalfrontera + $diferencia;
            //             // }
            //         }
            //     }
            // }
            // echo 'total dias: '. $totalfrontera;
            // echo 'AÑOS EN FRONTERA: '.get_format($totalfrontera);
            // function get_format($df) {
            //     $str = '';
            //     $str .= ($df->invert == 1) ? ' - ' : '';
            //     if ($df->y > 0) {
            //         // years
            //         $str .= ($df->y > 1) ? $df->y . ' AÑOS ' : $df->y . ' AÑO ';
            //     } if ($df->m > 0) {
            //         // month
            //         $str .= ($df->m > 1) ? $df->m . ' MESES ' : $df->m . ' MES ';
            //     } if ($df->d > 0) {
            //         // days
            //         $str .= ($df->d > 1) ? $df->d . ' DÍAS ' : $df->d . ' DÍA ';
            //     } 
            //     echo $str;
            // }
           
            

            // foreach ($array as $key=> $array1) {
            //     echo $key, " : ";
            //     echo $array1, "\n";
            // }
            // var_dump($array[0]['fecha_destino']);
            // echo $array->fecha_destino;
            
            
            // $long = sizeof($fechadest);
            // echo 'CANTIDAD ELEMENTOS'.$long.'<br>';
            // $x = 1;
            // foreach ($fechadest as $row){
            //     if($row->frontera == 1){
            //         $date1 = new DateTime($row->fecha_destino);
            //         $date2 = new DateTime($row->finfechadestino);
            //         $diff = $date1->diff($date2);
            //         $diferencia = $diff->days;
            //     } 
            // }
            ?>
            
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">   
                @if($personal->per_sexo=='MASCULINO')
                    <p style="margin: 1px">Qué, revisada la documentación existente en el Departamento I - Personal, se establece que el Señor:</p>
                @endif
                @if($personal->per_sexo=='FEMENINO')
                    <p style="margin: 1px">Qué, revisada la documentación existente en el Departamento I - Personal, se establece que la Señora:</p>
                @endif
            </div>
                
            <div>
                <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px;" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td width="45%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: center;"><span><img style="width:90; height:90; border: 2px solid #142A98;" src="../public/img/personal/{{$personal->per_foto}}"></span></td>
                            <td width="20%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: left;">
                                <span>
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">GRADO:</p>
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">APELLIDO(S):</p>
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">NOMBRE(S):</p>
                                    <!--<p style="margin: 1px; font-size: 14px; font-weight: bold;">AP. MATERNO:</p>-->
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">C. MILITAR:</p>
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">C. IDENTIDAD:</p>
                                </span>
                            </td>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: left;">
                                <span>
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}}</p>
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                                    <!--<p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> </p>-->
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->per_nombre}}</p>
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->per_cm}}</p>
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->per_ci}} {{$personal->per_expedido}}</p>
                                </span>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">Cuenta con la siguiente información:</p>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">DESTINOS FRONTERA</p>
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;" width="1cm">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;" width="2cm">FECHA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;">DESTINO FRONTERA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;" width="2cm">DIAS</th>
                    </tr>
                </thead>
                <tbody class="table-striped">                   
                    <?php
                    // $date = date_create($row->fecha_destino);
                    // $fechadest = date_format($date,"d/m/Y");
                    ?>
                        <?php
                            //calculo cantidad de elementos del array
                            $long = sizeof($destino_frontera);
                            //json_decode convierte datos en json a un array
                            $array=json_decode($destino_frontera,true);
                            //calculo de la fecha actual
                            $fechaact = date('Y-m-d');
                            //variable para la siguiente fecha
                            $x = 0;
                            //variable para la numeracion
                            $num = 0;
                            //variable para el total de dias en frontera
                            $totalfrontera = 0;
                            for ($i=0; $i < $long ; $i++) { 
                                $x = $i + 1;
                                if($array[$i]['frontera'] == 1){
                                    $num = $num + 1;
                                    //hace el recorrido hasta el penultimo elemento del array
                                    if ($x<$long){
                                        $date1 = new DateTime($array[$i]['fecha_destino']);
                                        $date2 = new DateTime($array[$x]['fecha_destino']);
                                        $diff = $date1->diff($date2);
                                        $diferencia = $diff->days;
                                        // if($diferencia >= 181){
                                            // echo $x.'.- '.$diferencia.' dias'.' frontera '.$array[$i]['frontera'];
                                            echo '<tr>';
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;" width="1cm"><span>'.$num.'</span></td>';
                                            $date = date_create($array[$i]['fecha_destino']);
                                            $fechafront = date_format($date,"d/m/Y");
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;" width="2cm"><span>'.$fechafront.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: justify;" ><span>'.$array[$i]['desc_dn2'].'<strong> - </strong>'.$array[$i]['desc_dn3'].'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: right;" width="2cm"><span>'.$diferencia.'</span></td>';
                                            echo '</tr>';
                                            $totalfrontera = $totalfrontera + $diferencia;
                                        // }
                                    }
                                    //se emplea para el ultimo destino donde no se tiene la final del destino
                                    else{
                                        $date1 = new DateTime($array[$i]['fecha_destino']);
                                        $date2 = new DateTime($fechaact);
                                        $diff = $date1->diff($date2);
                                        $diferencia = $diff->days;
                                        // if($diferencia >= 181){
                                            echo '<tr>';
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;" width="1cm"><span>'.$num.'</span></td>';
                                            $date = date_create($array[$i]['fecha_destino']);
                                            $fechafront = date_format($date,"d/m/Y");
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;" width="2cm"><span>'.$fechafront.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: justify;"><span>'.$array[$i]['desc_dn2'].'<strong> - </strong>'.$array[$i]['desc_dn3'].'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: right;" width="2cm"><span>'.$diferencia.'</span></td>';
                                            echo '</tr>';
                                            $totalfrontera = $totalfrontera + $diferencia;
                                        // }
                                    }
                                }
                            }
                            // $tiempoTemporal =  get_format($diff);
                            // $tiempoTemporal =  $dteDiff->format('Y-m-d');
                            // echo $diff->y . " year, " . $diff->m." months and ".$diff->d." day"; 
                            $tiempo_total = $totalfrontera;
                            $anos = floor($tiempo_total / 365);
                            $res_ano = $tiempo_total % 365;
                            $meses = floor($res_ano / 30.42);
                            $res_mes = $res_ano % 30.42;
                            $dias = $res_mes;
                        ?>
                </tbody>
            </table>     
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        echo '<tr>';
                        echo '<td style="/*border: 1px solid #000;*/ padding: 7px; font-size: 12px; text-align: justify; font-weight: bold;" withd="50%"><span>TIEMPO TOTAL EN FRONTERA:</span></td>';
                        // echo '<td style="/*border: 1px solid #000;*/ padding: 7px; font-size: 11px; text-align: right;"><span>'.$tiempo_total.'</span></td>';
                        echo '<td style="/*border: 1px solid #000;*/ padding: 7px; font-size: 12px; text-align: right; font-weight: bold;" withd="50%"><span>'.$anos.' AÑO(S) '.$meses.' MES(ES) '.$dias.' DÍA(S)'.'</span></td>';
                        echo '</tr>';
                    ?>
                </tbody>
            </table>
            <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <tr>
                        <td width="8%" style="/*border: 1px solid #000;*/ padding: 0px; font-size: 14px; text-align: left; font-weight: bold; vertical-align: top;" ><span>NOTA:</span></td>
                        @if($nota=='')
                        <td width="92%" style="/*border: 1px solid #000;*/ padding-left: 2px; padding-top: 0px; font-size: 14px; text-align: justify;"><span>SIN OBSERVACIONES</span></td>
                    
                        @else
                        <td width="92%" style="/*border: 1px solid #000;*/ padding-left: 2px; padding-top: 0px; font-size: 14px; text-align: justify;"><span>{{$nota}}</span></td>
                        @endif                   
                    </tr> 
                </tbody>
            </table>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">Es cuanto tengo a bien certificar, para los fines consiguientes.</p>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: right; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                La Paz, 
                    <?php
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
            </div>

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 14px; font-weight: bold; border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 14px;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 14px; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
            </div>

            <div style="padding-top: 0px; padding-bottom: 0px; text-align: left; font-size: 11px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$rubrica}}</p>
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
