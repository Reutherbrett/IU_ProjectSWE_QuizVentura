<?php
require_once 'db_connect.php';

// Registrierung eines Nutzers
function registerUser($username, $email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Benutzer WHERE E_Mail = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        return ['success' => false, 'message' => 'E-Mail bereits registriert'];
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO Benutzer (Username, E_Mail, Password_Hash) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $passwordHash])) {
        return ['success' => true, 'message' => 'Registrierung erfolgreich'];
    } else {
        return ['success' => false, 'message' => 'Fehler bei der Registrierung'];
    }
}

// Login eines Nutzers
function loginUser($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Benutzer WHERE E_Mail = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['Password_Hash'])) {
        return [
            'success' => true,
            'message' => 'Login erfolgreich',
            'user_id' => $user['Nutzer_ID'],
            'username' => $user['Username'],
            'score_total' => $user['Score_total']
        ];
    } else {
        return [
            'success' => false,
            'message' => 'E-Mail oder Passwort ist falsch'
        ];
    }
}

// Nutzerprofil abrufen
function getUserProfile($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Nutzer_ID, Username, E_Mail, Created_at, Score_total FROM Benutzer WHERE Nutzer_ID = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

// Nutzerprofil aktualisieren (nur Username und E-Mail als Beispiel)
function updateUserProfile($userId, $data) {
    global $pdo;
    $fields = [];
    $params = [];
    if (isset($data['Username'])) {
        $fields[] = "Username = ?";
        $params[] = $data['Username'];
    }
    if (isset($data['E_Mail'])) {
        $fields[] = "E_Mail = ?";
        $params[] = $data['E_Mail'];
    }
    if (empty($fields)) {
        return ['success' => false, 'message' => 'Keine Felder zum Aktualisieren'];
    }
    $params[] = $userId;
    $sql = "UPDATE Benutzer SET " . implode(', ', $fields) . " WHERE Nutzer_ID = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        return ['success' => true, 'message' => 'Profil aktualisiert'];
    } else {
        return ['success' => false, 'message' => 'Fehler beim Aktualisieren'];
    }
}

// Gesamtscore eines Nutzers abrufen
function getUserTotalScore($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Score_total FROM Benutzer WHERE Nutzer_ID = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetch();
    return $result ? $result['Score_total'] : null;
}

// Nutzer abmelden
function logoutUser() {
    session_start();
    session_destroy();
    return ['success' => true, 'message' => 'Erfolgreich abgemeldet'];
}

// Beispiel-Aufrufe (zum Testen):
// $reg = registerUser('MaxMustermann', 'max@example.com', 'geheimesPasswort');
// print_r($reg);
// $login = loginUser('max@example.com', 'geheimesPasswort');
// print_r($login);
// $profile = getUserProfile(1);
// print_r($profile);
// $update = updateUserProfile(1, ['Username' => 'NeuerName', 'E_Mail' => 'neu@example.com']);
// print_r($update);
// $score = getUserTotalScore(1);
// echo $score;
?>