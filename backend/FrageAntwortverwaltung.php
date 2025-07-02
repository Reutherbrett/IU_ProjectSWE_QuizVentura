<?php
require_once 'db_connect.php';

// Frage erstellen
function createQuestion($kategorieId, $frageText, $createdBy) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES (?, ?, ?)");
    if ($stmt->execute([$frageText, $kategorieId, $createdBy])) {
        return ['success' => true, 'message' => 'Frage erstellt', 'Frage_ID' => $pdo->lastInsertId()];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Erstellen der Frage'];
    }
}

// Get single category by ID
function getCategoryById($kategorieId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Kategorie WHERE Kategorie_ID = ?");
    $stmt->execute([$kategorieId]);
    return $stmt->fetch();
}

// Alle Fragen einer Kategorie abrufen
function getQuestionsByCategory($kategorieId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Frage_ID, Frage_Text, Kategorie_ID, Created_by FROM Fragen WHERE Kategorie_ID = ?");
    $stmt->execute([$kategorieId]);
    return $stmt->fetchAll();
}

// Frage aktualisieren
function updateQuestion($frageId, $data) {
    global $pdo;
    $fields = [];
    $params = [];
    if (isset($data['Frage_Text'])) {
        $fields[] = "Frage_Text = ?";
        $params[] = $data['Frage_Text'];
    }
    if (isset($data['Kategorie_ID'])) {
        $fields[] = "Kategorie_ID = ?";
        $params[] = $data['Kategorie_ID'];
    }
    if (empty($fields)) {
        return ['success' => false, 'message' => 'Keine Felder zum Aktualisieren'];
    }
    $params[] = $frageId;
    $sql = "UPDATE Fragen SET " . implode(', ', $fields) . " WHERE Frage_ID = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        return ['success' => true, 'message' => 'Frage aktualisiert'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Aktualisieren'];
    }
}

// Frage löschen
function deleteQuestion($frageId) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM Fragen WHERE Frage_ID = ?");
    if ($stmt->execute([$frageId])) {
        return ['success' => true, 'message' => 'Frage gelöscht'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Löschen'];
    }
}

// Antwort erstellen
function createAnswer($frageId, $antwortText, $isCorrect) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES (?, ?, ?)");
    if ($stmt->execute([$frageId, $antwortText, $isCorrect])) {
        return ['success' => true, 'message' => 'Antwort erstellt', 'Antwort_ID' => $pdo->lastInsertId()];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Erstellen der Antwort'];
    }
}

// Alle Antworten zu einer Frage abrufen
function getAnswersByQuestion($frageId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Antwort_ID, Antworttext, is_correct FROM Antworten WHERE Frage_ID = ?");
    $stmt->execute([$frageId]);
    return $stmt->fetchAll();
}

// Antwort aktualisieren
function updateAnswer($antwortId, $data) {
    global $pdo;
    $fields = [];
    $params = [];
    if (isset($data['Antworttext'])) {
        $fields[] = "Antworttext = ?";
        $params[] = $data['Antworttext'];
    }
    if (isset($data['is_correct'])) {
        $fields[] = "is_correct = ?";
        $params[] = $data['is_correct'];
    }
    if (empty($fields)) {
        return ['success' => false, 'message' => 'Keine Felder zum Aktualisieren'];
    }
    $params[] = $antwortId;
    $sql = "UPDATE Antworten SET " . implode(', ', $fields) . " WHERE Antwort_ID = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        return ['success' => true, 'message' => 'Antwort aktualisiert'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Aktualisieren'];
    }
}

// Antwort löschen
function deleteAnswer($antwortId) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM Antworten WHERE Antwort_ID = ?");
    if ($stmt->execute([$antwortId])) {
        return ['success' => true, 'message' => 'Antwort gelöscht'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Löschen'];
    }
}

// Get category with questions and answers
function getCategoryWithQuestions($kategorieId) {
    // Use existing function to get category
    $category = getCategoryById($kategorieId);
    
    if (!$category) return false;
    
    // Use existing function to get questions
    $questions = getQuestionsByCategory($kategorieId);
    
    // Use existing function to get answers for each question
    foreach ($questions as &$question) {
        $question['answers'] = getAnswersByQuestion($question['Frage_ID']);
    }
    
    $category['questions'] = $questions;
    return $category;
}

// Beispiel-Aufrufe (zum Testen):
// $frage = createQuestion(1, 'Was ist die Hauptstadt von Frankreich?', 1);
// print_r($frage);
// $fragen = getQuestionsByCategory(1);
// print_r($fragen);
// $updateFrage = updateQuestion(1, ['Frage_Text' => 'Neue Frage?']);
// print_r($updateFrage);
// $deleteFrage = deleteQuestion(1);
// print_r($deleteFrage);
// $antwort = createAnswer(1, 'Paris', true);
// print_r($antwort);
// $antworten = getAnswersByQuestion(1);
// print_r($antworten);
// $updateAntwort = updateAnswer(1, ['Antworttext' => 'Berlin', 'is_correct' => false]);
// print_r($updateAntwort);
// $deleteAntwort = deleteAnswer(1);
// print_r($deleteAntwort);
?>