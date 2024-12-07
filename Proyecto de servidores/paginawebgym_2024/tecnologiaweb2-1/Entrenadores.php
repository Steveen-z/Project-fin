<?php
require_once 'conexion.php';

// Consulta para obtener los entrenadores
$query = "SELECT id, nombre, especialidad, experiencia FROM entrenadores";
$stmt = $pdo->query($query);
$entrenadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Entrenadores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         body {
            height: 100vh;
            margin: 0;
            background-image: url('imagen.png'); /* Imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .content-overlay {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
           background: rgba(0, 0, 0, 0); /* Fondo oscuro semitransparente */
            padding: 20px;
        }

        .container {
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        }

        

        .btn-primary:hover {
            background-color: #1A5276;
            border-color: #1A5276;
        }

        .bg-section {
            margin-top: 20px;
            padding: 30px;

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
    <!-- Menú de navegación -->
    <?php require_once 'menu.php'; ?>

    
    <div class="container">
        <h2 class="my-4 text-center">Lista de Entrenadores</h2>

        <!-- Tabla de entrenadores -->
        <table class="table table-bordered" id="tablaInstructores">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Experiencia (años)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entrenadores as $entrenador): ?>
                    <tr>
                        <td><?php echo $entrenador['id']; ?></td>
                        <td><?php echo $entrenador['nombre']; ?></td>
                        <td><?php echo $entrenador['especialidad']; ?></td>
                        <td><?php echo $entrenador['experiencia']; ?> años</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
