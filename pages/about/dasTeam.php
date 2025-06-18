<?php
/**
 * Teamseite – dasTeam.php
 */

// Beispiel-Teamdaten (kann später aus Datenbank kommen)
$team = [
    [
        'name' => 'Jannik Grooters',
        'role' => 'Projektleiter',
        'bio' => 'Verantwortlich für Projektkoordination, Teamführung und strategische Planung.',
        'skills' => ['Serveradministration und Infrastrukturmanagement', 'Projektmanagement', 'Webdesign und Frontend-Entwicklung', 'Selbstständigkeit und Unternehmerische Kompetenz', 'Analytisches Denken und Problemlösungsfähigkeit'],
        'image' => 'assets/img/team_jannik.jpg'
    ],
    [
        'name' => 'Luana Gerber',
        'role' => 'Frontend-Entwicklerin',
        'bio' => 'Verantwortlich für UI/UX-Design und Frontend-Implementierung.',
        'skills' => ['kritisches und analytisches Denken', 'Kreativität', 'Sinn für Ästhetik', 'Proaktivität',
'Teamkoordination und Aufgabenorganisation', 'Kommunikation'],
        'image' => 'assets/img/team_luana.jpg'
    ],
    [
        'name' => 'Lukas Göggel',
        'role' => 'Qualitätsmanager',
        'bio' => 'Verantwortlich für Qualitätssicherung, Testing und Feedback-Management.',
        'skills' => ['Softwareentwicklung', 'Daten & KI', 'Projektmanagement', 'UX & Qualitätssicherung'],
        'image' => 'assets/img/team_lukas.jpg'
    ],
    [
        'name' => 'Paul Reuther',
        'role' => 'Backend-Entwickler',
        'bio' => 'Verantwortlich für Serverarchitektur, Datenbankdesign und Backend-Entwicklung.',
        'skills' => ['Datenbankdesign und Setup', 'Grundlagen in Java- und Python-Entwicklung', 'Windows-Troubleshooting und Setup', 'Grundwissen in Serveradministration', 'Lösungsorientiertes Denken aus 3rd-Level-Der ComSupport', 'Quiz-Wissen'],
        'image' => 'assets/img/team_paul.jpg'
    ],
];
?>

<div class="page-header">
    <h2>Unser Team</h2>
    <p>Lerne das Team hinter QuizVentura kennen.</p>
</div>

<div class="page-grid">
    <?php foreach ($team as $member): ?>
        <div class="card card-vertical text-center">
            <img src="<?php echo $member['image']; ?>" 
                 alt="Foto von <?php echo $member['name']; ?>" 
                 class="team-member-image">
            <h4 class="team-name"><?php echo htmlspecialchars($member['name']); ?></h4>
            <p class="team-role"><?php echo htmlspecialchars($member['role']); ?></p>
            <p class="team-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
            <div class="team-skills">
                <strong>Skills:</strong>
                <?php echo implode(', ', $member['skills']); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>