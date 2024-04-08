<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CUADRO DE EFECTIVO</title>
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
            margin-top: 3cm;
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 2cm;
            margin-right: 2cm;
            
            /* border: 1px solid #C00; */
        }
        header {
            position: fixed;
            top: 0cm;
            left: 2cm;
            right: 2cm;
            height: 3cm;
            
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
            left: 2cm;
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

        .rotate {
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            width: 1.5em;
        }
        .rotate div {
            -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
            -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
            -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
            filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
        }
        /* .cabecera {
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
        } */
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
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 9pt; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: 
                            <?php
                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 9pt; text-align: right; font-weight: bold;">
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
            <?php
                $gestion = date('Y');
                // echo $gestion;
                //calculo cantidad de elementos del array
                // $long = sizeof($cantidad2);
                // $grados2 = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,164,165,166,167,168,169,170,171,172,18,19,20,21,22,23,24,25,26,27,28,157,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48);

                // $long2 = sizeof($grados2);
                // //json_decode convierte datos en json a un array
                //  $array=json_decode($cantidad2,true);
                //muestra el json convertido en array
                // var_dump($array);
                
            ?>
            <div style="padding-top: 1cm; padding-bottom: 1cm; text-align: center; font-size: 14pt; font-weight: bold; /*border: 1px solid #C00;*/">
                
                <p style="margin: 0px;"><u>CUADRO DE EFECTIVOS DEL PERSONAL POR UNIDADES Y GRADOS GESTIÓN <?php echo $gestion; ?></u></p>
                <p><?php /*echo 'cantidad: '.$long2;*/ ?></p>
                <p><?php /*var_dump($array);*/ ?></p>
                <p><?php /*var_dump($grados2);*/ ?></p>
                <p><?php /*var_dump($array[5]['abreviatura']);*/ ?></p>
                <p><?php /*var_dump($grados[9]);*/ ?></p>
            </div>

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px; padding-top: 2px; padding-bottom: 2px;" class="table table-bordered table-striped">
                <tr>
                    <td style="border: 1px solid #000; padding-top: 1cm; padding-bottom: 1cm; font-size: 6pt; text-align: center; font-weight: bold; width: 2cm;">
                        <div>DESTINOS</div>
                    </td>
                    @foreach($grados_cant as $row)
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>{{$row->abreviaturagrado}}</div></td>
                    @endforeach
                    
                    <!-- <td colspan="3" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>OF. GENERALES</div>
                    </td>
                    <td colspan="3" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>OF. SUPERIORES</div>
                    </td>
                    <td colspan="3" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>OF. SUBALTERNOS</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>SOF´S. TECNICOS</div>
                    </td>
                    <td colspan="3" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>SGTO´S. TECNICOS</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>SOF´S. DE MUSICA</div>
                    </td>
                    <td colspan="3" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>SGTO´S. DE MUSICA</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>PROF. SERV.</div>
                    </td>
                    <td colspan="7" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>SERV. TEC. ADM.</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>PROFESIONALES</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>TECNICOS</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>ADMINISTRATIVOS</div>
                    </td>
                    <td colspan="5" style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate">
                        <div>AP. ADM.</div>
                    </td> -->
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 6pt; text-align: center; font-weight: bold;" class="rotate"><div>TOTAL</div></td>
                </tr>
                <!-- <tr> -->
                    
                    <!-- <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>GRAL.FZA.AÉ</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>GRAL.DIV.AÉ</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>GRAL.BRIG.AÉ</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>CNL.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TCNL.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>MY.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>CAP.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TTE.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SBTTE.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.MTRE.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.MY.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.1RO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.2DO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.INC.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.1RO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.2DO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.INC.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.MTRE.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.MY.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.1RO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.2DO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.INC.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.1RO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.2DO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.INC.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TCNL.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>MY.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>CAP.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TTE.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SBTTE.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.1RO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.2DO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SOF.INC.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.1RO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.2DO.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.INC.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>SGTO.INC.INV.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>PROF.I.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>PROF.II.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>PROF.III.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>PROF.IV.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>PROF.V.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TEC.I.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TEC.II.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TEC.III.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TEC.IV.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>TEC.V.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>ADM.I.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>ADM.II.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>ADM.III.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>ADM.IV.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>ADM.V.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>AP.ADM.I.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>AP.ADM.II.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>AP.ADM.III.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>AP.ADM.IV.</div></td>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; text-align: center; font-weight: bold;" class="rotate"><div>AP.ADM.V.</div></td> -->
                <!-- </tr> -->
                    <?php
                        // $gestion = date('Y');
                        // echo $gestion;
                        // $gradosids = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,164,165,166,168,169,170,171,172,18,19,20,21,22,23,24,25,26,27,28,157,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48);
                        //calculo cantidad de elementos del array
                        // $cantGrados = sizeof($gradosids);
                        $cantRegistro = sizeof($cantidad2);
                        $cantDestinos = sizeof($destinos);
                        $cantGrados_Cant = sizeof($grados_cant);
                        //json_decode convierte datos en json a un array
                        $arrayCantidad2=json_decode($cantidad2,true);
                        $arrayDestinos=json_decode($destinos,true);
                        $arrayGradosCant=json_decode($grados_cant,true);
                        // muestra el json convertido en array
                        // var_dump($arrayDestinos);
                        //
                        for ($i=0; $i < $cantDestinos ; $i++) { 
                            echo '<tr>';
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5pt; padding-left: 0.1cm; width: 2cm;">'.$arrayDestinos[$i]['d3descripcion'].'</td>';
                                $k = 0;
                                for ($j=0; $j < $cantRegistro ; $j++) { 
                                    if($arrayDestinos[$i]['d3id'] == $arrayCantidad2[$j]['idd3'])
                                    {
                                        // for ($k=0; $k < $cantGrados ; $k++) { 
                                        while($k < $cantGrados_Cant){
                                            if($arrayGradosCant[$k]['idgrado'] == $arrayCantidad2[$j]['id'])
                                            {
                                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">'.$arrayCantidad2[$j]['total'].'</td>';
                                                $k++;
                                                break;
                                            }
                                            else
                                            {
                                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center;">-</td>';
                                                $k++;
                                            }
                                        }   
                                    }
                                }
                                if($k != $cantGrados_Cant){
                                    while ($k < $cantGrados_Cant) {
                                        echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 5.5pt;">-</td>';
                                        $k++;
                                    }
                                }
                                echo '<td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 5.5pt; font-weight: bold;">'.$arrayDestinos[$i]['d3cantidad'].'</td>';
                            echo '</tr>';
                        }
                    ?>
                <tr>
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 6pt; text-align: center; font-weight: bold; width: 2cm;">
                        <div>TOTAL GENERAL</div>
                    </td>
                    @foreach($grados_cant as $row)
                        <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center; font-weight: bold;">{{$row->cantidadgrado}}</td>
                    @endforeach
                    <td style="border: 1px solid #000; padding-top: 5px; padding-bottom: 5px; font-size: 5.5pt; text-align: center; font-weight: bold;">
                        <?php
                            $total_grado = 0;
                            $a = 0;
                            while ($a < $cantGrados_Cant) {
                                $total_grado = $total_grado + $arrayGradosCant[$a]['cantidadgrado'];
                                $a++;  
                            }
                            $total_unidad = 0;
                            $b = 0;
                            while ($b < $cantDestinos) {
                                $total_unidad = $total_unidad + $arrayDestinos[$b]['d3cantidad'];
                                $b++;  
                            }
                            if($total_grado == $total_unidad){
                                echo $total_unidad;
                            }else{
                                echo 'N/C';
                            }
                            // echo $total_grado;
                            // echo $total_unidad;  
                        ?>
                    </td>
                </tr>
            </table>
            <div><p><?php /*echo 'cantidad registro:'.$cantGrados_Cant;*/ ?></p></div>

            <div><p><?php /*var_dump($arrayGradosCant);*/ ?></p></div>
            
            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 12pt; font-weight: bold; border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 12pt;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 12pt; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
            </div>

        </div>

    </main>
    
    <script type="text/php">
            if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(460, 580.5, "$PAGE_NUM - $PAGE_COUNT", $font, 9);
                ');
            }
    </script>

</body>

</html>
