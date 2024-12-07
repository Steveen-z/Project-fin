<?php
$host = getenv('MYSQLHOST');  // mysql-uuw9.railway.internal
$port = getenv('MYSQLPORT');  // 3306
$username = getenv('MYSQLUSER');  // root
$password = getenv('MYSQLPASSWORD');  // BKEbKFpnpRgvQYZEiWZgNZXWbWTYDRPP
$dbname = getenv('MYSQLDATABASE');  // railway

try {
    // Establece la conexión a la base de datos usando las variables de entorno
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa a la base de datos.";  // Puedes dejar este echo para depuración
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;  // Detenemos la ejecución si no se puede conectar
}
?>
