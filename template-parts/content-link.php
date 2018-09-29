<?php 
    /*
        This is the template for display Link post format
        @package sunsettheme
    */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sunsetLinkPostFormat'); ?>>
    <header class="postHeader">
        <?php 
            $link = sunsetGrabUrl();
            the_title('<h2 class="postTitle"><a href="'.$link.'" target="_blank">', '</a></h2>'); 
        ?>
        <a href="<?php echo $link ?>" target="_blank"><div class="link"><span class="sunset-icon sunset-link"></span></div></a>      
    </header>
</article>