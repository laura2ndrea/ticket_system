<?php

require_once 'database/connection.php';

class AdminModel {

    // Obtener todos los usuarios
    public function obtenerUsuarios() {
        global $pdo;
        // Obtener usuarios con sus roles y estados descriptivos
        $sql = "SELECT u.id_usuario, u.nick, u.correo, ue.descripcion AS estado, ur.descripcion AS rol
                FROM usuario u
                JOIN usuario_estado ue ON u.id_estado = ue.id_usuario_estado
                JOIN usuario_rol ur ON u.id_rol = ur.id_usuario_rol;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Agregar un nuevo usuario
    public function agregarUsuario($nick, $correo, $contrasenia, $rol, $estado) {
        global $pdo;
        $sql = "INSERT INTO usuario (nick, correo, contrasenia, id_rol, id_estado) VALUES (:nick, :correo, :contrasenia, :rol, :estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nick' => $nick,
            ':correo' => $correo,
            ':contrasenia' => $contrasenia,
            ':rol' => $rol,
            ':estado' => $estado
        ]);
        return $pdo->lastInsertId();
    }

    // Actualizar el estado de un usuario
    public function actualizarEstado($id_usuario, $estado) {
        global $pdo;
        $sql = "UPDATE usuario SET id_estado = :estado WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':estado' => $estado,
            ':id_usuario' => $id_usuario
        ]);
        return $stmt->rowCount();
    }

    // Eliminar un usuario
    public function eliminarUsuario($id_usuario) {
        global $pdo;
        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->rowCount(); 
    }

    // Mostrar los datos de un usuario para editar
    public function editar() {
        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];
            $usuario = $this->adminModel->obtenerUsuarioPorId($id_usuario);
            echo json_encode($usuario); 
        }
    }

    // Actualizar los datos del usuario
    public function actualizar() {
        if (isset($_POST['id_usuario'], $_POST['nick'], $_POST['correo'], $_POST['rol'], $_POST['estado'])) {
            $id_usuario = $_POST['id_usuario'];
            $nick = $_POST['nick'];
            $correo = $_POST['correo'];
            $id_rol = $_POST['rol'];
            $id_estado = $_POST['estado'];

            $result = $this->adminModel->actualizarUsuario($id_usuario, $nick, $correo, $id_rol, $id_estado);

            if ($result > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el usuario']);
            }
        }
    }

    public function actualizarUsuario($id_usuario, $nick, $correo, $id_rol, $id_estado) {
        global $pdo;
        $sql = "UPDATE usuario SET nick = :nick, correo = :correo, id_rol = :id_rol, id_estado = :id_estado WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':nick', $nick);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':id_estado', $id_estado);
        return $stmt->execute();
    }
    

    public function obtenerUsuarioPorId($id_usuario) {
        global $pdo;
        $sql = "SELECT id_usuario, nick, correo, id_rol, id_estado FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC); 
        
        return $usuario;
    }
}    
?>
