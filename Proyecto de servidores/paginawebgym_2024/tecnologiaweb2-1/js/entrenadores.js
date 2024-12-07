$(document).ready(function(){
    // Cargar la lista de entrenadores al cargar la página
    cargarEntrenadores();
    
    // Buscar entrenadores en tiempo real al escribir en el campo de búsqueda
    $('#q').on('input', function() {
        cargarEntrenadores();
    });
    
    })
    
    // Función para cargar la lista de entrenadores
    function cargarEntrenadores() {
        var searchTerm = $('#q').val(); // Obtener el término de búsqueda del campo de búsqueda
        $.ajax({
            url: 'ajax/listar_entrenadores.php',
            type: 'GET',
            data: { q: searchTerm }, // Enviar el término de búsqueda al servidor
            success: function(response) {
                $('#tbody-entrenadores').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
// Función para mostrar el modal de editar entrenador
$(document).on('click', '.editar-entrenador', function(){
    var entrenador_id = $(this).data('id');
    $.ajax({
        url: 'modal/editar_entrenador.php',// Carga la modal de editar entrenador
        type: 'POST',
        data: { id: entrenador_id },
        success: function(response) {
            $('#editarModal').html(response);
            $('#editarModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
  // Función para agregar entrenador
$('#formAgregarEntrenador').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'ajax/agregar_entrenador.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                // Recargar la lista de entrenadores
                cargarEntrenadores();
                // Mostrar mensaje de éxito
                alert(response.message);
                // Limpiar el formulario
                $('#formAgregarEntrenador')[0].reset();
                // Cerrar el modal
                $('#nuevoEntrenador').modal('hide');
            } else {
                // Mostrar mensaje de error
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error en la solicitud: ' + error);
        }
    });
});
