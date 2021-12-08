<?php
/**
 * Adds custom classes to the array of body classes.
 */
function ftc_body_classes( $classes ) {

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'ftc-customizer';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'home-sidebar' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}
	return $classes;
}
add_filter( 'body_class', 'ftc_body_classes' );

/**
 * Checks to see if we're on the homepage or not.
 */
function ftc_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/*** Vertical Menu Heading ***/
if( !function_exists ('ftc_get_vertical_menu_heading') ){
	function ftc_get_vertical_menu_heading(){
		$locations = get_nav_menu_locations();
		if( isset($locations['vertical']) ){
			$menu = wp_get_nav_menu_object($locations['vertical']);
			if( isset( $menu->name ) ){
				return $menu->name;
			}
			else{
				return esc_html__('Shop by category', 'ornaldo');
			}
		}
		return '';
	}
}

/* function to display number of posts. */
function get_post_views($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}

/* function to count views. */
function set_post_views($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

/* Is Active Mega Main Menu */
if( !function_exists('ftc_has_megamainmenu') ){
	function ftc_has_megamainmenu(){
		$_actived = apply_filters('active_plugins', get_option('active_plugins'));
		if( in_array("mega_main_menu/mega_main_menu.php", $_actived) ){
			return true;
		}
		return false;
	}
}

/* Change footer for the individual page */
if( !class_exists('ThemeFtc_GET') ){
	add_filter('widget_display_callback', 'ftc_change_footer_for_individual_page', 10, 3);
	function ftc_change_footer_for_individual_page( $instance, $object, $args ){
		global $post;
		if( is_page() && ($args['name'] == esc_html__('Footer Top', 'ornaldo') || $args['name'] == esc_html__('Footer Bottom', 'ornaldo') || $args['name'] == esc_html__('Footer Middle', 'ornaldo'))
			&& get_class($object) == 'Ftc_Footer_Widget' ) 
		{
			if( $args['name'] == esc_html__('Footer Top', 'ornaldo') ){
				$block_id = get_post_meta($post->ID, 'ftc_footer_top', true);
			}
			elseif( $args['name'] == esc_html__('Footer Bottom', 'ornaldo') ){
				$block_id = get_post_meta($post->ID, 'ftc_footer_bottom', true);
			}
			else{
				$block_id = get_post_meta($post->ID, 'ftc_footer_middle', true);
			}
			if( $block_id ){
				$instance['block_id'] = $block_id;
			}
		}
		return $instance;
	}
}

?>