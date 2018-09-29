<?php
//contact form shortcode
function sunsetContactForm($atts, $content = null) {
    //[contact_form]

    //get the attributes
    $atts = shortcode_atts(
        array(),
        $atts,
        'contact_form'
    );

    //return HTML
    ob_start();
    include 'templates/contact-form.php';
    return ob_get_clean();
}
add_shortcode('contact_form', 'sunsetContactForm');