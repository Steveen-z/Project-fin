<?php
echo "Bienvenido a Gym Salud y Vida";
require_once 'conexion.php';
session_start(); // Iniciar sesión

function login($username, $password, $pdo) {
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':username' => $username));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verificar la contraseña usando password_verify para la seguridad
        if (password_verify($password, $user['password'])) {
            return $user; // Retornar los datos del usuario si el login es exitoso
        }
    }
    return false; // Si no se encuentra el usuario o la contraseña no coincide
}

if (isset($_POST['login'])) {
    // Limpiar y validar los datos de entrada
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<script>alert('Por favor, ingrese usuario y contraseña');</script>";
    } else {
        // Intentar el inicio de sesión
        $user = login($username, $password, $pdo);

        if ($user) {
            $_SESSION['user'] = $user['username']; // Guardar el nombre del usuario en la sesión
            header("Location: principal.php"); // Redirigir a la página principal
            exit; // Detener la ejecución para evitar que el código posterior se ejecute
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para la imagen de fondo */
        body {
            height: 100vh;
            background-image: url('imagen.png'); /* Coloca la ruta de tu imagen aquí */
            background-size: cover; /* Asegura que la imagen cubra toda la pantalla */
            background-position: center; /* Centra la imagen en la página */
            background-attachment: fixed; /* Hace que la imagen no se desplace con el scroll */
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333; /* Cambiar color de texto para que sea legible sobre la imagen */
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco con opacidad */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 login-container">
                <h2 class="text-center mb-4">Iniciar sesión</h2>
                 <img src="login.png" width="400" height="200">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
                <div class="text-center mt-3">
                    <a href="registrar.php" style="color: #333;">¿No tienes cuenta? Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
