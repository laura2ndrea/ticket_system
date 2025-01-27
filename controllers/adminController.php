<?php
require_once 'models/authModel.php';

class AdminController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    // Mostrar el panel de administración
    public function index() {
        session_start();

        // Verificar si el usuario tiene rol de Administrador
        if ($_SESSION['id_rol'] != 1) {
            echo "Acceso denegado. Solo los administradores pueden acceder a esta sección.";
            exit();
        }

        // Mostrar vista principal del administrador
        include 'views/admin/index.php';
    }

    // Listar todos los usuarios
    public function listarUsuarios() {
        session_start();

        // Verificar si el usuario tiene rol de Administrador
        if ($_SESSION['id_rol'] != 1) {
            echo "Acceso denegado.";
            exit();
        }

        $usuarios = $this->usuarioModel->obtenerTodosUsuarios();
        include 'views/admin/usuarios.php';
    }

    // Crear un nuevo usuario
    public function crearUsuario() {
        session_start();

        // Verificar si el usuario tiene rol de Administrador
        if ($_SESSION['id_rol'] != 1) {
            echo "Acceso denegado.";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nick = $_POST['nick'];
            $correo = $_POST['correo'];
            $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT);
            $id_estado = 1; // Por defecto activo
            $id_rol = $_POST['id_rol'];

            $this->usuarioModel->crearUsuario($nick, $correo, $contrasenia, $id_estado, $id_rol);
            header('Location: index.php?controller=admin&action=listarUsuarios');
        } else {
            // Obtener los roles para mostrarlos en el formulario
            $roles = $this->usuarioModel->obtenerRoles();
            include 'views/admin/crearUsuario.php';
        }
    }

    // Editar un usuario existente
    public function editarUsuario() {
        session_start();

        // Verificar si el usuario tiene rol de Administrador
        if ($_SESSION['id_rol'] != 1) {
            echo "Acceso denegado.";
            exit();
        }

        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nick = $_POST['nick'];
                $correo = $_POST['correo'];
                $id_estado = $_POST['id_estado'];
                $id_rol = $_POST['id_rol'];

                $this->usuarioModel->actualizarUsuario($id_usuario, $nick, $correo, $id_estado, $id_rol);
                header('Location: index.php?controller=admin&action=listarUsuarios');
            } else {
                $usuario = $this->usuarioModel->obtenerUsuarioPorId($id_usuario);
                $roles = $this->usuarioModel->obtenerRoles();
                include 'views/admin/editarUsuario.php';
            }
        }
    }

    // Cambiar el estado de un usuario (activar/desactivar)
    public function cambiarEstadoUsuario() {
        session_start();

        // Verificar si el usuario tiene rol de Administrador
        if ($_SESSION['id_rol'] != 1) {
            echo "Acceso denegado.";
            exit();
        }

        if (isset($_GET['id']) && isset($_GET['estado'])) {
            $id_usuario = $_GET['id'];
            $nuevoEstado = $_GET['estado']; // Activo/Inactivo

            $this->usuarioModel->cambiarEstadoUsuario($id_usuario, $nuevoEstado);
            header('Location: index.php?controller=admin&action=listarUsuarios');
        }
    }
}
