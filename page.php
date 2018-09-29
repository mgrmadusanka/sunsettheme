<?php 
    /*
        This is the template for the display single page
        @package sunsettheme
    */
?>

<?php get_header(); ?>

<div class="primaryContainer">
    <main class="main" id="main" role="main">
        <div class="postsContainer">
            <?php 
                if(have_posts()):
                    while(have_posts()): the_post();
                        get_template_part('template-parts/content', 'page');
                    endwhile;
                else:
                    echo '<h3>No posts to show.</h3>';
                endif;
            ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>