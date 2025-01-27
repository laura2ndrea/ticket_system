$(document).ready(function() {
    // Obtener tickets del usuario
    obtenerTickets();

    // Función para obtener los tickets
    function obtenerTickets() {
        $.ajax({
            url: 'index.php?controller=usuario&action=obtenerTickets', 
            method: 'POST',
            data: { action: 'obtenerTickets' },
            success: function(response) {
                let tickets = JSON.parse(response);
                let ticketsHtml = '';
                tickets.forEach(function(ticket) {
                    ticketsHtml += `
                        <tr>
                            <td>${ticket.asunto || 'No disponible'}</td>
                            <td>${ticket.descripcion || 'No disponible'}</td>
                            <td>${ticket.fecha_creacion || 'No disponible'}</td>
                            <td>${ticket.respuesta || 'No disponible'}</td>
                            <td>${ticket.fecha_respuesta || 'No disponible'}</td>
                            <td>${ticket.estado || 'No disponible'}</td>
                        </tr>
                    `;
                });
                $('#tickets-list').html(ticketsHtml);
            }
        });
    }

    // Crear un nuevo ticket
    $('#crear-ticket-form').submit(function(e) {
        e.preventDefault();

        const asunto = $('#asunto').val();
        const descripcion = $('#descripcion').val();

        $.ajax({
            url: 'index.php?controller=usuario&action=crearTicket', 
            method: 'POST',
            data: {
                action: 'crearTicket',
                asunto: asunto,
                descripcion: descripcion
            },
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    $('#crearTicketModal').modal('hide');
                    obtenerTickets(); // Recargar la lista de tickets
                } else {
                    alert(res.message);
                }
            }
        });
    });
});
