<?php
// Datenbankverbindung mit PDO herstellen

$host = 'localhost';      // Datenbank-Host
$db   = 'quizventura';    // Name der Datenbank
$user = 'root';           // Datenbank-Benutzername
$pass = '';               // Datenbank-Passwort
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Verbindung fehlgeschlagen: ' . $e->getMessage());
}
?>