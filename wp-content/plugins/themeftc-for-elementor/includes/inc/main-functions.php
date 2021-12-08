<?php
/**
 * Main functions for WooCommerce
 *
 * @since 1.0.0
 * @package WordPress
 * @subpackage FTC Elements
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WC Query Arguments
 *
 * @param integer $posts_per_page - total posts number.
 * @param array   $categories - WC categories for filtering.
 * @param array   $exclude_cats categories - exclude WC categories for filtering.
 * @param string  $filters - WC filters - latest/sales/rated/best seller/random.
 * @param integer $offset - offset number skips first items in query.
 * @param array   $products_in - an array of products to use with "post_name__in".
 * @return $args
 *
 * function for filtering WooCommerce posts.
 * with a little help from: https://github.com/woocommerce/woocommerce/blob/master/includes/widgets/class-wc-widget-products.php
 */
function ftc_elements_query_args_func( $posts_per_page, $categories = array(), $exclude_cats = array(), $filters = 'latest', $offset = 0, $products_in = array() ) {

	// if WooCommerce is not active.
	if ( ! 'FTC_WOO_ACTIVE' ) {
		return;
	}

	// Default arguments.
	$args = array(
		'posts_per_page'   => $posts_per_page,
		'post_type'        => 'product',
		'offset'           => $offset,
		'order'            => 'DESC',
		'suppress_filters' => false,
	);

	$args['orderby'] = 'date menu_order';

	if ( ! empty( $categories ) ) {
		$args['tax_query'][] = array(
			'taxonomy'         => 'product_cat',
			'field'            => 'slug',
			'operator'         => 'IN',
			'terms'            => $categories,
			'include_children' => true,
		);
	}

	if ( ! empty( $exclude_cats ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'operator' => 'NOT IN',
			'terms'    => $exclude_cats,
			//'include_children' => true,
		);
	}

	if ( 'featured' === $filters ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
		);
	}
	if ( 'best_sellers' === $filters ) {

		$args['meta_key'] = 'total_sales';
		$args['orderby']  = 'meta_value_num';
		$args['order']    = 'DESC';

	} elseif ( 'best_rated' === $filters ) {

		$args['meta_key'] = '_wc_average_rating';
		$args['orderby']  = 'meta_value_num';
		$args['order']    = 'DESC';

	} elseif ( 'random' === $filters ) {

		$args['orderby'] = 'rand menu_order date';

	} elseif ( 'on_sale' === $filters ) {

		$product_ids_on_sale = wc_get_product_ids_on_sale();
		if ( ! empty( $product_ids_on_sale ) ) {
			$args['post__in'] = $product_ids_on_sale;
		}
	}

	if ( ! empty( $products_in ) ) {
		$args['post_name__in'] = $products_in;
	}

	// Polylang (and WPML) support.
	if ( function_exists( 'pll_current_language' ) ) {
		$current_lang = pll_current_language();
		$args['lang'] = $current_lang;
	} elseif ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		$current_lang = ICL_LANGUAGE_CODE;
		$args['lang'] = $current_lang;
	}

	return $args;

}
add_filter( 'ftc_elements_query_args', 'ftc_elements_query_args_func', 10, 6 );

function ftc_filter_product_by_product_element_func( $args = array(), $filters = 'recent' ){
	switch( $filters ){
		case 'on_sale':
		$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;
		case 'featured':
		$args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN',
		);
		break;
		case 'best_sellers':
		$args['meta_key'] 	= 'total_sales';
		$args['orderby'] 	= 'meta_value_num';
		$args['order'] 		= 'desc';
		break;
		case 'best_rated':
		$args['meta_key'] = '_wc_average_rating';
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';			
		break;
		case 'random':
		$args['orderby'] 	= 'rand';
		break;
		default: /* Recent */
		$args['orderby'] 	= 'date';
		$args['order'] 		= 'desc';
		break;
	}
}
add_filter( 'ftc_filter_product_by_product_element', 'ftc_filter_product_by_product_element_func', 10, 6 );
/**
 * PRODUCT FOR LOOP
 *
 * @param string  $style - slides style.
 * @param string  $img_format - registered image format.
 * @param boolean $posted_in - to show "Posted in" (categories), or not.
 * @param boolean $short_desc - to show Short product description or not.
 * @param boolean $price - to show product price or not.
 * @param boolean $add_to_cart - to show "Add to Cart" button or not.
 * @param string  $css_class - string with custom CSS classes.
 * @return void
 * DRY effort ...
 */
function ftc_template_element_gallery_image(){
	global $post, $product, $smof_data;

	$attachment_ids = $product->get_gallery_image_ids();
	$title = $product->get_title();
	$rand = $product->get_id();

	if ( $attachment_ids ) {
		if( is_array($attachment_ids) && has_post_thumbnail() && $smof_data['ftc_prod_cloudzoom'] == 1 ){
			array_unshift($attachment_ids, get_post_thumbnail_id());
		}
		$count_product = count($attachment_ids);

		?>
		<div class="ftc-thumbnails-gallery">
			<ul class="details-thumbnails">
				<?php
				$loop = 0;
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

				foreach ( array_slice( $attachment_ids, 0, 3) as $attachment_id ) {

					$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'medium' );
					$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
					$image_title      = get_post_field( 'post_excerpt', $attachment_id );

					$attributes = array(
						'title'                   => $image_title,
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);
					$html  = '<li class="image-gallery"><span>';
					$html .= wp_get_attachment_image( $attachment_id, 'shop_catalog', false, $attributes );

					$html .= '</span></li>';

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );

					$loop++;
				}
				?>
			</ul>     
		</div>
		<?php
	}
}
function ftc_loop_product_function( $style = 'style_1', $custom_size = false, $display_gallery = false , $img_format = 'thumbnail', $show_categories = true, $show_short_desc = false, $show_price = true, $show_add_to_cart = true, $css_class = '' ) {
	
	global $products;
	?> 

	<div class="post swiper-slide">

		<?php woocommerce_product_loop_start(); ?>				
		<?php 
		echo '<div class="ftc-products">';
		$options = array(
			'show_price'		=> $show_price
			,'show_add_to_cart'		=> $show_add_to_cart
			,'show_short_desc'		=> $show_short_desc
			,'show_categories'			=> $show_categories
		);
		if(class_exists('Themeftc_Plugin')){
			ftc_remove_product_hooks_shortcode( $options );				
		}
		// add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_title', 20);
		remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_time_deals', 10 , 7);
		if($custom_size || $display_gallery == 'yes'){
			global $smof_data;
			$lazy_load = isset($smof_data['ftc_prod_lazy_load']) && $smof_data['ftc_prod_lazy_load'] && !( defined( 'DOING_AJAX' ) && DOING_AJAX );
			if( defined( 'YITH_INFS' ) && (is_shop() || is_product_taxonomy()) ){ /* Compatible with YITH Infinite Scrolling */
				$lazy_load = false;
			}					
			?>
			<div class="ftc-product product custom_size <?php echo esc_attr($img_format) ?>">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

				<div class="images <?php echo ($lazy_load)?'lazy-loading':'' ?>">
					<a href="<?php the_permalink(); ?>">
						<?php
						global $product, $smof_data;

						$placeholder_img_src = isset($smof_data['ftc_prod_placeholder_img']['url']) ? $smof_data['ftc_prod_placeholder_img']['url'] : wc_placeholder_img_src();

						$prod_galleries = $product->get_gallery_image_ids();

						$back_image = (isset($smof_data['ftc_effect_product']) && (int) $smof_data['ftc_effect_product'] == 0) ? false : true;

						if ( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 )) {
							$back_image = false;
						}

						$image_size = apply_filters('ftc_loop_product_thumbnail', $img_format);

						echo '<span class="' . (($back_image) ? 'cover_image' : 'no-image') . '">';
						echo woocommerce_get_product_thumbnail($image_size);
						echo '</span>';
						if ( $back_image ) {
							echo '<span class="hover_image">';
							echo wp_get_attachment_image($prod_galleries[0], $image_size, 0, array('class' => 'product-hover-image'));
							echo '</span>';
						}
						add_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_product_label', 1);
						?>
					</a>
					<?php
					do_action( 'woocommerce_shop_loop_item_title' );
					do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
				</div>
				<?php
				if($display_gallery == 'yes'){
					ftc_template_element_gallery_image();
				}
				?>
				<div class="item-description">
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</div>
				
				<?php do_action( 'ftc_after_shop_loop_item' ); ?>
			</div>
			<?php
		}
		else {
			wc_get_template_part( 'content', 'product' );
		}
		echo '</div>';
		?>			

		<?php woocommerce_product_loop_end(); ?>
		<?php 
		if(class_exists('Themeftc_Plugin')){
			ftc_restore_product_hooks_shortcode();
		}
		?>

	</div>
	<?php

} 
add_filter( 'ftc_elements_loop_product', 'ftc_loop_product_function', 10, 7 );
function ftc_loop_deal_product_function($style = 'style_1', $rows, $img_format = 'shop_single',  $show_short_desc = true, $show_price = true, $show_add_to_cart = true, $show_categories = false, $css_class = ''){
	global $products;
	?>

	<li class="post swiper-slide">

		<?php woocommerce_product_loop_start(); ?>				

		<?php 
		echo '<div class="ftc-deal-products">';
		$options = array(
			'show_price'		=> $show_price
			,'show_add_to_cart'		=> $show_add_to_cart
			,'show_short_desc'		=> $show_short_desc
			,'show_categories'			=> $show_categories
		);
		if(class_exists('Themeftc_Plugin')){
			ftc_remove_product_hooks_shortcode( $options );				
		}
		add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_time_deals', 10 , 7);
		wc_get_template_part( 'content', 'product' );

		echo '</div>';
		?>			

		<?php woocommerce_product_loop_end(); ?>

	</li>
	<?php
}

add_filter( 'ftc_elements_deal_loop_product', 'ftc_loop_deal_product_function', 10, 7 );
/**
 * SIMPLE PRODUCT DATA (as in WC catalog)
 *
 * @param boolean $short_desc - if Short product description will be displayed.
 * @return void
 */
function ftc_data_single_product_func( $short_desc = true ) {

	echo '<h3 class="product_title"><a href="' . esc_attr( get_permalink() ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '"> ' . get_the_title() . '</a></h3>';

	if ( $short_desc ) {
		wc_get_template_part( 'single-product/short', 'description' );
	}
	woocommerce_template_loop_price();

	echo '<div class="add-to-cart-wrapper">';
	woocommerce_template_loop_add_to_cart();
	echo '</div>';

}
add_filter( 'ftc_data_single_product', 'ftc_data_single_product_func', 10, 1 );
/**
 * PRODUCT COUNT PER CATEGORY
 *
 * @param integer $term_id Parameter_Description.
 * @return $prod_count
 * @details html with count of products in category
 */
function ftc_product_count( $term_id ) {

	$products_count = get_term_meta( intval( $term_id ), 'product_count_product_cat', true );

	if ( is_wp_error( $products_count ) || ! $products_count ) {
		return;
	}

	$prod_count = '<span class="product-count">';
	// translators: %s is for number of product(s).
	$prod_count .= sprintf( _n( '%s product', '%s products', $products_count, 'ftc-element' ), $products_count );

	$prod_count .= '</span>';

	return $prod_count;
}

add_filter( 'ftc_product_count_category', 'ftc_product_count', 100, 3 );
/**
 * Product categories query arguments
 *
 * @param object $query - query object.
 * @return void
 */
function ftc_elements_cat_args( $query ) {

	if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'product' ) || $query->is_tax( get_object_taxonomies( 'product' ) ) ) ) {

		if ( isset( $_GET['on_sale'] ) && '' === $_GET['on_sale'] ) {

			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$query->set( 'post__in', $product_ids_on_sale );

		}
		if ( isset( $_GET['featured'] ) && '' === $_GET['featured'] ) {

			$query->set(
				'tax_query',
				array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				)
			);

		}

		if ( isset( $_GET['best_sellers'] ) && '' === $_GET['best_sellers'] ) {

			$query->set( 'meta_key', 'total_sales' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'DESC' );

		}

		if ( isset( $_GET['best_rated'] ) && '' === $_GET['best_rated'] ) {

			$query->set( 'meta_key', '_wc_average_rating' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'DESC' );

		}
	}

}
add_action( 'pre_get_posts', 'ftc_elements_cat_args', 999 );
