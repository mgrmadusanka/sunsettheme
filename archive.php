<?php 
    /*
        This is the template for the archive page
        @package sunsettheme
    */
?>

<?php get_header(); ?>

<div class="primaryContainer">
    <main class="main" id="main" role="main">
        <div class="postsContainer">
            <?php 
                if(have_posts()):
            ?>
            
                <header class="archiveHeader textCenter">
                    <?php the_archive_title('<h1 class="pageTitle">', '</h1>'); ?>
                </header>

            <?php
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