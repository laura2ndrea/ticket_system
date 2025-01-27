<?php
// /models/ticketModel.php
require_once 'database/connection.php';

class TicketModel {
    // Crear un nuevo ticket en la base de datos
    public function crearTicket($asunto, $descripcion, $id_usuario, $id_estado_ticket) {
        global $pdo;
        $sql = "INSERT INTO ticket (asunto, descripcion, usuario_creacion, fecha_creacion, id_estado_ticket) 
                VALUES (:asunto, :descripcion, :usuario_creacion, NOW(), :id_estado_ticket)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':asunto' => $asunto,
            ':descripcion' => $descripcion,
            ':usuario_creacion' => $id_usuario,
            ':id_estado_ticket' => $id_estado_ticket
        ]);
    }

    public function obtenerTodosTickets() {
        global $pdo; // Usamos la conexión global
        $sql = "SELECT * FROM ticket"; // Puedes modificar la consulta si necesitas más información o filtrado
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retornamos todos los tickets en formato de array asociativo
    }
}
