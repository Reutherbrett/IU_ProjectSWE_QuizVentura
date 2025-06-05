<?php
/**
 * QuizVentura Header
 * Includes meta tags, title and links to CSS/JS
 */
?>
<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'QuizVentura'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- API for custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Mobile Header -->
    <header class="mobile-header">
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <h1>QuizVentura</h1>
        <div style="width: 40px;"></div>
    </header>

    <!-- Menu Backdrop -->
    <div class="menu-backdrop" onclick="toggleMenu()"></div>