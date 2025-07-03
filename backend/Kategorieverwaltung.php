<?php
require_once 'db_connect.php';

// Kategorie erstellen
function createCategory($kategorie, $createdBy, $emoji = null) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Kategorie (Kategorie, Created_by, Emoji, QuestionsNumber) VALUES (?, ?, ?, 0)");
    if ($stmt->execute([$kategorie, $createdBy, $emoji])) {
        return ['success' => true, 'message' => 'Kategorie erstellt', 'Kategorie_ID' => $pdo->lastInsertId()];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Erstellen der Kategorie'];
    }
}

// Alle Kategorien abrufen
function getCategories() {
    global $pdo;
    $stmt = $pdo->query("SELECT Kategorie_ID, Kategorie, Created_by, Emoji, QuestionsNumber FROM Kategorie");
    return $stmt->fetchAll();
}

// Kategorie aktualisieren
function updateCategory($kategorieId, $data) {
    global $pdo;
    $fields = [];
    $params = [];
    if (isset($data['Kategorie'])) {
        $fields[] = "Kategorie = ?";
        $params[] = $data['Kategorie'];
    }
    if (isset($data['Emoji'])) {
        $fields[] = "Emoji = ?";
        $params[] = $data['Emoji'];
    }
    if (isset($data['QuestionsNumber'])) {
        $fields[] = "QuestionsNumber = ?";
        $params[] = $data['QuestionsNumber'];
    }
    if (empty($fields)) {
        return ['success' => false, 'message' => 'Keine Felder zum Aktualisieren'];
    }
    $params[] = $kategorieId;
    $sql = "UPDATE Kategorie SET " . implode(', ', $fields) . " WHERE Kategorie_ID = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        return ['success' => true, 'message' => 'Kategorie aktualisiert'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Aktualisieren'];
    }
}

// Kategorie löschen
function deleteCategory($kategorieId) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM Kategorie WHERE Kategorie_ID = ?");
    if ($stmt->execute([$kategorieId])) {
        return ['success' => true, 'message' => 'Kategorie gelöscht'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Löschen'];
    }
}

// Update question count for category
function updateQuestionCount($kategorieId, $count) {
    return updateCategory($kategorieId, ['QuestionsNumber' => $count]);
}

// Get category with questions and answers
function getCategoryWithQuestions($kategorieId) {
    global $pdo;
    
    // Get category
    $stmt = $pdo->prepare("SELECT * FROM Kategorie WHERE Kategorie_ID = ?");
    $stmt->execute([$kategorieId]);
    $category = $stmt->fetch();
    
    if (!$category) {
        return null;
    }
    
    // Get questions
    $stmt = $pdo->prepare("SELECT * FROM Fragen WHERE Kategorie_ID = ? ORDER BY Frage_ID");
    $stmt->execute([$kategorieId]);
    $questions = $stmt->fetchAll();
    
    // Get answers for each question
    foreach ($questions as &$question) {
        $stmt = $pdo->prepare("SELECT * FROM Antworten WHERE Frage_ID = ? ORDER BY Antwort_ID");
        $stmt->execute([$question['Frage_ID']]);
        $question['answers'] = $stmt->fetchAll();
    }
    
    $category['questions'] = $questions;
    return $category;
}

// Create question
function createQuestion($kategorieId, $frageText, $createdBy) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES (?, ?, ?)");
    if ($stmt->execute([$frageText, $kategorieId, $createdBy])) {
        return ['success' => true, 'message' => 'Frage erstellt', 'Frage_ID' => $pdo->lastInsertId()];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Erstellen der Frage'];
    }
}

// Create answer
function createAnswer($frageId, $antworttext, $isCorrect) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES (?, ?, ?)");
    if ($stmt->execute([$frageId, $antworttext, $isCorrect])) {
        return ['success' => true, 'message' => 'Antwort erstellt'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Erstellen der Antwort'];
    }
}

// Beispiel-Aufrufe (zum Testen):
// $create = createCategory('Allgemeinwissen', 1, 'Wissen');
// print_r($create);
// $cats = getCategories();
// print_r($cats);
// $update = updateCategory(1, ['Kategorie' => 'Geografie', 'Field' => 'Erdkunde']);
// print_r($update);
// $delete = deleteCategory(1);
// print_r($delete);
?>