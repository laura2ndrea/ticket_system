<?php
require_once 'database/connection.php';

class SoporteModel {
    public function __construct() {
        // Iniciar la conexión con la base de datos si es necesario.
    }

    // Obtener todos los tickets
    public function obtenerTickets() {
        global $pdo;
        $sql = "SELECT * FROM ticket";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener los detalles de un ticket específico
    public function obtenerTicketPorId($id_ticket) {
        global $pdo;
        $sql = "SELECT * FROM ticket WHERE id_ticket = :id_ticket";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_ticket' => $id_ticket]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cambiar el estado de un ticket
    public function cambiarEstadoTicket($id_ticket, $nuevoEstado) {
        global $pdo;
        $sql = "UPDATE ticket SET id_estado_ticket = :id_estado_ticket WHERE id_ticket = :id_ticket";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_estado_ticket' => $nuevoEstado,
            ':id_ticket' => $id_ticket
        ]);
    }

    // Responder a un ticket
    public function responderTicket($id_ticket, $respuesta, $usuario_respuesta) {
        global $pdo;
        $sql = "UPDATE ticket SET respuesta = :respuesta, usuario_respuesta = :usuario_respuesta, fecha_respuesta = NOW() WHERE id_ticket = :id_ticket";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':respuesta' => $respuesta,
            ':usuario_respuesta' => $usuario_respuesta,
            ':id_ticket' => $id_ticket
        ]);
    }
}
?>
