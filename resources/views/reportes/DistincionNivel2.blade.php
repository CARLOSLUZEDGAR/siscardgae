<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DISTINCION NIVEL 2</title>

    <style>
        @page{
            /*margin: 0rem;
            margin-top:0rem;
            padding: 1rem;*/
            margin: 0cm 0cm;
        }
        body {
            /*margin: 0px;*/
            margin-top: 5cm;
            margin-bottom: 1cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 3cm;
            margin-right: 2cm;
        }
        header {
            position: fixed;
            top: 2cm;
            left: 3cm;
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
            left: 3cm;
            right: 2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
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
        #cliente{
        text-align: left;
        }

        #facliente{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #000;
        font-size: 15px;
        padding: 5px;
        }

        #facliente thead{
        padding: 20px;
        background: lightgray;
        text-align: left;
        border: 1px solid #000;
         
        }

    </style>
</head>

<body>
    <header >
        <div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm;">
            <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
            <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
            <p style="margin: 0px 0px"><u><strong>BOLIVIA</strong></u></p>
        </div>
        <div style="padding-top: 25px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold;">
            <p style="margin: 1px">DISTINCIONES NIVEL 2</p>
        </div>

        <img style="margin: 75px 0px 0px 662px;  width:58; height:58; position:fixed" src="data:image/png;base64,  {{!! base64_encode($codigo) !!}}">
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
  
    <section>
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
            <thead style="background-color: lightgray;">
                <tr>
                    <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">NRO.</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">INSTITUCION</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">TIPO DISTINCION</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">DISTINCION</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">OBSERVACION</th>
                    <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">ESTADO</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php
                    $x = 0;
                ?>
                @foreach($distincionesNivel2 as $d2)
                <?php
                    $x = $x + 1;
                ?>
                <tr>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 10px; text-align: center;"><span><?php echo $x; ?></span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$d2->institucion}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$d2->tipo_distincion}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$d2->distintivo}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$d2->observacion}}</span></td>
                    <td style="border: 1px solid #000; padding: 7px; font-size: 10px;"><span>{{$d2->estado?'Activo':'Desactivo'}}</span></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <?php
        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
        //    $date = $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
        $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
    ?>
    <div class="col-md-12">
        <div style="padding-bottom: 4px; font-size: 14px; margin:0px; text-align:right;">La Paz, <?php echo $date;?></div>
    </div>
    <div style="padding-top: 120px; font-size: 14px;"><center> {{$jefe_dpto->gra_abreviatura}} {{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}<center>
        <center><strong>JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</strong></center>
    </div>

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