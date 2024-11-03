<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cursos</title>
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
        <h1 class="my-4">Gestión de Cursos</h1>

        <a href="http://localhost/Gestion_Academica/Public/index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>

        <?php if ($action !== 'nuevo' && $action !== 'editar'): ?>
            <a href="index.php?controller=Curso&action=nuevo" class="btn btn-primary mb-3">Agregar nuevo curso</a>
        <?php endif; ?>

        <?php if ($action === 'nuevo' || $action === 'editar'): ?>
            <h2 class="my-4"><?php echo $action === 'nuevo' ? 'Agregar Nuevo Curso' : 'Editar Curso'; ?></h2>
            
            <form action="index.php?controller=Curso&action=<?php echo htmlspecialchars($action); ?><?php echo isset($curso['id']) ? '&id=' . htmlspecialchars($curso['id']) : ''; ?>" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="nombre">Nombre del Curso</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $action === 'editar' ? htmlspecialchars($curso['nombre_curso']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo $action === 'editar' ? htmlspecialchars($curso['descripcion']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="id_profesor">Profesor Asignado</label>
                    <select class="form-control" id="id_profesor" name="id_profesor" required>
                        <option value="">Seleccione un profesor</option>
                        <?php foreach ($profesores as $profesor): ?>
                            <option value="<?php echo $profesor['id']; ?>" <?php echo isset($curso['id_profesor']) && $curso['id_profesor'] == $profesor['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($profesor['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_grado">Grado</label>
                    <select class="form-control" id="id_grado" name="id_grado" required>
                        <option value="">Seleccione un grado</option>
                        <?php foreach ($grados as $grado): ?>
                            <option value="<?php echo $grado['id']; ?>" <?php echo isset($curso['id_grado']) && $curso['id_grado'] == $grado['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($grado['grado']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $action === 'nuevo' ? 'Crear Curso' : 'Actualizar Curso'; ?></button>
            </form>
        <?php endif; ?>

        <?php if ($action === 'index'): ?>
            <h2 class="my-4">Lista de Cursos</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Profesor</th>
                        <th>Grado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($curso['nombre_curso']); ?></td>
                            <td><?php echo htmlspecialchars($curso['descripcion']); ?></td>
                            <td>
                                <?php echo isset($curso['nombre_profesor']) ? htmlspecialchars($curso['nombre_profesor']) : 'Sin asignar'; ?>
                            </td>
                            <td><?php echo htmlspecialchars($curso['nombre_grado']); ?></td>
                            <td>
                                <a href="index.php?controller=Curso&action=editar&id=<?php echo htmlspecialchars($curso['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?controller=Curso&action=eliminar&id=<?php echo htmlspecialchars($curso['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este curso?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
