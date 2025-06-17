<?php
/**
 * Tutorial und Hilfe – tutorial.php
 */

// Beispiel-FAQs (kann später aus Datenbank kommen)
$faqs = [
    [
        'question' => 'Wie starte ich ein neues Quiz?',
        'answer' => 'Gehe auf "Spielen" im Menü und wähle eine Kategorie aus.'
    ],
    [
        'question' => 'Wo finde ich meine bisherigen Ergebnisse?',
        'answer' => 'Unter "Dashboard" findest du deinen letzten Punktestand.'
    ],
    [
        'question' => 'Muss ich mich registrieren?',
        'answer' => 'Ja, du brauchst ein Zugang, um alle Funktionen zu nutzen.'
    ]
];
?>

<div class="page-header">
    <h2>Hilfe & Tutorial</h2>
    <p>Hier findest du Antworten auf häufige Fragen und eine Einführung in QuizVentura.</p>
</div>

<!-- Hilfebereich -->
<div class="card card-vertical" style="margin-bottom: 30px;">
    <h4 style="margin-bottom: 10px;">Erste Schritte</h4>
    <p style="color: #555;">
        Willkommen bei QuizVentura! Um loszulegen, wähle im Menü eine Funktion aus:
    </p>
    <ul style="margin-left: 20px; color: #555;">
        <li>📈 <strong>Dashboard</strong>: Deinen Fortschritt und Statistiken ansehen</li>
        <li>📚 <strong>Lernen</strong>: Kategorien erkunden und Wissen aufbauen</li>
        <li>🎮 <strong>Spielen</strong>: Quizzes lösen und Punkte sammeln</li>
    </ul>
</div>

<!-- FAQ-Bereich -->
<div class="quiz-list">
    <h3 style="margin-bottom: 20px;">FAQ – Häufige Fragen</h3>
    <?php foreach ($faqs as $faq): ?>
        <div class="quiz-item" style="flex-direction: column; align-items: flex-start;">
            <strong style="margin-bottom: 5px;"><?php echo htmlspecialchars($faq['question']); ?></strong>
            <span><?php echo htmlspecialchars($faq['answer']); ?></span>
        </div>
    <?php endforeach; ?>
</div>