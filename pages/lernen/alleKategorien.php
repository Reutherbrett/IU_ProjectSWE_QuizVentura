<?php
/**
 * All Categories Page - Show all quiz categories
 */

// Sample data for quizzes (replace with database queries later)
$favorite_quizzes = [
    ['id' => 1, 'name' => 'Geschichte', 'icon' => '📚', 'questions_count' => 15],
    ['id' => 2, 'name' => 'Erdkunde', 'icon' => '🌍', 'questions_count' => 20],
    ['id' => 3, 'name' => 'Naturwissenschaften', 'icon' => '🔬', 'questions_count' => 12]
];

$all_quizzes = [
    ['id' => 1, 'name' => 'Geschichte', 'icon' => '📚', 'questions_count' => 15],
    ['id' => 2, 'name' => 'Erdkunde', 'icon' => '🌍', 'questions_count' => 20],
    ['id' => 3, 'name' => 'Naturwissenschaften', 'icon' => '🔬', 'questions_count' => 12],
    ['id' => 4, 'name' => 'Mathematik', 'icon' => '➕', 'questions_count' => 25],
    ['id' => 5, 'name' => 'Portugiesisch', 'icon' => '📖', 'questions_count' => 18],
    ['id' => 6, 'name' => 'Kunst', 'icon' => '🎨', 'questions_count' => 10],
    ['id' => 7, 'name' => 'Musik', 'icon' => '🎵', 'questions_count' => 22],
    ['id' => 8, 'name' => 'Sport', 'icon' => '⚽', 'questions_count' => 16]
];
?>

<div class="page-header">
    <h2>Alle Kategorien</h2>
    <p>Entdeck alle verfügbaren Quizzes!</p>
</div>

<!-- Favorite Quizzes Section -->
<h3 style="margin-bottom: 20px; color: var(--primary-color);">⭐ Deine Lieblings-Quizzes</h3>
<div class="page-grid">
    <?php foreach ($favorite_quizzes as $quiz): ?>
        <div class="card" onclick="window.location.href='aktiveKategorie.php?id=<?php echo $quiz['id']; ?>'" style="cursor: pointer;">
            <div class="card-vertical" style="text-align: center;">
                <span style="font-size: 48px; margin-bottom: 15px;"><?php echo $quiz['icon']; ?></span>
                <h4 style="margin-bottom: 10px; color: var(--text-secondary);"><?php echo htmlspecialchars($quiz['name']); ?></h4>
                <div style="display: flex; justify-content: space-between; width: 100%; margin-top: 10px; font-size: 14px; color: #666;">
                    <span><?php echo $quiz['questions_count']; ?> Fragen</span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- All Quizzes Section -->
<h3 style="margin: 40px 0 20px 0; color: var(--text-secondary);">📋 Alle Quizzes</h3>
<div class="page-grid">
    <?php foreach ($all_quizzes as $quiz): ?>
        <div class="card" onclick="window.location.href='aktiveKategorie.php?id=<?php echo $quiz['id']; ?>'" style="cursor: pointer;">
            <div class="card-vertical" style="text-align: center;">
                <span style="font-size: 48px; margin-bottom: 15px;"><?php echo $quiz['icon']; ?></span>
                <h4 style="margin-bottom: 10px; color: var(--text-secondary);"><?php echo htmlspecialchars($quiz['name']); ?></h4>
                <div style="display: flex; justify-content: space-between; width: 100%; margin-top: 10px; font-size: 14px; color: #666;">
                    <span><?php echo $quiz['questions_count']; ?> Fragen</span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Add New Category Button -->
<div style="margin-top: 40px; text-align: center;">
    <button onclick="window.location.href='neueKategorie.php'" 
            style="background-color: var(--primary-color); 
                   color: white; 
                   border: none; 
                   padding: 15px 30px; 
                   border-radius: 8px; 
                   font-size: 16px; 
                   font-weight: 600; 
                   cursor: pointer; 
                   transition: background-color 0.2s;">
        ➕ Neue Kategorie erstellen
    </button>
</div>

<style>
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

button:hover {
    background-color: var(--primary-hover) !important;
}
</style>