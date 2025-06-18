<?php
/**
 * QuizVentura Footer
 * Includes JavaScript scripts and closing HTML tags
 */
?>

    </div> <!-- Close .app-container -->

    <!-- Core JavaScript Modules (load in dependency order) -->
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/app.js"></script>
    
    <?php if (isset($additional_scripts) && is_array($additional_scripts)): ?>
        <?php foreach ($additional_scripts as $script): ?>
            <script src="<?php echo htmlspecialchars($script); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>