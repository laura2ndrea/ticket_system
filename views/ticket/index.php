<!-- /views/ticket/index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Lista de Tickets</title>
    <!-- Incluimos Bootstrap 5.3 desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>Lista de Tickets</h1>
    
    <!-- Botón para agregar un nuevo ticket (este puede ser un modal si lo prefieres) -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearTicketModal">Crear Ticket</button>

    <!-- Tabla para listar los tickets -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Asunto</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?php echo $ticket['id_ticket']; ?></td>
                <td><?php echo $ticket['asunto']; ?></td>
                <td><?php echo $ticket['descripcion']; ?></td>
                <td><?php echo $ticket['id_estado_ticket']; ?></td> <!-- Puedes mostrar el estado de manera más legible si lo deseas -->
                <td><?php echo $ticket['fecha_creacion']; ?></td>
                <td>
                    <!-- Acciones: Ver, Editar, Eliminar -->
                    <a href="index.php?controller=ticket&action=edit&id=<?php echo $ticket['id_ticket']; ?>" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

     <!-- Modal para crear un nuevo ticket -->
     <div class="modal fade" id="crearTicketModal" tabindex="-1" aria-labelledby="crearTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTicketModalLabel">Crear Nuevo Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?controller=ticket&action=create" method="POST">
                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
