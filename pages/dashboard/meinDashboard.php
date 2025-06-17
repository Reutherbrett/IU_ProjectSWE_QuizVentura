<?php
/**
 * Dashboard Page content
 */

// Example data for the quizzes (usually from the database)
$favorite_quizzes = [
    ['id' => 1, 'name' => 'Geschichte-Quiz', 'icon' => '📚'],
    ['id' => 2, 'name' => 'Geografie-Quiz', 'icon' => '🌍'],
    ['id' => 3, 'name' => 'Wissenschafts-Quiz', 'icon' => '🔬']
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
    <p>Setzen Sie fort, wo Sie aufgehört haben</p>
</div>

<h3 class="section-title">Lieblings-Quizzes</h3>
<div class="page-grid">
    <?php foreach ($favorite_quizzes as $quiz): ?>
        <div class="card text-center">
            <span style="font-size: 48px;"><?php echo $quiz['icon']; ?></span>
            <h4 class="mt-10"><?php echo htmlspecialchars($quiz['name']); ?></h4>
        </div>
    <?php endforeach; ?>
</div>

<div class="page-list">
    <h3 class="section-title">Ihre besten Ergebnisse</h3>
    <?php foreach ($top_scores as $index => $score): ?>
        <div class="list-item">
            <span><?php echo ($index + 1) . '. ' . htmlspecialchars($score['name']); ?></span>
            <span class="text-primary"><?php echo htmlspecialchars($score['score']); ?></span>
        </div>
    <?php endforeach; ?>
</div>