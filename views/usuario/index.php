<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Mis Tickets</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Mis tickets de soporte</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearTicketModal">Crear Nuevo Ticket</button>
    
    <!-- Tabla de tickets -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Asunto</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
                <th>Respuesta</th>
                <th>Fecha de respuesta</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="tickets-list">
            <!-- Los tickets se cargarán dinámicamente aquí -->
        </tbody>
    </table>

    <!-- Modal para crear un ticket -->
    <div class="modal fade" id="crearTicketModal" tabindex="-1" aria-labelledby="crearTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTicketModalLabel">Crear nuevo ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crear-ticket-form">
                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/usuario.js"></script>
</body>
</html>
