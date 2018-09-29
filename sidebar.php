<?php 
    /*
        This is the template for the sidebar
        @package sunsettheme
    */
?>

<?php 
    if(!is_active_sidebar('sunset-sidebar')):
        return;
    endif;
?>

<aside id="sunsetRightSidebar">
    <?php dynamic_sidebar('sunset-sidebar'); ?>
</aside> <!-- #sunsetRightSidebar -->