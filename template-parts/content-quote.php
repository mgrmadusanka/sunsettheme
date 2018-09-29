<?php 
    /*
        This is the template for display quote post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetQuotePostFormat'); ?>>
    <header class="postHeader">
        <h2 class="quoteContent"><?php echo get_the_content(); ?></h2>
        <?php the_title('<h3 class="quoteAuthor">- ', ' -</h3>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>
    </header>

    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>