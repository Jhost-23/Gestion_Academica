<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asignaciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #003366, #000000); /* Degradado de azul oscuro a negro */
            color: white;
            min-height: 100vh;
        }
        h1, h2 {
            color: #ffffff;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.1); /* Fondo transparente para mayor contraste */
            padding: 20px;
            border-radius: 8px;
        }
        table {
            background-color: rgba(255, 255, 255, 0.1); /* Fondo ligero para la tabla */
            color: white;
        }
        table th, table td {
            color: white;
        }
        /* Botón primario más vibrante */
        .btn-primary {
            background-color: #007bff; /* Azul vibrante */
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el ratón */
        }
        /* Botón secundario más claro */
        .btn-secondary {
            background-color: #6c757d; /* Gris más claro */
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Cambio de color al pasar el ratón */
        }
        .btn-warning {
            background-color: #ffcc00; /* Botón de editar con un color amarillo vibrante */
            border: none;
        }
        .btn-danger {
            background-color: #ff4d4d; /* Botón de eliminar con rojo vibrante */
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gestión de Asignaciones</h1>

        <a href="index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>

        <?php if ($action !== 'nuevo' && $action !== 'editar'): ?>
            <a href="index.php?controller=Asignacion&action=nuevo" class="btn btn-primary mb-3">Agregar nueva asignación</a>
        <?php endif; ?>

        <?php if ($action === 'nuevo' || $action === 'editar'): ?>
            <h2 class="my-4"><?php echo $action === 'nuevo' ? 'Agregar Nueva Asignación' : 'Editar Asignación'; ?></h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="index.php?controller=Asignacion&action=<?php echo htmlspecialchars($action); ?><?php echo isset($asignacion['id_asig']) ? '&id=' . htmlspecialchars($asignacion['id_asig']) : ''; ?>" method="post">
                <div class="form-group">
                    <label for="carnet">Carnet de Alumno</label>
                    <select class="form-control" id="carnet" name="carnet" required>
                        <option value="">Seleccione un alumno</option>
                        <?php foreach ($alumnos as $alumno): ?>
                            <option value="<?php echo htmlspecialchars($alumno['carnet']); ?>" <?php echo ($action === 'editar' && $asignacion['carnet'] == $alumno['carnet']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($alumno['nombre']) . ' ' . htmlspecialchars($alumno['apellido']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_curso">Curso</label>
                    <select class="form-control" id="id_curso" name="id_curso" required>
                        <option value="">Seleccione un curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?php echo htmlspecialchars($curso['id']); ?>" <?php echo ($action === 'editar' && $asignacion['id_curso'] == $curso['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($curso['nombre_curso']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        <?php else: ?>
            <h2 class="my-4">Lista de Asignaciones</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre del Alumno</th>
                        <th>Curso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($asignaciones as $asignacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($asignacion['carnet']); ?></td>
                            <td><?php echo htmlspecialchars($asignacion['nombre_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($asignacion['nombre_curso']); ?></td>
                            <td>
                                <a href="index.php?controller=Asignacion&action=editar&id=<?php echo htmlspecialchars($asignacion['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?controller=Asignacion&action=eliminar&id=<?php echo htmlspecialchars($asignacion['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta asignación?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
