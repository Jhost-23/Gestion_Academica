<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #e9ecef; /* Fondo claro */
            color: #212529; /* Texto oscuro */
            position: relative;
            min-height: 100vh;
        }
        .navbar {
            background-color: #007bff; /* Color de la barra de navegación */
        }
        .navbar-brand img {
            border-radius: 50%;
        }
        h1 {
            margin-top: 2rem;
            color: #007bff; /* Color de encabezado */
        }
        .lead {
            color: #6c757d; /* Color de texto secundario */
        }
        .card {
            border: none;
            border-radius: 15px;
            background-color: #ffffff; /* Fondo de las tarjetas */
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        .btn {
            background-color: #007bff; /* Fondo de los botones */
            color: #ffffff; /* Texto de los botones */
            border-radius: 25px; /* Bordes redondeados para botones */
        }
        .btn:hover {
            background-color: #0056b3; /* Color de fondo al pasar el mouse por los botones */
        }
        .table {
            background-color: #ffffff; /* Fondo de la tabla */
        }
        .table th {
            background-color: #007bff; /* Fondo de los encabezados */
            color: #ffffff; /* Color de texto de los encabezados */
        }
        .table td {
            color: #212529; /* Color de texto de las celdas */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Color de fondo para filas impares */
        }
        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: #dc3545; /* Fondo rojo */
            color: white; /* Texto blanco */
            border-radius: 5px;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?controller=alumno&action=dashboard">
                <img src="assets/Imagen/logo.png" alt="Logo" width="60" height="60">
                <span class="ms-2">Portal del Alumno</span>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <!-- Cerrar Sesión -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=login&action=logout">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="display-5">Bienvenido, <?php echo htmlspecialchars($_SESSION['login_name']); ?></h1>
                <p class="lead">Consulta tus cursos, calificaciones, asistencia y más desde este panel.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Tus Cursos y Calificaciones</h2>
                        <?php if (!empty($asignacionesYCalificaciones)): ?>
                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>Curso</th>
                                            <th>Descripción</th>
                                            <th>Unidad</th>
                                            <th>Nota</th>
                                            <th>Fecha de Asignación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($asignacionesYCalificaciones as $asignacion): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($asignacion['nombre_curso']); ?></td>
                                                <td><?php echo htmlspecialchars($asignacion['descripcion_curso']); ?></td>
                                                <td><?php echo htmlspecialchars($asignacion['unidad']); ?></td>
                                                <td><?php echo htmlspecialchars($asignacion['nota']); ?></td>
                                                <td><?php echo htmlspecialchars($asignacion['fecha_asignacion']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center">No tienes cursos asignados aún.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Desempeño Académico</h2>
                        <canvas id="gradesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Obtener las notas de PHP
        const notas = <?php echo json_encode(array_column($asignacionesYCalificaciones, 'nota')); ?>;
        const cursos = <?php echo json_encode(array_column($asignacionesYCalificaciones, 'nombre_curso')); ?>;

        const ctx = document.getElementById('gradesChart').getContext('2d');
        const gradesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cursos,
                datasets: [{
                    label: 'Calificaciones',
                    data: notas,
                    backgroundColor: 'rgba(38, 185, 154, 0.6)',
                    borderColor: 'rgba(38, 185, 154, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10, // Asumiendo que las notas son de 0 a 10
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>
</body>
</html>
