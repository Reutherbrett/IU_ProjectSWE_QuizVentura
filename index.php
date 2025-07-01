<?php
session_start();
require_once 'backend/Benutzerverwaltung.php';

$loginMessage = '';

// Handle login form submission
if ($_POST && isset($_POST['email']) && isset($_POST['password'])) {
    $result = loginUser($_POST['email'], $_POST['password']);
    
    if ($result['success']) {
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['score_total'] = $result['score_total'];
        header('Location: index2.php');
        exit();
    } else {
        $loginMessage = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'QuizVentura'; ?></title>
    <link rel="stylesheet" href="assets/css/styleIndex.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>
   <div class="app-container">
    <h2>Willkommen bei QuizVentura</h2> 
    <h3>Deine Plattform für interaktive Quizze und Lerninhalte.</h3>
   </div>
   
   <div class="content">
    <h4>About</h4> 
    <p>Willkommen bei QuizVentura - der innovativen Online-Quizplattform, die das Lernen durch Zusammenarbeit verbessert. 
        Unser System ermöglicht es Lernenden, ihr Verständnis von Kursinhalten mithilfe interaktiver Quizze in verschiedenen spannenden Formaten zu vertiefen. 
        Egal, ob du lieber alleine lernst, dich mit anderen misst oder gemeinsam im Team Aufgaben löst - 
        QuizVentura bietet die ideale Umgebung für nachhaltiges Lernen und effektive Prüfungsvorbereitung. 
        Dank unseres communitybasierten Ansatzes kannst du nicht nur von einer wachsenden Sammlung an Lerninhalten profitieren, sondern auch selbst zur Erweiterung beitragen. 
        Werde noch heute Teil unserer Community und entdecke eine effektivere und unterhaltsamere Art, deinen Lernstoff zu meistern. Gemeinsam lernen wir besser.</p>

    <h4>Starten</h4> 
    <?php if ($loginMessage): ?>
        <p style="color: red; text-align: center;"><?php echo $loginMessage; ?></p>
    <?php endif; ?>
    
    <center>
        <form class="login-form" method="POST">
            <input type="email" name="email" placeholder="E-Mail" class="login-input" required>
            <input type="password" name="password" placeholder="Passwort" class="login-input" required>
            <button type="submit" class="login-button">Login</button>
        </form>
    </center>
   </div>
</body>
</html>