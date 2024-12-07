<?php
require_once 'conexion.php';

$query = "SELECT * FROM membresias";
$stmt = $pdo->query($query);
$membresias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Menú de navegación -->
    <?php require_once 'menu.php'; ?>

    <title>Lista de Membresías</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            background-image: url('imagen.png'); /* Imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            margin: 20px 0;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: #fff;
            padding: 20px;
            border-radius: 0 0 10px 10px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #007bff;
        }

        .btn-custom {
            display: block;
            margin: 20px auto;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center my-4">Membresías Disponibles</h2>

    <!-- Mensaje de estado -->
    <?php
    if (isset($_GET['adquirida']) && $_GET['adquirida'] === '1') {
        echo "<div class='alert alert-success text-center' role='alert'>¡Membresía adquirida con éxito!</div>";
    } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<div class='alert alert-danger text-center' role='alert'>Hubo un error al adquirir la membresía. Por favor, inténtalo de nuevo.</div>";
    }
    ?>

    <!-- Membresías -->
    <div class="row">
        <?php foreach ($membresias as $membresia): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/500x200?text=<?php echo $membresia['nombre']; ?>" class="card-img-top" alt="<?php echo $membresia['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $membresia['nombre']; ?></h5>
                        <p class="price">$<?php echo number_format($membresia['precio'], 2); ?> <small>por <?php echo $membresia['duracion']; ?> días</small></p>
                        <p class="card-text"><?php echo $membresia['descripcion']; ?></p>
                        <ul>
                            <li><strong>Accesos incluidos:</strong> <?php echo $membresia['accesos_incluidos']; ?></li>
                            <li><strong>No incluye:</strong> <?php echo $membresia['accesos_no_incluidos']; ?></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<a href="pagos.php" class="btn btn-custom">Adquirir Membresía</a>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
