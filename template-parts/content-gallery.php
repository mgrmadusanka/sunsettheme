<?php 
    /*
        This is the template for display gallery post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetGalleryPostFormat'); ?>>
    <header class="postHeader">
        <?php if(sunsetGetAttachment()): ?>
            <div class="postGallery">
                <div class="owl-carousel">
                    <?php 
                        $attachments = sunsetGetAttachment(7);  
                        $count = count($attachments);
                        for($i = 0; $i < $count; $i++ ): ?>
                            <div class="image" style="background-image: url('<?php echo wp_get_attachment_url( $attachments[$i]->ID ); ?>');"></div>
                        <?php endfor;
                    ?>
                </div>
            </div>
        <?php endif; ?>
  
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