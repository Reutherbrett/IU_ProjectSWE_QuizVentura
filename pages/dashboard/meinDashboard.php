<?php
/**
 * Dashboard Page content
 */

// Example data for the quizzes (usually from the database)
$favorite_quizzes = [
    ['id' => 1, 'name' => 'Quiz de História', 'icon' => '⭐'],
    ['id' => 2, 'name' => 'Quiz de Geografia', 'icon' => '⭐'],
    ['id' => 3, 'name' => 'Quiz de Ciências', 'icon' => '⭐']
];

$top_scores = [
    ['name' => 'Quiz de Matemática', 'score' => '98%'],
    ['name' => 'Quiz de Português', 'score' => '95%'],
    ['name' => 'Quiz de História', 'score' => '92%'],
    ['name' => 'Quiz de Geografia', 'score' => '89%'],
    ['name' => 'Quiz de Ciências', 'score' => '87%']
];
?>

<div class="page-header">
    <h2>Dashboard</h2>
    <p>Continue de onde você parou</p>
</div>

<div class="page-grid">
    <div class="card">
        <span style="font-size: 18px; color: #666;">Cartão 1</span>
    </div>
    <div class="card">
        <span style="font-size: 18px; color: #666;">Cartão 2</span>
    </div>
</div>

<h3 style="margin-bottom: 20px;">Quizzes Favoritos</h3>
<div class="page-grid">
    <?php foreach ($favorite_quizzes as $quiz): ?>
        <div class="card">
            <span style="font-size: 24px;"><?php echo $quiz['icon']; ?></span>
        </div>
    <?php endforeach; ?>
</div>

<div class="quiz-list">
    <h3 style="margin-bottom: 20px;">Suas melhores pontuações</h3>
    <?php foreach ($top_scores as $index => $score): ?>
        <div class="quiz-item">
            <span><?php echo ($index + 1) . '. ' . htmlspecialchars($score['name']); ?></span>
            <span><?php echo htmlspecialchars($score['score']); ?></span>
        </div>
    <?php endforeach; ?>
</div>