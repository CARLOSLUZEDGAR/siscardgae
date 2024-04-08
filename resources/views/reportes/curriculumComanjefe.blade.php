<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CURRICULUM COMANJEFE</title>
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
            
            /* border: 1px solid #C00; */
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 2cm;
            
            color: black;
            text-align: right;
            /*line-height: 10px;
            font-size: 9px;*/
            /* border: 1px solid #C00; */
            /* padding-top: 5px;
            padding-bottom: 0px; */
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
            /*font-size: 9px;*/
            /* border: 1px solid #C00; */
        }


        * {
            font-family: verdana, arial, sans-serif;
        }

        .lista {
            list-style: none;
        }

        .lista::before {
		content: "-";
		color: blue; 
		display: inline-block;
		width: 1cm;
		margin-left: -1em;
        border: 1px solid #000;
        padding-left: 0cm;
        
	}
        
    </style>
</head>
<body>

<header>        
    <!-- <div style="padding-top: 22px; padding-bottom: 1px;">
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
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10px; text-align: left; font-weight: bold;">
                        {{-- <span>Fecha de Emision:  --}}
                            <?php
                                // $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                // $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                // echo $fecha;
                            ?>
                        {{-- </span> --}}
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold;">
                        {{-- <span>Desarrollado por la: DIGETIC -  --}}
                            <?php
                                // $gestion_act = date("Y");
                                // echo $gestion_act;
                             ?>
                        {{-- </span> --}}
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
</footer>
    <main>  
        <div class="cabecera">
        <?php 

// echo "El número 100 en números romanos es: <strong>" . convertirNum(1987) . "</strong>";
// echo "<br/>";
// echo "El número 799 en números romanos es: <strong>" . convertirNum(799) . "</strong>";

function convertirNum($num){
    // intval(xxx) para que convierta explícitamente a int
    $n = intval($num);
    $res = '';
    // Array con los números romanos
    $roman_numerals = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    foreach ($roman_numerals as $roman => $number) {
        // Dividir para encontrar resultados en array
        $matches = intval($n / $number);
        // Asignar el numero romano al resultado
        $res .= str_repeat($roman, $matches);
        // Descontar el numero romano al total
        $n = $n % $number;
    }
    // Res = String
    return $res;
}
?>
            <?php
            $num = 1;
            ?>
            <div style="padding-top: 0px; padding-bottom: 0px;">
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                                <div style="text-align: center; width: 270px; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00; padding: 0px;*/">
                                    <p style="margin: 0px; /*border: 1px solid #C00;*/">FUERZA AÉREA BOLIVIANA</p>
                                    <p style="margin: 0px; /*border: 1px solid #C00;*/">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                                    <p style="margin: 0px; /*border: 1px solid #C00;*/"><u><strong>BOLIVIA</strong></u></p>
                                </div>
                            </td>
                        </tr>  
                    </tbody>
                </table>
            </div>
            <div style="padding-top: 1cm; text-align: right; font-size: 10pt; font-weight: bold; /*border: 1px solid #C00;*/" class="col-12">
                <!-- <div style="margin: 0px; /*border: 1px solid #C00;*/ display: inline-block; text-align: right; width: 64.5%;">APENDICE: 1 AL ANEXO "C"</div> -->
                <div style="margin: 0px; /*border: 1px solid #C00;*/ display: inline-block; text-align: center; width: 4cm;">LA PAZ, 
                    <?php
                        $fecha = date('d')."/".date('m')."/".date('Y');
                        echo $fecha;
                    ?>
                </div>
            </div>
            <!-- <div style="padding-top: 1cm; text-align: center; font-size: 10pt; font-weight: bold; border: 1px solid #C00;" >
                <p style="margin: 0px; border: 1px solid #C00;">APENDICE: 1 AL ANEXO "C"</p>
            </div> -->
            <div style="padding-top: 1cm; padding-bottom: 1cm; text-align: center; font-size: 14pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px;"><u>CURRICULUM VITAE</u></p>
            </div>
            <div style="padding-top: 0px; padding-bottom: 0px; padding-left: 0px; text-align: right; width: 4cm; position: fixed; top: 5cm; right: 2cm; /*font-size: 14px; font-weight: bold;*/ /*border: 1px solid #C00;*/">
                <span><img style="width:4cm; height:4cm; border-radius: 5px; /*border: black 2px;*/" src="../public/img/personal/{{$personal->per_foto}}"></span>
            </div>
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>DATOS PERSONALES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">I.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>DATOS PERSONALES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>  
            <div>
                <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ padding-left: 1cm; /*border: 1px solid #C00;*/" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">GRADO</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}}</span></td>
                        </tr>
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">NOMBRES Y APELLIDOS</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</span></td>
                        </tr>
                        <tr>
                        <?php
                            // $size = sizeof($datosfam);
                            // echo("el tamaño del aarray es $size. \n");
                            // if(sizeof($datosfam) == 0)
                            // echo("el array esta vacio.");
                            // echo $datosfam;
                            
                        $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
                        // echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');

                        list($anio, $mes, $dia) = explode("-",$personal->per_fecha_nacimiento);
                    
                            ?>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">LUGAR Y FECHA DE NAC.</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: {{$personal->depanombre}}, <?php echo ($dia.' DE '.$meses[date($mes)-1].' DE '.$anio); ?></span></td>
                        </tr>
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">ARMA DE ORIGEN</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: FUERZA AÉREA</span></td>
                        </tr>
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">ESPECIALIDAD</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: {{$personal->espenombre}} - {{$personal->subespenombre}}</span></td>
                        </tr>
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">CARNET MILITAR</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: {{$personal->per_cm}}</span></td>
                        </tr>
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-weight: bold;">DESTINO ACTUAL</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; /*font-weight: bold;*/">: {{$personal->n3nom}}</span></td>
                        </tr>
                        <!-- @if(sizeof($datosfam) != 0 )
                        <tr>
                            <td width="36%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12pt; font-weight: bold;">NOMBRE DE LA ESPOSA E HIJOS</span></td>
                            <td width="64%" style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; font-size: 12pt; text-align: justify; vertical-align: top;">
                            @foreach($datosfam as $row)
                                <p style="margin: 1px; font-size: 12pt; /*font-weight: bold;*/">: {{$row->datfamnombre}} {{$row->paterno}} {{$row->materno}} - {{$row->parentesco}}
                                </p>
                                @endforeach
                            </td>
                        </tr>
                        @endif -->
                    </tbody>
                </table>
            </div>

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>TIEMPO DE SERVICIO GENERAL.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">II.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>TIEMPO DE SERVICIO GENERAL.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            <?php
            if($personal->detsit_cod == 1 || $personal->detsit_cod == 2 || $personal->detsit_cod == 6 ||  $personal->detsit_cod == 7){
                $date1 = new DateTime($situacion->fecha_documento);
                $date2 = new DateTime("now");
                $diff = $date1->diff($date2);
                function get_formato($df) {
                    $str = '';
                    $str .= ($df->invert == 1) ? ' - ' : '';
                    if ($df->y > 0) {
                        // years
                        $str .= ($df->y > 1) ? $df->y . ' AÑOS ' : $df->y . ' AÑO ';
                    } 
                    if ($df->m > 0) {
                        // month
                        $str .= ($df->m > 1) ? $df->m . ' MESES ' : $df->m . ' MES ';
                    } 
                    if ($df->d > 0) {
                        // days
                        $str .= ($df->d > 1) ? $df->d . ' DÍAS ' : $df->d . ' DÍA ';
                    } 
                    //if ($df->h > 0) {
                    //     // hours
                    //     $str .= ($df->h > 1) ? $df->h . ' Hours ' : $df->h . ' Hour ';
                    // } if ($df->i > 0) {
                    //     // minutes
                    //     $str .= ($df->i > 1) ? $df->i . ' Minutes ' : $df->i . ' Minute ';
                    // } if ($df->s > 0) {
                    //     // seconds
                    //     $str .= ($df->s > 1) ? $df->s . ' Seconds ' : $df->s . ' Second ';
                    // }
                    echo $str;
                    }
            }else{
                $date1 = new DateTime($situacion->fecha_documento);
                $date2 = new DateTime($personal->fecha_documento);
                $diff = $date1->diff($date2);
                function get_formato($df) {
                    $str = '';
                    $str .= ($df->invert == 1) ? ' - ' : '';
                    if ($df->y > 0) {
                        // years
                        $str .= ($df->y > 1) ? $df->y . ' AÑOS ' : $df->y . ' AÑO ';
                    } 
                    if ($df->m > 0) {
                        // month
                        $str .= ($df->m > 1) ? $df->m . ' MESES ' : $df->m . ' MES ';
                    } 
                    if ($df->d > 0) {
                        // days
                        $str .= ($df->d > 1) ? $df->d . ' DÍAS ' : $df->d . ' DÍA ';
                    } 
                    //if ($df->h > 0) {
                    //     // hours
                    //     $str .= ($df->h > 1) ? $df->h . ' Hours ' : $df->h . ' Hour ';
                    // } if ($df->i > 0) {
                    //     // minutes
                    //     $str .= ($df->i > 1) ? $df->i . ' Minutes ' : $df->i . ' Minute ';
                    // } if ($df->s > 0) {
                    //     // seconds
                    //     $str .= ($df->s > 1) ? $df->s . ' Seconds ' : $df->s . ' Second ';
                    // }
                    echo $str;
                    }
            }
            
            ?>
            <div style="padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; text-align: justify; font-size: 12pt; /*border: 1px solid #C00;*/">
                <p style="margin: 0px"><?php echo get_formato($diff); ?></p>
            </div>
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 0px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FOJAS DE CONCEPTO DE TODA LA CARRERA.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">III.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>FOJAS DE CONCEPTO DE TODA LA CARRERA.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            <div style="padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; text-align: justify; font-size: 12pt; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">{{$notafojas}}</p>
            </div>
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 0px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;<u>CURSOS MILITARES REALIZADOS.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">IV.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>CURSOS MILITARES REALIZADOS.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($cursomil) != 0)
                @foreach($cursomil as $row) 
                <?php
                    $date = date_create($row->fecha_otorgacion);
                    $fechaotorgacion = date_format($date,"d/m/Y");
                ?>
                <!-- <div style="padding-top: 0px; padding-bottom: 0px; padding-left: 1cm; text-align: justify; font-size: 12pt; border: 1px solid #C00;"> -->
                <!-- <ul class="lista"> -->
                <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                    <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                        <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: right; font-size: 12pt;">{{$row->percurdesc}} DE FECHA <?php echo $fechaotorgacion; ?></span>
                    </li>
                </ul>
                <!-- </div> -->
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>CURSOS ACADÉMICOS MILITARES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">V.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>CURSOS ACADÉMICOS MILITARES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if($personal->idesc == 1)
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; padding-left: 1cm;" class="table table-bordered table-striped">
                <thead class="table-striped">
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center; font-weight: bold;">
                            CURSOS ACADEMICOS MILITARES
                        </td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center; font-weight: bold;">
                            PROMEDIO
                        </td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center; font-weight: bold;">
                            ORDEN DE MERITO
                        </td>
                    </tr>  
                </thead>
                <tbody class="table-striped">
                    
                    <tr>
                    @if($personal->idsubesc == 1 || $personal->idsubesc == 2 ||$personal->idsubesc == 3)
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; padding-left: 0.3cm">CURSO DE ESCUADRON AÉREO</td>
                    @else
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; padding-left: 0.3cm; ">CURSO DE PERFECCIONAMIENTO</td>
                    @endif
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center">{{$promedioact}}</td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center">{{$meritoact}}</td>
                    </tr>
                    <tr>
                    @if($personal->idsubesc == 1 || $personal->idsubesc == 2 ||$personal->idsubesc == 3)
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; padding-left: 0.3cm">CURSO DE COMANDO Y ESTADO MAYOR AÉREO</td>
                    @else
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; padding-left: 0.3cm">CURSO DE SUPERVISIÓN</td>
                    @endif
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center">{{$promediodip}}</td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 10pt; text-align: center">{{$meritodip}}</td>
                    </tr>
                </tbody>
            </table>
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CORRESPONDE.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;<u>CURSOS ACADEMICOS CIVILES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">VI.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>CURSOS ACADEMICOS CIVILES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($otrocur) != 0)
                @foreach($otrocur as $row)
                    <?php
                    $date = date_create($row->fecha_otorgacion);
                    $fechaotorgacion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->percurdesc}} DE FECHA <?php echo $fechaotorgacion; ?></span>
                        </li>
                    </ul>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;<u>CARGOS Y DESTINOS.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">VII.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>CARGOS Y DESTINOS.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($destinos) != 0)
                @foreach($grados as $fila)
                    <div style="/*border: 1px solid #000;*/ /*display: inline-block;*/ padding-left: 1cm; /*width: 52%;*/ vertical-align: top; text-align: left; padding-top: 0.3cm; padding-bottom: 0.3cm; font-weight: bold;"><label class="form-control-label"><u>{{$fila->nombre}}:</u></label></div>      
                    @foreach($destinos as $row)
                        @if($fila->id == $row->id)
                        <?php
                            $date = date_create($row->fecha_destino);
                            $fechadestino = date_format($date,"d/m/Y");
                        ?>
                        <!-- <div class="form-group row" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: justify; vertical-align: top;"> -->
                        <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm; font-size: 12pt">
                            <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; padding-top: 0.3cm; padding-bottom: 0.3cm"><label class="form-control-label"><?php echo $fechadestino; ?></label></div>
                            <div style="/*border: 1px solid #000;*/ display: inline-block; width: 52%; vertical-align: top; text-align: left; padding-top: 0.3cm; padding-bottom: 0.3cm"><label class="form-control-label">{{$row->n3desc}}</label></div>
                            <div style="/*border: 1px solid #000;*/ display: inline-block; width: 25%; vertical-align: top; text-align: left; padding-top: 0.3cm; padding-bottom: 0.3cm"><label class="form-control-label">{{$row->cargdesc}}</label></div>
                        </div>
                        @endif
                    @endforeach
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;<u>DESTINOS EN FRONTERA.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">VIII.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>DESTINOS EN FRONTERA.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($destinosfront) != 0)
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; padding-left: 1cm;" class="table table-bordered table-striped">
                    <!-- <thead class="table-striped"> -->
                        <tr>
                            <td rowspan="2" style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                N°
                            </td>
                            <td rowspan="2" style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                GRADO
                            </td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                FECHA
                            </td>
                            <td colspan="3" style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                TIEMPO
                            </td>
                            <td rowspan="2" style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                UNIDAD
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                DESDE
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                HASTA
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                DÍAS
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                MESES
                            </td>
                            <td style="border: 1px solid #000; padding: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                                AÑOS
                            </td>
                        </tr>
                    <!-- </thead> -->
                
                    <!-- <tbody class="table-striped"> -->
                        <?php
                            //calculo cantidad de elementos del array
                            $long = sizeof($destinos);
                            //json_decode convierte datos en json a un array
                            $array=json_decode($destinos,true);
                            //calculo de la fecha actual
                            $fechaact = date('Y-m-d');
                            //variable para la siguiente fecha
                            $x = 0;
                            //variable para la numeracion
                            $nume = 0;
                            //variable para ser restada al final
                            $dteNow = new DateTime('now');
                            //variable donde se suma las diferencias de fechas
                            $dteDiff = new DateTime('now');
                            for ($i=0; $i < $long ; $i++) { 
                                $x = $i + 1;
                                //pregunta $i el nro de array y ['nombre_columna_query']
                                if($array[$i]['frontera'] == 1){
                                    $nume = $nume + 1;
                                    //hace el recorrido hasta el penultimo elemento del array
                                    if ($x<$long){
                                        $date1 = new DateTime($array[$i]['fecha_destino']);
                                        $date2 = new DateTime($array[$x]['fecha_destino']);
                                        $diffe = $date1->diff($date2);
                                        $dteDiff->add($diffe);
                                        //sacar la diferencia en dias
                                        $diferencia = $diffe->days;
                                        // if($diferencia >= 181){
                                            echo '<tr>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;" width="1cm"><span>'.$nume.'</span></td>';
                                            $date = date_create($array[$i]['fecha_destino']);
                                            $fechainicio = date_format($date,"d/m/Y");
                                            $date = date_create($array[$x]['fecha_destino']);
                                            $fechafinal = date_format($date,"d/m/Y");
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$array[$i]['abreviatura'].'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$fechainicio.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$fechafinal.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$diffe->d.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$diffe->m.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$diffe->y.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: justify;"><span>'.$array[$i]['n3desc'].'</span></td>';
                                            echo '</tr>';
                                        // }
                                    }
                                    //se emplea para el ultimo destino donde no se tiene la final del destino
                                    else{
                                        $date1 = new DateTime($array[$i]['fecha_destino']);
                                        $date2 = new DateTime($fechaact);
                                        $diffe = $date1->diff($date2);
                                        $dteDiff->add($diffe);
                                        $diferencia = $diffe->days;
                                        // if($diferencia >= 181){
                                            echo '<tr>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;" width="1cm"><span>'.$nume.'</span></td>';
                                            $date = date_create($array[$i]['fecha_destino']);
                                            $fechainicio = date_format($date,"d/m/Y");
                                            // $date = date_create($array[$x]['fecha_destino']);
                                            $fechafinal = date_format($date2,"d/m/Y");
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$array[$i]['abreviatura'].'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$fechainicio.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$fechafinal.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$diffe->d.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$diffe->m.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: center;"><span>'.$diffe->y.'</span></td>';
                                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 10pt; text-align: justify;"><span>'.$array[$i]['n3desc'].'</span></td>';
                                            echo '</tr>';
                                        // }
                                    }
                                }
                            }
                            //variable donde obtenemos tiempo en frontera
                            $tiempoTotalFrontera =  $dteDiff->diff($dteNow);
                            echo '<tr>';
                            echo '<td colspan="4" style="border: 1px solid #000; padding: 5px; font-size: 11pt; font-weight: bold; text-align: center;"><span>TOTAL</span></td>';
                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 11pt; font-weight: bold; text-align: center;"><span>'.$tiempoTotalFrontera->d.'</span></td>';
                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 11pt; font-weight: bold; text-align: center;"><span>'.$tiempoTotalFrontera->m.'</span></td>';
                            echo '<td style="border: 1px solid #000; padding: 5px; font-size: 11pt; font-weight: bold; text-align: center;"><span>'.$tiempoTotalFrontera->y.'</span></td>';
                            echo '<td style="/*border: 1px solid #000;*/ padding: 5px; font-size: 11pt; font-weight: bold; text-align: justify;"><span></span></td>';
                            echo '</tr>';
                        ?>
                    <!-- </tbody> -->
                </table>
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;<u>PROFESORADO MILITAR.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">IX.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>PROFESORADO MILITAR.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FELICITACIONES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">X.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>FELICITACIONES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($felicitacion) != 0)    
                @foreach($felicitacion as $row)
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm; font-size: 12pt;">   
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 60%; vertical-align: top; text-align: left; padding-top: 0.3cm; padding-bottom: 0.3cm"><label class="form-control-label">{{$row->n2disdesc}}</label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 10%; vertical-align: top; text-align: right; padding-top: 0.3cm; padding-bottom: 0.3cm"><label class="form-control-label">{{$row->cantfel}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>    
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;<u>CONDECORACIONES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XI.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>CONDECORACIONES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($condecoracion) != 0)
                @foreach($condecoracion as $row)  
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->pdisdesc}} DE FECHA <?php echo $fechadistincion; ?></span>
                        </li>
                    </ul>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;<u>PREMIOS Y DISTINCIONES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XII.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>PREMIOS Y DISTINCIONES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($plaqueta) != 0 || sizeof($diploma) != 0 || sizeof($otro) != 0)
                @foreach($plaqueta as $row)
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->pdisdesc}} DE FECHA <?php echo $fechadistincion; ?></span>
                        </li>
                    </ul>
                @endforeach
                @foreach($diploma as $row)
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->pdisdesc}} DE FECHA <?php echo $fechadistincion; ?></span>
                        </li>
                    </ul>                
                @endforeach
                @foreach($otro as $row)
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->pdisdesc}} DE FECHA <?php echo $fechadistincion; ?></span>
                        </li>
                    </ul>                
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;<u>ASCENSOS (AÑO DE ANTIGUEDAD).</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XIII.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>ASCENSOS (AÑO DE ANTIGUEDAD).</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($ascenso) != 0)
            <table frame="border" width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; padding-left: 1cm;" class="table table-bordered table-striped">
                <thead class="table-striped">
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: center; font-weight: bold;">
                            GRADO
                        </td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: center; font-weight: bold;">
                           ORDEN DE MERITO
                        </td>
                        <!-- <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 11pt; text-align: center; font-weight: bold;">
                            FECHA
                        </td> -->
                    </tr>  
                </thead>
                <tbody class="table-striped">
                    @foreach($ascenso as $row) 
                    <tr>  
                        <?php
                            $date = date_create($row->fechasc);
                            $fechaascenso = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: justify;"><span>{{$row->nombre}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 3px; padding-right: 3px; font-size: 12pt; text-align: center; vertical-align: top;" width="4cm"><span>{{$row->antigfin}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;<u>ABANDERADOS Y ESCOLTAS.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XIV.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>ABANDERADOS Y ESCOLTAS.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($abanescol) != 0)
                @foreach($abanescol as $row) 
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->pdisdesc}} DE FECHA <?php echo $fechadistincion; ?></span>
                        </li>
                    </ul>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;<u>REPRESENTACIONES O COMISIONES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XV.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>REPRESENTACIONES O COMISIONES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($representacion) != 0)
                @foreach($representacion as $row)  
                    <?php
                        $date = date_create($row->fecha);
                        $fecharepresentacion = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->perrepdesc}} DE FECHA <?php echo $fecharepresentacion; ?></span>
                        </li>
                    </ul>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>         
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;<u>SUMARIOS.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XVI.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>SUMARIOS.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($sumario) != 0)
                @foreach($sumario as $row)  
                    <?php
                        $date = date_create($row->fecha_sancion);
                        $fecha_sumario = date_format($date,"d/m/Y");
                    ?>
                    <ul style="/*border: 1px solid #000;*/ padding-left: 1.3cm;">
                        <li style="/*border: 1px solid #000;*/ padding-left: 0.6cm;">
                            <span style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; text-align: justify; font-size: 12pt;">{{$row->sandesc}}, {{$row->f2}}, {{$row->observacion}}, SEGÚN {{$row->documento}} NRO. {{$row->ndoc}} DE FECHA <?php echo $fecha_sumario; ?></span>
                        </li>
                    </ul>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>         
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;<u>SANCIONES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XVII.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>SANCIONES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if(sizeof($sancion) != 0)
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; padding-left: 1cm;" class="table table-bordered table-striped">
                <thead class="table-striped">
                    <tr>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: center; font-weight: bold;">
                            SANCIÓN IMPUESTA
                        </td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: center; font-weight: bold;">
                            CANTIDAD
                        </td>
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: center; font-weight: bold;">
                            DÍAS DE SANCIÓN
                        </td>
                    </tr>  
                </thead>
                <tbody class="table-striped">
                    @foreach($sancion as $row) 
                    <tr>  
                        <?php
                            // $date = date_create($row->fechasc);
                            // $fechaascenso = date_format($date,"d/m/Y");
                            $total_dias = $row->cant_sancion * $row->dias;
                        ?>
                        @if($row->horas == 1)
                            @if($row->dias > 3)
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: left;"><span>ARRESTO {{$row->dias}} DIAS</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;"><span>{{$row->cant_sancion}}</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;" width="4cm"><span><?php echo $total_dias; ?></span></td>
                            @endif
                            @if($row->dias == 3)
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: left"><span>ARRESTO 72 HRS</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;"><span>{{$row->cant_sancion}}</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;" width="4cm"><span><?php echo $total_dias; ?></span></td>
                            @endif
                            @if($row->dias == 2)
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: left"><span>ARRESTO 48 HRS</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;"><span>{{$row->cant_sancion}}</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;" width="4cm"><span><?php echo $total_dias; ?></span></td>
                            @endif
                            @if($row->dias == 1)
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: left"><span>ARRESTO 24 HRS</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;"><span>{{$row->cant_sancion}}</span></td>
                                <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;" width="4cm"><span><?php echo $total_dias; ?></span></td>
                            @endif
                        @endif
                        @if($row->horas == 0)
                            <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: left;"><span>LLAMADA DE ATENCIÓN</span></td>
                            <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;"><span>{{$row->cant_sancion}}</span></td>
                            <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; padding-left: 3px; padding-right: 3px; font-size: 12pt; vertical-align: top; text-align: center;" width="4cm"><span><?php echo $total_dias; ?></span></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 12pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <!-- <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.<u>OBSERVACIONES.</u></p> -->
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; padding: 0px;" class="table table-bordered table-striped">
                    <tr>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px; width: 1cm;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/">XVIII.</p>
                            </div>
                        </td>
                        <td style="/*border: 1px solid #000;*/ vertical-align: bottom; padding: 0px;">
                            <div style="text-align: left; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/ padding: 0px;">
                                <p style="margin: 0px; /*border: 1px solid #C00;*/"><u>OBSERVACIONES.</u></p>
                            </div>
                        </td>
                    </tr>  
                </table>
            </div>
            @if($observacion=='')
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>SIN OBSERVACIONES.</span></div>
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 0.3cm; padding-bottom: 0.3cm; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 12pt;"><span>{{$observacion}}</span></div>
            @endif

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 12pt; font-weight: bold; border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 12pt;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 12pt; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
                <p style="margin: 0px; padding-top: 0.3cm; font-size: 12pt; text-align: left;">{{$rubrica}}</p>
            </div>

        </div>

    </main>
    
    <script type="text/php">
            if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(310, 760, "$PAGE_NUM - $PAGE_COUNT", $font, 10);
                ');
            }
    </script>

</body>

</html>
