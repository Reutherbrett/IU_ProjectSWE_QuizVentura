<!-- Hauptcontainer (neben Sidebar) -->
<?php
/**
 * Teammodus Spielen Page - Show quiz game interface
 */

// Sample data for quizzes (replace with database queries later)
$all_answers = [
    ['id' => 1, 'name' => 'Antwort 1', 'points' => 0],
    ['id' => 2, 'name' => 'Antwort 2','points' =>  0],
    ['id' => 3, 'name' => 'Antwort 3', 'points' => 0],
    ['id' => 4, 'name' => 'Antwort 4', 'points' => 1],
];

$answer_labels = ['A', 'B', 'C', 'D'];
?>

<div class="page-header">
    <h2>Quiz</h2>
</div>

<div class="quiz-game-container">
    <!-- Game Information -->
    <div class="game-info-bar">
        <div class="game-info-text">Zeit</div>
        <div class="game-info-text">Punkte</div>
    </div>
    <!-- Question Container -->
    <div class="quiz-question-container">
        <div class="quiz-question-card">
            <h3>Who came first?<br>The chicken or the egg?</h3>
            <p class="quiz-question-number">Frage 1/10</p>
        </div>
    </div>

    <!-- Answers Section -->
    <h3 class="quiz-answers-title">Wähle die richtige Antwort:</h3>
    <div class="quiz-answers-grid">
        <?php foreach ($all_answers as $index => $answer): ?>
            <div class="quiz-answer-option" onclick="selectAnswer(this)">
                <div class="quiz-answer-label"><?php echo $answer_labels[$index]; ?></div>
                <div class="quiz-answer-text"><?php echo $answer['name']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-actions">
        <button type="submit" name="next_question" class="btn btn-primary">
            Nächste Frage
        </button>
    </div>
</div>


<script>
function selectAnswer(element) {
    // Remove selected class from all options
    document.querySelectorAll('.quiz-answer-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    element.classList.add('selected');
}

function nextQuestion() {
    // Check if an answer is selected
    const selectedAnswer = document.querySelector('.quiz-answer-option.selected');
    if (!selectedAnswer) {
        alert('Bitte wähle eine Antwort aus!');
        return;
    }
    
    // Here you can add logic to proceed to the next question
    console.log('Next question...');
    // For now, just remove all selections
    document.querySelectorAll('.quiz-answer-option').forEach(option => {
        option.classList.remove('selected');
    });
}
</script>