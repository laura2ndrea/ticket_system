<?php
// index.php
session_start();
require_once 'controllers/authController.php';
require_once 'controllers/ticketController.php';
require_once 'controllers/usuarioController.php'; // Incluir el controlador de usuarios

// Verificar qué controlador y acción se han solicitado, si no, por defecto usaremos 'usuario' y 'index'
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';  // Cambiado a 'usuario'
$action = isset($_GET['action']) ? $_GET['action'] : 'login';  // Acción 'index' para usuarios

switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        $authController->$action();
        break;
    case 'ticket':
        $ticketController = new TicketController();
        $ticketController->$action();
        break;
    case 'usuario':  // Caso para gestionar usuarios
        $usuarioController = new UsuarioController();  
        $usuarioController->$action();  
        break;
    default:
        echo "Controlador no encontrado.";
        break;
}
?>

