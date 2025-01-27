<!-- /views/crear_ticket.php -->
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Crear Ticket</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <h2>Crear Ticket</h2>
                <form id="ticketForm">
                    <div class="mb-3">
                        <label for="asunto" class="form-label">Asunto</label>
                        <input type="text" class="form-control" id="asunto" name="asunto" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Ticket</button>
                </form>
                <div id="respuesta" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#ticketForm').submit(function(e){
                e.preventDefault(); // Evita el envío convencional del formulario

                var asunto = $('#asunto').val();
                var descripcion = $('#descripcion').val();

                $.ajax({
                    url: 'index.php?controller=ticket&action=crear', // Controlador y acción
                    type: 'POST',
                    data: {
                        asunto: asunto,
                        descripcion: descripcion
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.success) {
                            $('#respuesta').html('<div class="alert alert-success">Ticket creado con éxito!</div>');
                            $('#ticketForm')[0].reset(); // Limpia el formulario
                        } else {
                            $('#respuesta').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function(){
                        $('#respuesta').html('<div class="alert alert-danger">Hubo un error al procesar la solicitud.</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
