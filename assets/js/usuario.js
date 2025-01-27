$(document).ready(function() {
    // Enviar formulario de creación de ticket
    $('#crearTicketForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'index.php?controller=usuario&action=crearTicket',
            data: $(this).serialize(),
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.message);
                if (result.status === 'success') {
                    location.reload(); // Recargar la página para ver el nuevo ticket
                }
            },
            error: function() {
                alert('Error al crear el ticket');
            }
        });
    });
});