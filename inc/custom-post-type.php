<?php
$contactFrm = get_option('activateSunsetContactForm');
if(@$contactFrm == 1) :
    add_action('init', 'createSunsetContactCustomPostType');

    add_filter('manage_sunset-contact_posts_columns', 'manageSunsetContactColumns');
    add_action('manage_sunset-contact_posts_custom_column', 'customizeSunsetContactColumns', 10, 2);

    add_action('add_meta_boxes', 'createSunsetContactEmailMetaBox');
    add_action('save_post', 'sunsetSaveContactEmailData');
endif;

function createSunsetContactCustomPostType() {
    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message'
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email',
        'supports'          => array('title', 'editor', 'author')
    );

    register_post_type('sunset-contact', $args);
}

function manageSunsetContactColumns($columns) {
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';

    return $newColumns;
}

function customizeSunsetContactColumns($column, $postId) {
    switch($column) {
        case 'message' :
            echo get_the_excerpt();
        break;

        case 'email' :
            $email = get_post_meta($postId, '_sunsetContactEmailValueKey', true);
            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
        break;
    }
}

//create custom meatabaox for email address
function createSunsetContactEmailMetaBox() {
    add_meta_box(
        'sunsetContactEmailMetaBox', 
        'User Email', 
        'sunsetContactEmailMetaBoxCallback',
        'sunset-contact',
        'side'
    );
}

function sunsetContactEmailMetaBoxCallback($post) {
    wp_nonce_field(
        'sunsetSaveContactEmailData',
        'sunsetContactEmailMetaBoxNonce'
    );

    $value = get_post_meta($post->ID, '_sunsetContactEmailValueKey', true);

    echo '<label for="sunsetContactEmailField">User Email Address </label>';
    echo '<input type="email" id="sunsetContactEmailField" name="sunsetContactEmailField" value="'.esc_attr($value).'" size="25"/>';
}

function sunsetSaveContactEmailData($post_id) {
    if(!isset($_POST['sunsetContactEmailMetaBoxNonce'])) :
        return;
    endif;

    if(!wp_verify_nonce($_POST['sunsetContactEmailMetaBoxNonce'], 'sunsetSaveContactEmailData')) :
        return;
    endif;

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) :
        return;
    endif;

    if(!current_user_can('edit_post', $post_id)) :
        return;
    endif;

    if(!isset($_POST['sunsetContactEmailField'])) :
        return;
    endif;

    $sunsetContactEmail = sanitize_text_field($_POST['sunsetContactEmailField']);

    update_post_meta($post_id, '_sunsetContactEmailValueKey', $sunsetContactEmail);
}