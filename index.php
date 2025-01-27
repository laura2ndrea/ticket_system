<?php
// index.php
require_once 'controllers/authController.php';
//require_once 'controllers/ticketController.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        $authController->$action();
        break;
    //case 'ticket':
        $ticketController = new TicketController();
        $ticketController->$action();
        break;
    default:
        echo "Controlador no encontrado.";
        break;
}
