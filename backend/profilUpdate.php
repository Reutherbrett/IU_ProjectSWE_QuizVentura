<?php
session_start();
require_once __DIR__ . '/Benutzerverwaltung.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /pages/login.php"); // ggf. korrigieren
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $result = ['success' => false, 'message' => 'Unbekannte Aktion'];

    if ($action === 'update_username') {
        $username = trim($_POST['Username']);
        $result = updateUserProfile($userId, ['Username' => $username]);
    } elseif ($action === 'update_email') {
        $email = trim($_POST['E_Mail']);
        $result = updateUserProfile($userId, ['E_Mail' => $email]);
    } elseif ($action === 'update_password') {
        $old = $_POST['old_password'];
        $new = $_POST['new_password'];
        $result = updateUserPassword($userId, $old, $new);
    }

    if ($result['success']) {
        header("Location: meinProfil.php?success=" . urlencode($result['message']));
    } else {
        header("Location: meinProfil.php?error=" . urlencode($result['message']));
    }
    exit;
}
?>
