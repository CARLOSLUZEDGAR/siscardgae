<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CURRICULUM RESUMEN</title>
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
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            /*line-height: 10px;
            font-size: 9px;*/
            /* border: 1px solid #C00; */
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
    <!-- <div>
        <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            /* border: black 1px; */
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10px; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: -->
                            <?php
                                // $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                // $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                // echo $fecha;
                            ?>
                        <!-- </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold;">
                        <span>Desarrollado por la: DIGETIC - -->
                            <?php
                               // $gestion_act = date("Y");
                                // echo $gestion_act;
                             ?>
                       <!-- </span>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div> -->
</footer>
    <main> 
        
    <div style="padding-top: 0.2cm; padding-bottom: 0cm; /*border: 1px solid #000;*/">
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/margin-bottom: 0px; " class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ vertical-align: bottom;">
                        <div style="text-align: center; width: 230px; font-size: 8pt; /*border: 1px solid #C00;*/">
                            <p style="margin: 1px;">FUERZA AÉREA BOLIVIANA</p>
                            <p style="margin: 1px;">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                            <p style="margin: 1px;"><u><strong>BOLIVIA</strong></u></p>
                        </div>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
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
        <div class="cabecera">
            <div style="padding-top: 15px; padding-bottom: 10px; text-align: center; font-size: 16px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CURRICULUM VITAE</p>
            </div>
            <?php
            $num = 1;
            ?>
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>DATOS PERSONALES</u></p>
            </div>  
            <div>
                <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px; padding-left: 1cm;" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <!-- <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: center;" rowspan="7"><span><img style="width:100; height:100; border: 2px solid #142A98;" src="../public/img/personal/{{$personal->per_foto}}"></span></td> -->
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">GRADO:</span></td>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}}</span></td>
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: center;" rowspan="7"><span><img style="width:100; height:100; border: 2px solid #142A98;" src="../public/img/personal/{{$personal->per_foto}}"></span></td>
                        </tr>
                        <tr>
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">NOMBRES Y APELLIDOS:</span></td>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</span></td>
                        </tr>
                        <tr>
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">LUGAR Y FECHA DE NAC.:</span></td>
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
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$personal->depanombre}}, <?php echo ($dia.' DE '.$meses[date($mes)-1].' DE '.$anio); ?></span></td>
                        </tr>
                        <tr>
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">ESPECIALIDAD:</span></td>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$personal->espenombre}} - {{$personal->subespenombre}}</span></td>
                        </tr>
                        <tr>
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">CARNET MILITAR:</span></td>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$personal->per_cm}}</span></td>
                        </tr>
                        <tr>
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">CARGO ACTUAL:</span></td>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$personal->descripcion}}</span></td>
                        </tr>
                        <tr>
                            @if(sizeof($datosfam) != 0)
                            <td width="30%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 12px; font-weight: bold;">DATOS FAMILIARES:</span></td>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;">
                            @foreach($datosfam as $row)
                                <p style="margin: 1px; font-size: 12px; /*font-weight: bold;*/">{{$row->datfamnombre}} {{$row->paterno}} {{$row->materno}} - {{$row->parentesco}}
                                </p>
                                @endforeach
                            </td>
                            @endif
                           
                        </tr>
                    </tbody>
                </table>
            </div>
            @if(sizeof($instituto) != 0 || sizeof($cursomil) != 0 || sizeof($otrocur) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FORMACIÓN PROFESIONAL</u></p>
            </div>
            @endif
            @if(sizeof($instituto) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">FORMACION EN INSTITUTOS MILITARES</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($instituto as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <!-- <td style="/*/*border: 1px solid #000;*/*/ padding: 1px; padding-left: 15px; font-size: 10px; text-align: center;"><span></span></td> -->
                        <?php
                        $date = date_create($row->fecha_otorgacion);
                        $fechaotorgacion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechaotorgacion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->tipcurdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($cursomil) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CURSOS MILITARES</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($cursomil as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <!-- <td style="/*/*border: 1px solid #000;*/*/ padding: 1px; padding-left: 15px; font-size: 12px; text-align: center;"><span></span></td> -->
                        <?php
                        $date = date_create($row->fecha_otorgacion);
                        $fechaotorgacion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechaotorgacion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->percurdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($otrocur) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">OTROS CURSOS</p>
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($otrocur as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <!-- <td style="/*/*border: 1px solid #000;*/*/ padding: 1px; padding-left: 1cm; font-size: 12px; text-align: center;"><span></span></td> -->
                        <?php
                        $date = date_create($row->fecha_otorgacion);
                        $fechaotorgacion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechaotorgacion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->tipcurdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($destinos) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>CARGOS Y DESTINOS</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($destinos as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_destino);
                        $fechadestino = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechadestino; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->n3desc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->cargdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($condecoracion) != 0 || sizeof($plaqueta) != 0 || sizeof($abanescol) != 0 || sizeof($constancia) != 0 || sizeof($otro) != 0 || sizeof($breins) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>PREMIOS Y DISTINCIONES</u></p>
            </div>
            @endif
            @if(sizeof($condecoracion) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CONDECORACIONES</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($condecoracion as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechadistincion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($plaqueta) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">PLAQUETA DE HONOR</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($plaqueta as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechadistincion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($abanescol) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">ABANDERADO Y ESCOLTA</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($abanescol as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechadistincion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($constancia) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CONSTANCIA MILITAR</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($constancia as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechadistincion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($otro) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">OTROS</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($otro as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechadistincion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($breins) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">BREVETS E INSIGNIAS</p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($breins as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_imposicion);
                        $fechaimposicion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechaimposicion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>{{$row->descripcion}} OTORGADO EN {{$row->nombre}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($ascenso) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ASCENSOS</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($ascenso as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fechasc);
                        $fechaascenso = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;" width="3cm"><span><?php echo $fechaascenso; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; vertical-align: top;"><span>AL GRADO DE {{$row->nombre}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 12px; text-align: center; vertical-align: top;"><span>{{$row->antigfin}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            <div style="padding-top: 70px; padding-bottom: 0px; text-align: center; /*border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 14px;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 14px; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
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
