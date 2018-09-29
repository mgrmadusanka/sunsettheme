<?php 
    /*
        This is the template for display sinlge image post
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="postHeader">
        <?php the_title('<h2 class="postTitle">', '</h2>'); ?>

        <div class="postMeta">
            <?php echo sunsetPostedMeta(); ?>
        </div>
    </header>

    <div class="postContentContainer">
        <?php if(sunsetGetAttachment()): ?>
            <div class="postTumbnail" style="background-image: url('<?php echo sunsetGetAttachment(); ?>')">
            </div>
        <?php endif; ?>

        <div class="postContent">
            <?php the_content(); ?>
        </div>
    </div>

    <footer class="postFooter">
        <?php echo sunsetPostedFooter(); ?>
    </footer>
</article>