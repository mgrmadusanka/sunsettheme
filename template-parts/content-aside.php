<?php 
    /*
        This is the template for display aside post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetAsidePostFormat'); ?>>
    <div class="asideContent">
        <div class="asideProPicContainer">
            <div class="asideProPic" style="background-image: url('<?php echo sunsetGetAttachment(); ?>')"></div>
        </div>

        <div class="asideMessage">
            <div class="postMeta">
                <?php echo sunsetPostedMeta(); ?>
            </div>

            <div class="asideExcerpt">
                <p>
                    <?php echo get_the_excerpt() . '<a href="'.esc_url(get_permalink()).'" rel="bookmark"> Read More &raquo;</a>'; ?>
                </p>
            </div>
        </div>
    </div>

    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>