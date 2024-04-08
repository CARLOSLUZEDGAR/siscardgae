<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CUADRO PROMOCIONES</title>
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
            ?>
            <div style="padding-top: 1cm; padding-bottom: 1cm; text-align: center; font-size: 14pt; font-weight: bold; /*border: 1px solid #C00;*/">
                
                <p style="margin: 0px;"><u>CUADRO DE PROMOCIONES GESTIÓN <?php echo $gestion; ?></u></p>               
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px;" class="table table-bordered table-striped">
                <tr>
                    <td style="border: 1px solid #000; padding-top: 1cm; padding-bottom: 1cm; font-size: 8pt; text-align: center; font-weight: bold; width: 2cm;">
                        <div>PROMOCIÓN</div>
                    </td>
                    @foreach($grados as $row)
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 7pt; text-align: center; font-weight: bold;" class="rotate"><div>{{$row->abreviaturagrado}}</div></td>
                    @endforeach                                      
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 6pt; text-align: center; font-weight: bold;" class="rotate"><div>TOTAL</div></td>
                </tr> 
                <?php                
	                    //FUNCION sizeof CALCULA LA CANTIDAD DE ELEMENTOS DE UNA CONSULTA                               
                        $cantPromocion = sizeof($promocion);
                        $cantGrados = sizeof($grados);
                        $cantPromocionGrado = sizeof($promociongrados);

                        
                        $arrayPromocion = json_decode($promocion,true);
                        $arrayGrados = json_decode($grados,true);
                        $arrayPromocionGrado = json_decode($promociongrados,true);

                        
                        //PRIMER FOR DONDE VAMOS A MOSTRAR Y RECORRER TODOS LOS DESTINOS
                        for ($i=0; $i < $cantPromocion ; $i++) { 
                            echo '<tr>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 8pt; text-align: center; /*padding-left: 0.1cm; width: 2cm;*/">'.$arrayPromocion[$i]['promocion'].'</td>';
                                $k = 0;
                                for ($j=0; $j < $cantPromocionGrado ; $j++) {
                                    if($arrayPromocion[$i]['promocion'] == $arrayPromocionGrado[$j]['promocion'])
                                    {
                                        while($k < $cantGrados){
                                            if($arrayGrados[$k]['idgrado'] == $arrayPromocionGrado[$j]['idgrado'])
                                            {
                                               // if($arrayDestinoGradoPericia[$j]['pericia'] == $arrayGradosPericia[$k]['pericia']){
                                                    echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayPromocionGrado[$j]['cantidad'].'</td>';
                                                    $k++;
                                                    break;
                                               // }
                                                //else
                                                //{
                                                  //  echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">-</td>';
                                                    //$k++;
                                                //}
                                            }
                                            else
                                            {
                                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">-</td>';
                                                $k++;
                                            }
                                        }   
                                    }
                                }
                                 if($k != $cantGrados){
                                     while ($k < $cantGrados) {
                                         echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 5.5pt;">-</td>';
                                         $k++;
                                     }
                                 }
//AQUÍ CODIGO
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 5.5pt; font-weight: bold;">'.$arrayPromocion[$i]['cantidad'].'</td>';                            
                            echo '</tr>';
                        }
                    ?>
                    <!-- <tr>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 6pt; text-align: center; font-weight: bold; width: 2cm;">
                        <div>TOTAL GENERAL</div>
                    </td>
                    
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center; font-weight: bold;"> -->
                        <?php
                            // $total_grado = 0;
                            // $a = 0;
                            // while ($a < $cantGradosPericia) {
                            //     $total_grado = $total_grado + $arrayGradosPericia[$a]['total'];
                            //     $a++;  
                            // }
                            // // $total_unidad = 0;
                            // // $b = 0;
                            // // while ($b < $cantDestinos) {
                            // //     $total_unidad = $total_unidad + $arrayDestinos[$b]['d3cantidad'];
                            // //     $b++;  
                            // // }
                            // // if($total_grado == $total_unidad){
                            // //     echo $total_unidad;
                            // // }else{
                            // //     echo 'N/C';
                            // // }
                            // echo $total_grado;
                            // // echo $total_unidad;  
                        ?>
                    <!-- </td>
                </tr> -->
                  
            </table>
            <div><p><?php /*echo 'cantidad registro:'.$cantDestinos;*/ ?></p></div>

            <div><p><?php /*var_dump($arrayGradosPericia);*/ ?></p></div>
            
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