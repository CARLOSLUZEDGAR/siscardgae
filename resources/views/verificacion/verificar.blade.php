<!DOCTYPE html>
<html>
<head>
    <title>Verificación de Licencia</title>
</head>
<body>

    <h2>LICENCIA VERIFICADA</h2>

    <p><strong>Nombre:</strong> {{ $personal->per_paterno }}</p>
    <p><strong>Estado:</strong> {{ $estado }}</p>
    <p><strong>Vigencia:</strong> {{ $personal->fecha_expiracion }}</p>

</body>
</html>