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
    <p>Die Champions von QuizVentura</p>
</div>

<!-- Top 3 Winners Highlight -->
<h3 class="section-title">Top 3 Champions</h3>
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

<style>
/* Leaderboard specific styles */
.top-winners {
    margin-bottom: 40px;
}

.champion-card {
    position: relative;
    min-height: 200px;
}

.champion-card.rank-1 {
    /* border: 3px solid var(--primary-color); */
}

.champion-card.rank-2 {
    /* border: 3px solid var(--primary-color); */
}

.champion-card.rank-3 {
    /* border: 3px solid var(--primary-color); */
}

.champion-trophy {
    font-size: 60px;
    margin-bottom: 15px;
}

.champion-name {
    font-size: 20px;
    margin-bottom: 8px;
    color: var(--primary-color);
}

.champion-category {
    font-size: 14px;
    color: var(--text-muted);
    margin-bottom: 15px;
}

.champion-score {
    font-size: 18px;
    font-weight: 550;
    margin-bottom: 10px;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-block;
}

.champion-date {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 0;
}

/* Leaderboard table styles */
.leaderboard-container {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    margin-bottom: 30px;
}

.leaderboard-header {
    display: grid;
    grid-template-columns: 80px 1fr 1fr 100px;
    gap: 15px;
    padding: 20px;
    background: var(--primary-color);
    color: var(--text-primary);
    font-weight: 550;
}

.leaderboard-row {
    display: grid;
    grid-template-columns: 80px 1fr 1fr 100px;
    gap: 15px;
    padding: 15px 20px;
    border-bottom: 1px solid var(--border-color);
    transition: background-color var(--transition-fast);
    align-items: center;
}

.leaderboard-row:hover {
    /* background-color: #f8f9fa; */
}

.leaderboard-row:last-child {
    border-bottom: none;
}

.leaderboard-row.top-three {
    /* background: linear-gradient(90deg, rgba(242, 100, 25, 0.05) 0%, rgba(242, 100, 25, 0.02) 100%); */
}

.rank-col {
    display: flex;
    align-items: center;
    gap: 8px;
}

.rank-number {
    font-weight: 550;
    font-size: 16px;
    min-width: 20px;
}

.rank-trophy {
    font-size: 20px;
}

.category-badge {
    padding: 4px 8px;
    border-radius: 12px;
}

.score-value {
    font-weight: 550;
    padding: 4px 8px;
    border-radius: 8px;
    font-size: 16px;
}

/* Score color classes */
.score-excellent {
    background: rgba(0, 188, 212, 0.15); /* Moonstone with transparency */
    color: #006064; /* Darker Moonstone */
}

.score-great {
    background: rgba(98, 0, 234, 0.15); /* Electric Indigo with transparency */
    color: #4527A0; /* Darker Electric Indigo */
}

.score-good {
    background: rgba(242, 100, 25, 0.12); /* Orange (Pantone) with transparency */
    color: #D14F0F; /* Darker Orange (Pantone) */
}

.score-normal {
    background: rgba(255, 82, 82, 0.15); /* Bittersweet with transparency */
    color: #C62828; /* Darker Bittersweet */
}

/* Statistics */
.stat-number {
    font-size: 36px;
    font-weight: 550;
    color: var(--primary-color);
    margin: 10px 0;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .leaderboard-header,
    .leaderboard-row {
        grid-template-columns: 60px 1fr 80px;
        gap: 10px;
    }
    
    .category-col,
    .date-col {
        display: none;
    }
    
    .champion-trophy {
        font-size: 40px;
    }
    
    .champion-score {
        font-size: 20px;
    }
    
    .rank-trophy {
        font-size: 16px;
    }
}
</style>