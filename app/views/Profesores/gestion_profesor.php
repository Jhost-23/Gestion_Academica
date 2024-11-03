<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Profesores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #003366, #000000);
            color: white;
            min-height: 100vh;
        }
        h1, h2 {
            color: #ffffff;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        table {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        table th, table td {
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #00ff04;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-warning {
            background-color: #eeff00;
            border: none;
        }
        .btn-danger {
            background-color: #ff4d4d;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gestión de Profesores</h1>

        <a href="http://localhost/Gestion_Academica/Public/index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>

        <!-- Formulario para agregar un nuevo profesor -->
        <h2 class="my-4">Agregar Nuevo Profesor</h2>
        <form method="POST" action="index.php?controller=Profesor&action=nuevo">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad" required>
            </div>
            <div class="form-group">
                <label for="id_usuario">ID Usuario:</label>
                <input type="number" class="form-control" id="id_usuario" name="id_usuario" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Profesor</button>
        </form>

        <!-- Mostrar error si existe -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Tabla de gestión de profesores -->
        <h2 class="my-4">Lista de Profesores</h2>
        <?php if (!empty($profesores)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>ID Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($profesores as $profesor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($profesor['id']); ?></td>
                            <td><?php echo htmlspecialchars($profesor['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($profesor['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($profesor['especialidad']); ?></td>
                            <td><?php echo htmlspecialchars($profesor['id_usuario']); ?></td>
                            <td>
                                <a href="index.php?controller=Profesor&action=editar&id=<?php echo $profesor['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="index.php?controller=Profesor&action=eliminar&id=<?php echo $profesor['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este profesor?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No hay profesores registrados.</div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
