<?php
// Obtener la URL completa de la base de datos desde la variable de entorno
$dsn = getenv('MYSQL_URL');  // Ejemplo: mysql://root:password@hostname:port/database

try {
    // Crear la conexión PDO utilizando la URL completa de la base de datos
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa a la base de datos.";  // Puedes dejar este echo para depuración
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;  // Detenemos la ejecución si no se puede conectar
}
?>

