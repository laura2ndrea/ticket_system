<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Mis tickets</h1>

        <div style="text-align: right; padding: 10px;">
            <form action="index.php?controller=auth&action=logout" method="POST">
                <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar sesión</button>
            </form>
        </div>
        
        <!-- Botón para crear nuevo ticket -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearTicketModal">Crear ticket</button>

        <!-- Tabla de tickets -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ticket['asunto']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['descripcion']); ?></td>
                        <td><?php echo $ticket['fecha_creacion']; ?></td>
                        <td>
                            <?php
                                switch ($ticket['id_estado_ticket']) {
                                    case 1: echo 'Abierto'; break;
                                    case 2: echo 'En Proceso'; break;
                                    case 3: echo 'Cerrado'; break;
                                    case 4: echo 'Cancelado'; break;
                                    default: echo 'Desconocido'; break;
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal para crear nuevo ticket -->
        <div class="modal fade" id="crearTicketModal" tabindex="-1" aria-labelledby="crearTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearTicketModalLabel">Crear ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="crearTicketForm">
                            <div class="mb-3">
                                <label for="asunto" class="form-label">Asunto</label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/usuario.js"></script>
</body>
</html>
