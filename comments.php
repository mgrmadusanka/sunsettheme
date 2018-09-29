<?php 
    /*
        This is the template for the comments
        @package sunsettheme
    */
?>

<?php 
    if(post_password_required()):
        return;
    endif;
?>

<div class="commentsArea">
    <?php if(have_comments()): ?>
        <h3 class="commentsTitle">
            <?php 
                printf(
                    esc_html(
                        _nx(
                            'One comment on &ldquo;%2$s&rdquo;',
                            '%1$s comments on &ldquo;%2$s&rdquo;',
                            get_comments_number(),
                            'comments title',
                            'sunsettheme'
                        )
                    ),
                    number_format_i18n(get_comments_number()),
                    '<span>' . get_the_title() . '</span>'
                );
            ?>
        </h3>

        <?php sunsetGetPostNavigation(); ?>

        <ol class="commentsList">
            <?php 
                wp_list_comments(array(
                    'walker'            => null,
                    'max_depth'         => '',
                    'style'             => 'ol',
                    'callback'          => null,
                    'end-callback'      => null,
                    'type'              => 'all',
                    'page'              => '',
                    'per_page'          => '',
                    'avatar_size'       => 64,
                    'reverse_top_level' => null,
                    'reverse_children'  => '',
                    'format'            => 'html5',
                    'short_ping'        => false,
                    'echo'              => true
                ));
            ?>
        </ol>

        <?php sunsetGetPostNavigation(); ?>

        <?php if(!comments_open() && get_comments_number()): ?>
            <p class="noComments"><?php esc_html_e('Comments are closed', 'sunsettheme'); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php comment_form(); ?>
</div> <!-- .commentsArea -->