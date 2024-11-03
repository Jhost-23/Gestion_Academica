<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imprimir Calificación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Calificación de <?php echo htmlspecialchars($calificacion['nombre_alumno']); ?></h1>
        <p><strong>Curso:</strong> <?php echo htmlspecialchars($calificacion['nombre_curso']); ?></p>
        <p><strong>Unidad:</strong> <?php echo htmlspecialchars($calificacion['unidad']); ?></p>
        <p><strong>Nota:</strong> <?php echo htmlspecialchars($calificacion['nota']); ?></p>
        <a href="index.php?controller=Calificacion&action=index" class="btn btn-primary">Volver</a>
    </div>
</body>
</html>
