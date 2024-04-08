<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICADO DESTINOS</title>
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

        #watermark {
            position: fixed;

            /** 
                Establece una posición en la página para tu imagen
                Esto debería centrarlo verticalmente
            **/
            bottom:   10cm;
            left:     5.5cm;

            /** Cambiar las dimensiones de la imagen **/
            width:    8cm;
            height:   8cm;

            /** Tu marca de agua debe estar detrás de cada contenido **/
            z-index:  -1000;
        }

    </style>
</head>
<body style="background-image: url('../public/img/apache_comando.png'); background-size: 75%; background-position: center center; max-width:100%; background-attachment: fixed; background-repeat: no-repeat;">

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

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">N° 77/21</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">EL JEFE DEL DEPARTAMENTO   I  PERSONAL DEL ESTADO MAYOR GENERAL DE LA FUERZA AÉREA BOLIVIANA</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CERTIFICA:</p>
            </div>
            
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">   
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
                            <td width="45%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: center;"><span><img style="width:100; height:100; border: 5px solid #142A98;" src="../public/img/picture/{{$personal->per_foto}}"></span></td>
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

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">Cuenta con la siguiente información:</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">SITUACIÓN MILITAR</p>
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">FECHA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">DOCUMENTO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">NRO. DOC.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">SITUACION</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">SUBSITUACION</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">DETALLE</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">OBSERVACION</th> 
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($personal_sit as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px; text-align: center;"><span><?php echo $x; ?></span></td>
                        <?php
                        $date = date_create($row->sitper_fecha_documento);
                        $fechasit = date_format($date,"d/m/Y");
                        ?>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px; text-align: center;"><span><?php echo $fechasit; ?></span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$row->sitper_documento}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$row->sitper_nrodoc}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$row->sit_nombre}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$row->detsit_nombre}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$row->detsit_nombre}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$row->obs}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">DESTINOS</p>
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;">FECHA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 12px;">DESTINO</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($personal_destinos as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;"><span><?php echo $x; ?></span></td>
                        <?php
                        $date = date_create($row->fechadestino);
                        $fechadest = date_format($date,"d/m/Y");
                        ?>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;"><span><?php echo $fechadest; ?></span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11px;"><span>{{$row->desc_dn2}}  <strong>-</strong>  {{$row->desc_dn3}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 12px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">NOTA:</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">Es cuanto tengo a bien certificar, para los fines consiguientes.</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
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

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: left; font-size: 11px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">AAA/aaa</p>
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
