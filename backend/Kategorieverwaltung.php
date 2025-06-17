<?php
<?php
require_once 'db_connect.php';

// Kategorie erstellen
function createCategory($kategorie, $createdBy, $field = null) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Kategorie (Kategorie, Created_by, Field) VALUES (?, ?, ?)");
    if ($stmt->execute([$kategorie, $createdBy, $field])) {
        return ['success' => true, 'message' => 'Kategorie erstellt', 'Kategorie_ID' => $pdo->lastInsertId()];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Erstellen der Kategorie'];
    }
}

// Alle Kategorien abrufen
function getCategories() {
    global $pdo;
    $stmt = $pdo->query("SELECT Kategorie_ID, Kategorie, Created_by, Field FROM Kategorie");
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
    if (isset($data['Field'])) {
        $fields[] = "Field = ?";
        $params[] = $data['Field'];
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