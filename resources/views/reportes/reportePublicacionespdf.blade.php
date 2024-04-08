<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE PUBLICACIONES</title>
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
            margin-top: 4.5cm;
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
        .cabecera {
            background-color: #FEFEFE;
            color: #000000;
            
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

    </style>
</head>
<body>

<header>
    <div style="padding-top: 60px; padding-bottom: 1px;">
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
                        <img style="margin: 20px 0px 0px 662px;  width:58; height:58; position:fixed" src="data:image/png;base64,  {{!! base64_encode($codigo) !!}}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="padding-top: 30px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold;">
            <p style="margin: 1px">PUBLICACIONES DE: {{$personal->grabrev}}{{$personal->estbrev}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p><br>
                    
                    </p>
        </div>
    </div>
</header>

<footer >
<table style="width: 100%">
            <tr>
                <td style="text-align: left;  width: 200px; ">
                    <h5>Fecha de Emisión:<?php $fecha = date("dHi-M-Y"); echo $fecha;?></h5>
                </td>
                <td style="text-align: center;   width: 200px">
                    <h5></h5>
                </td>
                <td style="text-align: right;  width: 200px">
                    <h5>Desarrollado por la: DIGETIC - <?php $gestion_act = date("Y"); echo $gestion_act;?></h5>   
                </td>
            </tr>
        </table>
    </footer>

    <main>

        <div class="cabecera">
                

            <table width="100%" style="border-collapse: collapse;
            border-spacing: 0;
            border: black 1px;
            margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:10%; font-size: 10px;">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:20%; font-size: 10px;">PUBLICACION</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:25%; font-size: 10px;">DESCRIPCION</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:10%; font-size: 10px;">DOCUMENTO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:10%; font-size: 10px;">NRO.DOC</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:15%; font-size: 10px;">FECHA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; width:20%; font-size: 10px;">OBSERVACION</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($personal_publicaciones as $ps)
                    <?php
                        $x = $x + 1;
                    ?>
                    <tr>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 9px; text-align: center;"><span><?php echo $x; ?></span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$ps->publicacion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$ps->descripcion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$ps->documento}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$ps->nrodoc}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$ps->fecha}}</span></td>                       
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$ps->observacion}}</span></td>
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
            <div style="padding-top: 120px; font-size: 14px;"><center> {{$jefe_dpto->grabrev_j}} {{$jefe_dpto->estbrev_j}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}<center>
                <center><strong>JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</strong></center>
            </div>
        </div>
    </main>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(310, 762, "$PAGE_NUM - $PAGE_COUNT", $font, 8);
            ');
        }
        </script>
</body>

</html>

