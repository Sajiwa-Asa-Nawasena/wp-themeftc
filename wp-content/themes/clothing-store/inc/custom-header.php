<?php
/**
 * Custom header
 */

function clothing_store_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'clothing_store_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 100,
		'wp-head-callback'       => 'clothing_store_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'clothing_store_custom_header_setup' );

if ( ! function_exists( 'clothing_store_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see clothing_store_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'clothing_store_header_style' );
function clothing_store_header_style() {
	if ( get_header_image() ) :
	$custom_css = "
        #header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'clothing-store-style', $custom_css );
	endif;
}
endif;