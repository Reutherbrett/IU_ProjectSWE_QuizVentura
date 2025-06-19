<?php
/**
 * QuizVentura Footer
 * Includes JavaScript scripts and closing HTML tags
 */
?>

    </div> <!-- Close .app-container -->
    <script src="assets/js/simple-nav.js"></script>

    <?php if (isset($additional_scripts) && is_array($additional_scripts)): ?>
        <?php foreach ($additional_scripts as $script): ?>
            <script src="<?php echo htmlspecialchars($script); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>