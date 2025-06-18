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
    ['name' => 'Mathematik-Quiz', 'score' => 98],
    ['name' => 'Deutsch-Quiz', 'score' => 95],
    ['name' => 'Geschichte-Quiz', 'score' => 92],
    ['name' => 'Geografie-Quiz', 'score' => 89],
    ['name' => 'Wissenschafts-Quiz', 'score' => 87]
];

// Helper functions for styling (same as leaderboard)
function getTrophyIcon($rank) {
    switch($rank) {
        case 1: return '🥇';
        case 2: return '🥈';
        case 3: return '🥉';
        default: return '🏆';
    }
}

function getScoreClass($score) {
    if ($score >= 95) return 'score-excellent';
    if ($score >= 90) return 'score-great';
    if ($score >= 85) return 'score-good';
    return 'score-normal';
}
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
<div class="leaderboard-container dashboard-leaderboard">
    <div class="leaderboard-header">
        <div class="rank-col">Rang</div>
        <div class="category-col">Quiz-Kategorie</div>
        <div class="score-col">Punkte</div>
    </div>
    
    <?php foreach($top_scores as $index => $score): 
        $rank = $index + 1;
    ?>
        <div class="leaderboard-row <?php echo $rank <= 3 ? 'top-three' : ''; ?>">
            <div class="rank-col">
                <span class="rank-number"><?php echo $rank; ?></span>
                <span class="rank-trophy"><?php echo getTrophyIcon($rank); ?></span>
            </div>
            <div class="category-col">
                <span class="category-badge"><?php echo htmlspecialchars($score['name']); ?></span>
            </div>
            <div class="score-col">
                <span class="score-value <?php echo getScoreClass($score['score']); ?>">
                    <?php echo $score['score']; ?>%
                </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>

<style>
    .leaderboard-header,
    .leaderboard-row {
    grid-template-columns: 80px 2fr 120px; /* Changed from 80px 1fr 1fr 100px */
    gap: 15px;
}
</style>