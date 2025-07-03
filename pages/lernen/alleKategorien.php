<?php
/**
 * All Categories Page - Show all quiz categories
 */

// Sample data for quizzes (replace with database queries later)
require_once '../../backend/Kategorieverwaltung.php';

// Get categories from database
$all_categories = getCategories();

$favorite_quizzes = [
    ['id' => 1, 'name' => 'Geschichte', 'icon' => '📚', 'questions_count' => 15],
    ['id' => 2, 'name' => 'Erdkunde', 'icon' => '🌍', 'questions_count' => 20],
    ['id' => 3, 'name' => 'Naturwissenschaften', 'icon' => '🔬', 'questions_count' => 12]
];

?>

<div class="page-header">
    <h2>Alle Kategorien</h2>
    <p>Entdeck alle verfügbaren Quizzes.</p>
</div>

<!-- Favorite Quizzes Section -->
<h3>Deine Lieblings-Quizzes</h3>
<div class="page-grid">
    <?php foreach ($favorite_quizzes as $quiz): ?>
    <div class="card card-button text-center" onclick="loadPage('pages/lernen/kategorieAnsicht.php')">
        <span class="quiz-card-icon"><?php echo $quiz['icon']; ?></span>
        <span class="quiz-card-title"><?php echo htmlspecialchars($quiz['name']); ?></span>
        <span class="quiz-card-info"><?php echo $quiz['questions_count']; ?> Fragen</span>
    </div>
    <?php endforeach; ?>
</div>

<!-- All Quizzes Section -->
<h3>Alle Quizzes</h3>
<div class="page-grid">
    <?php foreach ($all_categories as $category): ?>
<div class="card card-button text-center" onclick="loadPage('pages/lernen/kategorieAnsicht.php?id=<?php echo $category['Kategorie_ID']; ?>')">
    <span class="quiz-card-icon"><?php echo htmlspecialchars($category['Emoji'] ?? '📚'); ?></span>
    <span class="quiz-card-title"><?php echo htmlspecialchars($category['Kategorie']); ?></span>
    <span class="quiz-card-info"><?php echo $category['QuestionsNumber']; ?> Fragen</span>
</div>
<?php endforeach; ?>
</div>

<!-- Add New Category Button -->
<div class="text-center mt-40">
    <button onclick="window.location.href='neueKategorie.php'" class="btn btn-primary">
        Neue Kategorie erstellen
    </button>
</div>