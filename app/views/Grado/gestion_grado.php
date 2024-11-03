<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Grados</title>
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
        <h1 class="my-4">Gestión de Grados</h1>

        <a href="http://localhost/Gestion_Academica/Public/index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>

        <?php if ($action !== 'nuevo' && $action !== 'editar'): ?>
            <a href="index.php?controller=Grado&action=nuevo" class="btn btn-primary mb-3">Agregar nuevo grado</a>
        <?php endif; ?>

        <?php if ($action === 'nuevo' || $action === 'editar'): ?>
            <h2 class="my-4"><?php echo $action === 'nuevo' ? 'Agregar Nuevo Grado' : 'Editar Grado'; ?></h2>

            <form action="index.php?controller=Grado&action=<?php echo htmlspecialchars($action); ?><?php echo isset($grado['id']) ? '&id=' . htmlspecialchars($grado['id']) : ''; ?>" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="grado">Nombre del Grado</label>
                    <input type="text" class="form-control" id="grado" name="grado" value="<?php echo $action === 'editar' ? htmlspecialchars($grado['grado']) : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $action === 'nuevo' ? 'Crear Grado' : 'Actualizar Grado'; ?></button>
            </form>
        <?php endif; ?>

        <?php if ($action === 'index'): ?>
            <h2 class="my-4">Lista de Grados</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grados as $grado): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($grado['id']); ?></td>
                            <td><?php echo htmlspecialchars($grado['grado']); ?></td>
                            <td>
                                <a href="index.php?controller=Grado&action=editar&id=<?php echo htmlspecialchars($grado['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?controller=Grado&action=eliminar&id=<?php echo htmlspecialchars($grado['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este grado?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
