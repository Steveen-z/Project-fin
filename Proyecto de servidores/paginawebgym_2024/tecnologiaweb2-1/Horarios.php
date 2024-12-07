<?php
require_once 'conexion.php'; // Conexión a la base de datos

$resultados_por_pagina = 2; // Número de resultados por página
$busqueda = isset($_GET['q']) ? $_GET['q'] : ''; // Obtener el término de búsqueda
$pagina_actual = isset($_GET['page']) ? intval($_GET['page']) : 1; // Obtener la página actual
$indice_inicial = ($pagina_actual - 1) * $resultados_por_pagina; // Índice para LIMIT

// Obtener el total de registros
$total_registros_query = "SELECT COUNT(*) AS total FROM horarios"; 
if (!empty($busqueda)) {
    $total_registros_query .= " WHERE dia LIKE :busqueda OR ejercicio LIKE :busqueda";
}
$total_registros_stmt = $pdo->prepare($total_registros_query);
if (!empty($busqueda)) {
    $total_registros_stmt->bindValue(':busqueda', "%$busqueda%");
}
$total_registros_stmt->execute();
$total_registros = $total_registros_stmt->fetch(PDO::FETCH_ASSOC)['total'];

$total_paginas = ceil($total_registros / $resultados_por_pagina); // Calcular el número total de páginas

// Consulta para obtener los horarios
$query = "SELECT * FROM horarios";
if (!empty($busqueda)) {
    $query .= " WHERE dia LIKE :busqueda OR ejercicio LIKE :busqueda";
}
$query .= " LIMIT :indice_inicial, :resultados_por_pagina";

$stmt = $pdo->prepare($query);
if (!empty($busqueda)) {
    $stmt->bindValue(':busqueda', "%$busqueda%");
}
$stmt->bindValue(':indice_inicial', $indice_inicial, PDO::PARAM_INT);
$stmt->bindValue(':resultados_por_pagina', $resultados_por_pagina, PDO::PARAM_INT);
$stmt->execute();
$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Horarios</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        body {
            height: 100vh;
            margin: 0;
            background-image: url('imagen.png'); /* Imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .content-overlay {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            background: rgba(0, 0, 0, 0.5); /* Fondo oscuro semitransparente */
            padding: 20px;
        }

        .container {
            color: #000;
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #2980B9;
            border-color: #2980B9;
        }

        .btn-primary:hover {
            background-color: #1A5276;
            border-color: #1A5276;
        }

        .bg-section {
            margin-top: 20px;
            padding: 30px;
            background: rgba(44, 62, 80, 0.8); /* Fondo oscuro */
            color: #fff;
            border-radius: 8px;
        }

        .bg-section h1 {
            font-size: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <?php require_once 'menu.php'; ?>

    <div class="container">
        <div class="header">
            <h2>Horarios de Ejercicio</h2>
        </div>

        <?php
        if (isset($_GET['eliminado']) && $_GET['eliminado'] === '1') {
            echo "<div class='alert alert-success' role='alert'>El horario se eliminó correctamente.</div>";
        } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<div class='alert alert-danger' role='alert'>Hubo un error al eliminar el horario. Por favor, inténtalo de nuevo.</div>";
        }
        ?>

        

<table class="table table-bordered" id="tablaHorarios">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Día</th>
            <th>Ejercicio</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($horarios as $horario): ?>
            <tr>
                <td><?php echo $horario['id']; ?></td>
                <td><?php echo $horario['dia']; ?></td>
                <td><?php echo $horario['ejercicio']; ?></td>
                <td><?php echo $horario['hora_inicio']; ?></td>
                <td><?php echo $horario['hora_fin']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        <!-- Paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($pagina_actual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $pagina_actual - 1; ?>&q=<?php echo $busqueda; ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php if ($i == $pagina_actual) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&q=<?php echo $busqueda; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($pagina_actual < $total_paginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $pagina_actual + 1; ?>&q=<?php echo $busqueda; ?>" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Modal para agregar horario -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarLabel">Agregar Nuevo Horario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="insertar_horario.php" method="POST">
                        <div class="form-group">
                            <label for="dia">Día:</label>
                            <input type="text" class="form-control" id="dia" name="dia">
                        </div>
                        <div class="form-group">
                            <label for="ejercicio">Ejercicio:</label>
                            <input type="text" class="form-control" id="ejercicio" name="ejercicio">
                        </div>
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Inicio:</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio">
                        </div>
                        <div class="form-group">
                            <label for="hora_fin">Hora de Fin:</label>
                            <input type="time" class="form-control" id="hora_fin" name="hora_fin">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar horario -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Horario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="editar_horario.php" method="POST">
                        <div class="form-group">
                            <label for="dia_editar">Día:</label>
                            <input type="text" class="form-control" id="dia_editar" name="dia_editar">
                        </div>
                        <div class="form-group">
                            <label for="ejercicio_editar">Ejercicio:</label>
                            <input type="text" class="form-control" id="ejercicio_editar" name="ejercicio_editar">
                        </div>
                        <div class="form-group">
                            <label for="hora_inicio_editar">Hora de Inicio:</label>
                            <input type="time" class="form-control" id="hora_inicio_editar" name="hora_inicio_editar">
                        </div>
                        <div class="form-group">
                            <label for="hora_fin_editar">Hora de Fin:</label>
                            <input type="time" class="form-control" id="hora_fin_editar" name="hora_fin_editar">
                        </div>
                        <input type="hidden" name="id_editar" id="id_editar">
                        <button type="submit" class="btn btn-primary" name="editar">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript para editar el horario
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            $.get('get_horario.php', { id: id }, function(data) {
                var horario = JSON.parse(data);
                $('#id_editar').val(horario.id);
                $('#dia_editar').val(horario.dia);
                $('#ejercicio_editar').val(horario.ejercicio);
                $('#hora_inicio_editar').val(horario.hora_inicio);
                $('#hora_fin_editar').val(horario.hora_fin);
            });
        });

        // Función para filtrar los registros
        function filtrarRegistros() {
            var busqueda = document.getElementById('buscador').value.toLowerCase();
            var filas = document.querySelectorAll('#tablaHorarios tbody tr');
            filas.forEach(function(fila) {
                var texto = fila.textContent.toLowerCase();
                fila.style.display = texto.includes(busqueda) ? '' : 'none';
            });
        }
    </script>
    <!-- Mensaje sobre el cierre los domingos -->
    <div class="alert alert-info" role="alert">
           <CENTER> Los domingos estamos cerrados.
            <BR>¡Visítanos durante la semana para nuestros horarios regulares!<br></CENTER>
        </div>
</body>
</html>
