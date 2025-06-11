<?php
/**
 * Secondary QuizVentura sidebar
 * Contains second level menu items
 */

// User data (usually from session or database)
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Dashboard';
?>

<!-- Secondary menu -->
<aside class="secondary-sidebar" id="secondary-sidebar">
    <!-- About content -->
    <div class="sidebar-content" id="content-about" style="display: block;">
        <div class="profile-card" data-page="pages/about/dasProjekt.php">
            <h4>Das Projekt</h4>
            <p style="font-size: 14px; margin-top: 10px;">Über das Projekt wissen</p>
        </div>
        <div class="profile-card" data-page="pages/about/dasTeam.php">
            <h4>Das Team</h4>
            <p style="font-size: 14px; margin-top: 10px;">Das Team kennenlernen</p>
        </div>
        <div class="profile-card" data-page="pages/about/tutorial.php">
            <h4>Tutorial</h4>
            <p style="font-size: 14px; margin-top: 10px;">Wie lernt man mit QuizVentura?</p>
        </div>
    </div>

    <!-- Dashboard content -->
    <div class="sidebar-content" id="content-dashboard" style="display: none;">
        <div class="profile-card" data-page="pages/dashboard/meinDashboard.php">
                <h4>Mein Dashboard</h4>
                <p style="font-size: 14px; margin-top: 10px;">Überblick über meine Aktivitäten</p>
        </div>
        <div class="profile-card" data-page="pages/dashboard/meinProfil.php">
            <h4>Profileinstellungen</h4>
            <p style="font-size: 14px; margin-top: 10px;">Persönliche Informationen bearbeiten</p>
        </div>
    </div>

    <!-- Lernen content -->
    <div class="sidebar-content" id="content-lernen" style="display: none;">
        <div class="profile-card" data-page="pages/lernen/neueKategorie.php">
            <h4>Neue Kategorie anlegen</h4>
            <p style="font-size: 14px; margin-top: 10px;">Fragen hinzufügen</p>
        </div>
        <div class="profile-card" data-page="pages/lernen/alleKategorien.php">
            <h4>Kategorie Auswählen</h4>
            <p style="font-size: 14px; margin-top: 10px;">Alle Quizze</p>
        </div>
    </div>

    <!-- Spielen content -->
    <div class="sidebar-content" id="content-spielen" style="display: none;">
        <div class="profile-card" data-page="pages/spielen/leaderboard.php">
            <h4>Leaderboard</h4>
            <p style="font-size: 14px; margin-top: 10px;">Wer führt das Ranking an?</p>
        </div>
    <div class="profile-card" data-page="pages/spielen/einzelkampf.php">
            <h4>Einzelkampf</h4>
            <p style="font-size: 14px; margin-top: 10px;">Überwinde deine eigenen Grenzen!</p>
        </div>
        <div class="profile-card" data-page="pages/spielen/teammodus.php">
            <h4>Teammodus</h4>
            <p style="font-size: 14px; margin-top: 10px;">Gemeinsam sind wir stark!</p>
        </div>
        <div class="profile-card" data-page="pages/spielen/wettkampf.php">
            <h4>Wettkampf</h4>
            <p style="font-size: 14px; margin-top: 10px;">Möge der Beste gewinnen!</p>
        </div>
    </div>

    <!-- Abmelden content -->
    <div class="sidebar-content" id="content-abmelden" style="display: none;">
        <div class="profile-card" data-page="pages/dashboard/logout.php">
            <h4>Abmelden</h4>
            <p style="font-size: 14px; margin-top: 10px;">Bis bald!</p>
        </div>
    </div>
</aside>