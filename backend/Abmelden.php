<?php
require_once 'Benutzerverwaltung.php';

// Call logout function
$result = logoutUser();

// Get the correct path to index.php
$indexPath = str_replace('/backend/Abmelden.php', '/index.php', $_SERVER['REQUEST_URI']);

// Redirect to login page
header('Location: ' . $indexPath . '?logout=success');
exit();
?>