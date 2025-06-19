<?php
/**
 * QuizVentura main page
 */

$page_title = "QuizVentura";

// Only include the simple navigation script
$additional_scripts = [
    'assets/js/simple-nav.js'  // Your new simple file
];
?>

<?php include 'includes/header.php'; ?>

<!-- Mobile Header -->
<header class="mobile-header">
    <span>QuizVentura</span>
    <button class="menu-toggle">☰</button>
</header>

<!-- Menu Backdrop -->
<div class="menu-backdrop"></div>

<div class="app-container">
    <?php include 'includes/menu.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content">
        <!-- Default content will be loaded by JavaScript -->
    </main>
</div>

<?php include 'includes/footer.php'; ?>