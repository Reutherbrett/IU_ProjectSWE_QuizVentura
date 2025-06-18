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
    <p>Erstelle eine neue Quiz-Kategorie mit eigenen Fragen.</p>
</div>

<form method="POST" class="category-form">
    <!-- Category Details Section -->
    <div class="page-section">
        <h3>Kategorie-Details</h3>
        <div class="card card-display card-vertical">
            <div class="form-group">
                <label class="form-label">Kategorie-Name</label>
                <span class="form-help">Wähle einen aussagekräftigen Namen für deine Kategorie</span>
                <input type="text" 
                       id="category_name"
                       name="category_name" 
                       required 
                       class="form-input"
                       placeholder="z.B. Geschichte-Quiz, Mathematik, Sport">
            </div>
            
            <div class="form-group">
                <label class="form-label">Symbol (Emoji)</label>
                <span class="form-help">Ein passendes Emoji für deine Kategorie (z.B. 📚 📊 ⚽ 🎵)</span>
                <input type="text" 
                       id="category_icon"
                       name="category_icon" 
                       required 
                       maxlength="2" 
                       class="form-input icon-input"
                       placeholder="📚">
            </div>
        </div>
    </div>

    <!-- Questions Section -->
    <div class="page-section">
        <h3>Fragen</h3>
        
        <div class="questions-card" id="questions-container">
            <!-- Initial question -->
            <div class="question-block" data-question="0">
                <div class="question-header">
                    <h4>Frage 1</h4>
                    <button type="button" onclick="removeQuestion(this)" class="btn btn-remove btn-small">
                        x
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Fragentext</label>
                    <input type="text" 
                           name="questions[0][question]" 
                           required 
                           class="form-input"
                           placeholder="Geben Sie hier Ihre Frage ein...">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Antwortoptionen</label>
                    <span class="form-help">Markiere die richtige Antwort durch Auswahl des entsprechenden Buchstabens</span>
                    <div class="answer-grid">
                        <div class="answer-option">
                            <div class="answer-option-header">
                                <input type="radio" name="questions[0][correct]" value="0" required id="q0_opt0">
                                <label for="q0_opt0" class="option-label">A</label>
                            </div>
                            <input type="text" 
                                   name="questions[0][options][0]" 
                                   required 
                                   placeholder="Erste Antwortoption" 
                                   class="form-input form-input-small">
                        </div>
                        <div class="answer-option">
                            <div class="answer-option-header">
                                <input type="radio" name="questions[0][correct]" value="1" required id="q0_opt1">
                                <label for="q0_opt1" class="option-label">B</label>
                            </div>
                            <input type="text" 
                                   name="questions[0][options][1]" 
                                   required 
                                   placeholder="Zweite Antwortoption" 
                                   class="form-input form-input-small">
                        </div>
                        <div class="answer-option">
                            <div class="answer-option-header">
                                <input type="radio" name="questions[0][correct]" value="2" required id="q0_opt2">
                                <label for="q0_opt2" class="option-label">C</label>
                            </div>
                            <input type="text" 
                                   name="questions[0][options][2]" 
                                   required 
                                   placeholder="Dritte Antwortoption" 
                                   class="form-input form-input-small">
                        </div>
                        <div class="answer-option">
                            <div class="answer-option-header">
                                <input type="radio" name="questions[0][correct]" value="3" required id="q0_opt3">
                                <label for="q0_opt3" class="option-label">D</label>
                            </div>
                            <input type="text" 
                                   name="questions[0][options][3]" 
                                   required 
                                   placeholder="Vierte Antwortoption" 
                                   class="form-input form-input-small">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <center>
        <button type="button" onclick="addQuestion()" class="btn btn-primary">
                Frage hinzufügen
        </button>
        </center>
    </div>

    <!-- Action Buttons -->
    <div class="form-actions">
        <button type="button" 
                onclick="window.location.href='alleKategorien.php'" 
                class="btn btn-secondary">
            Abbrechen
        </button>
        <button type="submit" 
                name="save_category" 
                class="btn btn-primary">
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
    questionBlock.setAttribute('data-question', questionCount);
    
    questionBlock.innerHTML = `
        <div class="question-header">
            <h4>Frage ${questionCount + 1}</h4>
            <button type="button" onclick="removeQuestion(this)" class="btn btn-remove btn-small">
                x
            </button>
        </div>
        
        <div class="form-group">
            <label class="form-label">Fragentext</label>
            <input type="text" 
                   name="questions[${questionCount}][question]" 
                   required 
                   class="form-input"
                   placeholder="Geben Sie hier Ihre Frage ein...">
        </div>
        
        <div class="form-group">
            <label class="form-label">Antwortoptionen</label>
            <span class="form-help">Markiere die richtige Antwort durch Auswahl des entsprechenden Buchstabens</span>
            <div class="answer-grid">
                <div class="answer-option">
                    <div class="answer-option-header">
                        <input type="radio" name="questions[${questionCount}][correct]" value="0" required id="q${questionCount}_opt0">
                        <label for="q${questionCount}_opt0" class="option-label">A</label>
                    </div>
                    <input type="text" 
                           name="questions[${questionCount}][options][0]" 
                           required 
                           placeholder="Erste Antwortoption" 
                           class="form-input form-input-small">
                </div>
                <div class="answer-option">
                    <div class="answer-option-header">
                        <input type="radio" name="questions[${questionCount}][correct]" value="1" required id="q${questionCount}_opt1">
                        <label for="q${questionCount}_opt1" class="option-label">B</label>
                    </div>
                    <input type="text" 
                           name="questions[${questionCount}][options][1]" 
                           required 
                           placeholder="Zweite Antwortoption" 
                           class="form-input form-input-small">
                </div>
                <div class="answer-option">
                    <div class="answer-option-header">
                        <input type="radio" name="questions[${questionCount}][correct]" value="2" required id="q${questionCount}_opt2">
                        <label for="q${questionCount}_opt2" class="option-label">C</label>
                    </div>
                    <input type="text" 
                           name="questions[${questionCount}][options][2]" 
                           required 
                           placeholder="Dritte Antwortoption" 
                           class="form-input form-input-small">
                </div>
                <div class="answer-option">
                    <div class="answer-option-header">
                        <input type="radio" name="questions[${questionCount}][correct]" value="3" required id="q${questionCount}_opt3">
                        <label for="q${questionCount}_opt3" class="option-label">D</label>
                    </div>
                    <input type="text" 
                           name="questions[${questionCount}][options][3]" 
                           required 
                           placeholder="Vierte Antwortoption" 
                           class="form-input form-input-small">
                </div>
            </div>
        </div>
    `;
    
    container.appendChild(questionBlock);
    questionCount++;
    
    // Smooth scroll to new question
    questionBlock.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function removeQuestion(button) {
    const questions = document.querySelectorAll('.question-block');
    if (questions.length > 1) {
        const questionBlock = button.closest('.question-block');
        questionBlock.style.opacity = '0';
        questionBlock.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            questionBlock.remove();
            updateQuestionNumbers();
        }, 300);
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

// Form validation enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.category-form');
    
    form.addEventListener('submit', function(e) {
        const questions = document.querySelectorAll('.question-block');
        
        if (questions.length < 3) {
            e.preventDefault();
            alert('Bitte erstellen Sie mindestens 3 Fragen für Ihre Kategorie.');
            return false;
        }
        
        // Check if all questions have a selected correct answer
        let hasErrors = false;
        questions.forEach((question, index) => {
            const radios = question.querySelectorAll('input[type="radio"]');
            const isSelected = Array.from(radios).some(radio => radio.checked);
            
            if (!isSelected) {
                hasErrors = true;
                question.style.borderColor = '#ff4444';
                question.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                question.style.borderColor = '';
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            alert('Bitte wählen Sie für jede Frage die richtige Antwort aus.');
            return false;
        }
    });
});
</script>

<style>
/* Page-specific styles for neueKategorie.php */

.category-form {
    margin: 0 auto;
}

.icon-input {
    width: 80px !important;
    text-align: center;
    font-size: 20px;
}

.answer-grid {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-sm);
}

.answer-option {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.answer-option-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    flex-shrink: 0;
}

.option-label {
    font-weight: 600;
    color: var(--primary-color);
    background: var(--background);
    border: 2px solid var(--primary-color);
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.answer-option .form-input {
    flex: 1;
}

.answer-option input[type="radio"]:checked + .option-label {
    background: var(--primary-color);
    color: var(--text-primary);
}

.answer-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: var(--spacing-md);
    margin-top: var(--spacing-xxl);
    padding-top: var(--spacing-xl);
    border-top: 1px solid var(--border-color);
}

/* Animation for question removal */
.question-block {
    transition: all var(--transition-medium);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .answer-option {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }
    
    .answer-option .form-input {
        width: 100%;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
    
    .d-flex.justify-between {
        flex-direction: column;
        gap: var(--spacing-md);
    }
    
    .d-flex.justify-between .btn {
        align-self: flex-start;
    }
}


/* Enhanced visual feedback */
.question-block.error {
    border-color: #ff4444 !important;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}
</style>