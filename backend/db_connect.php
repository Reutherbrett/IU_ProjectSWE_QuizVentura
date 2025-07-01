<?php
// Server Datenbankverbindung mit PDO

<<<<<<< HEAD
$host = 'localhost';               // Via UNIX socket
$db   = 'swe_quizventura';             // Your database name
$user = 'swe_jjlp';                // Your MariaDB username
$pass = '2gw%J3m65';           // Your MariaDB password
=======
$host = 'localhost';      // Datenbank-Host
$db   = 'swe_quizventura';    // Name der Datenbank
$user = 'root';           // Datenbank-Benutzername
$pass = '';               // Datenbank-Passwort
>>>>>>> d2bda15 (fix(db_connect.php): db name fixed)
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