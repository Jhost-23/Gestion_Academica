<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <!-- Bootstrap 5 y FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
        background: #004d80; /* Fondo azul */
        color: #f1f1f1; /* Texto blanco */
        position: relative;
        min-height: 100vh;
    }
    .navbar {
        background-color: #004d80; /* Color de la barra de navegación */
    }
    .navbar-brand img {
        border-radius: 50%;
    }
    .navbar-brand span {
        font-weight: bold;
        font-size: 1.5rem;
        color: #f1f1f1; /* Color de texto */
    }
    .dropdown-menu {
        background-color: #005b99; /* Fondo del menú desplegable */
    }
    .dropdown-item {
        color: #fff; /* Color de texto del menú desplegable */
    }
    .dropdown-item:hover {
        background-color: #337ab7; /* Color de fondo al pasar el mouse */
    }
    h1 {
        margin-top: 2rem;
        color: #f1f1f1; /* Color de encabezado */
    }
    .lead {
        color: #f1f1f1; /* Color de texto secundario */
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #005b99; /* Fondo de las tarjetas */
        padding: 1.5rem;
        margin-top: 2rem;
    }
    .btn {
        background-color: #005b99; /* Fondo de los botones */
        color: #fff; /* Texto de los botones */
        border: none; /* Sin borde */
        border-radius: 25px; /* Bordes redondeados para botones */
    }
    .btn:hover {
        background-color: #004d80; /* Color de fondo al pasar el mouse por los botones */
        color: #fff; /* Color de texto al pasar el mouse */
    }
    /* Estilos para el botón de Cerrar Sesión */
    .logout-btn {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background-color: #ff4d4d; /* Fondo rojo */
        color: white; /* Texto blanco */
        border-radius: 5px;
        padding: 10px 20px;
    }
    .logout-btn:hover {
        background-color: #ff1a1a; /* Rojo más oscuro al pasar el mouse */
    }
  </style>
</head>
<body>
  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?controller=admin&action=dashboard">
        <img src="assets/Imagen/logo.png" alt="Logo" width="60" height="60">
        <span class="ms-2">TEC-SGA</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Menú Inicio -->
          <li class="nav-item">
            <a class="nav-link active" href="index.php?controller=admin&action=dashboard">
              <i class="fas fa-home"></i> Inicio
            </a>
          </li>
          <!-- Menú desplegable Usuarios -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-users"></i> Usuarios
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
              <li><a class="dropdown-item" href="index.php?controller=usuarios&action=index">Gestión de Usuarios</a></li>
              <li><a class="dropdown-item" href="index.php?controller=Asignacion&action=index">Asignaciones</a></li>
            </ul>
          </li>
          <!-- Menú desplegable Registro -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRegistro" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-clipboard-list"></i> Registro
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownRegistro">
            <li><a class="dropdown-item" href="index.php?controller=Alumno&action=index">Alumnos</a></li>
              <li><a class="dropdown-item" href="index.php?controller=Curso&action=index">Cursos</a></li>
              <li><a class="dropdown-item" href="index.php?controller=Profesor&action=index">Profesores</a></li>
              <li><a class="dropdown-item" href="index.php?controller=Grado&action=index">Grados</a></li>
              <li><a class="dropdown-item" href="index.php?controller=Especialidad&action=index">Especialidad</a></li>
            </ul>
          </li>
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
  <!-- Contenedor principal -->
  <div class="container mt-4">
    <!-- Título de bienvenida -->
    <div class="card">
      <div class="card-body text-center">
        <h1 class="display-5">Bienvenido al Panel de Administración</h1>
        <p class="lead">Gestiona usuarios, asignaciones, cursos y más.</p>
      </div>
    </div>
  </div>
  <!-- Scripts de Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
