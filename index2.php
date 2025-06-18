<?php
/**
 * QuizVentura Dashboard main page
 * File that gathers all the components
 */

// Start session if needed
// session_start();

// Define variables for the header
$page_title = "QuizVentura Dashboard";

// Additional scripts (if needed)
$additional_scripts = [
    // 'assets/js/dashboard.js'
];
?>

<?php include 'includes/header.php'; ?>

<div class="app-container">
    <?php include 'includes/menu.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <!-- Add main content wrapper -->
    <main class="main-content" id="main-content">
        <?php 
        // Load default page or requested page
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard/meinDashboard';
        include "pages/{$page}.php"; 
        ?>
    </main>
</div>

<?php include 'includes/footer.php'; ?>