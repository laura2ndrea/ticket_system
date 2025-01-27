<?php
require_once 'database/connection.php';

class UsuarioModel {

    // Crear nuevo ticket
    public function crearTicket($asunto, $descripcion, $usuario_id) {
        global $pdo; 
        $query = "INSERT INTO ticket (asunto, descripcion, usuario_creacion, fecha_creacion, id_estado_ticket) 
                  VALUES (:asunto, :descripcion, :usuario_creacion, NOW(), 1)"; // 1 = Abierto
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':usuario_creacion', $usuario_id);
        return $stmt->execute();
    }

    // Obtener los tickets del usuario
    public function obtenerTicketsPorUsuario($usuario_id) {
        global $pdo; 
        $query = "SELECT * FROM ticket WHERE usuario_creacion = :usuario_creacion";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':usuario_creacion', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
