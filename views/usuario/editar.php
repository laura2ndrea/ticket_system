<!-- /views/usuario/editar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Usuario</h1>
        <form method="POST" action="index.php?controller=usuario&action=editar">
            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario']; ?>">
            
            <div class="mb-3">
                <label for="nick" class="form-label">Nick</label>
                <input type="text" class="form-control" id="nick" name="nick" value="<?= $usuario['nick']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?= $usuario['correo']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_rol" class="form-label">Rol</label>
                <select class="form-control" id="id_rol" name="id_rol" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol['id_usuario_rol']; ?>" <?= $rol['id_usuario_rol'] == $usuario['id_rol'] ? 'selected' : ''; ?>>
                            <?= $rol['descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_estado" class="form-label">Estado</label>
                <select class="form-control" id="id_estado" name="id_estado" required>
                    <?php foreach ($estados as $estado): ?>
                        <option value="<?= $estado['id_usuario_estado']; ?>" <?= $estado['id_usuario_estado'] == $usuario['id_estado'] ? 'selected' : ''; ?>>
                            <?= $estado['descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            <a href="index.php?controller=usuario&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
