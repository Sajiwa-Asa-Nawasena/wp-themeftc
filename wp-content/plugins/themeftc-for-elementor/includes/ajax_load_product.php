<?php
add_action('wp_ajax_ftc_products_elements_load_items', 'ftc_products_items_content_element');
add_action('wp_ajax_nopriv_ftc_products_elements_load_items', 'ftc_products_items_content_element');
if( !function_exists('ftc_products_items_content_element') ){
	function ftc_products_items_content_element($atts, $products = null){

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}

			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;

			extract($atts);

			$options = array(
				'show_image'		=> $show_image
				,'show_label'		=> $show_label
				,'show_title'		=> $show_title
				,'show_sku'			=> $show_sku
				,'show_price'		=> $show_price
				,'show_short_desc'	=> $show_short_desc
				,'show_categories'	=> $show_categories
				,'show_rating'		=> $show_rating
				,'show_add_to_cart'	=> $show_add_to_cart
			);
			ftc_remove_product_hooks_shortcode( $options );

			if( $meta_position == 'on-thumbnail' ){
				add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_meta_left_open', 1);
				add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_meta_close', 35);
				add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_meta_right_open', 35);
				add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_meta_close', 65);
			}

			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $posts_per_page
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
				,'paged'				=> $paged
			);			

			if( $custom_order ){
				$args['orderby'] = $orderby;
				$args['order'] = $order;
			}
			else{
				ftc_filter_product_by_product_type($args, $filter);
			}


			if( ! empty($categories)) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat'
						,'terms' => $categories
						,'field' => 'slug'
						,'include_children' => false
					)
				);
			}

			ob_start();

			global $woocommerce_loop;
			$old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;	

			$products = new WP_Query( $args );

		}
		extract($atts);

		while( $products->have_posts() ): $products->the_post(); 			
			wc_get_template_part( 'content', 'product' ); 							
		endwhile; 

		wp_reset_postdata();
		if(class_exists('Themeftc_Plugin')){
			ftc_restore_product_hooks_shortcode();
		}

		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}

	}
}
?>