<?php

require_once 'models/AdminModel.php';

class AdminController {

    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // Obtener la lista de usuarios
    public function index() {
        $usuarios = $this->adminModel->obtenerUsuarios();
        require_once 'views/admin/index.php';
    }

    // Agregar un nuevo usuario
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nick = $_POST['nick'];
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];
            $rol = $_POST['rol'];
            $estado = $_POST['estado'];
            $this->adminModel->agregarUsuario($nick, $correo, $contrasenia, $rol, $estado);
            echo json_encode(['status' => 'success']);
        }
    }

    public function cambiarEstado() {
        if (isset($_GET['id']) && isset($_GET['estado'])) {
            $id_usuario = $_GET['id'];
            $estado = $_GET['estado'];
            $nuevoEstado = ($estado == 'Activo') ? 1 : 2;
            $this->adminModel->actualizarEstado($id_usuario, $nuevoEstado);
            echo json_encode(['status' => 'success']);
        }
    }

    // Eliminar un usuario
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id_usuario = $_GET['id'];
            $this->adminModel->eliminarUsuario($id_usuario);
            echo json_encode(['status' => 'success']);
        }
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
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos para actualizar el usuario']);
        }
    }
}
?>
