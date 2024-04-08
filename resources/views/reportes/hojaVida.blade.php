<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOJA DE VIDA</title>
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
                <p style="margin: 0px;"><u>HOJA DE VIDA</u></p>
            </div>
            <div style="padding-top: 0px; padding-bottom: 0px; padding-left: 400px; text-align: center; position: fixed; top: 5cm; left: 5.2cm; right: -1cm; /*font-size: 14px; font-weight: bold;*/ /*border: 1px solid #C00;*/">
                <span><img style="width:4cm; height:4cm; border-radius: 5px; /*border: black 2px;*/" src="../public/img/personal/{{$personal->per_foto}}"></span>
            </div>
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>DATOS PERSONALES.</u></p>
            </div>  
            <div>
                <table width="100%" style="border-collapse: collapse;border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px; padding-left: 1cm; /*border: 1px solid #C00;*/" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">a. Grado</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}}</span></td>
                        </tr>
                        <tr>
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">b. Nombres y Apellidos</span></td>
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
                            <td width="35%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: left; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; font-weight: bold;">c. Lugar y Fecha de Nac.</span></td>
                            <td width="65%" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: justify; vertical-align: top;"><span style="margin: 1px; font-size: 11pt; /*font-weight: bold;*/">: {{$personal->depanombre}}, <?php echo ($dia.' DE '.$meses[date($mes)-1].' DE '.$anio); ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ORDEN DE MÉRITO EN CADA GRADO (ANTIGUEDAD).</u></p>
            </div>
            @if(sizeof($ascenso) != 0)
                @foreach($ascenso as $row)
                    <?php
                        $date = date_create($row->fechasc);
                        $fechaascenso = date_format($date,"d/m/Y");
                    ?>
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 65%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">AL GRADO DE {{$row->nombre}}</label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 15%; vertical-align: top; text-align: center; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->antigfin}}</label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: right; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaascenso; ?></label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>CURSOS MILITARES.</u></p>
            </div>
            @if(sizeof($cursomil) != 0)
                @foreach($cursomil as $row) 
                <?php
                    $date = date_create($row->fecha_otorgacion);
                    $fechaotorgacion = date_format($date,"d/m/Y");
                ?>
                <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                    <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaotorgacion; ?></label></div>
                    <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->percurdesc}}</label></div>
                </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 0px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>CURSOS ACADÉMICOS MILITARES.</u></p>
            </div>
            @if(sizeof($instituto) != 0)
                @foreach($instituto as $row) 
                <?php
                    $date = date_create($row->fecha_otorgacion);
                    $fechaotorgacion = date_format($date,"d/m/Y");
                ?>
                <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                    <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechaotorgacion; ?></label></div>
                    <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: justify; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->percurdesc}}</label></div>
                </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>HORAS DE VUELO.</u></p>
            </div>
            <div style="padding-top: 2px; padding-bottom: 2px; padding-left: 1cm; text-align: justify; font-size: 11pt; /*border: 1px solid #C00;*/">
                <p style="margin: 0px">{{$horavuelo}} Hrs.</u></p>
            </div>

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>DESTINOS EN FRONTERA.</u></p>
            </div>
            @if(sizeof($destinosfront) != 0) 
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
                    // $num = 0;
                    //variable para ser restada al final
                    $dteNow = new DateTime('now');
                    //variable donde se suma las diferencias de fechas
                    $dteDiff = new DateTime('now');
                    for ($i=0; $i < $long ; $i++) { 
                        $x = $i + 1;
                        //pregunta $i el nro de array y ['nombre_columna_query']
                        if($array[$i]['frontera'] == 1){
                            // $num = $num + 1;
                            //hace el recorrido hasta el penultimo elemento del array
                            if ($x<$long){
                                $date1 = new DateTime($array[$i]['fecha_destino']);
                                $date2 = new DateTime($array[$x]['fecha_destino']);
                                $diffe = $date1->diff($date2);
                                $dteDiff->add($diffe);
                                //sacar la diferencia en dias
                                $diferencia = $diffe->days;
                                // if($diferencia >= 181){
                                    
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
                                    
                                // }
                            }
                        }
                    }
                    //variable donde obtenemos tiempo en frontera
                    $tiempoTotalFrontera =  $dteDiff->diff($dteNow);
                ?>          
                @foreach($destinosfront as $row) 
                    <?php
                        $date = date_create($row->fecha_destino);
                        $fechadestino = date_format($date,"d/m/Y");
                    ?>
                    
                    <!-- <div class="form-group row" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 12pt; text-align: justify; vertical-align: top;"> -->
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 17%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label"><?php echo $fechadestino; ?></label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 82%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->n3desc}}</label></div>
                    </div>
                @endforeach
                    <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt; font-weight: bold;"><span>Total</span></div>
                    <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt; "><span><?php echo  $tiempoTotalFrontera->y.' AÑO(S),'.$tiempoTotalFrontera->m.' MES(ES) Y '.$tiempoTotalFrontera->d.' DIA(S)'; ?></span></div>
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>    
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FELICITACIONES</u></p>
            </div>
            @if(sizeof($felicitacion) != 0)    
                @foreach($felicitacion as $row)
                    <div class="form-group row" style="/*border: 1px solid #000;*/ padding-left: 1cm;">   
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 45%; vertical-align: top; text-align: left; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->n2disdesc}}</label></div>
                        <div style="/*border: 1px solid #000;*/ display: inline-block; width: 30%; vertical-align: top; text-align: right; font-size: 11pt; padding-top: 5px; padding-bottom: 5px"><label class="form-control-label">{{$row->cantfel}} MEMORANDUM(S)</label></div>
                    </div>
                @endforeach
            @else
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: left; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>    
            @endif
            
            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>ABANDERADO Y ESCOLTA.</u></p>
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
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif
            

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>CONDECORACIONES.</u></p>
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
                <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt;"><span>NO CUENTA CON REGISTROS.</span></div>
            @endif

            <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"><?php $num = $num + 1; echo $num; ?>.&nbsp;&nbsp;&nbsp;<u>OBSERVACIONES.</u></p>
            </div>
            @if($observacion=='')
            <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt;"><span>SIN OBSERVACIONES.</span></div>
            @else
            <div style="/*border: 1px solid #000;*/ padding-top: 5px; padding-bottom: 5px; padding-left: 1cm; vertical-align: top; text-align: justify; font-size: 11pt;"><span>{{$observacion}}</span></div>
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
