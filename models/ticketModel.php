<?php
// /models/ticketModel.php
require_once 'database/connection.php';

class TicketModel {
    public function crearTicket($asunto, $descripcion, $usuario_creacion) {
        global $pdo;
        $sql = "INSERT INTO ticket (asunto, descripcion, usuario_creacion, fecha_creacion) 
                VALUES (:asunto, :descripcion, :usuario_creacion, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':usuario_creacion', $usuario_creacion);

        return $stmt->execute(); // Retorna true si se ejecuta correctamente
    }
}
