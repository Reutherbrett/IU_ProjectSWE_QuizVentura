<?php
session_start();
require_once __DIR__ . '/../../../backend/Benutzerverwaltung.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /pages/login.php"); // ggf. anpassen
    exit;
}

$user = getUserProfile($_SESSION['user_id']);
?>


<div class="page-header">
    <h2>Mein Profil</h2>
    <p>Verwalte deine persönlichen Informationen.</p>

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>
</div>

<h3 class="section-title">Profil-Einstellungen</h3>
<div class="page-section">
    <div class="page-list">

        <!-- Benutzername -->
        <div class="list-item">
            <span>Benutzername: <?= htmlspecialchars($user['Username']) ?></span>
            <button onclick="toggleForm('username-form')" class="btn btn-secondary btn-small">Bearbeiten</button>
        </div>
        <div id="username-form" style="display:none;">
            <form method="POST" action="/backend/profilUpdate.php">
                <input type="text" name="Username" required placeholder="Neuer Benutzername">
                <input type="hidden" name="action" value="update_username">
                <button type="submit">Speichern</button>
            </form>
        </div>

        <!-- E-Mail -->
        <div class="list-item">
            <span>E-Mail: <?= htmlspecialchars($user['E_Mail']) ?></span>
            <button onclick="toggleForm('email-form')" class="btn btn-secondary btn-small">Bearbeiten</button>
        </div>
        <div id="email-form" style="display:none;">
            <form method="POST" action="/backend/profilUpdate.php">
                <input type="email" name="E_Mail" required placeholder="Neue E-Mail">
                <input type="hidden" name="action" value="update_email">
                <button type="submit">Speichern</button>
            </form>
        </div>

        <!-- Passwort -->
        <div class="list-item">
            <span>Passwort: ******</span>
            <button onclick="toggleForm('password-form')" class="btn btn-secondary btn-small">Bearbeiten</button>
        </div>
        <div id="password-form" style="display:none;">
            <form method="POST" action="/backend/profilUpdate.php">
                <input type="password" name="old_password" required placeholder="Altes Passwort">
                <input type="password" name="new_password" required placeholder="Neues Passwort">
                <input type="hidden" name="action" value="update_password">
                <button type="submit">Speichern</button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleForm(id) {
    var form = document.getElementById(id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
