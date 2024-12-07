<!DOCTYPE html>
<html lang="es">
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Registro</h2> <!-- Se corrigió el título -->
                <form action="registrar_usuario.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label> <!-- Se corrigió la etiqueta -->
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Registrar</button>
                </form>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="index.php">Iniciar sesión</a>
        </div>
    </div>
</body>
</html>
