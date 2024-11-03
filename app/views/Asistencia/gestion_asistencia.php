<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($asistencia) ? 'Editar Asistencia' : 'Gestión de Asistencias' ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #003366;
            color: white;
        }
        .container {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        h1, h2 {
            color: #ffffff;
        }
        table {
            background-color: rgba(255, 255, 255, 0.2);
        }
        /* Estilos para ocultar elementos en la impresión */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= isset($asistencia) ? 'Editar Asistencia' : 'Gestión de Asistencias' ?></h1>

        <!-- Formulario para nueva asistencia o edición -->
        <form id="form-asistencia" method="post" action="index.php?controller=Asistencia&action=<?= isset($asistencia) ? 'editar&id=' . $asistencia['id'] : 'nuevo' ?>">
            <div class="form-group">
                <label for="id_curso">Curso</label>
                <select id="id_curso" name="id_curso" class="form-control" required>
                    <option value="">Seleccione un curso</option>
                    <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso['id'] ?>" <?= isset($asistencia) && $asistencia['id_curso'] == $curso['id'] ? 'selected' : '' ?>><?= $curso['nombre_curso'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="<?= isset($asistencia) ? $asistencia['fecha'] : '' ?>" required>
            </div>
            <div id="alumnos-list" class="form-group">
                <label>Alumnos</label>
                <div id="alumnos-container">
                    <?php if (isset($alumnos)): ?>
                        <?php foreach ($alumnos as $alumno): ?>
                            <div class="form-group">
                                <label><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']) ?></label>
                                <select name="asistencia[<?= $alumno['carnet'] ?>]" class="form-control">
                                    <option value="Presente" <?= isset($alumno['estado']) && $alumno['estado'] === 'Presente' ? 'selected' : '' ?>>Presente</option>
                                    <option value="Ausente" <?= isset($alumno['estado']) && $alumno['estado'] === 'Ausente' ? 'selected' : '' ?>>Ausente</option>
                                </select>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-success no-print"><?= isset($asistencia) ? 'Actualizar Asistencia' : 'Guardar Asistencia' ?></button>
            <?php if (isset($asistencia)): ?>
                <a href="index.php?controller=Asistencia&action=index" class="btn btn-secondary no-print">Cancelar</a>
            <?php endif; ?>
        </form>

        <!-- Tabla de asistencias guardadas (solo se muestra en modo nuevo) -->
        <?php if (!isset($asistencia)): ?>
            <hr>
            <h2>Asistencias Guardadas</h2>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Curso</th>
                        <th>Fecha</th>
                        <th>Alumno</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($asistencias as $asistencia): ?>
                        <tr>
                            <td><?= htmlspecialchars($asistencia['id']) ?></td>
                            <td><?= htmlspecialchars($asistencia['nombre_curso']) ?></td>
                            <td><?= htmlspecialchars($asistencia['fecha']) ?></td>
                            <td><?= htmlspecialchars($asistencia['nombre_alumno'] . ' ' . $asistencia['apellido_alumno']) ?></td>
                            <td><?= htmlspecialchars($asistencia['estado']) ?></td>
                            <td>
                                <a href="index.php?controller=Asistencia&action=editar&id=<?= $asistencia['id'] ?>" class="btn btn-warning btn-sm no-print">Editar</a>
                                <a href="index.php?controller=Asistencia&action=eliminar&id=<?= $asistencia['id'] ?>" class="btn btn-danger btn-sm no-print" onclick="return confirm('¿Estás seguro de eliminar esta asistencia?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="index.php?controller=profesor&action=dashboard" class="btn btn-secondary no-print">Cancelar</a>
            <a href="index.php?controller=Asistencia&action=imprimir" class="btn btn-secondary mb-3 no-print" onclick="window.print(); return false;">Imprimir</a>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_curso').change(function() {
                const idCurso = $(this).val();
                if (idCurso) {
                    $.ajax({
                        url: 'index.php?controller=Asistencia&action=getAlumnos&id_curso=' + idCurso,
                        type: 'GET',
                        success: function(data) {
                            const alumnos = JSON.parse(data);
                            let html = '';
                            alumnos.forEach(function(alumno) {
                                html += `
                                    <div class="form-group">
                                        <label>${alumno.nombre} ${alumno.apellido}</label>
                                        <select name="asistencia[${alumno.carnet}]" class="form-control">
                                            <option value="Presente">Presente</option>
                                            <option value="Ausente">Ausente</option>
                                        </select>
                                    </div>
                                `;
                            });
                            $('#alumnos-container').html(html);
                        }
                    });
                } else {
                    $('#alumnos-container').html('');
                }
            });
        });
    </script>
</body>
</html>
