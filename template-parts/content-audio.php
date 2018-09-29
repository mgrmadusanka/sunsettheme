<?php 
    /*
        This is the template for display audio post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetAudioPostFormat'); ?>>
    <header class="postHeader">
        <?php the_title('<h2 class="postTitle"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>
    </header>

    <div class="postContent">
        <?php echo susetGetEmbeddedMedia(array('audio', 'iframe')); ?>
    </div>

    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>