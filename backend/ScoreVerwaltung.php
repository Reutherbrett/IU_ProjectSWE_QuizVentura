<?php
<?php
require_once 'db_connect.php';

// Leaderboard: Top-Nutzer nach Gesamtscore
function getLeaderboard($limit = 10) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Nutzer_ID, Username, Score_total FROM Benutzer ORDER BY Score_total DESC, Username ASC LIMIT ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Statistik: Scores eines Nutzers (alle Runden)
function getUserStats($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Score_Value, score_date FROM Score_Runde WHERE Nutzer_ID = ? ORDER BY score_date DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

// Statistik: Durchschnittlicher Score pro Kategorie
function getCategoryStats($kategorieId) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT k.Kategorie, AVG(sr.Score_Value) as avg_score, COUNT(sr.score_ID) as rounds_played
        FROM Score_Runde sr
        JOIN Benutzer b ON sr.Nutzer_ID = b.Nutzer_ID
        JOIN Fragen f ON f.Kategorie_ID = ?
        JOIN Kategorie k ON k.Kategorie_ID = f.Kategorie_ID
        WHERE f.Kategorie_ID = ?
        GROUP BY k.Kategorie
    ");
    $stmt->execute([$kategorieId, $kategorieId]);
    return $stmt->fetch();
}

// Beispiel-Aufrufe (zum Testen):
// $leaderboard = getLeaderboard();
// print_r($leaderboard);
// $userStats = getUserStats(1);
// print_r($userStats);
// $catStats = getCategoryStats(1);
// print_r($catStats);
?>