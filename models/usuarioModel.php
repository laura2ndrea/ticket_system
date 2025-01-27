<?php

require_once 'database/connection.php';

class UsuarioModel {

    // Obtener los tickets de un usuario
    public function obtenerTickets($id_usuario) {
        global $pdo;
        $sql = "SELECT t.id_ticket, t.asunto, t.descripcion, t.fecha_creacion, t.respuesta, t.fecha_respuesta, e.descripcion AS estado
                FROM ticket t
                JOIN estado_ticket e ON t.id_estado_ticket = e.id_estado_ticket
                WHERE t.usuario_creacion = :id_usuario";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna los tickets creados por el usuario
    }

    // Crear un nuevo ticket
    public function crearTicket($asunto, $descripcion, $id_usuario) {
        global $pdo;
        $sql = "INSERT INTO ticket (asunto, descripcion, usuario_creacion, fecha_creacion, id_estado_ticket) 
                VALUES (:asunto, :descripcion, :usuario_creacion, NOW(), 1)"; 
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':asunto' => $asunto,
            ':descripcion' => $descripcion,
            ':usuario_creacion' => $id_usuario
        ]);
        return $pdo->lastInsertId(); // Retorna el ID del ticket recién creado
    }
}

?>
