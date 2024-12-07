<?php
$host = getenv('MYSQLHOST');  // Asegúrate de que esta variable de entorno esté bien configurada
$port = getenv('MYSQLPORT');  // Asegúrate de que esta variable de entorno esté bien configurada
$username = getenv('MYSQLUSER');  // Asegúrate de que esta variable de entorno esté bien configurada
$password = getenv('MYSQLPASSWORD');  // Asegúrate de que esta variable de entorno esté bien configurada
$dbname = getenv('MYSQLDATABASE');  // Asegúrate de que esta variable de entorno esté bien configurada

try {
    // Intenta conectar con la base de datos usando las variables de entorno
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa a la base de datos.";  // Puedes dejar este echo para depuración
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;  // Detenemos la ejecución si no se puede conectar
}
?>

