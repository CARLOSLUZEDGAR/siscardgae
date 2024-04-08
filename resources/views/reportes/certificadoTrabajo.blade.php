<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICADO TRABAJO</title>
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
            padding-top: 0px;
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
            /* line-height: 24px; */
            /*font-size: 9px;*/
            /* border: 1px solid #C00; */
        }


        * {
            font-family: verdana, arial, sans-serif;
        }
    </style>
</head>
<body>

<header>        
    <!-- <div style="padding-top: 0px; padding-bottom: 0px;">
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
    </div> -->
</header> 

<footer>
    <div>
        <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            /* border: black 1px; */
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10pt; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: 
                            <?php
                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10pt; text-align: right; font-weight: bold;">
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
            <div style="padding-top: 0.5cm; padding-bottom: 0cm; text-align: center; font-size: 14pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px;"><u>CERTIFICADO DE TRABAJO</u></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: right; font-size: 11pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">No. {{$nro_doc}}/{{$gestion_act}}</p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">EL SUSCRITO JEFE DEL DEPARTAMENTO I PERSONAL DEL ESTADO MAYOR GENERAL DE LA FUERZA AÉREA BOLIVIANA</p>
                <p style="margin: 1px">CERTIFICA:</p>
            </div>
            
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: normal; /*border: 1px solid #C00;*/">   
                @if($personal->per_sexo=='MASCULINO')
                    <p style="margin: 1px">QUÉ, EL SEÑOR: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                @endif
                @if($personal->per_sexo=='FEMENINO')
                    <p style="margin: 1px">QUÉ, LA SEÑORA: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                @endif
            </div>
            @if($personal->detsitid == 1 || $personal->detsitid == 2 || $personal->detsitid == 6)
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">PRESTÁ SERVICIOS EN LA FUERZA AÉREA BOLIVIANA DE ACUERDO AL SIGUIENTE DETALLE:</p>
            </div>
            @else
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">PRESTÓ SERVICIOS EN LA FUERZA AÉREA BOLIVIANA DE ACUERDO AL SIGUIENTE DETALLE:</p>
            </div>
            @endif
            <?php
                        $dateinc = date_create($incorporacion->fecha_documento);
                        $fechaincorporacion = date_format($dateinc,"d/m/Y");
                        $datedoc = date_create($personal->fecha_documento);
                        $fechasitiacionactual = date_format($datedoc,"d/m/Y");
                        $datenow = date_create('now');
                        $fechaactual = date_format($datenow,"d/m/Y");
                        ?>
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">FECHA DE INCORPORACIÓN: <span style="font-weight: normal;">DESDE EL <?php echo $fechaincorporacion?></span></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">DOCUMENTO DE INCORPORACIÓN: <span style="font-weight: normal;">{{$incorporacion->documento}} {{$incorporacion->nrodoc}}</span></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">ESCALAFÓN: <span style="font-weight: normal;">{{$personal->esca_nombre}}</span></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">SUBESCALAFÓN: <span style="font-weight: normal;">{{$personal->subesca_nombre}}</span></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">GRADO O NIVEL INICIAL: <span style="font-weight: normal;">{{$primergrado->nombre}}</span></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">ÚLTIMO O ACTUAL DESTINO: </p>
                <p style="margin: 1px; font-weight: normal;">{{$personal->d2nom}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;{{$personal->d3nom}}</p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">FUNCIÓN O TAREA: <span style="font-weight: normal;">{{$personal->cardesc}}</span></p>
            </div>
            @if($personal->detsitid == 1 || $personal->detsitid == 2 || $personal->detsitid == 6)
            @else
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">DOCUMENTO Y FECHA DE RETIRO: </p>
                <p style="margin: 1px; font-weight: normal;">{{$personal->documento}} {{$personal->nrodoc}} DE FECHA <?php echo $fechasitiacionactual?></p>
            </div>
            @endif
            
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">SITUACIÓN MILITAR: </p>
                <p style="margin: 1px; font-weight: normal;">{{$personal->detsitnom}} SEGUN {{$personal->documento}} {{$personal->nrodoc}} DE FECHA <?php echo $fechasitiacionactual?></p>
            </div>
            @if($personal->detsitid == 1 || $personal->detsitid == 2 || $personal->detsitid == 6)
            @else
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">MOTIVO DE RETIRO: </p>
                <p style="margin: 1px; font-weight: normal;">{{$personal->detsitnom}}</p>
            </div>
            @endif
            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">GRADO O NIVEL FINAL O ACTUAL: <span style="font-weight: normal;">{{$personal->gra_nombre}}</span></p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
            <?php
            if($personal->detsitid == 1 || $personal->detsitid == 2 || $personal->detsitid == 6 ||  $personal->detsitid == 7){
                $date1 = new DateTime($incorporacion->fecha_documento);
                $date2 = new DateTime("now");
                $diff = $date1->diff($date2);
                function get_format($df) {
                    $str = '';
                    $str .= ($df->invert == 1) ? ' - ' : '';
                    if ($df->y > 0) {
                        // years
                        $str .= ($df->y > 1) ? $df->y . ' AÑOS ' : $df->y . ' AÑO ';
                    } if ($df->m > 0) {
                        // month
                        $str .= ($df->m > 1) ? $df->m . ' MESES ' : $df->m . ' MES ';
                    } if ($df->d > 0) {
                        // days
                        $str .= ($df->d > 1) ? $df->d . ' DÍAS ' : $df->d . ' DÍA ';
                    } 
                    echo $str;
                }
            }else{
                $date1 = new DateTime($incorporacion->fecha_documento);
                $date2 = new DateTime($personal->fecha_documento);
                $diff = $date1->diff($date2);
                function get_format($df) {
                    $str = '';
                    $str .= ($df->invert == 1) ? ' - ' : '';
                    if ($df->y > 0) {
                        // years
                        $str .= ($df->y > 1) ? $df->y . ' AÑOS ' : $df->y . ' AÑO ';
                    } if ($df->m > 0) {
                        // month
                        $str .= ($df->m > 1) ? $df->m . ' MESES ' : $df->m . ' MES ';
                    } if ($df->d > 0) {
                        // days
                        $str .= ($df->d > 1) ? $df->d . ' DÍAS ' : $df->d . ' DÍA ';
                    } 
                    echo $str;
                }
            }
            ?>
            @if($personal->detsitid == 1 || $personal->detsitid == 2 ||  $personal->detsitid == 6 || $personal->detsitid == 7)
                <p style="margin: 1px">TIEMPO TOTAL DE AÑOS DE SERVICIO AL: {{$fechaactual}}</P>
                <p style="margin: 1px; font-weight: normal;"><?php echo get_format($diff); ?></p>
            @else
                <p style="margin: 1px">TIEMPO TOTAL DE AÑOS DE SERVICIO AL: {{$fechasitiacionactual}} </P>
                <p style="margin: 1px; font-weight: normal;"><?php echo get_format($diff); ?></p>
            @endif
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">PROPÓSITO DE LA CERTIFICACIÓN: </P>
                <p style="margin: 1px; font-weight: normal;">{{$motivo}}</p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: justify; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">ES CUANTO TENGO A BIEN CERTIFICAR, PARA LOS FINES CONSIGUIENTES.</p>
            </div>

            <div style="padding-top: 0.3cm; padding-bottom: 0cm; text-align: right; font-size: 10pt; font-weight: normal; /*border: 1px solid #C00;*/">
                La Paz, 
                    <?php
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
            </div>

            <div style="padding-top: 0cm; padding-bottom: 0cm; text-align: center; font-size: 10pt; position: fixed; bottom: 3.5cm; left: 3cm; right: -3cm; /*border: 1px solid #C00;*/">
                <p style="margin: 0px; font-size: 12pt;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 0px; font-size: 12pt; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
                <p style="margin: 0px; padding-top: 0.3cm; font-size: 10pt; text-align: left;">{{$rubrica}}</p>
            </div>

        </div>
    </main>
    
    <script type="text/php">
            if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(310, 754, "$PAGE_NUM - $PAGE_COUNT", $font, 10);
                ');
            }
    </script>

</body>

</html>
