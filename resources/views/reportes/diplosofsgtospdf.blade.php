<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>REPORTE DE BREVETS</title>
        <style>
            @page{
            margin: 0cm 0cm;
            }
            body {
                margin-top: 2cm;
                margin-bottom: 2cm;
                /** margenes de izquierda y derecha es menos un cm*/
                margin-left: 2cm;
                margin-right: 1cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 3cm;
                right:2cm;
                height: 2cm;
                color: black;
                text-align: right;
                line-height: 24px;
                padding-top: 5px;
                padding-bottom: 0px;
            }
            footer {
                position: fixed;
                bottom: 0cm;
                left: 3cm;
                right: 2cm;
                height: 2cm;
                color: black;
                line-height: 24px;
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
        <footer>
            <h6>Desarrollado por: DIGETIC</h6>
        </footer>

        <div class="cabecera">
            <div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm;">
                <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
                <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                <p style="margin: 0px 0px;"><u><strong>BOLIVIA</strong></u></p>
            </div>

            <div style="padding-top: 30px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold; border: 0px">
                <p style="margin: 1px">REPORTE DEL PERSONAL DE SUBOFICIALES Y SARGENTOS QUE SON DIPLOMADOS EN SUPERVISIÓN Y ACTUALIZACIÓN</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">Nº</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">CARNET MILITAR</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">GRADO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">APELLIDOS Y NOMBRES</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">DIPLOMADO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">DIPLOMADO 2</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">FECHA INICIO DEL CURSO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;">FECHA FIN DEL CURSO</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                     @foreach ($cursopersonal as $cp)
                    <?php
                        $x = $x + 1;
                    ?>
                    <tr>
                        <?php
                            $dateinicio = date_create($cp->fec_inicio);
                            $fechainicio= date_format($dateinicio,"d/m/Y");
                        ?>
                        <?php
                            $datefinal = date_create($cp->fec_final);
                            $fechafinal= date_format($datefinal,"d/m/Y");
                        ?>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px; text-align: center;"><span><?php echo $x; ?></span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$cp->per_cm}}</span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$cp->grado}} {{$cp->estu_abreviatura}}</span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$cp->per_paterno}} {{$cp->per_materno}} {{$cp->per_nombre}}</span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$cp->Diplomado}}</span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$cp->Diplomado2}}</span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span><?php echo $fechainicio; ?></span></td>
                            <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span><?php echo $fechafinal; ?></span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script type="text/php">
            if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(305, 755, "$PAGE_NUM", $font, 10);
                ');
            }
        </script>
    </body>
</html>
