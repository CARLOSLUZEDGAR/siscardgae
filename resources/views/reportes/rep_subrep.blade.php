<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORDEN DE DESTINOS</title>
    <!-- CSS only -->
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
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 2cm;
            margin-right: 1cm;
            /**border: 1px solid #C00;*/
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right: 2cm;
            height: 5cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            /*line-height: 10px;
            font-size: 9px;
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
    <div style="padding-top: 22px; padding-bottom: 1px;">
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/margin-bottom: 0px; " class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td width="60%" style="/*border: 1px solid #000;*/ vertical-align: bottom;">
                        <div style="text-align: center; width: 355px; font-size: 11.5px; /*border: 1px solid #C00;*/">
                            <p style="margin: 1px;">COMANDO EN JEFE DE LAS FUERZAS ARMADAS DEL ESTADO</p>
                            <p style="margin: 1px;">COMANDO GENERAL DE LA FUERZA AEREA</p>
                            <p style="margin: 1px;">ESTADO MAYOR GENERAL DE LA FAB</p>
                            <p style="margin: 1px;">DEPARTAMENTO I - PERS. EMGFAB.</p>
                            <p style="margin: 1px;"><u><strong>BOLIVIA</strong></u></p>
                        </div>
                    </td>
                    <td width="40%"style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold; font-size: 11.5px;">
                        <span>C.G 31-DIC-2020
                            <?php
                                $gestion_act = date("Y");
                                //echo $gestion_act;
                             ?>
                        </span>
                    </td>
                </tr> 
                <tr>
                    <td colspan="2" style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold; font-size: 11.5px;">
                        <div style="padding-top: 5px; padding-bottom: 5px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                            <p style="margin: 1px"><strong>ORDEN GENERAL DE DESTINOS 02/20</strong></p>
                            <p style="margin: 1px"><strong>SEGUNDA PARTE</strong></p>
                            <p style="margin: 1px"><u><strong>DE LOS DESTINOS</strong></u></p>
                        </div>
                    </td>
                </tr> 
            </tbody>
        </table>
    </div>
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

            <table width="100%" style="border-collapse: collapse; border-spacing: 0; border: black 1px; margin-bottom: 5px;" class="table table-bordered table-striped">
                <tbody class="table-striped">
                    @foreach($gran_unidad as $row)
                    <tr>  
                        <td colspan="3" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 14px; text-align: left; font-weight: bold;"><span>{{$row->destn2_descripcion}}</span></td>
                    </tr>
                        
                        @foreach($reparticion as $rep) 
                            @if ($rep->destn3_destn2codigo == $row->iddestn2)
                                <tr>  
                                    <td colspan="3" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 13px; text-align: left; font-weight: bold;"><span>{{$rep->destn3_descripcion}}</span></td>
                                </tr>
                                @foreach($subreparticiones as $subrep) 
                                    @if ($subrep->destn4_destn3codigo == $rep->iddestn3)
                                        <tr>  
                                            <td colspan="3" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 12px; text-align: left; font-weight: bold;"><span>{{$subrep->destn4_descripcion}}</span></td>
                                        </tr>
                                        @foreach($personalDestinos1 as $perdestn1) 
                                            @if ($perdestn1->perdest_destn4_codigo == $subrep->iddestn4)
                                                <tr>  
                                                    <td width="60%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 11px; text-align: left; font-weight: normal;"><span>{{$perdestn1->gra_abreviatura}}{{$perdestn1->estu_abreviatura}} {{$perdestn1->per_nombre}} {{$perdestn1->per_paterno}} {{$perdestn1->per_materno}}</span></td>
                                                    <td width="20%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 11px; text-align: left; font-weight: normal;"><span>{{$perdestn1->desc_cargo}}</span></td>
                                                    @foreach($personalDestinos2 as $perdestn2) 
                                                        @if ($perdestn2->idpersonal_destinos == $perdestn1->idpersonal_destinos) 
                                                            @if ($perdestn2->desc_cargo != 'FUNCION ASIGNARSE')
                                                                <td width="20%" style="/*border: 1px solid #000;*/ padding: 7px; font-size: 11px; text-align: left; font-weight: normal;"><span>{{$perdestn2->desc_cargo}}</span></td>  
                                                            @endif                                                      
                                                        @endif
                                                     @endforeach                                                    
                                                </tr>
                                             @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                    @endforeach
                </tbody>
            </table>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 12px; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">NOTA:</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: justify; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">Es cuanto tengo a bien certificar, para los fines consiguientes.</p>
            </div>

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
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

            <div style="padding-top: 5px; padding-bottom: 5px; text-align: left; font-size: 11px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">AAA/aaa</p>
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
