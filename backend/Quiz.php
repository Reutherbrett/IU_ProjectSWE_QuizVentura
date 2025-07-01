<?php
require_once 'db_connect.php';

// Zufällige Kategorie holen
function getRandomCategoryId() {
    global $pdo;
    $stmt = $pdo->query("SELECT Kategorie_ID FROM Kategorie ORDER BY RAND() LIMIT 1");
    $row = $stmt->fetch();
    return $row ? $row['Kategorie_ID'] : null;
}

// 10 zufällige Fragen aus einer Kategorie holen
function getQuizQuestions($kategorieId, $limit = 10) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Frage_ID, Frage_Text FROM Fragen WHERE Kategorie_ID = ? ORDER BY RAND() LIMIT ?");
    $stmt->bindValue(1, $kategorieId, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Antwort prüfen und Punkt vergeben
function checkAnswer($userId, $frageId, $antwortId) {
    global $pdo;
    // Prüfen, ob die Antwort korrekt ist
    $stmt = $pdo->prepare("SELECT is_correct FROM Antworten WHERE Antwort_ID = ? AND Frage_ID = ?");
    $stmt->execute([$antwortId, $frageId]);
    $row = $stmt->fetch();
    $isCorrect = $row ? (bool)$row['is_correct'] : false;

    // Antwort speichern
    $stmt = $pdo->prepare("INSERT INTO Benutzer_Antworten (Nutzer_ID, Frage_ID, Antwort_ID) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $frageId, $antwortId]);

    // Punkt vergeben, falls korrekt
    if ($isCorrect) {
        $stmt = $pdo->prepare("UPDATE Benutzer SET Score_total = Score_total + 1 WHERE Nutzer_ID = ?");
        $stmt->execute([$userId]);
    }

    return $isCorrect;
}

// Quizrunde abschließen und Score speichern
function saveQuizRoundScore($userId, $score) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Score_Runde (Nutzer_ID, Score_Value) VALUES (?, ?)");
    $stmt->execute([$userId, $score]);
    return ['success' => true, 'message' => 'Quizrunde gespeichert'];
}

// Beispiel-Ablauf (Pseudocode):
/*
$userId = 1;

// Kategorie wählen (entweder vom Nutzer oder zufällig)
$kategorieId = isset($_POST['kategorieId']) ? $_POST['kategorieId'] : getRandomCategoryId();

// 10 Fragen holen
$fragen = getQuizQuestions($kategorieId);

// Für jede Frage: Antwort prüfen und Score zählen
$score = 0;
foreach ($fragen as $frage) {
    // $antwortId = ... (vom Nutzer übergeben)
    // $isCorrect = checkAnswer($userId, $frage['Frage_ID'], $antwortId);
    // if ($isCorrect) $score++;
}

// Nach 10 Fragen: Score speichern
// saveQuizRoundScore($userId, $score);
*/

?>