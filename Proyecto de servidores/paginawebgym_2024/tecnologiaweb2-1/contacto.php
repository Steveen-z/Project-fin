<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
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

        .location {
            margin-top: 30px;
            padding: 20px;
            background: rgba(44, 62, 80, 0.8);
            border-radius: 8px;
        }

        .location h3 {
            font-size: 1.5rem;
            color: #fff;
        }

        .location p {
            color: #ccc;
        }

        .contact-info {
            margin-top: 20px;
            padding: 20px;
            background: rgba(44, 62, 80, 0.8);
            border-radius: 8px;
            color: #fff;
        }

        .contact-info h4 {
            font-size: 1.2rem;
        }

        .contact-info p {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <!-- Menú de navegación -->
  <?php require_once 'menu.php'; ?>
  
<div class="container mt-5">
    <h2 class="text-center">CONTACTOS</h2>

    <!-- Mostrar el mensaje de éxito o error -->
    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Dirección y Ubicación -->
    <div class="location">
        <h3>Dirección</h3>
        <p>Boulevard de Los Héroes, Prolongación de Avenida Los Andes y Boulevard Tutunichapa - San Salvador San Salvador, SS - 1101</p>
        <h3>Ubicación</h3>
        <p>Latitud: 12.345678, Longitud: -98.765432</p>
    </div>

    

    <!-- Información de contacto -->
    <div class="contact-info">
        <h4>Información de Contacto</h4>
        <p><strong>Teléfono:</strong> 503 456 7890</p>
        <p><strong>Correo Electrónico:</strong> contacto@ejemplo.com</p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
