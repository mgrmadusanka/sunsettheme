<?php 
    /*
        This is the template for display single page
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="postHeader">
        <?php the_title('<h1 class="pageTitle">', '</h1>'); ?>
    </header>

    <div class="postContent">
        <div class="postExcerpt">
            <?php the_content(); ?>
        </div>
    </div>
</article>