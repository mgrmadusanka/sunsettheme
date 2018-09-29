<?php
//enqueue scripts and styles for sunset custom admin page
function sunsetEnqueueAdminScripts($hook) {
    if($hook != 'toplevel_page_sunset_theme'):
        return;
    endif;

    //stylesheets
    wp_register_style(
        'sunsetAdminStyle',
        get_template_directory_uri() . '/css/sunset.admin.css',
        array(),
        '1.0.0',
        'all'
    );
    wp_enqueue_style('sunsetAdminStyle');

    //javascripts
    wp_register_script(
        'sunsetAdminJS',
        get_template_directory_uri() . '/js/sunset.admin.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script('sunsetAdminJS');

    //enqueues all scripts and styles necessary to media uploader
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'sunsetEnqueueAdminScripts');


//enqueue scripts and styles for sunset front end
function sunsetEnqueueFrontendScripts() {
    wp_enqueue_style(
        'sunset',
        get_template_directory_uri() . '/css/sunset.css',
        array(),
        '1.0.0',
        'all'
    );

    wp_deregister_script('jquery');
    wp_register_script(
        'jquery',
        get_template_directory_uri() . '/js/jquery-3.3.1.min.js',
        false,
        '3.3.1',
        true
    );
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'owl',
        get_template_directory_uri() . '/js/owl.carousel.min.js',
        array(),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'sunset',
        get_template_directory_uri() . '/js/sunset.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'sunsetEnqueueFrontendScripts');