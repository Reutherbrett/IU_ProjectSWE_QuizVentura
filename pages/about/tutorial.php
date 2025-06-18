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
<div class="page-section">
<h3>Erste Schritte</h3>
<div class="card card-vertical mb-30">
    <p>Willkommen bei QuizVentura! Um loszulegen, wähle im Menü eine Funktion aus:</p>
    <ul class="tutorial-list">
        <li><strong>Dashboard</strong>: Deinen Fortschritt und Statistiken ansehen</li>
        <li><strong>Lernen</strong>: Kategorien erkunden und Wissen aufbauen</li>
        <li><strong>Spielen</strong>: Quizzes lösen und Punkte sammeln</li>
    </ul>
</div>
</div>

<!-- FAQ-Bereich -->
<div class="page-section">
    <h3 class="section-title">FAQ – Häufige Fragen</h3>
    <div class="quiz-list">
        <?php foreach ($faqs as $faq): ?>
            <div class="faq-item">
            <strong class="faq-question"><?php echo htmlspecialchars($faq['question']); ?></strong>
            <span><?php echo htmlspecialchars($faq['answer']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>