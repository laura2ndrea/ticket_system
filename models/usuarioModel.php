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
}
