<?php
// /controllers/usuarioController.php
require_once 'models/usuarioModel.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    // Mostrar lista de usuarios
    public function index() {
        // Obtener todos los usuarios
        $usuarios = $this->usuarioModel->obtenerUsuarios();
        require 'views/usuario/index.php'; // Cargar la vista con los usuarios
    }

    /*public function create() {
        require 'views/usuario/create.php';
    }*/

      // Crear usuario
      public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nick = $_POST['nick'];
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];
            $id_rol = $_POST['rol'];
            $id_estado = $_POST['estado'];
            if ($id_rol && $id_estado) {
                $this->usuarioModel->crearUsuario($nick, $correo, $contrasenia, $id_rol, $id_estado);
                header('Location: index.php?controller=usuario&action=index');
            } else {
                echo "Error: Rol o estado no definidos.";
            }
        }
        //$roles = $this->usuarioModel->obtenerRoles();
       // $estados = $this->usuarioModel->obtenerEstados();
        //require 'views/usuario/crear.php'; 
    }

    // Editar usuario
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $nick = $_POST['nick'];
            $correo = $_POST['correo'];
            $id_rol = $_POST['id_rol'];
            $id_estado = $_POST['id_estado'];
            $this->usuarioModel->actualizarUsuario($id_usuario, $nick, $correo, $id_rol, $id_estado);
            header('Location: index.php?controller=usuario&action=index');
            require 'views/usuario/index.php';
        }

        // Cargar los datos actuales del usuario para editarlos
        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];
            $usuario = $this->usuarioModel->obtenerUsuarioPorId($id_usuario);
            $roles = $this->usuarioModel->obtenerRoles();
            $estados = $this->usuarioModel->obtenerEstados();
            require 'views/usuario/editar.php'; // Vista para editar usuario
        }
    }

    // Eliminar usuario
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];
            $this->usuarioModel->eliminarUsuario($id_usuario);
            header('Location: index.php?controller=usuario&action=index');
        }
    }

     // Cambiar el estado de un usuario
     public function cambiarEstado() {
        if (isset($_GET['id']) && isset($_GET['estado'])) {
            $id_usuario = $_GET['id'];
            $id_estado = $_GET['estado'];
            $this->usuarioModel->cambiarEstadoUsuario($id_usuario, $id_estado);
            header('Location: index.php?controller=usuario&action=index');
        }
    }
}
