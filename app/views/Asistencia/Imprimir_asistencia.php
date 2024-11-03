<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Fondo claro para impresión */
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #004d80;
            color: white;
        }
        .container {
            margin: auto;
            width: 80%;
        }
        .btn-print {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Reporte de Asistencia</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Estudiante</th>
                    <th>Curso</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($asistencias)): ?>
                    <?php foreach ($asistencias as $asistencia): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($asistencia['id']); ?></td>
                            <td><?php echo htmlspecialchars($asistencia['nombre_alumno']); ?></td> <!-- Cambio aquí -->
                            <td><?php echo htmlspecialchars($asistencia['nombre_curso']); ?></td>
                            <td><?php echo htmlspecialchars($asistencia['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($asistencia['estado']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay asistencias para mostrar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button class="btn btn-primary btn-print" onclick="window.print()">Imprimir</button>
        <a href="index.php?controller=Asistencia&action=index" class="btn btn-secondary btn-print">Regresar</a>
    </div>
</body>
</html>
