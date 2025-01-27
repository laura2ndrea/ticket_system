<?php
require_once 'models/authModel.php';
require_once 'models/ticketModel.php';
require_once 'models/adminModel.php';
require_once 'models/usuarioModel.php';
require_once 'models/soporteModel.php';

class AuthController {
    private $authModel;

    public function __construct() {
        $this->authModelModel = new AuthModel();
    }

    // Mostrar el formulario de login
    //public function loginForm() {
        //include 'views/login.php';
    //}

    // Procesar el login
    public function login() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];

            // Verificar credenciales
            $authModel = new AuthModel();
            $auth = $authModel->verificarAuth($correo, $contrasenia); 

            if ($auth) {
                // Guardar datos en la sesión
                $_SESSION['id_usuario'] = $auth['id_usuario'];
                $_SESSION['nick'] = $auth['nick'];
                $_SESSION['id_rol'] = $auth['id_rol'];

                // Redirigir según el rol
                if ($_SESSION['id_rol'] == 1) {
                    header('Location: index.php?controller=admin&action=index');
                } elseif ($_SESSION['id_rol'] == 2) {
                    header('Location: index.php?controller=soporte&action=index');
                } else {
                    header('Location: index.php?controller=ticket&action=index');
                }
            } else {
                echo "Credenciales incorrectas. Intenta nuevamente.";
            }
        }
        require_once 'views/login.php';
    }

    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=auth&action=loginForm');
        exit();
    }
}
