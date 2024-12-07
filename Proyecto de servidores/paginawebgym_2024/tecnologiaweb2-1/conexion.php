$host = getenv('MYSQLHOST');        // Dirección del host de la base de datos (por ejemplo, autorack.proxy.rlwy.net)
$port = getenv('MYSQLPORT');        // Puerto de la base de datos (por ejemplo, 43309)
$username = getenv('MYSQLUSER');    // Usuario de la base de datos (por ejemplo, root)
$password = getenv('MYSQLPASSWORD'); // Contraseña del usuario de la base de datos
$dbname = getenv('MYSQLDATABASE');  // Nombre de la base de datos (por ejemplo, railway)

try {
    // Establecer la conexión a la base de datos utilizando las variables de entorno
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
