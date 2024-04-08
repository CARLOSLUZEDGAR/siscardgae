<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE RANGO DE FECHAS DE CURSOS</title>
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

        /*#footer .page:after { content: counter(page, upper-roman);}*/

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
    </style>
</head>
<body>
<header>
    <div style="padding-top: 22px; padding-bottom: 1px;">
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/margin-bottom: 0px; " class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="vertical-align: bottom;">
                        <div style="text-align: center; width:230px; font-size: 11.5px;">
                            <p style="margin: 1px;">FUERZA AÉREA BOLIVIANA</p>
                            <p style="margin: 1px;">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                            <p style="margin: 1px;"><u><strong>BOLIVIA</strong></u></p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</header>
<footer>
    <div>
        <table width="100%" style="border-collapse:collapse; border-spacing:0; margin-bottom:5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="padding-top:25px; padding-bottom:25px; font-size: 10px; text-align:left; font-weight:bold;">
                        <span>Fecha de Emision:
                            <?php
                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="padding:2px; font-size:10px; text-align:right; font-weight:bold;">
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
            <p style="margin: 1px">REPORTE DE CURSOS DEL PERSONAL</p>
        </div>
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
            <thead style="background-color: lightgray;">
                <tr>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">NRO.</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">CARNET MILITAR</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">NOMBRE</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">CURSO</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">TIPO CURSO</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">DESGLOSE CURSO</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">DESCRIPCIÓN</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">FECHA OTORGACION</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">TIPO DOC.</th>
                    <th style="text-align:center; border:1px solid #000; height:30px; font-size:10px;">NRO. DOC.</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php
                    $x = 0;
                ?>
                    @foreach ($rangofechas as $rdf)
                <?php
                    $x = $x + 1;
                ?>
                <tr>
                    <td style="border:1px solid #000; padding:7px; font-size:9px; text-align:center;"><span><?php echo $x; ?></span></td>
                    <?php
                        $date = date_create($rdf->fecha_otorgacion);
                        $fech = date_format($date,"d/m/Y");
                    ?>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->per_cm}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->gra_abreviatura}} {{$rdf->estu_abreviatura}} {{$rdf->per_nombre}} {{$rdf->per_paterno}} {{$rdf->per_materno}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->nombrecurso}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->nombretipocurso}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->nombredesglocurso}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->descripcion}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span><?php echo $fech; ?></span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->documento}}</span></td>
                    <td style="border:1px solid #000; padding:7px; font-size:10px;"><span>{{$rdf->nro_doc}}</span></td>
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
    </div>
</main>
<script type="text/php">
        if(isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(310, 780, "$PAGE_NUM - $PAGE_COUNT", $font, 9);
            ');
        }
</script>
</body>
</html>
