<?php 

class sunsetProfileWidget extends WP_Widget {
    //setup the widget name, description, etc...
    public function __construct() {
        $widgetOptions = array(
            'classname'     => 'sunsetProfileWidget',
            'description'   => 'Custom Sunset Profile Widget'
        );
        parent::__construct('sunsetProfile', 'Sunset Profile', $widgetOptions);
    }

    //bakck end display of widget
    public function form($instance) {
        echo '<p><strong>No options for this Widget!</strong><br>' .
            'You can control the fields of this Widget from <a href="./admin.php?page=sunset_theme">This Page</a></p>';
    }

    //front end display of widget
    public function widget($args, $instance) {
        $picture = esc_attr(get_option('profilePicture'));
        $firstName = esc_attr(get_option('firstName'));
        $lastName = esc_attr(get_option('lastName'));
        $fullName = $firstName . ' ' . $lastName;
        $description = esc_attr(get_option('description'));

        $twitter = esc_attr(get_option('twitterHandler'));
        $facebook = esc_attr(get_option('facebookHandler'));
        $google = esc_attr(get_option('googlePlusHandler'));

        echo $args['before_widget'];

        ?>

        <div class="sunsetProPicContainer">
            <div id="sunsetProPicPrev" class="sunsetProPicPrev" style="background-image: url('<?php print $picture; ?>');"></div>
        </div>
        <h2 class="sunsetAuthorName"><?php print $fullName; ?></h2>

        <h3 class="sunsetDescription"><?php print $description; ?></h3>

        <div class="socialMedia">
            <?php if(!empty($twitter)): ?>
                <a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank">
                    <span class="sunset-icon sunset-twitter"></span>
                <a>
            <?php endif; ?>

            <?php if(!empty($facebook)): ?>
                <a href="https://facebook.com/<?php echo $facebook; ?>" target="_blank">
                    <span class="sunset-icon sunset-facebook"></span>
                <a>
            <?php endif; ?>

            <?php if(!empty($google)): ?>
                <a href="https://plus.google.com/u/0/<?php echo $google; ?>" target="_blank">
                    <span class="sunset-icon sunset-googleplus"></span>
                <a>
            <?php endif; ?>
        </div>
        
        <hr>

        <?php

        echo $args['after_widget'];
    }
}

add_action('widgets_init', function() {
    register_widget('sunsetProfileWidget');
});

//edit default wordpress tags widget
function sunsetTagCloudFontChange($args) {
    $args['smallest'] = 10;
    $args['largest'] = 10;

    return $args;
}
add_filter('widget_tag_cloud_args', 'sunsetTagCloudFontChange');

//edit defult wordpress categories widget
function sunsetListCategoriesOutputChange($links) {
    $links = str_replace('</a> (', '</a><span>', $links);
    $links = str_replace(')', '</span>', $links);

    return $links;
}
add_filter('wp_list_categories', 'sunsetListCategoriesOutputChange');

//save posts views
function sunsetSavePostViews($postID) {
    $metaKey = 'sunset_post_views';
    $views = get_post_meta($postID, $metaKey, true);

    $count = (empty($views) ? 0 : $views);
    $count++;

    update_post_meta($postID, $metaKey, $count);
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//sunset popular posts widget
class Sunset_Popular_Posts_Widget extends WP_Widget {
	
	//setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'sunset-popular-posts-widget',
			'description' => 'Popular Posts Widget',
		);
		parent::__construct( 'sunset_popular_posts', 'Sunset Popular Posts', $widget_ops );
		
	}
	
	// back-end display of widget
	public function form( $instance ) {
		
		$title = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Popular Posts' );
		$tot = ( !empty( $instance[ 'tot' ] ) ? absint( $instance[ 'tot' ] ) : 4 );
		
		$output = '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
		$output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '"';
		$output .= '</p>';
		
		$output .= '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Posts:</label>';
		$output .= '<input type="number" class="widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tot' ) ) . '" value="' . esc_attr( $tot ) . '"';
		$output .= '</p>';
		
		echo $output;
		
	}
	
	//update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'tot' ] = ( !empty( $new_instance[ 'tot' ] ) ? absint( strip_tags( $new_instance[ 'tot' ] ) ) : 0 );
		
		return $instance;
		
	}
	
	//front-end display of widget
	public function widget( $args, $instance ) {
		
		$tot = absint( $instance[ 'tot' ] );
		
		$posts_args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> $tot,
			'meta_key'			=> 'sunset_post_views',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		);
		
		$posts_query = new WP_Query( $posts_args );
		
		echo $args[ 'before_widget' ];
		
		if( !empty( $instance[ 'title' ] ) ):
			
			echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
			
		endif;
		
		if( $posts_query->have_posts() ):
		
			//echo '<ul>';
				
			while( $posts_query->have_posts() ): $posts_query->the_post();
				
				echo '<div class="media">';
				echo '<div class="media-left"><img class="media-object" src="' . get_template_directory_uri() . '/img/post-' . ( get_post_format() ? get_post_format() : 'standard') . '.png" alt="' . get_the_title() . '"/></div>';
				echo '<div class="media-body"><a href="'.esc_url(get_permalink()).'">' . get_the_title() . '</a></div>';
				echo '</div>';
				
			endwhile;
				
			//echo '</ul>';
		
		endif;
		
		echo $args[ 'after_widget' ];
		
	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Sunset_Popular_Posts_Widget' );
} );