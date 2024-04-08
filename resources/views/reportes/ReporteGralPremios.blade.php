<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>REPORTE GRAL PREMIOS DIST.</title>

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
        <div style="padding-top: 15px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold;">
        <p style="margin: 1px">
            @if($tipo_reporte=='general')
                <p style="margin: 1px">PREMIOS Y DISTINCIONES EN GRAL. DESDE {{$fecha_inicio}} HASTA {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='promocion')
                <p style="margin: 1px">PROMOCION {{$promo->promocion}} DE {{$promo->instituto}} DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='institucion')
                <p style="margin: 1px">PREMIOS Y DISTINCIONES DE {{$institu->institucion}} DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='distincion')
                <p style="margin: 1px">DISTINCIONES DE "{{$distin->institucion}} - {{$distin->distincion}}" DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='tipo_distincion')
                <p style="margin: 1px">"{{$distin2->institucion}} - {{$distin2->distincion}}- {{$distin2->tipo_distincion}}" DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='promo_institucion')
                <p style="margin: 1px"> DISTINCIONES DE {{$institu->institucion}} A {{$promo->promocion}} DE {{$promo->instituto}} DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='promo_distincion')
                <p style="margin: 1px">DISTINCIONES "{{$distin->distincion}} A {{$promo->promocion}}" DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
            @if($tipo_reporte=='promo_tipo_distincion')
                <p style="margin: 1px">"{{$distin2->institucion}} - {{$distin2->tipo_distincion}} A {{$promo->promocion}}" DESDE {{$fecha_inicio}} AL {{$fecha_fin}}</p>
            @endif
        </p>

        </div>

        <img style="margin: 70px 0px 0px 905px;  width:58; height:58; position:fixed" src="data:image/png;base64, {{!! base64_encode($codigo) !!}}">
    </header> 
    <footer>
        <table style="width: 100%">
            <tr>
                <td style="text-align: left;  width: 295px">
                    <h5>Fecha de Emisión:<?php $fecha = date("dHi-M-Y"); echo $fecha;?></h5>
                </td>
                <td style="text-align: center;   width: 295px">
                    <h5></h5>
                </td>
                <td style="text-align: right;  width: 295px">
                    <h5>Desarrollado por la: DIGETIC - <?php $gestion_act = date("Y"); echo $gestion_act;?></h5>   
                </td>
            </tr>
        </table>
    </footer> 

    <div>
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; 
            border: black 1px; 
            margin-bottom: 30px;" class="table table-bordered table-striped">
            <thead style="background-color: lightgray;">
                <tr>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">NRO.</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">GRADO Y NOMBRE</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">TIPO DISTINCION</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">DISTINCION</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">DESCRIPCION</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">NRO DOC</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">TIPO DOC.</th>
                    <th style="text-align: center; border: 1px solid #000; height:20px;">FECHA</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php
                    $x = 0;
                ?>
                @foreach ($datos as $d)
                <?php
                    $x = $x + 1;
                ?> 
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px; text-align: center;"><span><?php echo $x; ?></span></td>
                    
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->grado}} {{$d->estudio}} {{$d->nombre}} {{$d->paterno}} {{$d->materno}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->descripcion2}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->descripcion3}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->descripcion}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->nro_doc}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->tipo_doc}}</td>
                    <td style="border: 1px solid #000; padding: 5px; font-size: 10px;">{{$d->fecha_distincion}}</td>
                </tr>
                @endforeach
                               
            </tbody>
        </table>
    </div>
    <?php
        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                
        //    $date = $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
        $date = date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
    ?>
    <div class="col-md-12">
        <div style="padding-bottom: 4px; font-size: 14px; margin:0px; text-align:right;">La Paz, <?php echo $date;?></div>
    </div>
    
    <div style="padding-top: 100px; font-size: 14px;"><center>{{$jefe_dpto->gra_abreviatura}} {{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}} <center>
        <center><strong>JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</strong></center>
    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(392, 584, "$PAGE_NUM - $PAGE_COUNT", $font, 8);
            ');
        }
    </script>

</body>

</html>