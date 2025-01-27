<?php
// /models/usuarioModel.php
require_once 'database/connection.php';

class UsuarioModel {
    public function verificarUsuario($correo, $contrasenia) {
        global $pdo;
        $sql = "SELECT * FROM usuario WHERE correo = :correo AND contrasenia = :contrasenia";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasenia', $contrasenia);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarios() {
        global $pdo;
    
        try {
            $sql = "SELECT u.id_usuario, u.nick, u.correo, ur.descripcion AS rol, ue.descripcion AS estado
                    FROM usuario u
                    INNER JOIN usuario_rol ur ON u.id_rol = ur.id_usuario_rol
                    INNER JOIN usuario_estado ue ON u.id_estado = ue.id_usuario_estado";
    
            $stmt = $pdo->query($sql);

            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $usuarios;
    
        } catch (Exception $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    // Obtener todos los roles
    public function obtenerRoles() {
        global $pdo;
        $sql = "SELECT * FROM usuario_rol";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los estados de usuario
    public function obtenerEstados() {
        global $pdo;
        $sql = "SELECT * FROM usuario_estado";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public function crearUsuario($nick, $correo, $contrasenia, $id_rol, $id_estado) {
        global $pdo;
        $sql = "INSERT INTO usuario (nick, correo, contrasenia, id_rol, id_estado) 
                VALUES (:nick, :correo, :contrasenia, :id_rol, :id_estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nick' => $nick,
            ':correo' => $correo,
            ':contrasenia' => password_hash($contrasenia, PASSWORD_BCRYPT),
            ':id_rol' => $id_rol,
            ':id_estado' => $id_estado
        ]);
    }

    // Actualizar un usuario
    public function actualizarUsuario($id_usuario, $nick, $correo, $id_rol, $id_estado) {
        global $pdo;
        $sql = "UPDATE usuario 
                SET nick = :nick, correo = :correo, id_rol = :id_rol, id_estado = :id_estado
                WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nick' => $nick,
            ':correo' => $correo,
            ':id_rol' => $id_rol,
            ':id_estado' => $id_estado,
            ':id_usuario' => $id_usuario
        ]);
    }

    // Eliminar un usuario
    public function eliminarUsuario($id_usuario) {
        global $pdo;
        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
    }

    // Obtener usuario por ID
    public function obtenerUsuarioPorId($id_usuario) {
        global $pdo;
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cambiar el estado de un usuario
    public function cambiarEstadoUsuario($id_usuario, $id_estado) {
        global $pdo;
        $sql = "UPDATE usuario SET id_estado = :id_estado WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_estado' => $id_estado,
            ':id_usuario' => $id_usuario
        ]);
    }
}
