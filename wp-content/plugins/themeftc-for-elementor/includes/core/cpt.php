<?php
/**
 * Custom Post Types
 *
 * @since 1.0
 * @package WordPress
 * @subpackage FTC Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// MM Mega menu CPT.
$mega_menu_labels = array(
	'name'               => __( 'Mega Menus', 'ftc-element' ),
	'singular_name'      => __( 'Mega Menu', 'ftc-element' ),
	'add_new'            => __( 'New Mega Menu', 'ftc-element' ),
	'add_new_item'       => __( 'Add New Mega Menu', 'ftc-element' ),
	'edit_item'          => __( 'Edit Mega Menu', 'ftc-element' ),
	'new_item'           => __( 'New Mega Menu', 'ftc-element' ),
	'view_item'          => __( 'View Mega Menu', 'ftc-element' ),
	'search_items'       => __( 'Search Mega Menus', 'ftc-element' ),
	'not_found'          => __( 'No Mega Menus Found', 'ftc-element' ),
	'not_found_in_trash' => __( 'No Mega Menus found in Trash', 'ftc-element' ),
);
$mega_menu_args   = array(
	'labels'              => $mega_menu_labels,
	'supports'            => array( 'title' ),
	'public'              => true,
	'rewrite'             => false,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'exclude_from_search' => true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'menu_icon'           => 'dashicons-menu',
);
register_post_type( 'Mega menu', $mega_menu_args );

// Header CPT
// - postponed for 1.0.0
/*
$header_labels = array(
	'name'               => __( 'Headers', 'ftc-element' ),
	'singular_name'      => __( 'Header', 'ftc-element' ),
	'add_new'            => __( 'New Header', 'ftc-element' ),
	'add_new_item'       => __( 'Add New Header', 'ftc-element' ),
	'edit_item'          => __( 'Edit Header', 'ftc-element' ),
	'new_item'           => __( 'New Header', 'ftc-element' ),
	'view_item'          => __( 'View Header', 'ftc-element' ),
	'search_items'       => __( 'Search Headers', 'ftc-element' ),
	'not_found'          => __( 'No Headers Found', 'ftc-element' ),
	'not_found_in_trash' => __( 'No Headers found in Trash', 'ftc-element' ),
);
$header_args   = array(
	'labels'              => $mm_header_labels,
	'supports'            => array( 'title' ),
	'public'              => true,
	'rewrite'             => false,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'exclude_from_search' => true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'menu_icon'           => 'dashicons-layout',
);
register_post_type( 'Header', $header_args );
*/
//  Footer CPT.
$footer_labels = array(
	'name'               => __( 'Footers', 'ftc-element' ),
	'singular_name'      => __( 'Footer', 'ftc-element' ),
	'add_new'            => __( 'New Footer', 'ftc-element' ),
	'add_new_item'       => __( 'Add New Footer', 'ftc-element' ),
	'edit_item'          => __( 'Edit Footer', 'ftc-element' ),
	'new_item'           => __( 'New Footer', 'ftc-element' ),
	'view_item'          => __( 'View Footer', 'ftc-element' ),
	'search_items'       => __( 'Search Footers', 'ftc-element' ),
	'not_found'          => __( 'No Footers Found', 'ftc-element' ),
	'not_found_in_trash' => __( 'No Footers found in Trash', 'ftc-element' ),
);
$footer_args   = array(
	'labels'              => $mm_footer_labels,
	'supports'            => array( 'title' ),
	'public'              => true,
	'rewrite'             => false,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => false,
	'exclude_from_search' => true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'menu_icon'           => 'dashicons-layout',
);
register_post_type( 'Footer', $footer_args );


// Automatically activate Elementor support for MM Mega menu CPT (always active).
$elementor_cpt_support = get_option( 'elementor_cpt_support', [ 'page', 'post' ] );
if ( ! in_array( 'mmmegamenu', $elementor_cpt_support ) ) {
	$elementor_cpt_support[] = 'mmmegamenu';
	update_option( 'elementor_cpt_support', $elementor_cpt_support );
}
/* // Postponed for 0.8.0
if ( ! in_array( 'mmheader', $elementor_cpt_support ) ) {
	$elementor_cpt_support[] = 'mmheader';
	update_option( 'elementor_cpt_support', $elementor_cpt_support );
}
*/
if ( ! in_array( 'mmfooter', $elementor_cpt_support ) ) {
	$elementor_cpt_support[] = 'mmfooter';
	update_option( 'elementor_cpt_support', $elementor_cpt_support );
}

add_filter( 'mm_megamenu_cpt', '__return_true' );
//add_filter( 'mm_header_cpt', '__return_true' ); // for 0.8.0
add_filter( 'mm_footer_cpt', '__return_true' );
