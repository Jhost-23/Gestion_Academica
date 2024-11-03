<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Especialidades</title>
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
        /* Estilo de botones */
        .btn-primary {
            background-color: #007bff; /* Azul vibrante */
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-danger {
            background-color: #ff4d4d; /* Botón de eliminar con rojo vibrante */
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gestión de Especialidades</h1>

        <a href="index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>

        <?php if ($action !== 'nuevo' && $action !== 'editar'): ?>
            <a href="index.php?controller=Especialidad&action=nuevo" class="btn btn-primary mb-3">Agregar nueva especialidad</a>
        <?php endif; ?>

        <?php if ($action === 'nuevo' || $action === 'editar'): ?>
            <h2 class="my-4"><?php echo $action === 'nuevo' ? 'Agregar Nueva Especialidad' : 'Editar Especialidad'; ?></h2>
            
            <form action="index.php?controller=Especialidad&action=<?php echo htmlspecialchars($action); ?><?php echo isset($especialidad['id']) ? '&id=' . htmlspecialchars($especialidad['id']) : ''; ?>" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $action === 'editar' ? htmlspecialchars($especialidad['descripcion']) : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-success"><?php echo $action === 'nuevo' ? 'Agregar' : 'Actualizar'; ?></button>
            </form>

        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($especialidades as $especialidad): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($especialidad['id']); ?></td>
                            <td><?php echo htmlspecialchars($especialidad['descripcion']); ?></td>
                            <td>
                                <a href="index.php?controller=Especialidad&action=editar&id=<?php echo $especialidad['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="index.php?controller=Especialidad&action=eliminar&id=<?php echo $especialidad['id']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
