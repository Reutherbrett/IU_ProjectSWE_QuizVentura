<?php
/**
 * New Category Page - Create new quiz category
 */

require_once '../../backend/Kategorieverwaltung.php';

// Handle form submission
if ($_POST && isset($_POST['save_category'])) {
    $category_name = $_POST['category_name'] ?? '';
    $category_icon = $_POST['category_icon'] ?? '';
    $questions = $_POST['questions'] ?? [];
    $created_by = 1; // Replace with actual user ID from session
    
    try {
        // Create category
        $categoryResult = createCategory($category_name, $created_by, $category_icon);
        
        if ($categoryResult['success']) {
            $kategorie_id = $categoryResult['Kategorie_ID'];
            $question_count = 0;
            
            // Create questions and answers
            foreach ($questions as $questionData) {
                $questionResult = createQuestion($kategorie_id, $questionData['question'], $created_by);
                
                if ($questionResult['success']) {
                    $frage_id = $questionResult['Frage_ID'];
                    $correct_index = (int)$questionData['correct'];
                    
                    // Create answers
                    foreach ($questionData['options'] as $index => $option_text) {
                        $is_correct = ($index == $correct_index) ? 1 : 0;
                        createAnswer($frage_id, $option_text, $is_correct);
                    }
                    $question_count++;
                }
            }
            
            // Update question count
            updateQuestionCount($kategorie_id, $question_count);
            
            echo "<script>alert('Kategorie erfolgreich gespeichert!'); window.location.href='alleKategorien.php';</script>";
        } else {
            echo "<script>alert('Fehler: " . $categoryResult['message'] . "');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Fehler beim Speichern: " . $e->getMessage() . "');</script>";
    }
}

// Handle delete category
if ($_POST && isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'] ?? '';
    if ($category_id) {
        $deleteResult = deleteCategory($category_id);
        if ($deleteResult['success']) {
            echo "<script>alert('Kategorie erfolgreich gelöscht!'); window.location.href='alleKategorien.php';</script>";
        } else {
            echo "<script>alert('Fehler beim Löschen: " . $deleteResult['message'] . "');</script>";
        }
    }
}

// Check if editing existing category
$editing = false;
$category = null;
if (isset($_GET['id'])) {
    $editing = true;
    $category = getCategoryWithQuestions($_GET['id']);
    if (!$category) {
        header('Location: alleKategorien.php');
        exit;
    }
}
?>

<div class="page-header">
    <h2><?= $editing ? 'Kategorie bearbeiten' : 'Neue Kategorie' ?></h2>
    <p><?= $editing ? 'Bearbeite eine bestehende Quiz-Kategorie.' : 'Erstelle eine neue Quiz-Kategorie mit eigenen Fragen.' ?></p>
</div>

<form method="POST" class="category-form">
    <?php if ($editing): ?>
        <input type="hidden" name="category_id" value="<?= $category['Kategorie_ID'] ?>">
    <?php endif; ?>
    
    <!-- Category Details Section -->
    <div class="page-section">
        <h3>Kategorie-Details</h3>
        <div class="question-block">
            <div class="form-group">
                <label class="form-label">Kategorie-Name</label>
                <span class="form-help">Wähle einen aussagekräftigen Namen für deine Kategorie</span>
                <input type="text" id="category_name" name="category_name" required class="form-input"
                    placeholder="z.B. Geschichte-Quiz, Mathematik, Sport"
                    value="<?= $editing ? htmlspecialchars($category['Kategorie']) : '' ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Symbol (Emoji)</label>
                <span class="form-help">Wähle ein passendes Emoji für deine Kategorie</span>
                <div class="emoji-grid">
                    <?php
                    $emojis = ['📚', '📊', '⚽', '🎵', '🎨', '🔬', '🌍', '💻', '🍳', '🎭', '🏛️', '🎯', '🏆', '🚗', '🎪', '📱', '🎮', '📐', '🎬', '🌟'];
                    $selected_emoji = $editing ? $category['Emoji'] : '';
                    
                    foreach ($emojis as $index => $emoji): ?>
                        <div class="emoji-option">
                            <input type="radio" name="category_icon" value="<?= $emoji ?>" required id="emoji_<?= $index + 1 ?>"
                                <?= ($selected_emoji === $emoji) ? 'checked' : '' ?>>
                            <label for="emoji_<?= $index + 1 ?>" class="emoji-label"><?= $emoji ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Section -->
    <div class="page-section">
        <h3>Fragen</h3>

        <div class="questions-card" id="questions-container">
            <?php if ($editing && !empty($category['questions'])): ?>
                <?php foreach ($category['questions'] as $index => $question): ?>
                    <div class="question-block" data-question="<?= $index ?>">
                        <div class="question-header">
                            <h4>Frage <?= $index + 1 ?></h4>
                            <button type="button" onclick="removeQuestion(this)" class="btn btn-remove btn-small">x</button>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fragentext</label>
                            <input type="text" name="questions[<?= $index ?>][question]" required class="form-input"
                                placeholder="Geben Sie hier Ihre Frage ein..."
                                value="<?= htmlspecialchars($question['Frage_Text']) ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Antwortoptionen</label>
                            <span class="form-help">Markiere die richtige Antwort durch Auswahl des entsprechenden Buchstabens</span>
                            <div class="answer-grid">
                                <?php 
                                $correct_index = 0;
                                foreach ($question['answers'] as $i => $answer) {
                                    if ($answer['is_correct']) $correct_index = $i;
                                }
                                ?>
                                <?php for ($i = 0; $i < 4; $i++): ?>
                                    <div class="answer-option">
                                        <div class="answer-option-header">
                                            <input type="radio" name="questions[<?= $index ?>][correct]" value="<?= $i ?>" required 
                                                id="q<?= $index ?>_opt<?= $i ?>" <?= ($correct_index === $i) ? 'checked' : '' ?>>
                                            <label for="q<?= $index ?>_opt<?= $i ?>" class="option-label"><?= chr(65 + $i) ?></label>
                                        </div>
                                        <input type="text" name="questions[<?= $index ?>][options][<?= $i ?>]" required
                                            placeholder="<?= ['Erste', 'Zweite', 'Dritte', 'Vierte'][$i] ?> Antwortoption" 
                                            class="form-input form-input-small"
                                            value="<?= isset($question['answers'][$i]) ? htmlspecialchars($question['answers'][$i]['Antworttext']) : '' ?>">
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Initial question for new category -->
                <div class="question-block" data-question="0">
                    <div class="question-header">
                        <h4>Frage 1</h4>
                        <button type="button" onclick="removeQuestion(this)" class="btn btn-remove btn-small">x</button>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fragentext</label>
                        <input type="text" name="questions[0][question]" required class="form-input"
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
                                <input type="text" name="questions[0][options][0]" required
                                    placeholder="Erste Antwortoption" class="form-input form-input-small">
                            </div>
                            <div class="answer-option">
                                <div class="answer-option-header">
                                    <input type="radio" name="questions[0][correct]" value="1" required id="q0_opt1">
                                    <label for="q0_opt1" class="option-label">B</label>
                                </div>
                                <input type="text" name="questions[0][options][1]" required
                                    placeholder="Zweite Antwortoption" class="form-input form-input-small">
                            </div>
                            <div class="answer-option">
                                <div class="answer-option-header">
                                    <input type="radio" name="questions[0][correct]" value="2" required id="q0_opt2">
                                    <label for="q0_opt2" class="option-label">C</label>
                                </div>
                                <input type="text" name="questions[0][options][2]" required
                                    placeholder="Dritte Antwortoption" class="form-input form-input-small">
                            </div>
                            <div class="answer-option">
                                <div class="answer-option-header">
                                    <input type="radio" name="questions[0][correct]" value="3" required id="q0_opt3">
                                    <label for="q0_opt3" class="option-label">D</label>
                                </div>
                                <input type="text" name="questions[0][options][3]" required
                                    placeholder="Vierte Antwortoption" class="form-input form-input-small">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <center>
            <button type="button" onclick="addQuestion()" class="btn btn-primary">
                Frage hinzufügen
            </button>
        </center>
    </div>

    <!-- Action Buttons -->
    <div class="form-actions">
        <button type="button" onclick="window.location.href='alleKategorien.php'" class="btn btn-secondary">
            Abbrechen
        </button>
        <?php if ($editing): ?>
            <button type="submit" name="delete_category" class="btn btn-danger" 
                onclick="return confirm('Sind Sie sicher, dass Sie diese Kategorie löschen möchten?')">
                Kategorie löschen
            </button>
        <?php endif; ?>
        <button type="submit" name="save_category" class="btn btn-primary">
            Kategorie speichern
        </button>
    </div>
</form>

<script>
    let questionCount = <?= $editing ? count($category['questions'] ?? []) : 1 ?>;

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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.category-form');

        form.addEventListener('submit', function (e) {
            // Skip validation for delete
            if (e.submitter && e.submitter.name === 'delete_category') {
                return true;
            }

            // Check if emoji is selected
            const emojiRadios = document.querySelectorAll('input[name="category_icon"]');
            const isEmojiSelected = Array.from(emojiRadios).some(radio => radio.checked);
            if (!isEmojiSelected) {
                e.preventDefault();
                alert('Bitte wählen Sie ein Emoji für Ihre Kategorie aus.');
                return false;
            }

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
        width: 100%;
        max-width: none;
    }

    /* Form inputs - ensure full width */
    .category-form .form-input {
        width: 100%;
        max-width: none;
        box-sizing: border-box;
    }

    /* Emoji selection grid */
    .emoji-grid {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: var(--spacing-xs);
        margin-top: var(--spacing-xs);
        width: 100%;
    }

    .emoji-option {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .emoji-label {
        background: var(--background);
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: var(--spacing-sm);
        font-size: 24px;
        cursor: pointer;
        transition: all var(--transition-fast);
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 50px;
        width: 100%;
    }

    .emoji-label:hover {
        border-color: var(--primary-color);
        background: var(--background-hover);
        transform: translateY(-2px);
    }

    .emoji-option input[type="radio"]:checked + .emoji-label {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: var(--text-primary);
        transform: scale(1.05);
    }

    .emoji-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
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

    .answer-option input[type="radio"]:checked+.option-label {
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

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: 1px solid #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Animation for question removal */
    .question-block {
        transition: all var(--transition-medium);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .category-form {
            width: 100%;
            padding: 0;
        }

        .category-form .form-input {
            width: 100%;
            max-width: none;
        }

        .emoji-grid {
            grid-template-columns: repeat(5, 1fr);
            gap: var(--spacing-xs);
        }

        .emoji-label {
            padding: var(--spacing-xs);
            font-size: 20px;
            min-height: 40px;
        }

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
            gap: var(--spacing-md);
        }

        .form-actions .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .category-form {
            width: 100%;
            padding: 0;
        }

        .category-form .form-input {
            width: 100%;
            max-width: none;
        }

        .emoji-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .emoji-label {
            font-size: 18px;
            padding: var(--spacing-xs);
            min-height: 35px;
        }
    }

    /* Enhanced visual feedback */
    .question-block.error {
        border-color: #ff4444 !important;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
    }
</style>