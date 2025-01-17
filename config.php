<?php
$host = 'localhost';
$dbname = 'clientes';
$username = 'root';
$password = '';
$port = 3307;

try {
    // Agrega el puerto directamente en la cadena DSN
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
    exit();
}
?>
