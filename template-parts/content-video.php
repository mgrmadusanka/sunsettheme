<?php 
    /*
        This is the template for display video post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetVideoPostFormat'); ?>>
    <header class="postHeader">
        <div class="postVideo">
            <?php echo susetGetEmbeddedMedia(array('video', 'iframe')); ?>
        </div>

        <?php the_title('<h2 class="postTitle"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>
    </header>

    <div class="postContent">
        <div class="postExcerpt">
            <?php the_excerpt(); ?>
        </div>

        <div class="postReadMore">
            <a href="<?php the_permalink();  ?>" class="btn btnDefault"><?php _e('Read More'); ?></a>
        </div>
    </div>

    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>