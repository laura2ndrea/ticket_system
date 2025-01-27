<?php
// /controllers/authController.php
require_once 'models/usuarioModel.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->verificarUsuario($correo, $contrasenia);

            if ($usuario) {
                session_start();
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nick'] = $usuario['nick'];
                header('Location: index.php?controller=ticket&action=crear');
            } else {
                echo "Correo o contraseña incorrectos.";
            }
        } else {
            require_once 'views/login.php';
        }
    }
}