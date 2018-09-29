<?php
//post format
$options = get_option('sunsetPostFormats');
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach($formats as $format):
    $output[] = (@$options[$format] == 1 ? $format : '');
endforeach;
if(!empty($options)) :
    add_theme_support('post-formats', $output);
endif;

//custom header
$header = get_option('sunsetCustomHeader');
if(@$header == 1) :
    add_theme_support('custom-header');
endif;

//custom background
$background = get_option('sunsetCustomBackground');
if(@$background == 1) :
    add_theme_support('custom-background');
endif;

//activate navigation menu option
function sunsetRegisterNavMenu() {
    register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'sunsetRegisterNavMenu');

//activate post thumbnail
add_theme_support('post-thumbnails');


//blog loop custom functions
//return post meta data
function sunsetPostedMeta() {
    $postedOn = human_time_diff(get_the_time('U'), current_time('timestamp'));
    $categories = get_the_category();
    $separator = ', ';
    $i = 1;
    $output = '';

    if(!empty($categories)):
        foreach($categories as $category):
            if($i > 1): $output .= $separator; endif;

            $output .= '<a href="'.esc_url(get_category_link($category->term_id)).'"' .
                        'alt="'.esc_attr('View all posts in%s', $category->name).'">' .
                        esc_html($category->name) . '</a>';

            $i++;
        endforeach;
    endif;

    return '<span class="postedOn">Posted <a href="'.esc_url(get_permalink()).'">'.$postedOn.
            '</a> ago</span> / <span class="postedIn">'.$output.'</span>';
}

//return post tag list and comment
function sunsetPostedFooter() {
    $commentsNum = get_comments_number();

    if(comments_open()):
        if($commentsNum == 0):
            $comments = __('No Comments');
        elseif($commentsNum > 1):
            $comments = $commentsNum . __(' Comments');
        else:
            $comments = __('1 Comment');
        endif;

        $comments = __('<span class="sunset-icon sunset-comment"></span><a href="'.get_comments_link().'">'.$comments.'</a>');
    else:
        $comments = __('Comments are closed');
    endif;

    return get_the_tag_list('<div class="postTags"><span class="sunset-icon sunset-tag"></span>', '&nbsp;', '</div>').
            '<div class="postComments">'.
                $comments .
            '</div>';
}

//return feature image link for posts
function sunsetGetAttachment($num = 1) {
    $output = '';

    if(has_post_thumbnail() && $num == 1 ):
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    else:
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => $num,
            'post_parent' => get_the_ID()
        ));

        if($attachments && $num == 1):
            foreach($attachments as $attachment):
                $output = wp_get_attachment_url($attachment->ID);
            endforeach;
        elseif($attachments && $num > 1):
            $output = $attachments;
        endif;

        wp_reset_postdata();
    endif;

    return $output;
}

//return embeded media
function susetGetEmbeddedMedia($type = array()) {
    $content = do_shortcode(apply_filters('the_content', get_the_content()));
    $embed = get_media_embedded_in_content($content, $type);

    if(in_array('audio', $type)):
        $output = str_replace('visual=true', 'visual=false', $embed[0]);
    else:
        $output = $embed[0];
    endif;

    return $output;
}

//get url from post
function sunsetGrabUrl() {
    if(! preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $link)):
        return false;
    endif;
    return esc_url_raw($link[1]);
}

//share post
function sunsetShareThis($content) {
    if(is_single()):
        $content .= '<div class="sunsetShareThis"><h4>Share This On : </h4>';

        $title = get_the_title();
        $permalink = get_permalink();

        $twitterHandler = (get_option('twitterHandler') ? '&amp;via=' . esc_attr(get_option('twitterHandler')) : '');

        $twitter = 'https://twitter.com/intent/tweet?text=Hey! read this : ' . $title . '&amp;url=' . $permalink . $twitterHandler;
        $facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
        $google = 'https://plus.google.com/share?url=' . $permalink;

        $content .= '<ul>';
        $content .= '<li><a href="' .$twitter . '" target="_blank" rel="nofollow"><span class="sunset-icon sunset-twitter"></span></a></li>';
        $content .= '<li><a href="' .$facebook . '" target="_blank" rel="nofollow"><span class="sunset-icon sunset-facebook"></span></a></li>';
        $content .= '<li><a href="' .$google . '" target="_blank" rel="nofollow"><span class="sunset-icon sunset-googleplus"></span></a></li>';
        $content .= '</ul></div>';

        return $content;
    else:
        return $content;
    endif;
}
add_filter('the_content', 'sunsetShareThis');

function sunsetGetPostNavigation() {
    if(get_comment_pages_count() > 1 && get_option('page_comments')):
        require(get_template_directory() . '/inc/templates/sunset-comments-nav.php');
    endif;
}

function sunsetSidebarInit() {
    register_sidebar(array(
        'name'          => esc_html__('Sunset Sidebar', 'sunsettheme'),
        'id'            => 'sunset-sidebar',
        'Description'   => 'Dynamic Right Sidebar',
        'before_widget' => '<section id="%1$s" class="sunsetWidget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="sunsetWidgetTitle">',
        'after_title'   => '</h2>'
    ));
}
add_action('widgets_init', 'sunsetSidebarInit');