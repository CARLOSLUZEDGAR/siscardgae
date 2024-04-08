<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CURRICULUM VITAE</title>
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

            <div style="padding-top: 1.5cm; padding-bottom: 1.5cm; text-align: center; font-size: 14pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px;"><u>CURRICULUM VITAE</u></p>
            </div>
            <div style="padding-top: 0px; padding-bottom: 0px; padding-left: 400px; text-align: center; position: fixed; top: 5.2cm; left: 5.2cm; right: -1cm; /*font-size: 14px; font-weight: bold;*/ /*border: 1px solid #C00;*/">
                <span><img style="width:4cm; height:4cm; border-radius: 5px; /*border: black 2px;*/" src="../public/img/personal/{{$personal->per_foto}}"></span>
            </div>
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>DATOS PERSONALES.</u></p>
            </div>  
            <div>
                <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px; padding-left: 1cm; /*border: 1px solid #C00;*/" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">GRADO</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}}</span></td>
                        </tr>
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">NOMBRES Y APELLIDOS</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</span></td>
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
                                <span>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">LUGAR Y FECHA DE NAC.</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->depanombre}}, <?php echo ($dia.' DE '.$meses[date($mes)-1].' DE '.$anio); ?></span></td>
                        </tr>
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">ESPECIALIDAD</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->espenombre}} - {{$personal->subespenombre}}</span></td>
                        </tr>
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">CARNET MILITAR</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->per_cm}}</span></td>
                        </tr>
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">CARGO ACTUAL</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->descripcion}}</span></td>
                        </tr>
                        <!-- @if(sizeof($datosfam) != 0 )
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">NOMBRE DE LA ESPOSA E HIJOS</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;">
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
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FORMACIÓN PROFESIONAL</u></p>
            </div>
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">FORMACIÓN EN INSTITUTOS MILITARES</p>
            </div>
            @if(sizeof($instituto) != 0)           
                @foreach($instituto as $row) 
                    <?php
                        $date = date_create($row->fecha_otorgacion);
                        $fechaotorgacion = date_format($date,"d/m/Y");
                    ?>
                    <!-- <div class="form-group row" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: justify; vertical-align: top;"> -->
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaotorgacion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->descurdesc}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">CURSOS MILITARES</p>
            </div>
            @if(sizeof($cursomil) != 0)
                @foreach($cursomil as $row) 
                <?php
                    $date = date_create($row->fecha_otorgacion);
                    $fechaotorgacion = date_format($date,"d/m/Y");
                ?>
                <!-- <div style="padding-top: 0px; padding-bottom: 0px; padding-left: 1cm; text-align: justify; font-size: 12pt; border: 1px solid #C00;"> -->
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaotorgacion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->percurdesc}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">OTROS CURSOS</p>
            </div>
            @if(sizeof($otrocur) != 0)
                @foreach($otrocur as $row)
                    <?php
                    $date = date_create($row->fecha_otorgacion);
                    $fechaotorgacion = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaotorgacion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->descurdesc}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <?php
            $date1 = new DateTime($situacion->fecha_documento);
            $date2 = new DateTime("now");
            $diff = $date1->diff($date2);
            function get_format($df) {
                $str = '';
                $str .= ($df->invert == 1) ? ' - ' : '';
                if ($df->y > 0) {
                    // years
                    $str .= ($df->y > 1) ? $df->y . ' AÑOS, ' : $df->y . ' AÑO, ';
                } if ($df->m > 0) {
                    // month
                    $str .= ($df->m > 1) ? $df->m . ' MESES Y ' : $df->m . ' MES Y ';
                } if ($df->d > 0) {
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
                // echo '<div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 12pt; /*border: 1px solid #C00;*/">';
                // echo '<p style="margin: 1px">'.$str.'</p>';
                // echo '</div>';
                }
            ?>
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;<u>CARGOS Y DESTINOS.</u></p>
            </div>
            @if(sizeof($destinos) != 0)           
                @foreach($destinos as $row) 
                    <?php
                        $date = date_create($row->fecha_destino);
                        $fechadestino = date_format($date,"d/m/Y");
                    ?>
                    <!-- <div class="form-group row" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: justify; vertical-align: top;"> -->
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechadestino; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 52%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->n3desc}}</label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 25%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->cargdesc}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;<u>PREMIOS Y DISTINCIONES</u></p>
            </div>
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">CONDECORACIONES</p>
            </div>
            @if(sizeof($condecoracion) != 0)
                @foreach($condecoracion as $row)  
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechadistincion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->pdisdesc}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">PLAQUETAS DE HONOR</p>
            </div>
            @if(sizeof($plaqueta) != 0)
                @foreach($plaqueta as $row)
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechadistincion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->pdisdesc}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">ABANDERADO Y ESCOLTA</p>
            </div>
            @if(sizeof($abanescol) != 0)
                @foreach($abanescol as $row) 
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechadistincion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->pdisdesc}}</label></div>
                    </div>                
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">CONSTANCIA MILITAR</p>
            </div>
            @if(sizeof($constancia) != 0)
                @foreach($constancia as $row) 
                    <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechadistincion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->pdisdesc}}</label></div>
                    </div>                
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; padding-left: 1cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">BREVETS E INSIGNIAS</p>
            </div>
            @if(sizeof($breins) != 0)
                @foreach($breins as $row) 
                    <?php
                        $date = date_create($row->fecha_imposicion);
                        $fechaimposicion = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaimposicion; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->descripcion}}</label></div>
                    </div>                
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ASCENSOS</u></p>
            </div>
            @if(sizeof($ascenso) != 0)           
                @foreach($ascenso as $row) 
                    <?php
                        $date = date_create($row->fechasc);
                        $fechaascenso = date_format($date,"d/m/Y");
                    ?>
                    <!-- <div class="form-group row" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: justify; vertical-align: top;"> -->
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaascenso; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 52%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">AL GRADO DE {{$row->nombre}}</label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 25%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->antigfin}}</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 12pt; font-weight: bold; border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 12pt;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 12pt; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
                <p style="margin: 0px; padding-top: 0.3cm; font-size: 10pt; text-align: left;">{{$rubrica}}</p>
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
