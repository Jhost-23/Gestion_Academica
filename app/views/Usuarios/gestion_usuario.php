<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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
        <h1 class="my-4">Gestión de Usuarios</h1>

        <!-- Mensaje de éxito al agregar o editar un usuario -->
        <?php if (isset($mensaje)) : ?>
            <div class="alert alert-success"><?= htmlentities($mensaje) ?></div>
        <?php endif; ?>

        <!-- Enlace para crear un nuevo usuario -->
        <?php if ($action !== 'nuevo' && $action !== 'editar') : ?>
            <a href="index.php?controller=usuarios&action=nuevo" class="btn btn-primary mb-3">Agregar nuevo usuario</a>

            <!-- Botón para regresar a la carpeta 'public' -->
            <a href="http://localhost/Gestion_Academica/Public/index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>
        <?php endif; ?>

        <!-- Botón para regresar al index desde nuevo -->
        <?php if ($action === 'nuevo') : ?>
            <a href="index.php?controller=usuarios&action=index" class="btn btn-secondary mb-3">Regresar</a>
            <h2 class="my-4">Agregar Nuevo Usuario</h2>
            
            <form action="index.php?controller=usuarios&action=nuevo" method="post">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="numero_tel">Número de Teléfono</label>
                    <input type="text" class="form-control" id="numero_tel" name="numero_tel" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="">Seleccionar rol</option>
                        <option value="administrador">Administrador</option>
                        <option value="profesor">Profesor</option>
                        <option value="estudiante">Estudiante</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Usuario</button>
            </form>
        <?php endif; ?>

        <!-- Botón para regresar al index desde editar -->
        <?php if ($action === 'editar') : ?>
            <a href="index.php?controller=usuarios&action=index" class="btn btn-secondary mb-3">Regresar</a>
            <h2 class="my-4">Editar Usuario</h2>

            <form action="index.php?controller=usuarios&action=editar&id=<?= htmlentities($usuario['id']) ?>" method="post">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?= htmlentities($usuario['nombre_completo']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?= htmlentities($usuario['correo']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?= htmlentities($usuario['usuario']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="numero_tel">Número de Teléfono</label>
                    <input type="text" class="form-control" id="numero_tel" name="numero_tel" value="<?= htmlentities($usuario['numero_tel']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="">Seleccionar rol</option>
                        <option value="administrador" <?= $usuario['rol'] === 'administrador' ? 'selected' : '' ?>>Administrador</option>
                        <option value="profesor" <?= $usuario['rol'] === 'profesor' ? 'selected' : '' ?>>Profesor</option>
                        <option value="estudiante" <?= $usuario['rol'] === 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            </form>
        <?php endif; ?>

        <!-- Mostrar la lista de usuarios si no estamos en 'nuevo' o 'editar' -->
        <?php if ($action !== 'nuevo' && $action !== 'editar') : ?>
            <?php if (!empty($usuarios)) : ?>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Número de Teléfono</th> <!-- Nueva columna -->
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td><?= htmlentities($usuario['id']) ?></td>
                                <td><?= htmlentities($usuario['nombre_completo']) ?></td>
                                <td><?= htmlentities($usuario['correo']) ?></td>
                                <td><?= htmlentities($usuario['usuario']) ?></td>
                                <td><?= htmlentities($usuario['numero_tel']) ?></td> <!-- Muestra el número de teléfono -->
                                <td><?= htmlentities($usuario['rol']) ?></td> <!-- Mostrar rol aquí -->
                                <td class="actions">
                                <a href="index.php?controller=usuarios&action=editar&id=<?php echo $usuario['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?controller=usuarios&action=eliminar&id=<?php echo $usuario['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert alert-info">No hay usuarios registrados.</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
