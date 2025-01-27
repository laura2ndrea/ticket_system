<?php
// /database/connection.php
$host = 'localhost';
$port = '5432'; // Puerto por defecto de PostgreSQL
$dbname = 'ticket_system';
$user = 'postgres';
$password = 'root';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
}
?>
