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
    <p>Erstell eine neue Quiz-Kategorie</p>
</div>

<form method="POST" style="max-width: 800px;">
    <!-- Category Details -->
    <div class="card" style="margin-bottom: 30px;">
        <div style="width: 100%;">
            <h3 style="margin-bottom: 20px; color: var(--primary-color);">Kategorie-Details</h3>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-secondary);">Kategorie-Name:</label>
                <input type="text" name="category_name" required 
                       style="width: 100%; padding: 12px; border: 2px solid var(--border-color); border-radius: 8px; font-size: 16px;"
                       placeholder="z.B.: Geschichte-Quiz">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-secondary);">Symbol (Emoji):</label>
                <input type="text" name="category_icon" required maxlength="2"
                       style="width: 100px; padding: 12px; border: 2px solid var(--border-color); border-radius: 8px; font-size: 16px; text-align: center;"
                       placeholder="📚">
            </div>
        </div>
    </div>

    <!-- Questions Section -->
    <div class="card" style="margin-bottom: 30px;">
        <div style="width: 100%;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);">❓ Fragen</h3>
                <button type="button" onclick="addQuestion()" 
                        style="background-color: var(--primary-color); color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">
                    ➕ Frage hinzufügen
                </button>
            </div>
            
            <div id="questions-container">
                <!-- Initial question -->
                <div class="question-block" style="border: 2px solid var(--border-color); border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 15px;">
                        <h4 style="color: var(--text-secondary);">Frage 1</h4>
                        <button type="button" onclick="removeQuestion(this)" style="background: #ff4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-left: auto;">Entfernen</button>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Frage:</label>
                        <input type="text" name="questions[0][question]" required 
                               style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;"
                               placeholder="Geben Sie hier Ihre Frage ein...">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Antwortoptionen:</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <div>
                                <input type="radio" name="questions[0][correct]" value="0" required style="margin-right: 8px;">
                                <input type="text" name="questions[0][options][0]" required placeholder="Option A" 
                                       style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                            </div>
                            <div>
                                <input type="radio" name="questions[0][correct]" value="1" required style="margin-right: 8px;">
                                <input type="text" name="questions[0][options][1]" required placeholder="Option B" 
                                       style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                            </div>
                            <div>
                                <input type="radio" name="questions[0][correct]" value="2" required style="margin-right: 8px;">
                                <input type="text" name="questions[0][options][2]" required placeholder="Option C" 
                                       style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                            </div>
                            <div>
                                <input type="radio" name="questions[0][correct]" value="3" required style="margin-right: 8px;">
                                <input type="text" name="questions[0][options][3]" required placeholder="Option D" 
                                       style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                            </div>
                        </div>
                        <small style="color: #666; margin-top: 5px; display: block;">Wählen Sie die richtige Antwort durch Markieren des entsprechenden Kreises</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div style="text-align: center; margin-top: 30px;">
        <button type="button" onclick="window.location.href='alleKategorien.php'" 
                style="background-color: #666; color: white; border: none; padding: 15px 30px; border-radius: 8px; font-size: 16px; margin-right: 15px; cursor: pointer;">
            Abbrechen
        </button>
        <button type="submit" name="save_category" 
                style="background-color: var(--primary-color); color: white; border: none; padding: 15px 30px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;">
            💾 Kategorie speichern
        </button>
    </div>
</form>

<script>
let questionCount = 1;

function addQuestion() {
    const container = document.getElementById('questions-container');
    const questionBlock = document.createElement('div');
    questionBlock.className = 'question-block';
    questionBlock.style.cssText = 'border: 2px solid var(--border-color); border-radius: 8px; padding: 20px; margin-bottom: 20px;';
    
    questionBlock.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h4 style="color: var(--text-secondary);">Frage ${questionCount + 1}</h4>
            <button type="button" onclick="removeQuestion(this)" style="background: #ff4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Entfernen</button>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Frage:</label>
            <input type="text" name="questions[${questionCount}][question]" required 
                   style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;"
                   placeholder="Geben Sie hier Ihre Frage ein...">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Antwortoptionen:</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div>
                    <input type="radio" name="questions[${questionCount}][correct]" value="0" required style="margin-right: 8px;">
                    <input type="text" name="questions[${questionCount}][options][0]" required placeholder="Option A" 
                           style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                </div>
                <div>
                    <input type="radio" name="questions[${questionCount}][correct]" value="1" required style="margin-right: 8px;">
                    <input type="text" name="questions[${questionCount}][options][1]" required placeholder="Option B" 
                           style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                </div>
                <div>
                    <input type="radio" name="questions[${questionCount}][correct]" value="2" required style="margin-right: 8px;">
                    <input type="text" name="questions[${questionCount}][options][2]" required placeholder="Option C" 
                           style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                </div>
                <div>
                    <input type="radio" name="questions[${questionCount}][correct]" value="3" required style="margin-right: 8px;">
                    <input type="text" name="questions[${questionCount}][options][3]" required placeholder="Option D" 
                           style="width: calc(100% - 30px); padding: 8px; border: 1px solid var(--border-color); border-radius: 4px;">
                </div>
            </div>
            <small style="color: #666; margin-top: 5px; display: block;">Wählen Sie die richtige Antwort durch Markieren des entsprechenden Kreises</small>
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

<style>
button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

input:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 2px rgba(242, 100, 25, 0.2);
}

.question-block {
    transition: all 0.3s ease;
}

.question-block:hover {
    border-color: var(--primary-color);
}
</style>