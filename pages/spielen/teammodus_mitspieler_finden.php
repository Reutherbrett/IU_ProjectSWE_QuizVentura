<main>

  <h2>Gegenspieler auswählen</h2>

  <!-- Spiel beitreten -->
 

  <!-- Neues Spiel erstellen -->
  <section>

    <form method="POST" class="category-form">
    <!-- Category Details Section -->
    <div class="page-section">
        
        <div class="question-block">
            <div class="form-group">
                <label class="form-label">Spiel ID-Eingeben</label>
                <span class="form-help">Bitte geben Sie Ihre Spiel ID ein oder generieren Sie Ihre eigene</span>
                <input type="text" id="category_name" name="category_name" required class="form-input"
                    placeholder="z.B. #12345">
            </div>
     
            <button type="button" onclick="loadPage('pages/spielen/teammodus_spielen.php')" class="btn btn-primary">
                Spiel Starten
            </button>

     
            <button type="button" onclick="SpielIDgenerieren()" class="btn btn-primary">
               Eigene ID generieren
     

  </section>

</main>
