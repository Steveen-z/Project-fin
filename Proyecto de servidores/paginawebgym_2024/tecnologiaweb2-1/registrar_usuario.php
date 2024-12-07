<?php
require_once 'conexion.php';
session_start();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Verifica si el usuario ya existe
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query); // Cambiar $conn a $pdo
        $stmt->execute(array(':username' => $username));
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if($existingUser) {
            echo "<script>alert('El usuario ya existe');</script>";
            echo "<script>window.location='registrar.php';</script>";
            exit;
        } else {
            // Inserta el nuevo usuario
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery= "INSERT INTO users (username, password)  values (:username, :password)";
            $insertStmt= $pdo->prepare($insertQuery); // Cambiar $conn a $pdo
            $insertStmt->execute(array(':username' => $username, ':password' => $hashedpassword));

            echo "<script>alert('Usuario registrado exitosamente');</script>";
            echo "<script>window.location='index.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Muestra cualquier error de PDO
    }
}
?>

