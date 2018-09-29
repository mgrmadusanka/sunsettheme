<?php
add_action('wp_ajax_nopriv_sunsetSaveUserContactFormData', 'sunsetSaveContact');
add_action('wp_ajax_sunsetSaveUserContactFormData', 'sunsetSaveContact');

function sunsetSaveContact() {
    $name = wp_strip_all_tags($_POST["name"]);
    $email = wp_strip_all_tags($_POST["email"]);
    $message = wp_strip_all_tags($_POST["message"]);

    $postID = wp_insert_post(array(
        'post_title'    => $name,
        'post_content'  => $message,
        'post_author'   => 1,
        'post_status'   => 'publish',
        'post_type'     => 'sunset-contact',
        'meta_input'    => array(
            '_sunsetContactEmailValueKey' => $email
        )
    ));

    if($postID != 0):
        $to = get_bloginfo('admin_email');
        $subject = 'Sunset Contact Form - '.$name;

        $headers[] = 'From: '.get_bloginfo('name').' <'.$to.' >';
        $headers[] = 'Reply-To: '.$name.' <'.$email.'>';
        $headers[] = 'Content-Type: text/html: charset=UTF-8';

        wp_mail($to, $subject, $message, $headers);

        echo $postID;
    else:
        echo 0;
    endif;

    die();
}
