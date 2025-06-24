<div class="page-header">
<h2>Mitspieler finden</h2>
</div>

  <!-- Spiel beitreten -->
 

  <!-- Neues Spiel erstellen -->
  <div class="page-section">

    <form method="POST" class="category-form">
    <!-- Category Details Section -->
        
        <div class="question-block">
            <div class="form-group">
                <label class="form-label">Spiel ID-Eingeben</label>
                <span class="form-help">Bitte geben Sie Ihre Spiel ID ein oder generieren Sie Ihre eigene</span>
                <input type="text" id="category_name" name="category_name" required class="form-input"
                    placeholder="z.B. #12345">
            </div>

            <div class="form-actions">
            <button type="button" onclick="SpielIDgenerieren()" class="btn btn-primary">
               Eigene ID generieren
            </button>

            <button type="button" onclick="loadPage('pages/spielen/wettkampf_spielen.php')" class="btn btn-primary">
                Spiel Starten
            </button>
            </div>
        </div>

</form>
</div>
</div>

<style>
    .form-actions {
        display: flex;
        justify-content: center;
        gap: var(--spacing-md);
    }

    /* Animation for question removal */
    .question-block {
        transition: all var(--transition-medium);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
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