<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión Académica</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #f0f2f5; /* Fondo claro y limpio */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

main {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.contenedor__todo {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); /* Sombra suave */
    overflow: hidden;
    max-width: 900px;
    width: 100%;
    display: flex;
}

.caja__trasera {
    background: linear-gradient(to right, #1b4f72, #1f618d); /* Degradado en azul oscuro */
    padding: 50px;
    color: white;
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    flex-direction: column;
}

.caja__trasera h3 {
    font-size: 26px;
    margin-bottom: 20px;
    font-weight: 600;
}

.caja__trasera p {
    font-size: 18px;
}

.contenedor__login-register {
    width: 50%;
    padding: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
}

.formulario__login {
    width: 100%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
}

.formulario__login h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    font-size: 28px;
    font-weight: 600;
}

.formulario__login input {
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ddd;
    width: 100%;
    font-size: 16px;
    background-color: #f9f9f9;
    transition: border-color 0.3s;
}

.formulario__login input:focus {
    border-color: #1f618d; /* Color del borde cuando está en foco */
    outline: none;
}

.formulario__login button {
    background-color: #1b4f72; /* Botón en azul oscuro */
    color: white;
    padding: 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.formulario__login button:hover {
    background-color: #1f618d; /* Color de fondo más claro al pasar el mouse */
}

</style>
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
            <img src="assets/Imagen/logo.png" alt="Logo" width="150" height="180 ">
                <h3>Bienvenido</h3>
                <h3>Sistema de Gestión Académica</h3>
            </div>
            <div class="contenedor__login-register">
                <form action="index.php?controller=login&action=authenticate" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="email" placeholder="Correo Electrónico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="contrasena" required>
                    <button>Entrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
