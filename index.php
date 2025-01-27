<?php
require_once 'controllers/authController.php';
require_once 'controllers/adminController.php';
require_once 'controllers/ticketController.php';
require_once 'controllers/soporteController.php';

// Manejar controladores y acciones
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        $authController->$action();
        break;
    case 'admin':
        $adminController = new AdminController();
        $adminController->$action();
        break;
    case 'ticket':
        $ticketController = new TicketController();
        $ticketController->$action();
        break;
    case 'soporte':
        $soporteController = new SoporteController();
        $soporteController->$action();
    break;
    default:
        echo "Página no encontrada";
        break;
}
