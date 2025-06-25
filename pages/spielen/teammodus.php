<?php
/**
 * Team Mode Page - Show all quiz categories for team play
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
    <h2>Teammodus</h2>
    <p>Wähle eine Kategorie.</p>
</div>



<div class="page-grid">
    <?php foreach ($all_quizzes as $quiz): ?>
    <div class="card card-button text-center" onclick="loadPage('pages/spielen/teammodus_mitspieler_finden.php')">
        <span class="quiz-card-icon"><?php echo $quiz['icon']; ?></span>
        <span class="quiz-card-title"><?php echo htmlspecialchars($quiz['name']); ?></span>
        <span class="quiz-card-info"><?php echo $quiz['questions_count']; ?> Fragen</span>
    </div>
    <?php endforeach; ?>
</div>