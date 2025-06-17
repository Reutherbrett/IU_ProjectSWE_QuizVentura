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
        <div class="card card-vertical" style="text-align: center;">
            <img src="<?php echo $member['image']; ?>" alt="Foto von <?php echo $member['name']; ?>" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
            <h4><?php echo htmlspecialchars($member['name']); ?></h4>
            <p style="color: #888; font-size: 14px;"><?php echo htmlspecialchars($member['role']); ?></p>
            <p style="margin: 10px 0;"><?php echo htmlspecialchars($member['bio']); ?></p>
            <div style="font-size: 13px;">
                <strong>Skills:</strong>
                <?php echo implode(', ', $member['skills']); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>