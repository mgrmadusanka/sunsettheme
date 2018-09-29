<?php
//custom admin page functions

//sunset custom admin page
function sunsetAddAdminPage() {
    //create sunset custom admin page
    add_menu_page(
        'Sunset Theme Options',
        'Sunset',
        'manage_options',
        'sunset_theme',
        'sunsetCreateAdminPage',
        get_template_directory_uri() . '/img/sunset-icon.png',
        110
    );

    //create sunset sidebar options page (first page of the sunset custom admin)
    add_submenu_page(
        'sunset_theme',
        'Sunset Sidebar Options',
        'Sidebar',
        'manage_options',
        'sunset_theme',
        'sunsetCreateAdminPage'
    );

    //create sunset theme options sub page
    add_submenu_page(
        'sunset_theme',
        'Sunset Theme Support',
        'Theme Support',
        'manage_options',
        'sunset_theme_support',
        'sunsetCreateThemeSupportPage'
    );

    //create sunset theme contact sub page
    add_submenu_page(
        'sunset_theme',
        'Sunset Contact Page',
        'Contact Form',
        'manage_options',
        'sunset_theme_manage_contact_form',
        'sunsetCreateManageContactForm'
    );

    //activate custom admin settings
    add_action('admin_init', 'sunsetCustomAdminSettings');
}
add_action('admin_menu', 'sunsetAddAdminPage');

//create custom admin page
function sunsetCreateAdminPage() {
    require_once (get_template_directory() . '/inc/admin-templates/sunset-admin.php');
}

//create sunset theme support sub page
function sunsetCreateThemeSupportPage() {
    require_once (get_template_directory() . '/inc/admin-templates/sunset-theme-support.php');
}

//create sunset theme manage contact form sub page
function sunsetCreateManageContactForm() {
    require_once (get_template_directory() . '/inc/admin-templates/sunset-theme-manage-contact-form.php');
}

//create custom admin settings
function sunsetCustomAdminSettings() {
    //create section for sunset sidebar options
    add_settings_section(
        'sunset-sidebar-options', 
        'Sidebar Options',
        'sunsetSidebarOptions', 
        'sunset_theme'
    );

    //register sunset custom sidebar settings
    register_setting('sunset-settings-group', 'profilePicture');
    register_setting('sunset-settings-group', 'firstName');
    register_setting('sunset-settings-group', 'lastName');
    register_setting('sunset-settings-group', 'description');
    register_setting('sunset-settings-group', 'twitterHandler', 'sunsetSanitizeTwitterHandler');
    register_setting('sunset-settings-group', 'facebookHandler');
    register_setting('sunset-settings-group', 'googlePlusHandler');

    //create fields for sunset sidebar options section
    add_settings_field(
        'sidebar-profile-picture',
        'Profile Picture',
        'sunsetProfilePicture',
        'sunset_theme',
        'sunset-sidebar-options'
    );
    add_settings_field(
        'sidebar-name',
        'Full Name',
        'sunsetSidebarName',
        'sunset_theme',
        'sunset-sidebar-options'
    );
    add_settings_field(
        'sidebar-description',
        'Description',
        'sunsetSidebarDescription',
        'sunset_theme',
        'sunset-sidebar-options'
    );
    add_settings_field(
        'sidebar-twitter',
        'Twitter Handler',
        'sunsetSidebarTwitter',
        'sunset_theme',
        'sunset-sidebar-options'
    );
    add_settings_field(
        'sidebar-facebook',
        'Facebook Handler',
        'sunsetSidebarFacebook',
        'sunset_theme',
        'sunset-sidebar-options'
    );
    add_settings_field(
        'sidebar-google-plus',
        'Google+ Handler',
        'sunsetSidebarGooglePlus',
        'sunset_theme',
        'sunset-sidebar-options'
    );


    //create section for sunset theme support
    add_settings_section(
        'sunset-theme-support-section',
        'Theme Support',
        'sunsetThemeSupportSectionCallback',
        'sunset_theme_support'
    );

    //register sunset theme support settings
    register_setting('sunset-theme-support-group', 'sunsetPostFormats');
    register_setting('sunset-theme-support-group', 'sunsetCustomHeader');
    register_setting('sunset-theme-support-group', 'sunsetCustomBackground');

    //create fields for sunset theme support
    add_settings_field(
        'sunset-post-formats',
        'Post Formats',
        'sunsetPostFormatCallback',
        'sunset_theme_support',
        'sunset-theme-support-section'
    );
    add_settings_field(
        'sunset-custom-header',
        'Custom Header',
        'sunsetCustomHeaderCallback',
        'sunset_theme_support',
        'sunset-theme-support-section'
    );
    add_settings_field(
        'sunset-custom-background',
        'Custom Background',
        'sunsetCustomBackgroundCallback',
        'sunset_theme_support',
        'sunset-theme-support-section'
    );


    //create section for sunset manage contact form
    add_settings_section(
        'sunset-manage-contact-form-section',
        'Manage Contact Form',
        'sunsetManageContactFormSectionCallback',
        'sunset_theme_manage_contact_form'
    );

    //register sunset theme manage contact form settings
    register_setting('sunset-manage-contact-form-group', 'activateSunsetContactForm');

    //create fields for sunset manage contact form
    add_settings_field(
        'sunset-custom-contact-form',
        'Activate Contact Form',
        'activateSunsetContactFormCallback',
        'sunset_theme_manage_contact_form',
        'sunset-manage-contact-form-section'
    );
}


// ============================ callback functions of sunset sidebar ============================

//callback function of sunset sidebar section
function sunsetSidebarOptions() {
    echo 'Customize your sidebar information';
}

//callback functions of sunset sidebar options fields
function sunsetProfilePicture() {
    $picture = esc_attr(get_option('profilePicture'));
    if(empty($picture)) :
        echo '<input type="button" value="Upload Profile Picture" id="uploadSunsetProPic" class="button button-secondary" />' .
             '<input id="sunsetProPic" type="hidden" name="profilePicture" value="'. $picture .'" />';
    else :
        echo '<input type="button" value="Replace Profile Picture" id="uploadSunsetProPic" class="button button-secondary" />' .
             '&nbsp;<input type="button" value="Remove" id="removeSunsetProPic" class="button button-secondary" />' .
             '<input id="sunsetProPic" type="hidden" name="profilePicture" value="'. $picture .'" />';
    endif;
}

function sunsetSidebarName() {
    $firstName = esc_attr(get_option('firstName'));
    $lastName = esc_attr(get_option('lastName'));
    echo '<input type="text" name="firstName" value="'. $firstName .'" placeholder="First Name" />'.
         '<input type="text" name="lastName" value="'. $lastName .'" placeholder="Last Name" />';
}

function sunsetSidebarDescription() {
    $description = esc_attr(get_option('description'));
    echo '<input type="text" name="description" value="'. $description .'" placeholder="Description" />' .
         '<p class="description">Write something smart.</p>';
}

function sunsetSidebarTwitter() {
    $twitter = esc_attr(get_option('twitterHandler'));
    echo '<input type="text" name="twitterHandler" value="'. $twitter .'" placeholder="Twitter Handler" />' .
         '<p class="description">Input your twitter username without the @ character</p>';
}
//sanitization twitter handler
function sunsetSanitizeTwitterHandler($input) {
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}

function sunsetSidebarFacebook() {
    $facebook = esc_attr(get_option('facebookHandler'));
    echo '<input type="text" name="facebookHandler" value="'. $facebook .'" placeholder="Facebook Handler" />';
}

function sunsetSidebarGooglePlus() {
    $google = esc_attr(get_option('googlePlusHandler'));
    echo '<input type="text" name="googlePlusHandler" value="'. $google .'" placeholder="Google+ Handler" />';
}


// ============================ callback functions of sunset theme support ============================

//callback function of sunset theme support section
function sunsetThemeSupportSectionCallback() {
    echo 'Activate and Deactivate specific Theme Support Options';
}

//callback functions of sunset theme support
function sunsetPostFormatCallback() {
    $options = get_option('sunsetPostFormats');

    $output = '';
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    foreach($formats as $format):
        $checked = (@$options[$format] == 1 ? 'checked' : '');
        $output .= '<label> '.
                        '<input type="checkbox" '.$checked.' id="'.$format.'" name="sunsetPostFormats['.$format.']" value="1" />'.$format.
                    '</label> <br/>';
    endforeach;

    echo $output;
}

function sunsetCustomHeaderCallback() {
    $header = get_option('sunsetCustomHeader');
    $checked = (@$header == 1 ? 'checked' : '');

    echo '<label>' .
         '<input type="checkbox" '.$checked.' id="sunsetCustomHeader" name="sunsetCustomHeader" value="1" />Activate the Custom Header' .
         '</label>';
}

function sunsetCustomBackgroundCallback() {
    $background = get_option('sunsetCustomBackground');
    $checked = (@$background == 1 ? 'checked' : '');

    echo '<label>' .
         '<input type="checkbox" '.$checked.' id="sunsetCustomBackground" name="sunsetCustomBackground" value="1" />Activate the Custom Background' .
         '</label>';
}


// ============================ callback functions of sunset theme manage contact form ============================

//callback function of sunset theme manage contact form section
function sunsetManageContactFormSectionCallback() {
    echo 'Activate and Deactivate the Build-in Contact Form';
}

//callback functions of sunset manage contact form settings fields
function activateSunsetContactFormCallback() {
    $contactFrm = get_option('activateSunsetContactForm');
    $checked = (@$contactFrm == 1 ? 'checked' : '');

    echo '<label>' .
         '<input type="checkbox" '.$checked.' id="activateSunsetContactForm" name="activateSunsetContactForm" value="1" />' .
         '</label>';
}