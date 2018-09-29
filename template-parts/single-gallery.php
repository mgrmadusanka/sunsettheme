<?php 
    /*
        This is the template for display gallery single post
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetGalleryPostFormat'); ?>>
    <header class="postHeader">
        <?php the_title('<h2 class="postTitle"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h2>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>
    </header>

    <div class="postContentContainer">
        <div class="postContent">
            <?php the_content(); ?>
        </div>
    </div>

    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>