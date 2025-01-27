<?php

require_once 'models/usuarioModel.php';

class UsuarioController {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        session_start();
    }

    // Obtener los tickets del usuario
    public function obtenerTickets() {
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $tickets = $this->usuarioModel->obtenerTickets($id_usuario);
            echo json_encode($tickets);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No estás autenticado']);
        }
        require_once 'views/usuario/index.php';
    }

    // Crear un nuevo ticket
    public function crearTicket() {
        if (isset($_POST['asunto'], $_POST['descripcion']) && isset($_SESSION['id_usuario'])) {
            $asunto = $_POST['asunto'];
            $descripcion = $_POST['descripcion'];
            $id_usuario = $_SESSION['id_usuario'];

            $ticketId = $this->usuarioModel->crearTicket($asunto, $descripcion, $id_usuario);
            
            if ($ticketId) {
                echo json_encode(['status' => 'success', 'message' => 'Ticket creado exitosamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al crear el ticket']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos para crear el ticket']);
        }
    }
}

// Verificar la acción y ejecutar el método correspondiente
if (isset($_POST['action'])) {
    $controller = new UsuarioController();

    switch ($_POST['action']) {
        case 'obtenerTickets':
            $controller->obtenerTickets();
            break;
        case 'crearTicket':
            $controller->crearTicket();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
}
?>
