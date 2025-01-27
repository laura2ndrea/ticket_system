<!-- /views/usuario/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Usuarios</h1>

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
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm">Desactivar</a>
                                <?php else: ?>
                                    <a href="javascript:void(0);" class="btn btn-success btn-sm">Activar</a>
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
</body>
</html>
