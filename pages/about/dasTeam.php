<?php
/**
 * Teamseite – dasTeam.php
 */

// Beispiel-Teamdaten (kann später aus Datenbank kommen)
$team = [
    [
        'name' => 'Vorname Nachname',
        'role' => 'Rolle',
        'bio' => 'Verantwortlich für Organisation, Vision und UX.',
        'skills' => ['Projektmanagement', 'Kommunikation'],
        'image' => 'assets/img/incognito.webp'
    ],
    [
        'name' => 'Vorname Nachname',
        'role' => 'Rolle',
        'bio' => 'Verantwortlich für Organisation, Vision und UX.',
        'skills' => ['Projektmanagement', 'Kommunikation'],
        'image' => 'assets/img/incognito.webp'
    ],
    [
        'name' => 'Vorname Nachname',
        'role' => 'Rolle',
        'bio' => 'Verantwortlich für Organisation, Vision und UX.',
        'skills' => ['Projektmanagement', 'Kommunikation'],
        'image' => 'assets/img/incognito.webp'
    ],
    [
        'name' => 'Vorname Nachname',
        'role' => 'Rolle',
        'bio' => 'Verantwortlich für Organisation, Vision und UX.',
        'skills' => ['Projektmanagement', 'Kommunikation'],
        'image' => 'assets/img/incognito.webp'
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
            <h4><?php echo htmlspecialchars($member['name']); ?></h4>
            <p class="team-role"><?php echo htmlspecialchars($member['role']); ?></p>
            <p class="team-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
            <div class="team-skills">
                <strong>Skills:</strong>
                <?php echo implode(', ', $member['skills']); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>