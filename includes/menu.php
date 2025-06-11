<?php
/**
 * QuizVentura Main Menu
 * (the main menu is named: sidebar)
 */

// Array with menu items
$menu_items = [
    ['label' => 'Über QuizVentura', 'url' => 'pages/about/dasProjekt.php', 'color' => '#FF5252', 'content' => 'about'],
    ['label' => 'Dashboard', 'url' => 'pages/dashboard/meinDashboard.php', 'color' => '#F26419', 'content' => 'dashboard'],
    ['label' => 'Lernen', 'url' => 'pages/lernen/alleKategorien.php', 'color' => '#00BCD4', 'content' => 'lernen'],
    ['label' => 'Spielen', 'url' => 'pages/spielen/leaderboard.php', 'color' => '#6200EA', 'content' => 'spielen'],
    ['label' => 'Abmelden', 'url' => 'abmelden.php', 'color' => '#FF5252', 'content' => 'abmelden']
];
?>

<!-- Main Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h1>QuizVentura</h1>
    </div>
    <nav>
        <ul class="nav-menu">
            <?php foreach ($menu_items as $item): ?>
                <li class="nav-item" 
                    data-color="<?php echo $item['color']; ?>" 
                    data-content="<?php echo $item['content']; ?>">
                    <?php echo $item['label']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</aside>