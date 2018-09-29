<?php 
    /*
        This is the template for the single post
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
                        //save post view count
                        sunsetSavePostViews(get_the_ID());
                        
                        get_template_part('template-parts/single', get_post_format());

                        if(comments_open()):
                            comments_template();
                        endif;
                    endwhile;
                endif;
            ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>