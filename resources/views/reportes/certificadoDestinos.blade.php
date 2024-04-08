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
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            line-height: 24px;
            /*font-size: 9px;
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
        <!--<h6>Fecha de Emisión:--> 
        <?php
            //$fecha = date("dHi - M - Y");
            //echo $fecha;
        ?>
        <!--<img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
        </h6>-->
        <div>
            <img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
        </div>
</header> 

<footer>
        
        <div style="text-align: right;">
            <h6>Desarrollado por la: DIGETIC - <?php
                $gestion_act = date("Y");
                echo $gestion_act;
                ?>
            </h6>
        </div>
</footer>

    <main>  
    
        <div class="cabecera">
        <!--border: 1px solid #C00;-->
                <div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm; border: 1px solid #C00;">
                    <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
                    <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                    <p style="margin: 0px 0px;"><u><strong>BOLIVIA</strong></u></p>
                </div>

                <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; border: 1px solid #C00;">
                    <img style="width:100; height:100; border: 10px solid #142A98" src="../public/img/avatar_militar.jpg">  
                </div>

                <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px; font-weight: bold; border: 1px solid #C00;">
                    <p style="margin: 1px">N° 77/21</p>
                </div>

                <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 15px; font-weight: bold; border: 1px solid #C00;">
                    <p style="margin: 1px">EL JEFE DEL DEPARTAMENTO   I  PERSONAL DEL ESTADO MAYOR GENERAL DE LA FUERZA AÉREA BOLIVIANA.</p>
                </div>

                <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 15px; font-weight: bold; border: 1px solid #C00;">
                    <p style="margin: 1px">CERTIFICA:</p>
                </div>
                

                <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; border: 1px solid #C00;">
                    
                    
                    @if($personal->per_sexo=='MASCULINO')
                        <p style="margin: 1px">Qué, revisada la documentación existente en el Departamento I - Personal, se establece que el Señor:</p>
                    @endif
                    @if($personal->per_sexo=='FEMENINO')
                        <p style="margin: 1px">Qué, revisada la documentación existente en el Departamento I - Personal, se establece que la Señora:</p>
                    @endif
                </div>
                <div style="padding-top: 5px; padding-bottom: 5px; text-align: center; border: 1px solid #C00;">
                        <img style="width:100; height:100; border: 5px solid #142A98;" src="../public/img/avatar_militar.jpg">  
                </div>

                <div style="padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 15px; font-weight: bold; border: 1px solid #C00;">
                    <p style="margin: 1px">{{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                </div>
                <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; border: 1px solid #C00;">
                    @if($personal->per_sexo=='MASCULINO')
                        <p style="margin: 1px">Tiene la siguiente Situación Militar y fué destinado de acuerdo al siguiente detalle:</p>
                    @endif
                    @if($personal->per_sexo=='FEMENINO')
                        <p style="margin: 1px">Tiene la siguiente Situación Militar y fué destinada de acuerdo al siguiente detalle:</p>
                    @endif
                </div>

            <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            border: black 1px; 
            margin-bottom: 5px;" class="table table-bordered table-striped">
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
            </table><br>

            <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            border: black 1px; 
            margin-bottom: 5px;" class="table table-bordered table-striped">
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
                        $date = date_create($row->perdest_fechadestino);
                        $fechadest = date_format($date,"d/m/Y");
                        ?>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11px; text-align: center;"><span><?php echo $fechadest; ?></span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11px;"><span>{{$row->destn2_descripcion}}  <<>>  {{$row->destn3_descripcion}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 12px; font-weight: bold; border: 1px solid #C00;">
                <p style="margin: 1px">NOTA:</p>
            </div>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; border: 1px solid #C00;">
                <p style="margin: 1px">Es cuanto tengo a bien certificar, para los fines consiguientes.</p>
            </div>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 12px; font-weight: bold; border: 1px solid #C00;">
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
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: left; font-size: 11px; font-weight: normal; border: 1px solid #C00;">
                <p style="margin: 1px">MQR/amc</p>
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
