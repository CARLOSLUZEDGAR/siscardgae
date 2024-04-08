<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CURRICULUM GENERAL</title>
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
            <div style="padding-top: 15px; padding-bottom: 10px; text-align: center; font-size: 16px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CURRICULUM VITAE</p>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
            
                <p style="margin: 1px"><?php echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATOS PERSONALES: <span style="font-weight: normal;">{{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</span></p>
            </div>

            <!-- <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; border: 1px solid #C00;">
                <label style="margin: 1px">I.</label>
                <label style="margin: 1px; padding-left: 1cm;">DATOS PERSONALES: <label style="font-weight: normal;">{{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</label></label>
            </div> -->
            
            <div>
                <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px;" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td width="40%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: center;"><span><img style="width:90; height:90; border: 2px solid #142A98;" src="../public/img/personal/{{$personal->per_foto}}"></span></td>

                            <td width="60%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 10px; text-align: left;">
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
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">LUGAR Y FECHA DE NACIMIENTO:</p>
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->depanombre}}, <?php echo ($dia.' DE '.$meses[date($mes)-1].' DE '.$anio); ?></p>
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">ESTADO CIVIL:</p>
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$personal->per_estado_civil}}</p>
                                    @if(sizeof($datosfam) != 0)
                                    <p style="margin: 1px; font-size: 14px; font-weight: bold;">NOMBRES DE SUS FAMILIARES</p>
                                    
                                    @foreach($datosfam as $row)
                                    <p style="margin: 1px; font-size: 14px; /*font-weight: bold;*/"> {{$row->datfamnombre}} {{$row->paterno}} {{$row->materno}} - {{$row->parentesco}}</p>
                                    @endforeach
                                
                                    @endif
                                   
                                </span>
                            </td>
                            
                        </tr> 
                    </tbody>
                </table>
            </div>
            @if(sizeof($cursos) != 0 || sizeof($proflibre) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FORMACIÓN PROFESIONAL. </p>
            </div>
            @endif
            @if(sizeof($cursos) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>CURSOS</u></p>
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($cursos as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <!-- <td style="/*border: 1px solid #000;*/ padding: 1px; padding-left: 15px; font-size: 10px; text-align: center;"><span></span></td> -->
                        <?php
                        $date = date_create($row->fecha_otorgacion);
                        $fechaotorgacion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->curdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->tipcurdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->descurdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->documento}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechaotorgacion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($proflibre) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>PROFESION LIBRE</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($proflibre as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_egreso);
                        $fechaegreso = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->cardesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->nivprofdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->lugar_estudio}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechaegreso; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($proflibre) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>PROFESORADO</u></p>
            </div>
            @endif
            @if(sizeof($destinos) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESTINOS. </p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3desc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->cargdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadestino; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($abanescol) != 0 || sizeof($condecoracion) != 0 || sizeof($constancia) != 0 || sizeof($diploma) != 0 || sizeof($felicitacion) != 0 || sizeof($otro) != 0 || sizeof($plaqueta) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PREMIOS Y DISTINCIONES. </p>
            </div>
            @endif
            @if(sizeof($abanescol) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>ABANDERADO Y ESCOLTA</u></p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($condecoracion) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>CONDECORACIONES</u></p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($constancia) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>CONSTANCIA MILITAR</u></p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($diploma) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>DIPLOMAS</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($diploma as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($felicitacion) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>FELICITACIONES</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($felicitacion as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_distincion);
                        $fechadistincion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($otro) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>OTROS</u></p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($plaqueta) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>PLAQUETAS DE HONOR</u></p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n2disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->n3disdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pdisdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadistincion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($breins) != 0 || sizeof($representacion) != 0 || sizeof($designacion) != 0 || sizeof($tribunal) != 0 || sizeof($componente) != 0 || sizeof($revista) != 0 || sizeof($publicacion) != 0 || sizeof($proyecto) != 0 )
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo convertirNum($num); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESEMPEÑO PROFESIONAL. </p>
            </div>
            @endif
            @if(sizeof($breins) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>BREVETS E INSIGNIAS</u></p>
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
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->descripcion}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechaimposicion; ?></span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->nombre}}</span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($representacion) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>REPRESENTACIONES</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($representacion as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha);
                        $fecharepresentacion = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->repdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->perrepdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fecharepresentacion; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($designacion) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>DESIGNACIONES</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($designacion as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha);
                        $fecha = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->descripcion}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fecha; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($tribunal) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>MIEMBRO DE TRIBUNALES</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($tribunal as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha);
                        $fecha = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->tridesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->descripcion}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fecha; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($componente) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>COMPONENTE DEL CIES Y EME</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($componente as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_doc);
                        $fechadoc = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px;"><span>{{$row->descripcion}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechadoc; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($revista) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>REVISTAS MILITARES</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($revista as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha);
                        $fecha = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->compania}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->lugar}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fecha; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($publicacion) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>PUBLICACIONES REALIZADAS</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($publicacion as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha_doc);
                        $fechapub = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->pubdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->perpubdesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fechapub; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            @if(sizeof($proyecto) != 0)
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 14px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><u>PROYECTOS DE INGENIERIA MILITAR</u></p>
            </div>
            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px; padding-left: 1cm;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($proyecto as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <tr>  
                        <?php
                        $date = date_create($row->fecha);
                        $fecha = date_format($date,"d/m/Y");
                        ?>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->prodesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; vertical-align: top;"><span>{{$row->perprodesc}}</span></td>
                        <td style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; font-size: 10px; text-align: center; vertical-align: top;" width="2cm"><span><?php echo $fecha; ?></span></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            @endif
            <div style="padding-top: 2px; padding-bottom: 2px; text-align: right; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                La Paz, 
                    <?php
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
            </div>

            <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px; color: #0E2BE8">Esta informacion está sujeta a verificación del Departamento I - Personal, por lo que carece de valor legal</p>
            </div>

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; font-weight: bold; /*font-size: 14px;  border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 14px;">{{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
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
