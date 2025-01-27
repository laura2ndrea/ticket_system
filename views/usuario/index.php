<!-- /views/usuario/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Usuarios</h1>
         <!-- Botón para agregar un nuevo usuario -->
        <a href="index.php?controller=usuario&action=store" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateUser">Agregar Nuevo Usuario</a>


        <!-- Tabla de usuarios -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nick</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id_usuario']; ?></td>
                            <td><?= $usuario['nick']; ?></td>
                            <td><?= $usuario['correo']; ?></td>
                            <td><?= $usuario['rol']; ?></td>
                            <td><?= $usuario['estado']; ?></td>
                            <td>
                                <!-- Botones de acción -->
                                <a href="index.php?controller=usuario&action=editar&id=<?= $usuario['id_usuario']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?controller=usuario&action=eliminar&id=<?= $usuario['id_usuario']; ?>" class="btn btn-danger btn-sm">Eliminar</a>

                                <!-- Botones para cambiar el estado -->
                                <?php if ($usuario['estado'] === 'Activo'): ?>
                                    <a href="index.php?controller=usuario&action=cambiarEstado&id=<?= $usuario['id_usuario']; ?>&estado=Inactivo" class="btn btn-secondary btn-sm">Desactivar</a>
                                <?php else: ?>
                                    <a href="index.php?controller=usuario&action=cambiarEstado&id=<?= $usuario['id_usuario']; ?>&estado=Activo" class="btn btn-success btn-sm">Activar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay usuarios disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
      <!-- Modal para crear un nuevo usuario -->
      <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateUserLabel">Crear Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear un nuevo usuario -->
                    <form id="createUserForm" action="index.php?controller=usuario&action=store" method="POST">
                        <div class="mb-3">
                            <label for="nick" class="form-label">Nick</label>
                            <input type="text" class="form-control" id="nick" name="nick" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasenia" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasenia" name="contrasenia" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <option value="1">Administrador</option>
                                <option value="2">Responsable de Soporte</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Crear Usuario</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
