<?php
// Verificar qué controlador y acción se están solicitando
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'login'; // Controlador por defecto 'login'
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Acción por defecto 'index'

// Ajustar la ruta para los controladores desde la carpeta 'app/controllers'
$controllerFile = __DIR__ . '/../app/controllers/' . ucfirst($controller) . 'Controller.php';
$controllerName = ucfirst($controller) . 'Controller';

// Verificar si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile; // Incluir el archivo del controlador
    
    // Verificar si la clase del controlador existe
    if (class_exists($controllerName)) {
        $controllerObject = new $controllerName(); // Crear una instancia del controlador
        
        // Verificar si el método (acción) existe en el controlador
        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action(); // Llamar a la acción correspondiente
        } else {
            echo "Error: La acción '$action' no existe en el controlador '$controllerName'.";
        }
    } else {
        echo "Error: El controlador '$controllerName' no existe.";
    }
} else {
    echo "Error: El archivo del controlador '$controllerFile' no se encuentra.";
}
?>
