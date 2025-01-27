<?php
// /controllers/ticketController.php
require_once 'models/ticketModel.php';

class TicketController {
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger los datos del formulario
            $asunto = $_POST['asunto'];
            $descripcion = $_POST['descripcion'];
            $usuario_creacion = $_SESSION['id_usuario']; // Usuario logueado

            // Validaciones (puedes agregar más según los requisitos)
            if (empty($asunto) || empty($descripcion)) {
                echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
                return;
            }

            $ticketModel = new TicketModel();
            $resultado = $ticketModel->crearTicket($asunto, $descripcion, $usuario_creacion);

            if ($resultado) {
                echo json_encode(['success' => true, 'message' => 'Ticket creado con éxito.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Hubo un error al crear el ticket.']);
            }
        } else {
            require_once 'views/crear_ticket.php';
        }
    }
}
