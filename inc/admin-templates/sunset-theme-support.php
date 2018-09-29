<h1>Sunset Theme Support</h1>

<?php settings_errors(); ?>

<form action="options.php" method="POST" class="sunsetAdminGeneralForm">
    <?php settings_fields('sunset-theme-support-group'); ?>
    <?php do_settings_sections('sunset_theme_support'); ?>
    <?php submit_button(); ?>
</form>