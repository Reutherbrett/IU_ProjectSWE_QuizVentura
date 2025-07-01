<?php
// Server Datenbankverbindung mit PDO

$host = 'localhost';               // Via UNIX socket
$db   = 'swe_quizventura';    // Name der Datenbank
$user = 'swe_jllp';                // MariaDB username
$pass = '2gw%J3m65';           // MariaDB password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_PERSISTENT         => false,  // Good for shared hosting
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Log error instead of displaying in production
    error_log('Database connection failed: ' . $e->getMessage());
    die('Verbindung zur Datenbank fehlgeschlagen.');
}
?>