<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'QuizVentura'; ?></title>
    <link rel="stylesheet" href="assets/css/styleIndex.css">

    <!-- API for custom font -->
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
    <p style="margin-bottom: 40px;"></p>

    <h4>Starten</h4> 
    <p>
    <center>
        <form class="login-form">
            <input type="text" id="username" name="username" placeholder="Benutzername" class="login-input" required>
            <input type="password" id="password" name="password" placeholder="Passwort" class="login-input" required>
            <button type="submit" class="login-button" onclick="location.href='index2.php'">Login</button>
        </form>
    </center>
    </p>
   </div>

</body>
</html>