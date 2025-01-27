<?php
require_once 'models/soporteModel.php';

class SoporteController {

    private $soporteModel;

    public function __construct() {
        // Inicializamos el modelo de soporte
        $this->soporteModel = new SoporteModel();
    }

    // Mostrar todos los tickets de soporte
    public function index() {
        session_start();
        
        // Verificar si el usuario está autenticado y tiene el rol correcto
        if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 2) {
            echo "Acceso denegado. Solo el responsable de soporte puede acceder a esta sección.";
            exit();
        }
        
        // Obtener todos los tickets
        //$tickets = $this->soporteModel->obtenerTodosLosTickets();
        
        // Mostrar vista principal del responsable de soporte
        require_once 'views/soporte/index.php';
    }

    // Ver los detalles de un ticket específico
    public function verTicket($id_ticket) {
        $ticket = $this->soporteModel->obtenerTicketPorId($id_ticket);
        require_once 'views/soporte/ver.php';  // Vista para mostrar detalles del ticket
    }

    // Cambiar el estado de un ticket
    public function cambiarEstado($id_ticket, $nuevoEstado) {
        $this->soporteModel->cambiarEstadoTicket($id_ticket, $nuevoEstado);
        header('Location: index.php?controller=soporte&action=index');
    }

    // Responder a un ticket
    public function responder($id_ticket) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $respuesta = $_POST['respuesta'];
            $usuario_respuesta = $_SESSION['id_usuario'];  // Suponiendo que el usuario está logueado
            $this->soporteModel->responderTicket($id_ticket, $respuesta, $usuario_respuesta);
            header('Location: index.php?controller=soporte&action=verTicket&id_ticket=' . $id_ticket);
        }
    }
}
