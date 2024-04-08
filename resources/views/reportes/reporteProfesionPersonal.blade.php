<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DESTINOS DESGLOSE</title>
    <!-- CSS only -->
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
            margin-left: 3cm;
            margin-right: 2cm;
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

        /*#footer .page:after { content: counter(page, upper-roman);}*/

        * {
            font-family: verdana, arial, sans-serif;
        }
        /* .cabecera {
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
        } */

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
                
                <div style="padding-top: 30px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">PROFESIÓN DEL PERSONAL</p>
                </div>

                <div>
                    <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px;" class="table table-bordered table-striped">
                        <tbody class="table-striped">
                            <tr>
                                <td width="45%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: center;"><span><img style="width:90; height:90; border: 3px solid #142A98;" src="../public/img/personal/{{$personal->per_foto}}"></span></td>
                                <td width="20%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: left;">
                                    <span>
                                        <p style="margin: 1px; font-size: 14px; font-weight: bold;">GRADO:</p>
                                        <p style="margin: 1px; font-size: 14px; font-weight: bold;">APELLIDOS:</p>
                                        <p style="margin: 1px; font-size: 14px; font-weight: bold;">NOMBRE(S):</p>
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

                {{-- <div style="padding-top: 2px; padding-bottom: 2px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">PROFESIÓN LIBRE</p>
                </div> --}}

            <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            border: black 1px; 
            margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">FECHA DE EGRESO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">GRADO ACADEMICO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">CARRERA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">UNIDAD ACADEMICA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">DESCRIPCIÓN DE LA CARRERA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">OBSERVACIONES</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($profesion as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px; text-align: center;"><span><?php echo $x; ?></span></td>
                        <?php
                        $date = date_create($row->fecha_egreso);
                        $fechaegre = date_format($date,"d/m/Y");
                        ?>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 9px;"><span><?php echo $fechaegre; ?></span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->descripcion_carrera}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->niv_especialidad}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->lugar_estudio}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->descripcion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->observacion}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 12px; /*font-weight: bold; border: 1px solid #C00;*/">
                La Paz, <?php
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
                
            </div>

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 15px; font-weight: bold; border: 1px solid #C00;*/">
            <p style="margin: 1px; font-size: 12px;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 12px; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
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
