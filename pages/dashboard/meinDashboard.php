<?php
/**
 * Dashboard Page content
 */

// Example data for the quizzes (usually from the database)
$favorite_quizzes = [
    ['id' => 1, 'name' => 'Geschichte-Quiz', 'icon' => '📚', 'questions_count' => 15],
    ['id' => 2, 'name' => 'Geografie-Quiz', 'icon' => '🌍', 'questions_count' => 10],
    ['id' => 3, 'name' => 'Wissenschafts-Quiz', 'icon' => '🔬', 'questions_count' => 12]
];

$top_scores = [
    ['name' => 'Mathematik-Quiz', 'score' => '98%'],
    ['name' => 'Deutsch-Quiz', 'score' => '95%'],
    ['name' => 'Geschichte-Quiz', 'score' => '92%'],
    ['name' => 'Geografie-Quiz', 'score' => '89%'],
    ['name' => 'Wissenschafts-Quiz', 'score' => '87%']
];
?>

<div class="page-header">
    <h2>Dashboard</h2>
    <p>Setze fort, wo du aufgehört hast.</p>
</div>

<h3>Lieblings-Quizzes</h3>
<div class="page-grid">
    <?php foreach ($favorite_quizzes as $quiz): ?>
    <div class="card card-button text-center" onclick="handleClick()">
        <span class="quiz-card-icon"><?php echo $quiz['icon']; ?></span>
        <span class="quiz-card-title"><?php echo htmlspecialchars($quiz['name']); ?></span>
        <span class="quiz-card-info"><?php echo $quiz['questions_count']; ?> Fragen</span>
    </div>
    <?php endforeach; ?>
</div>

<h3>Deine besten Ergebnisse</h3>
<div class="page-section">
<div class="page-list">
    <?php foreach ($top_scores as $index => $score): ?>
        <div class="list-item">
            <span><?php echo ($index + 1) . '. ' . htmlspecialchars($score['name']); ?></span>
            <span class="text-primary"><?php echo htmlspecialchars($score['score']); ?></span>
        </div>
    <?php endforeach; ?>
</div>
</div>