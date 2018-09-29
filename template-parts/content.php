<?php 
    /*
        This is the template for display standard post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="postHeader">
        <?php the_title('<h2 class="postTitle"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>
    </header>

    <div class="postContent">
        <?php if(sunsetGetAttachment()): ?>
            <div class="postTumbnail" style="background-image: url('<?php echo sunsetGetAttachment(); ?>')">
            </div>
        <?php endif; ?>

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