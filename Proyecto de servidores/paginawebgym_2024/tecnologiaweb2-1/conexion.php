<?php
$host = 'localhost';
$db = 'tecnoweb';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
   
}
?>