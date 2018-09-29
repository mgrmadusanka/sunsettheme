<h1>Sunset Sidebar Options</h1>
<?php settings_errors(); ?>

<?php
    $picture = esc_attr(get_option('profilePicture'));
    $firstName = esc_attr(get_option('firstName'));
    $lastName = esc_attr(get_option('lastName'));
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr(get_option('description'));

    $twitter = esc_attr(get_option('twitterHandler'));
    $facebook = esc_attr(get_option('facebookHandler'));
    $google = esc_attr(get_option('googlePlusHandler'));
?>

<form action="options.php" method="POST" class="sunsetAdminGeneralForm">
    <?php settings_fields('sunset-settings-group'); ?>
    <?php do_settings_sections('sunset_theme'); ?>
    <?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>

<div class="sunsetSidebarPreview">
    <div class="sunsetSidebar">
        <div class="sunsetProPicContainer">
            <div id="sunsetProPicPrev" class="sunsetProPicPrev" style="background-image: url('<?php print $picture; ?>');"></div>
        </div>
        <h1 class="sunsetAuthorName"><?php print $fullName; ?></h1>
        <h2 class="sunsetDescription"><?php print $description; ?></h2>
        <div class="socialMedia">
            <?php if(!empty($twitter)): ?>
                <span class="dashicons-before dashicons-twitter"></span>
            <?php endif; ?>
            <?php if(!empty($facebook)): ?>
                <span class="dashicons-before dashicons-facebook"></span>
            <?php endif; ?>
            <?php if(!empty($google)): ?>
                <span class="dashicons-before dashicons-googleplus"></span>
            <?php endif; ?>
        </div>
    </div>
</div>