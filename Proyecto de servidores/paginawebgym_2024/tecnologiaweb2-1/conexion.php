<?php
$host = getenv('DB_HOST');     // Usar la variable de entorno para el host
$port = getenv('DB_PORT');     // Usar la variable de entorno para el puerto
$dbname = getenv('DB_NAME');   // Usar la variable de entorno para el nombre de la base de datos
$username = getenv('DB_USER'); // Usar la variable de entorno para el usuario
$password = getenv('DB_PASSWORD'); // Usar la variable de entorno para la contraseña

try {
    // DSN para la conexión PDO
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
    
    // Crear una instancia PDO
    $pdo = new PDO($dsn, $username, $password);
    
    // Establecer el modo de error a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Si ocurre un error, mostrarlo
    echo "Error de conexión: " . $e->getMessage();
}
?>
