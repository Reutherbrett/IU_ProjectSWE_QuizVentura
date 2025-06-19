<?php
/**
 * QuizVentura main page
 */

$page_title = "QuizVentura";

// Only include the simple navigation script
$additional_scripts = [
    'assets/js/simple-nav.js'
];
?>

<?php include 'includes/header.php'; ?>

<div class="app-container">
    <?php include 'includes/menu.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content">
        <!-- Default content will be loaded by JavaScript -->
    </main>
</div>

<?php include 'includes/footer.php'; ?>