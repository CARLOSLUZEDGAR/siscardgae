<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/dgae_logo.png"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CARNET</title>
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
            margin-top: 0.1cm;
            margin-bottom: 0.1cm;
            /** margenes de izquierda y derecha es menos un0.1cm*/
            margin-left: 0.1cm;
            margin-right: 0.1cm;
            /* border: 1px solid red; */
            background-image: url(../public/img/centenario_tranparencia.jpg);
            /* background-size: 100% 110%; */
            background-size: 8.2cm 5cm;

            /* width: 8cm;
            height: 5cm; */
            background-repeat: no-repeat;
        }
        header {
            /* position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 3cm; */
            /*background-color: #3498DB;*/
            /* color: black;
            text-align: right; */
            /*line-height: 10px;
            font-size: 9px;
            border: 1px solid #C00;*/
            /* padding-top: 5px;
            padding-bottom: 0px; */
        }

        footer {
            /* position: fixed;
            bottom: 0cm;
            left: 3cm;
            right: 2cm;
            height: 2cm; */
            /*background-color: #3498DB;*/
            /* color: black; */
            /*text-align: right;*/
            /* line-height: 24px; */
            /*font-size: 9px;
            border: 1px solid #C00;*/
        }


        * {
            font-family: verdana, arial, sans-serif;
        }
        .cabecera {
            background-color: #FEFEFE;
            color: #000000;
            padding: 0cm;
            /* padding-top: .2rem;
            padding-bottom: 0px; */
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
    <!-- <div>
        <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            /* border: black 1px; */
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10px; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: 
                            <?php
                                // $fecha = date("dHi-M-Y");
                                // echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold;">
                        <span>Desarrollado por la: DIGETIC - 
                            <?php
                                // $gestion_act = date("Y");
                                // echo $gestion_act;
                             ?>
                        </span>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div> -->
</footer>

    <main>  
        <div class="cabecera">
            <!-- ANVERSO CARNET -->
            <div style="text-align: center; position: fixed; top: 0.1cm; left: 0.1cm; right: 7.3cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <img style="width:0.8cm; height:0.8cm; /*border: 1px solid #142A98;*/" src="../public/img/escudo_nacional.png">
            </div>
            <div style="padding-top: 1px; padding-bottom: 1px; text-align: center; position: fixed; top: 0.2cm; left: 1cm; right: 0.1cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">I. ESTADO PLURINACIONAL DE BOLIVIA - PLURINATIONAL STATE OF BOLIVIA</p>
            </div>
            <div style="padding-top: 1px; padding-bottom: 1px; text-align: center; position: fixed; top: 0.55cm; left: 1cm; right: 0.1cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">VIII. DIRECCIÓN GENERAL DE AERONAVES DE ESTADO - STATE AVIATION AUTHORITY</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 0.9cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">IV.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 0.9cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">GRADO Y NOMBRE - Rank and Name:</p>
            </div>
            @if($personal->id_entidad < 5)
                <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.15cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">{{$personal->abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                </div>
            @else
                <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.15cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">{{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                </div>
            @endif
            
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 1.65cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">VI.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.65cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">NACIONALIDAD - Nationality:</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.9cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->nacionalidad}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 2.2cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">V.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 2.2cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">FECHA DE NACIMIENTO - D.O.B.:</p>
            </div>
            <?php
                $date = date_create($personal->per_fecha_nacimiento);
                $fechanacimiento = date_format($date,"d/m/Y");
            ?>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 2.45cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$fechanacimiento}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 2.75cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">IX.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: justify; position: fixed; top: 2.75cm; left: 0.5cm; right: 2.7cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CERTIFÍCASE Que el titular ha demostrado está debidamente calificado para ejercer los privilegios de: - Has demostrated property qualified to exercise the privileges of:</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 3.35cm; left: 0.1cm; right: 7.8cm; font-size: 5pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">II.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 3.35cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->licencia}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 3.85cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; font-style: italic; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->traduccion}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 4.1cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">X.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 4.1cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">FECHA DE EMISIÓN - Date of issue:</p>
            </div>
            <?php
                $date = date_create($personal->fecha_emision);
                $fechaemision = date_format($date,"d/m/Y");
            ?>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 4.35cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$fechaemision}}</p>
            </div>
            <!-- <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 0.9cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">I. PAIS - Country:</p>
            </div>
            <div style="padding-left: 0.5cm; text-align: left; position: fixed; top: 1.15cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->pais}}</p>
            </div> -->
            
            
            
            <!-- <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 3.15cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">VI. DIRECCIÓN - Address:</p>
            </div>
            <div style="padding-left: 0.5cm; text-align: left; position: fixed; top: 3.4cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px"></p>
            </div> -->
            
            <!-- <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 2.15cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">ENTIDAD - Entity:</p>
            </div>
            <div style="padding-left: 0.5cm; text-align: left; position: fixed; top: 2.4cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->entidad}}</p>
            </div> -->
            
            <!-- <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 4.25cm; left: 3cm; right: 2cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">FECHA DE EXPIRACIÓN - Date of expiration:</p>
            </div>
            <?php
                $date = date_create($personal->fecha_expiracion);
                $fechaexpiracion = date_format($date,"d/m/Y");
            ?>
            <div style="padding: 0cm; text-align: center; position: fixed; top: 4.5cm; left: 3cm; right: 2cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$fechaexpiracion}}</p>
            </div> -->
            <div style="padding: 0.1cm; text-align: center; position: fixed; top: 1cm; left: 5.5cm; right: 0.2cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <img style="width:2cm; height:2cm; border: 1px solid #142A98;" src="../public/img/personal/{{$personal->per_foto}}">
            </div>
            <div style="padding: 0.1cm; text-align: center; position: fixed; top: 3.2cm; left: 5.5cm; right: 0.2cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">III. LICENCIA No. - License No:</p>
            </div>
            <div style="padding: 0.1cm; text-align: center; position: fixed; top: 3.5cm; left: 5.5cm; right: 0.2cm; font-size: 7pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->per_ci}}</p>
            </div>
            <!-- FIN ANVERSO CARNET -->
            <div style="page-break-before: always;"></div>
            <!-- REVERSO CARNET -->
            @if($personal->id_entidad < 5)
                <div style="padding-top: 1px; padding-bottom: 1px; padding-left: 0.5cm; text-align: left; position: fixed; top: 0.2cm; left: 0.1cm; right: 2cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">{{$personal->abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                </div>
            @else
                <div style="padding-top: 1px; padding-bottom: 1px; padding-left: 0.5cm; text-align: left; position: fixed; top: 0.2cm; left: 0.1cm; right: 2cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">{{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p>
                </div>
            @endif
            <div style="padding-top: 1px; padding-bottom: 1px; text-align: center; position: fixed; top: 0.2cm; left: 6.3cm; right: 0.1cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">Folio No.: {{$personal->id_personal}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 0.8cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">XII.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 0.8cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">HABILITACIONES - Ratings:</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.05cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->habilitacion}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.55cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; font-style: italic; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->htraduccion}}</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 1.8cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">XIII.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 1.8cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">OBSERVACIONES - Remarks:</p>
            </div>
            <!-- <div style="padding-left: 0.1cm; text-align: justify; position: fixed; top: 1.8cm; left: 0.5cm; right: 2.5cm; font-size: 5pt; font-weight: bold; border: 1px solid #C00;">
                @if($personal->observacion != '')
                <p style="margin: 1px">{{$personal->observacion}}.</p>
                @else
                <p style="margin: 1px">SIN OBSERVACIONES.</p>
                @endif
            </div> -->
            <div style="padding-left: 0.1cm; text-align: justify; position: fixed; top: 2.05cm; left: 0.5cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">La presente licencia no es valida si el Certificado Médico Aeronáutico no se encuentra vigente en el codigo QR - The following license is invalid if the medical certificate is not current in the QR code.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: left; position: fixed; top: 2.65cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">COMPETENCIA LINGUISTICA - Language proficiency:</p>
            </div>
            <div style="padding-left: 0.5cm; text-align: left; position: fixed; top: 2.9cm; left: 0.1cm; right: 2.5cm; font-size: 5pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->nivel}}</p>
            </div>
            <div style="padding-left: 0.5cm; text-align: left; position: fixed; top: 3.15cm; left: 0.1cm; right: 2.5cm; font-size: 4pt; font-weight: normal; font-style: italic; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">{{$personal->cltraduccion}}</p>
            </div>
            <div style="padding: 0.1cm; text-align: center; position: fixed; top: 0.8cm; left: 5.8cm; right: 0.1cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <img style="border: 1px solid black; width: 2cm; height: 2cm" src="data:image/png;base64, {!! base64_encode($qr) !!} ">
            </div>
            <div style="padding: 0.1cm; text-align: center; position: fixed; top: 2.9cm; left: 0.1cm; right: 0.1cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <img style="width:2.5cm; height:2cm; /*border: 2px solid #142A98;*/" src="../public/img/firma_cnl_garnica.png">
            </div>
            <div style="padding: 0.1cm; text-align: center; position: fixed; top: 3.2cm; left: 0.1cm; right: 4.5cm; font-size: 4pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <img style="width:1.7cm; height:1.5cm; /*border: 2px solid #142A98;*/" src="../public/img/sello_dgae_2024.png">
            </div>
            <div style="padding-left: 0.1cm; text-align: right; position: fixed; top: 4.2cm; left: 0.1cm; right: 7.8cm; font-size: 4pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">X.</p>
            </div>
            <div style="padding-left: 0.1cm; text-align: center; position: fixed; top: 4.2cm; left: 0.1cm; right: 0.1cm; font-size: 5pt; /*font-weight: bold;*/ /*border: 1px solid #C00;*/">
                <p style="margin: 1px">Cnl. DAEN. Marco Antonio Garnica Bustillos</p>
                <p style="margin: 1px; font-weight: bold;">DIRECTOR GENERAL DE AERONAVES DE ESTADO</p>
            </div>
            <!-- FIN REVERSO CARNET -->
                

            <!-- <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 14px; font-weight: normal; /*border: 1px solid #C00;*/">
                La Paz, 
                    <?php
                        // $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        // echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
            </div> -->

            
                                                                                        
            <!-- <div style="padding-top: 5px; padding-bottom: 5px; text-align: left; font-size: 11px; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">AAA/aaa</p>
            </div> -->

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
