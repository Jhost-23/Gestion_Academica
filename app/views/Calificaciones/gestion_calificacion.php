<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Calificaciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #003366;
            color: white;
        }
        .container {
            margin-top: 20px;
        }
        h1, h2 {
            color: #ffffff; /* Color del texto de encabezados */
        }
        .btn {
            border-radius: 20px; /* Bordes redondeados para botones */
        }
        .table {
            background-color: #004080; /* Fondo de la tabla */
            border-radius: 10px; /* Bordes redondeados para la tabla */
            overflow: hidden; /* Para ocultar bordes en la esquina */
        }
        .table th {
            background-color: #00509E; /* Fondo de los encabezados */
            color: #f1f1f1; /* Color de texto de los encabezados */
        }
        .table td {
            color: #f1f1f1; /* Color de texto de las celdas */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #003366; /* Color de fondo para filas impares */
        }
        .table-striped tbody tr:hover {
            background-color: #00509E; /* Color de fondo al pasar el mouse */
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gestión de Calificaciones</h1>

        <?php if ($action !== 'nuevo' && $action !== 'editar'): ?>
            <a href="index.php?controller=profesor&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>
            <a href="index.php?controller=Calificacion&action=nuevo" class="btn btn-primary mb-3 no-print">Agregar nueva calificación</a>
            <a href="index.php?controller=Calificacion&action=imprimir" class="btn btn-secondary mb-3 no-print" onclick="window.print(); return false;">Imprimir</a>
        <?php endif; ?>

        <?php if ($action === 'nuevo' || $action === 'editar'): ?>
            <h2 class="my-4"><?php echo $action === 'nuevo' ? 'Agregar Nueva Calificación' : 'Editar Calificación'; ?></h2>
            <form action="index.php?controller=Calificacion&action=<?php echo htmlspecialchars($action); ?><?php echo isset($calificacion['id']) ? '&id=' . htmlspecialchars($calificacion['id']) : ''; ?>" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <!-- Selección del carnet con nombre -->
                <div class="form-group">
                    <label for="carnet">Carnet del Alumno</label>
                    <select class="form-control" id="carnet" name="carnet" required onchange="actualizarNombreAlumno()">
                        <option value="">Seleccione un carnet</option>
                        <?php foreach ($alumnos as $alumno): ?>
                            <option value="<?php echo $alumno['carnet']; ?>" data-nombre="<?php echo htmlspecialchars($alumno['nombre']); ?>"
                                <?php echo isset($calificacion['carnet']) && $calificacion['carnet'] == $alumno['carnet'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($alumno['carnet']); ?> - <?php echo htmlspecialchars($alumno['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo de nombre del alumno que se actualiza automáticamente -->
                <div class="form-group">
                    <label for="nombre_alumno">Nombre del Alumno</label>
                    <input type="text" class="form-control" id="nombre_alumno" readonly
                        value="<?php echo isset($calificacion['nombre_alumno']) ? htmlspecialchars($calificacion['nombre_alumno']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="id_curso">Curso</label>
                    <select class="form-control" id="id_curso" name="id_curso" required>
                        <option value="">Seleccione un curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?php echo $curso['id']; ?>" <?php echo isset($calificacion['id_curso']) && $calificacion['id_curso'] == $curso['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($curso['nombre_curso']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="unidad">Unidad</label>
                    <input type="number" class="form-control" id="unidad" name="unidad" required value="<?php echo isset($calificacion['unidad']) ? htmlspecialchars($calificacion['unidad']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="nota">Nota</label>
                    <input type="number" class="form-control" id="nota" name="nota" required value="<?php echo isset($calificacion['nota']) ? htmlspecialchars($calificacion['nota']) : ''; ?>">
                </div>

                <button type="submit" class="btn btn-primary"><?php echo $action === 'nuevo' ? 'Guardar' : 'Actualizar'; ?></button>
                <a href="index.php?controller=Calificacion&action=index" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else: ?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Alumno</th>
                        <th>Curso</th>
                        <th>Unidad</th>
                        <th>Nota</th>
                        <th class="no-print">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($calificaciones as $calificacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($calificacion['carnet']); ?></td>
                            <td><?php echo htmlspecialchars($calificacion['nombre_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($calificacion['nombre_curso']); ?></td>
                            <td><?php echo htmlspecialchars($calificacion['unidad']); ?></td>
                            <td><?php echo htmlspecialchars($calificacion['nota']); ?></td>
                            <td class="no-print">
                                <a href="index.php?controller=Calificacion&action=editar&id=<?php echo htmlspecialchars($calificacion['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                                <a href="index.php?controller=Calificacion&action=eliminar&id=<?php echo htmlspecialchars($calificacion['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta calificación?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- JavaScript para actualizar el nombre del alumno al seleccionar el carnet -->
    <script>
    function actualizarNombreAlumno() {
        const carnetSelect = document.getElementById('carnet');
        const nombreInput = document.getElementById('nombre_alumno');
        const nombre = carnetSelect.options[carnetSelect.selectedIndex].getAttribute('data-nombre');
        nombreInput.value = nombre || '';
    }
    </script>
</body>
</html>
