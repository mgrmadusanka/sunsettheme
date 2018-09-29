<?php 
    /*
        This is the template for the header
        @package sunsettheme
    */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta <?php bloginfo('charset'); ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); wp_title('|'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri().'/favicon.png' ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="sunsetSidebar sidebarClosed">
    <div class="sunsetSidebarContainer">
        <a id="sunsetCloseRightSidebar" class="sidebarClose jsSidebarToggle">
            <span class="sunset-icon sunset-close"></span>
        </a>
        <div class="sidebarScroll">
            <?php get_sidebar(); ?>
        </div> <!-- .sidebarScroll -->
    </div> <!-- .sunsetSidebarContainer -->
</div> <!-- .sunsetSidebar -->

<div class="sidebarOverlay jsSidebarToggle"></div>

<header class="pageHeader" style="background-image: url(<?php header_image(); ?>)">
    <a id="sunsetOpenRightSidebar" class="sidebarOpen jsSidebarToggle">
        <span class="sunset-icon sunset-menu"></span>
    </a>

    <div class="headerContent">
        <h1 class="siteTitle">
            <span class="hide"><?php bloginfo('name'); ?></span>
            <span class="sunset-icon sunset-logo"></span>
        </h1>
        <h2 class="siteDescription"><?php bloginfo('description'); ?></h2>
    </div>

    <nav class="headerNav">
        <?php 
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'headerNavLinks'
            ));
        ?>
    </nav>
</header>
