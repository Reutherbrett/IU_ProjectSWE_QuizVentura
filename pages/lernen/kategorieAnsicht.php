<?php
/**
 * View Category Page - Display all questions of a quiz category
 */

// Get category ID from URL parameter
$category_id = $_GET['id'] ?? 1;

// Sample data - replace with actual database fetch
$category = [
    'id' => $category_id,
    'name' => 'Geschichte-Quiz',
    'icon' => '📚',
    'questions' => [
        [
            'id' => 1,
            'question' => 'Wann wurde die Berliner Mauer gebaut?',
            'options' => [
                'A' => '1959',
                'B' => '1961',
                'C' => '1963',
                'D' => '1965'
            ],
            'correct' => 'B'
        ],
        [
            'id' => 2,
            'question' => 'Wer war der erste Bundeskanzler der BRD?',
            'options' => [
                'A' => 'Willy Brandt',
                'B' => 'Ludwig Erhard',
                'C' => 'Konrad Adenauer',
                'D' => 'Helmut Schmidt'
            ],
            'correct' => 'C'
        ],
        [
            'id' => 3,
            'question' => 'In welchem Jahr endete der Zweite Weltkrieg?',
            'options' => [
                'A' => '1944',
                'B' => '1945',
                'C' => '1946',
                'D' => '1947'
            ],
            'correct' => 'B'
        ]
    ]
];
?>

<div class="page-header">
    <h2><?= htmlspecialchars($category['icon']) ?> <?= htmlspecialchars($category['name']) ?></h2>
    <p>Übersicht aller Fragen dieser Kategorie mit den korrekten Antworten.</p>
</div>

<div class="page-section">
    <h3>Fragen (<?= count($category['questions']) ?>)</h3>
    
    <div class="questions-container">
        <?php foreach ($category['questions'] as $index => $question): ?>
            <div class="question-view-block">
                <div class="question-view-header">
                    <h4>Frage <?= $index + 1 ?></h4>
                </div>
                
                <div class="question-text">
                    <p><strong><?= htmlspecialchars($question['question']) ?></strong></p>
                </div>
                
                <div class="answer-view-grid">
                    <?php foreach ($question['options'] as $letter => $option): ?>
                        <div class="answer-view-option <?= $letter === $question['correct'] ? 'correct-answer' : '' ?>">
                            <div class="answer-view-label">
                                <span class="option-label-view"><?= $letter ?></span>
                            </div>
                            <div class="answer-view-text">
                                <?= htmlspecialchars($option) ?>
                                <?php if ($letter === $question['correct']): ?>
                                    <span class="correct-indicator">✓ Richtige Antwort</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Action Buttons -->
<div class="form-actions">
    <button type="button" onclick="window.location.href='alleKategorien.php'" class="btn btn-secondary">
        Zurück zur Übersicht
    </button>
    <button type="button" onclick="window.location.href='bearbeiteKategorie.php?id=<?= $category_id ?>'" class="btn btn-primary">
        Kategorie bearbeiten
    </button>
</div>

<style>
/* Page-specific styles for category view */
.questions-container {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-lg);
}

.question-view-block {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: var(--spacing-xl);
}

.question-view-header {
    margin-bottom: var(--spacing-md);
}

.question-view-header h4 {
    color: var(--primary-color);
    margin-bottom: 0;
}

.question-text {
    margin-bottom: var(--spacing-lg);
    padding: var(--spacing-md);
    background: rgba(242, 100, 25, 0.05);
    border-left: 4px solid var(--primary-color);
    border-radius: var(--border-radius-small);
}

.question-text p {
    margin-bottom: 0;
    font-size: 16px;
}

.answer-view-grid {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
}

.answer-view-option {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    padding: var(--spacing-md);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-small);
    transition: all var(--transition-fast);
}

.answer-view-option.correct-answer {
    background: rgba(40, 167, 69, 0.1);
    border-color: #28a745;
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.1);
}

.option-label-view {
    font-weight: 600;
    color: var(--text-secondary);
    background: var(--background);
    border: 2px solid var(--border-color);
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.correct-answer .option-label-view {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

.answer-view-text {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.correct-indicator {
    color: #28a745;
    font-weight: 600;
    font-size: 14px;
    margin-left: var(--spacing-md);
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: var(--spacing-md);
    margin-top: var(--spacing-xxl);
    padding-top: var(--spacing-xl);
    border-top: 1px solid var(--border-color);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .question-view-block {
        padding: var(--spacing-lg);
    }
    
    .answer-view-option {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-sm);
    }
    
    .answer-view-text {
        width: 100%;
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }
    
    .correct-indicator {
        margin-left: 0;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>