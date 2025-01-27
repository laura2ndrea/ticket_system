$(document).ready(function() {

    // Crear usuario con AJAX
    $('#createUserForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php?controller=admin&action=store', // Acción para crear usuario
            data: $(this).serialize(),
            success: function(response) {
                location.reload(); // Recargar la página para mostrar el nuevo usuario
            },
            error: function() {
                alert('Error al crear el usuario');
            }
        });
    });

    // Cambiar estado con AJAX
    $('.cambiar-estado').click(function() {
        var id = $(this).data('id');
        var estado = $(this).data('estado');
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=admin&action=cambiarEstado', // Acción para cambiar el estado
            data: { id: id, estado: estado },
            success: function(response) {
                location.reload(); // Recargar la página para reflejar el cambio
            },
            error: function() {
                alert('Error al cambiar el estado del usuario');
            }
        });
    });

    // Eliminar usuario con AJAX
    $('.eliminar-usuario').click(function() {
        var id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            $.ajax({
                type: 'GET',
                url: 'index.php?controller=admin&action=eliminar', // Acción para eliminar usuario
                data: { id: id },
                success: function(response) {
                    location.reload(); // Recargar la página para eliminar al usuario
                },
                error: function() {
                    alert('Error al eliminar el usuario');
                }
            });
        }
    });

    // Abrir el modal con los datos del usuario para editar
    $('.editar-usuario').click(function() {
        var id_usuario = $(this).data('id'); 
    
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=admin&action=editar', 
            data: { id: id_usuario },
            success: function(response) {
                var usuario = JSON.parse(response); 
    
                $('#modalEditUser #id_usuario').val(usuario.id_usuario);
                $('#modalEditUser #nick').val(usuario.nick);
                $('#modalEditUser #correo').val(usuario.correo);
                $('#modalEditUser #rol').val(usuario.id_rol);
                $('#modalEditUser #estado').val(usuario.id_estado);
    
                $('#modalEditUser').modal('show');
            },
            error: function() {
                alert('Error al cargar los datos del usuario');
            }
        });
    });
    
    $('#editUserForm').submit(function(e) {
        e.preventDefault(); 

        var formData = $(this).serialize(); 

        $.ajax({
            type: 'POST',
            url: 'index.php?controller=admin&action=actualizar', 
            data: formData,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message); 
                    location.reload(); 
                } else {
                    alert(result.message); 
                }
            },
            error: function() {
                alert('Error al actualizar los datos');
            }
        });
    });
});
