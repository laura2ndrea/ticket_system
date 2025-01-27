<?php
// /controllers/ticketController.php
require_once 'models/ticketModel.php';

class TicketController {
    private $ticketModel;

    public function __construct() {
        $this->ticketModel = new TicketModel(); // Instanciamos el modelo
    }

    public function index() {
        // Obtenemos todos los tickets desde el modelo
        $tickets = $this->ticketModel->obtenerTodosTickets();
        
        // Pasamos los tickets a la vista
        include 'views/ticket/index.php';
    } 
    
      // Crear un nuevo ticket (mostrar el modal o procesar el formulario)
      public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recuperar los datos del formulario
            $asunto = $_POST['asunto'];
            $descripcion = $_POST['descripcion'];
            $id_usuario = 1; // Por ahora, asignamos un usuario fijo, puedes cambiarlo según la sesión
            $id_estado_ticket = 1; // Asignamos el estado "Abierto"

            // Llamamos al modelo para insertar el ticket
            $this->ticketModel->crearTicket($asunto, $descripcion, $id_usuario, $id_estado_ticket);

            // Redirigimos a la lista de tickets
            header('Location: index.php?controller=ticket&action=index');
        }
    }
}
