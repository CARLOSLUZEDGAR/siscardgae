<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SISCAR - DGAE</title>

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .container {
        width: 100%;
        padding-bottom: 1cm;
    }

    .header {
        text-align: center;
        font-size: 0.9rem;
    }

    .main-table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        background-image: url('../img/dgae_agua.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }

    .main-table td {
        padding: 4px;
        font-size: 0.9rem;
    }

    .label {
        text-align: right;
        font-weight: bold;
        width: 50%;
    }

    .value {
        text-align: left;
        width: 50%;
    }

    .title {
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .image-container {
        text-align: center;
    }

    .image-container img {
        width: 120px;
        height: auto;
        border: 2px solid #142A98;
    }

    .estado-vigente {
        color: green;
    }

    .estado-no-vigente {
        color: red;
    }
</style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <p>FUERZA AÉREA BOLIVIANA</p>
        <p>DIRECCIÓN GENERAL DE AERONAVES DE ESTADO</p>
        <p><strong><u>BOLIVIA</u></strong></p>
    </div>

    <!-- TABLA -->
    <table class="main-table">
        <tr>
            <td colspan="2" class="title">
                DATOS LICENCIA
            </td>
        </tr>

        <tr>
            <td colspan="2" class="image-container">
                <img src="../img/personal/{{$personal->per_foto}}">
            </td>
        </tr>

        <tr>
            <td class="label">GRADO:</td>
            <td class="value">{{$personal->abreviatura}}</td>
        </tr>

        <tr>
            <td class="label">APELLIDO(S):</td>
            <td class="value">{{$personal->per_paterno}} {{$personal->per_materno}}</td>
        </tr>

        <tr>
            <td class="label">NOMBRE(S):</td>
            <td class="value">{{$personal->per_nombre}}</td>
        </tr>

        <tr>
            <td class="label">NRO. LICENCIA:</td>
            <td class="value">{{$personal->per_ci}}</td>
        </tr>

        <tr>
            <td class="label">NACIONALIDAD:</td>
            <td class="value">{{$personal->nacionalidad}}</td>
        </tr>

        <tr>
            <td class="label">FECHA DE NAC.:</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($personal->per_fecha_nacimiento)->format('d/m/Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">ESTADO:</td>
            <td class="value {{ $estado == 'VIGENTE' ? 'estado-vigente' : 'estado-no-vigente' }}">
                {{$estado}}
            </td>
        </tr>

        <tr>
            <td class="label">VIGENCIA:</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($personal->fecha_expiracion)->format('d/m/Y') }}
            </td>
        </tr>

    </table>

</div>

</body>
</html>