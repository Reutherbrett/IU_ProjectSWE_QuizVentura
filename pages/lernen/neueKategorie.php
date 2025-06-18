<?php
/**
 * New Category Page - Create new quiz category
 */

// Handle form submission
if ($_POST && isset($_POST['save_category'])) {
    // Here you would save to database
    $category_name = $_POST['category_name'] ?? '';
    $category_icon = $_POST['category_icon'] ?? '';
    $questions = $_POST['questions'] ?? [];
    
    // Sample processing - replace with actual database save
    echo "<script>alert('Kategorie erfolgreich gespeichert!'); window.location.href='alleKategorien.php';</script>";
}
?>

<div class="page-header">
    <h2>Neue Kategorie</h2>
    <p>Erstelle eine neue Quiz-Kategorie.</p>
</div>

<form method="POST" style="max-width: 800px;">
    <!-- Category Details -->
    <div class="card mb-30">
        <div style="width: 100%;">
            <h3 class="section-title">Kategorie-Details</h3>
            
            <div class="form-group">
                <label class="form-label">Kategorie-Name:</label>
                <input type="text" name="category_name" required class="form-input"
                       placeholder="z.B.: Geschichte-Quiz">
            </div>
            
            <div class="form-group">
                <label class="form-label">Symbol (Emoji):</label>
                <input type="text" name="category_icon" required maxlength="2" class="form-input"
                       style="width: 100px; text-align: center;" placeholder="📚">
            </div>
        </div>
    </div>

    <!-- Questions Section -->
    <div class="card mb-30">
        <div style="width: 100%;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 class="section-title">Fragen</h3>
                <button type="button" onclick="addQuestion()" class="btn btn-primary btn-small">
                    Frage hinzufügen
                </button>
            </div>
            
            <div id="questions-container">
                <!-- Initial question -->
                <div class="question-block">
                    <div class="question-header">
                        <h4>Frage 1</h4>
                        <button type="button" onclick="removeQuestion(this)" class="btn btn-remove">Entfernen</button>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Frage:</label>
                        <input type="text" name="questions[0][question]" required class="form-input"
                               placeholder="Geben Sie hier Ihre Frage ein...">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Antwortoptionen:</label>
                        <div class="answer-options">
                            <div class="answer-option">
                                <input type="radio" name="questions[0][correct]" value="0" required>
                                <input type="text" name="questions[0][options][0]" required placeholder="Option A" class="form-input-small">
                            </div>
                            <div class="answer-option">
                                <input type="radio" name="questions[0][correct]" value="1" required>
                                <input type="text" name="questions[0][options][1]" required placeholder="Option B" class="form-input-small">
                            </div>
                            <div class="answer-option">
                                <input type="radio" name="questions[0][correct]" value="2" required>
                                <input type="text" name="questions[0][options][2]" required placeholder="Option C" class="form-input-small">
                            </div>
                            <div class="answer-option">
                                <input type="radio" name="questions[0][correct]" value="3" required>
                                <input type="text" name="questions[0][options][3]" required placeholder="Option D" class="form-input-small">
                            </div>
                        </div>
                        <small class="form-help">Wählen Sie die richtige Antwort durch Markieren des entsprechenden Kreises</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="text-center mt-30">
        <button type="button" onclick="window.location.href='alleKategorien.php'" class="btn btn-neutral" style="margin-right: 15px;">
            Abbrechen
        </button>
        <button type="submit" name="save_category" class="btn btn-primary">
            Kategorie speichern
        </button>
    </div>
</form>

<script>
let questionCount = 1;

function addQuestion() {
    const container = document.getElementById('questions-container');
    const questionBlock = document.createElement('div');
    questionBlock.className = 'question-block';
    
    questionBlock.innerHTML = `
        <div class="question-header">
            <h4>Frage ${questionCount + 1}</h4>
            <button type="button" onclick="removeQuestion(this)" class="btn btn-remove">Entfernen</button>
        </div>
        
        <div class="form-group">
            <label class="form-label">Frage:</label>
            <input type="text" name="questions[${questionCount}][question]" required class="form-input"
                   placeholder="Geben Sie hier Ihre Frage ein...">
        </div>
        
        <div class="form-group">
            <label class="form-label">Antwortoptionen:</label>
            <div class="answer-options">
                <div class="answer-option">
                    <input type="radio" name="questions[${questionCount}][correct]" value="0" required>
                    <input type="text" name="questions[${questionCount}][options][0]" required placeholder="Option A" class="form-input-small">
                </div>
                <div class="answer-option">
                    <input type="radio" name="questions[${questionCount}][correct]" value="1" required>
                    <input type="text" name="questions[${questionCount}][options][1]" required placeholder="Option B" class="form-input-small">
                </div>
                <div class="answer-option">
                    <input type="radio" name="questions[${questionCount}][correct]" value="2" required>
                    <input type="text" name="questions[${questionCount}][options][2]" required placeholder="Option C" class="form-input-small">
                </div>
                <div class="answer-option">
                    <input type="radio" name="questions[${questionCount}][correct]" value="3" required>
                    <input type="text" name="questions[${questionCount}][options][3]" required placeholder="Option D" class="form-input-small">
                </div>
            </div>
            <small class="form-help">Wählen Sie die richtige Antwort durch Markieren des entsprechenden Kreises</small>
        </div>
    `;
    
    container.appendChild(questionBlock);
    questionCount++;
}

function removeQuestion(button) {
    if (document.querySelectorAll('.question-block').length > 1) {
        button.closest('.question-block').remove();
        updateQuestionNumbers();
    } else {
        alert('Sie müssen mindestens eine Frage haben!');
    }
}

function updateQuestionNumbers() {
    const questions = document.querySelectorAll('.question-block');
    questions.forEach((block, index) => {
        const header = block.querySelector('h4');
        header.textContent = `Frage ${index + 1}`;
    });
}
</script>