<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
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
            background-color:  #00ff04; 
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Cambio de color al pasar el ratón */
        }
        .btn-danger {
            background-color: #ff4d4d; /* Botón de eliminar con rojo vibrante */
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
        <h1 class="my-4">Gestión de Alumnos</h1>

        <a href="http://localhost/Gestion_Academica/Public/index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Regresar</a>

        <?php if ($action !== 'nuevo' && $action !== 'editar'): ?>
            <a href="index.php?controller=Alumno&action=nuevo" class="btn btn-primary mb-3">Agregar nuevo alumno</a>
        <?php endif; ?>

        <?php if ($action === 'nuevo' || $action === 'editar'): ?>
            <h2 class="my-4"><?php echo $action === 'nuevo' ? 'Agregar Nuevo Alumno' : 'Editar Alumno'; ?></h2>
            
            <form action="index.php?controller=Alumno&action=<?php echo htmlspecialchars($action); ?><?php echo isset($alumno['carnet']) ? '&carnet=' . htmlspecialchars($alumno['carnet']) : ''; ?>" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $action === 'editar' ? htmlspecialchars($alumno['nombre']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $action === 'editar' ? htmlspecialchars($alumno['apellido']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario Asignado</label>
                    <select class="form-control" id="usuario" name="usuario" required>
                        <option value="">Seleccione un usuario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?php echo htmlspecialchars($usuario['usuario']); ?>" 
                                 <?php echo isset($alumno['usuarioLogin']) && $alumno['usuarioLogin'] == $usuario['usuario'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($usuario['usuario']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_grado">Grado</label>
                    <select class="form-control" id="id_grado" name="id_grado" required>
                        <option value="">Seleccione un grado</option>
                        <?php foreach ($grados as $grado): ?>
                            <option value="<?php echo htmlspecialchars($grado['id']); ?>"
                                 <?php echo isset($alumno['id_grado']) && $alumno['id_grado'] == $grado['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($grado['grado']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"><?php echo $action === 'editar' ? htmlspecialchars($alumno['descripcion']) : ''; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success"><?php echo $action === 'nuevo' ? 'Crear Alumno' : 'Guardar Cambios'; ?></button>
            </form>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Grado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($alumno['carnet']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['nombre_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['nombre_grado']); ?></td>
                            <td>
                                <a href="index.php?controller=Alumno&action=editar&carnet=<?php echo htmlspecialchars($alumno['carnet']); ?>" class="btn btn-sm btn-primary">Editar</a>
                                <a href="index.php?controller=Alumno&action=eliminar&carnet=<?php echo htmlspecialchars($alumno['carnet']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este alumno?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
