<?php
/**
 * Leaderboard Page - Top Quiz Winners
 */

// Sample leaderboard data (replace with database query later)
$leaderboard = [
    ['rank' => 1, 'username' => 'MaxMustermann', 'category' => 'Geschichte-Quiz', 'date' => '2025-06-15', 'score' => 98],
    ['rank' => 2, 'username' => 'AnnaSchmidt', 'category' => 'Mathematik-Quiz', 'date' => '2025-06-14', 'score' => 97],
    ['rank' => 3, 'username' => 'TomMüller', 'category' => 'Wissenschafts-Quiz', 'date' => '2025-06-14', 'score' => 96],
    ['rank' => 4, 'username' => 'LauraKraus', 'category' => 'Geografie-Quiz', 'date' => '2025-06-13', 'score' => 95],
    ['rank' => 5, 'username' => 'PeterHans', 'category' => 'Deutsch-Quiz', 'date' => '2025-06-13', 'score' => 94],
    ['rank' => 6, 'username' => 'SarahLang', 'category' => 'Kunst-Quiz', 'date' => '2025-06-12', 'score' => 93],
    ['rank' => 7, 'username' => 'MikeWeber', 'category' => 'Musik-Quiz', 'date' => '2025-06-12', 'score' => 92],
    ['rank' => 8, 'username' => 'EvaFischer', 'category' => 'Sport-Quiz', 'date' => '2025-06-11', 'score' => 91],
    ['rank' => 9, 'username' => 'JanKnox', 'category' => 'Geschichte-Quiz', 'date' => '2025-06-11', 'score' => 90],
    ['rank' => 10, 'username' => 'LisaFrank', 'category' => 'Biologie-Quiz', 'date' => '2025-06-10', 'score' => 89],
    ['rank' => 11, 'username' => 'DavidGreen', 'category' => 'Physik-Quiz', 'date' => '2025-06-10', 'score' => 88],
    ['rank' => 12, 'username' => 'NinaBlau', 'category' => 'Chemie-Quiz', 'date' => '2025-06-09', 'score' => 87],
    ['rank' => 13, 'username' => 'LukasGold', 'category' => 'Informatik-Quiz', 'date' => '2025-06-09', 'score' => 86],
    ['rank' => 14, 'username' => 'MariaRot', 'category' => 'Philosophie-Quiz', 'date' => '2025-06-08', 'score' => 85],
    ['rank' => 15, 'username' => 'FelixSilber', 'category' => 'Psychologie-Quiz', 'date' => '2025-06-08', 'score' => 84]
];

// Function to get trophy emoji based on rank
function getTrophyIcon($rank) {
    switch($rank) {
        case 1: return '🥇';
        case 2: return '🥈';
        case 3: return '🥉';
        default: return '🏆';
    }
}

// Function to get score color class
function getScoreClass($score) {
    if ($score >= 95) return 'score-excellent';
    if ($score >= 90) return 'score-great';
    if ($score >= 85) return 'score-good';
    return 'score-normal';
}

// Function to format date
function formatDate($date) {
    return date('d.m.Y', strtotime($date));
}
?>

<div class="page-header">
    <h2>Leaderboard</h2>
    <p>Die Champions von QuizVentura.</p>
</div>

<!-- Top 3 Winners Highlight -->
<h3>Top 3 Champions</h3>
<div class="page-grid top-winners">
    <?php for($i = 0; $i < 3; $i++): $winner = $leaderboard[$i]; ?>
        <div class="card card-vertical text-center champion-card rank-<?php echo $winner['rank']; ?>">
            <div class="champion-trophy">
                <?php echo getTrophyIcon($winner['rank']); ?>
            </div>
            <h4 class="champion-name"><?php echo htmlspecialchars($winner['username']); ?></h4>
            <p class="champion-category"><?php echo htmlspecialchars($winner['category']); ?></p>
            <div class="champion-score <?php echo getScoreClass($winner['score']); ?>">
                <?php echo $winner['score']; ?>%
            </div>
            <p class="champion-date"><?php echo formatDate($winner['date']); ?></p>
        </div>
    <?php endfor; ?>
</div>

<!-- Complete Leaderboard -->
<h3>Vollständige Rangliste</h3>
<div class="page-section">
<div class="leaderboard-container">
    <div class="leaderboard-header">
        <div class="rank-col">Rang</div>
        <div class="player-col">Spieler</div>
        <div class="category-col">Kategorie</div>
        <div class="score-col">Punkte</div>
    </div>
    
    <?php foreach($leaderboard as $entry): ?>
        <div class="leaderboard-row <?php echo $entry['rank'] <= 3 ? 'top-three' : ''; ?>">
            <div class="rank-col">
                <span class="rank-number"><?php echo $entry['rank']; ?></span>
                <span class="rank-trophy"><?php echo getTrophyIcon($entry['rank']); ?></span>
            </div>
            <div class="player-col">
                <strong><?php echo htmlspecialchars($entry['username']); ?></strong>
            </div>
            <div class="category-col">
                <span class="category-badge"><?php echo htmlspecialchars($entry['category']); ?></span>
            </div>
            <div class="score-col">
                <span class="score-value <?php echo getScoreClass($entry['score']); ?>">
                    <?php echo $entry['score']; ?>%
                </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>

<!-- Statistics Cards -->
<h3>Leaderboard-Statistiken</h3>
<div class="page-grid">
    <div class="card card-display card-vertical text-center">
        <h4>Durchschnitt Top 5</h4>
        <div class="stat-number">
            <?php 
            $top5Avg = array_sum(array_slice(array_column($leaderboard, 'score'), 0, 5)) / 5;
            echo round($top5Avg, 1); 
            ?>%
        </div>
        <p class="text-secondary">Durchschnittliche Punktzahl der Top 5 Spieler</p>
    </div>
    
    <div class="card card-display card-vertical text-center">
        <h4>Aktivste Kategorie</h4>
        <div class="stat-number">Geschichte</div>
        <p class="text-secondary">Meistgespielte Kategorie in der Rangliste</p>
    </div>
    
    <div class="card card-display card-vertical text-center">
        <h4>Höchste Punktzahl</h4>
        <div class="stat-number"><?php echo $leaderboard[0]['score']; ?>%</div>
        <p class="text-secondary">Bestes Ergebnis aller Zeiten</p>
    </div>
</div>