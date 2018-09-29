<?php 
    /*
        This is the template for display image format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetImagePostFormat'); ?>>
    <header class="postHeader" style="background-image:url('<?php echo sunsetGetAttachment(); ?>')">
    <?php the_title('<h2 class="postTitle"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>

        <div class="postExcerpt">
            <?php the_excerpt(); ?>
        </div>
    </header>
    
    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>