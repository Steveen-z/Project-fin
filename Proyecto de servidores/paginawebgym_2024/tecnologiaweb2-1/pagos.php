<?php
require 'conexion.php'; // Archivo para la conexión a la base de datos

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $membresia_id = $_POST['membresia_id'];
    $monto = $_POST['monto'];
    $metodo_pago = $_POST['metodo_pago'];

    $sql = "INSERT INTO pagos (user_id, membresia_id, monto, metodo_pago) 
            VALUES (:user_id, :membresia_id, :monto, :metodo_pago)";
    $stmt = $pdo->prepare($sql); // Usando $pdo

    try {
        $stmt->execute([
            'user_id' => $user_id,
            'membresia_id' => $membresia_id,
            'monto' => $monto,
            'metodo_pago' => $metodo_pago
        ]);
        $message = "Pago registrado con éxito.";
    } catch (PDOException $e) {
        $message = "Error al registrar el pago: " . $e->getMessage();
    }
}

// Obtener pagos existentes
$pagos = $pdo->query("SELECT pagos.id, users.username, membresias.nombre AS membresia, 
                       pagos.monto, pagos.fecha_pago, pagos.metodo_pago 
                       FROM pagos
                       JOIN users ON pagos.user_id = users.id
                       JOIN membresias ON pagos.membresia_id = membresias.id
                       ORDER BY pagos.fecha_pago DESC")->fetchAll(PDO::FETCH_ASSOC);

// Obtener usuarios y membresías para el formulario
$usuarios = $pdo->query("SELECT id, username FROM users")->fetchAll(PDO::FETCH_ASSOC);
$membresias = $pdo->query("SELECT id, nombre FROM membresias")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos del Gimnasio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
    <!-- Menú de navegación -->
  <?php require_once 'menu.php'; ?>
  
<div class="container mt-5">
    <h1 class="text-center">Gestión de Pagos</h1>
    
    <!-- Mensaje de estado -->
    <?php if (isset($message)): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    
    <!-- Formulario de registro de pagos -->
    <div class="card mb-4">
        <div class="card-header">Registrar un Pago</div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="" selected disabled>Seleccione un usuario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['id'] ?>"><?= htmlspecialchars($usuario['username']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="membresia_id" class="form-label">Membresía</label>
                    <select id="membresia_id" name="membresia_id" class="form-select" required>
                        <option value="" selected disabled>Seleccione una membresía</option>
                        <?php foreach ($membresias as $membresia): ?>
                            <option value="<?= $membresia['id'] ?>"><?= htmlspecialchars($membresia['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto</label>
                    <div class="input-group">
                        <select id="monto_predefinido" class="form-select">
                            <option value="" selected disabled>Seleccionar monto</option>
                            <option value="15.00">15</option>
                            <option value="30.00">30</option>
                            <option value="300.00">300</option>
                        </select>
                        <input type="number" step="0.01" id="monto" name="monto" class="form-control" placeholder="Ejemplo: 100.00" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                    <select id="metodo_pago" name="metodo_pago" class="form-select" required>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Pago</button>
            </form>
        </div>
    </div>

    <!-- Tabla de pagos -->
    <h2 class="text-center">Pagos Registrados</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Membresía</th>
                <th>Monto</th>
                <th>Fecha de Pago</th>
                <th>Método de Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagos as $pago): ?>
                <tr>
                    <td><?= $pago['id'] ?></td>
                    <td><?= htmlspecialchars($pago['username']) ?></td>
                    <td><?= htmlspecialchars($pago['membresia']) ?></td>
                    <td>$<?= number_format($pago['monto'], 2) ?></td>
                    <td><?= $pago['fecha_pago'] ?></td>
                    <td><?= $pago['metodo_pago'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('monto_predefinido').addEventListener('change', function() {
        const selectedValue = this.value;
        document.getElementById('monto').value = selectedValue;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

