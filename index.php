<?php 
    /*
        This is the template for the post page
        @package sunsettheme
    */
?>

<?php get_header(); ?>

<div class="primaryContainer">
    <main class="main" id="main" role="main">
        <div class="postsContainer">
            <?php 
                if(have_posts()):
                    echo '<div class="pageLimit">';

                    while(have_posts()): the_post();
                        get_template_part('template-parts/content', get_post_format());
                    endwhile;

                    echo '</div>';
                else:
                    echo '<h3>No posts to show.</h3>';
                endif;
            ?>
        </div>

        <?php the_posts_pagination( array(
            'prev_text' => 'Prev',
            'next_text' => 'Next',
            'screen_reader_text' => ' '
        ) ); ?>
    </main>
</div>

<?php get_footer(); ?>