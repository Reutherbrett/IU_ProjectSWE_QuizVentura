<!-- Hauptcontainer (neben Sidebar) -->
<?php
/**
 * All Categories Page - Show all quiz categories
 */

// Sample data for quizzes (replace with database queries later)


$all_answers = [
    ['id' => 1, 'name' => 'Antwort 1', 'points' => 0],
    ['id' => 2, 'name' => 'Antwort 2','points' =>  0],
    ['id' => 3, 'name' => 'Antwort 3', 'points' => 0],
    ['id' => 4, 'name' => 'Antwort 4', 'points' => 1],
    
];
?>



   <div>
        <div class="question-box">
            <h1>Quiz</h1>
            <div class="card card-button text-center">
                <h3>Who came first?<br>The chicken or the egg?</h3>
                <p>Question 1/10</p>
            </div>
         

                    <!-- Antwortmöglichkeiten -->
                        <h3> Antworten</h3>
            <div class="page-grid">
                 
                <?php foreach ($all_answers as $answer): ?>
            

                <div class="card card-button text-center">
                     <span class="quiz-card-icon"><?php echo $answer['id']; ?></span>
                   <span class="quiz-card-title"><?php echo $answer['name']; ?></span>
               </div>
               <?php endforeach; ?>
             </div>
         </div>
        <div class="quiz-sidebar">
            <div class="card card-vertical mb-30">
             <h4>Punkte: 0/10</h4>
             <h4>Frage: 1/10</h4>
             <h4>Zeit: 30s</h4>
                </div>
          </div>
  </div>
