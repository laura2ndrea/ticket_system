<?php
require_once 'models/usuarioModel.php';

class UsuarioController {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    // Mostrar tickets del usuario
    public function index() {
        session_start();
        $usuario_id = $_SESSION['id_usuario']; 
        $tickets = $this->usuarioModel->obtenerTicketsPorUsuario($usuario_id);
        require_once 'views/usuario/index.php';
    }

    // Crear un nuevo ticket
    public function crearTicket() {
        session_start();
        if (isset($_POST['asunto'], $_POST['descripcion'])) {
            $asunto = $_POST['asunto'];
            $descripcion = $_POST['descripcion'];
            $usuario_id = $_SESSION['id_usuario'];
            $result = $this->usuarioModel->crearTicket($asunto, $descripcion, $usuario_id);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Ticket creado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al crear el ticket']);
            }
        }
    }
}
?>
