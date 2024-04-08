<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE DE DATOS FAMILIARES</title>
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
            margin-top: 4.2 cm;
            margin-bottom: 1cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 2cm;
            margin-right: 2cm;
        }
        header {
            position: fixed;
            top: 2cm;
            left: 2cm;
            right: 2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            line-height: 14px;
            /*border: 1px solid #C00;*/
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 2cm;
            right: 2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            line-height: 35px;
            /*border: 1px solid #C00;*/
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
    <div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm;">
        <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
        <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
        <p style="margin: 0px 0px;"><u><strong>BOLIVIA</strong></u></p>
    </div>

    
    <img style="margin: 70px 0px 0px 905px;  width:58; height:58; position:fixed" src="data:image/png;base64, {{!! base64_encode($qrband) !!}}">
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
                    <td style="text-align: center;   width: 295px">
                        <h5></h5>
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
            <div style="padding-top: 15px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold;/*border: 1px solid #C00;*/"">
                <p style="margin: 1px">RELACIÓN NOMINAL DATOS FAMILIARES</p>
            </div>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: left; font-size: 12px; font-weight: bold; /*border: 1px solid #C00;*/">
                @if($nombrepersona->per_sexo=='MASCULINO')
                    <p style="margin: 1px">DEL SEÑOR: {{$nombrepersona->gra_abreviatura}}{{$nombrepersona->estu_abreviatura}} {{$nombrepersona->per_nombre}} {{$nombrepersona->per_paterno}} {{$nombrepersona->per_materno}}</p><br>
                @endif
                @if($nombrepersona->per_sexo=='FEMENINO')
                    <p style="margin: 1px">DE LA SEÑORA: {{$nombrepersona->gra_abreviatura}}{{$nombrepersona->estu_abreviatura}} {{$nombrepersona->per_nombre}} {{$nombrepersona->per_paterno}} {{$nombrepersona->per_materno}}</p><br>
                @endif
                <p  style="margin: 1px">CARNET MILITAR: {{$nombrepersona->per_cm}}</p>
            </div>

        <table width="100%" style="border-collapse: collapse;
        border-spacing: 0;
        border: black 1px;
        margin-bottom: 5px;" class="table table-bordered table-striped">
            <thead style="background-color: lightgray;">
                <tr>
                    <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">NRO.</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">PARENTESCO</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">APELLIDO PATERNO</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">APELLIDO MATERNO</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">NOMBRES</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">C. IDENTIDAD</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">SEXO</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">FECHA DE NACIMIENTO</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">CELULAR</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">PROFESION</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">OBSERVACIONES</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php
                    $x = 0;
                ?>
                @foreach($datos_familiares as $datfam)
                <?php
                    $x = $x + 1;
                ?>
                <tr>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 9px; text-align: center;"><span><?php echo $x; ?></span></td>
                    <?php
                        $date = date_create($datfam->fecha_nac);
                        $fechaimpo = date_format($date,"d/m/Y");
                    ?>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->parentesco}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->paterno}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->materno}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->nombre}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->cidentidad}} {{$datfam->expedido}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->sexo}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span><?php echo $fechaimpo; ?></span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->celular}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->profesion}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$datfam->observacion}}</span></td>
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
            $pdf->text(392, 584, "$PAGE_NUM - $PAGE_COUNT", $font, 9);
        ');
    }
</script>
</body>
</html>
