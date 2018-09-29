<h1>Sunset Contact Form</h1>

<?php settings_errors(); ?>

<p>Use this <strong>shortcode</strong> to activate the Contact Form inside a Page or a Post</p>
<code>[contact_form]</code>

<form action="options.php" method="POST" class="sunsetAdminGeneralForm">
    <?php settings_fields('sunset-manage-contact-form-group'); ?>
    <?php do_settings_sections('sunset_theme_manage_contact_form'); ?>
    <?php submit_button(); ?>
</form>