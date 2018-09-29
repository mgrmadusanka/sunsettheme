<?php 
    /*
        This is the template for the display 404 page
        @package sunsettheme
    */
?>

<?php get_header(); ?>

<div class="primaryContainer">
    <main class="main" id="main" role="main">
        <div class="postsContainer">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="postHeader">
                    <h1 class="pageTitle">404<br>Page Not Found</h1>
                </header>
            </article>
        </div>
    </main>
</div>

<?php get_footer(); ?>