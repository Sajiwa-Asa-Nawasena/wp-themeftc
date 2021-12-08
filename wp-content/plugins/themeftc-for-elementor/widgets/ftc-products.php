<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Products extends Widget_Base {

	// products var - set here to use as "global" var in "post_class" hook
	public $products;

	public function get_name() {
		return 'ftc-products';
	}

	public function get_title() {
		return __( 'FTC - Products', 'ftc-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_main',
			[
				'label' => esc_html__( 'FTC Products', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Products', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'editor',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Title products', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc-product-grid .title-product-grid' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'heading_product_style',
			[
				'label'     => __( 'Style Content Product', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'def_style',
			[
				'label' => esc_html__( 'Apply style default', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'yes' => __( 'Yes', 'ftc-element' ),
					'no' => __( 'No', 'ftc-element' ),
				],
				'default' => 'no',
			]
		);
		$this->add_control(
			'def_style_option',
			[
				'label' => __( 'Default style', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'def_style_1',
				'options' => [
					'def_style_1' => __( 'Style 1', 'ftc-element' ),
					'def_style_2' => __( 'Style 2', 'ftc-element' ),
					'def_style_3' => __( 'Style 3', 'ftc-element' ),
					'def_style_4' => __( 'Style 4', 'ftc-element' ),
					'def_style_5' => __( 'Style 5', 'ftc-element' ),
					'def_style_6' => __( 'Style 6', 'ftc-element' ),
					'def_style_7' => __( 'Style 7', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Customize Style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       => __( 'Default', 'ftc-element' ),
					'style_1'     => __( 'Style 1', 'ftc-element' ),
					'style_2'     => __( 'Style 2', 'ftc-element' ),
					'style_3'     => __( 'Style 3', 'ftc-element' ),
					'style_4'     => __( 'Style 4', 'ftc-element' ),
					'style_5'     => __( 'Style 5', 'ftc-element' ),
					'style_6'     => __( 'Style 6', 'ftc-element' ),
					'style_7'     => __( 'Style 7', 'ftc-element' ),
					'style_8'     => __( 'Style 8', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);
		$this->add_control(
			'custom_size',
			[
				'label'     => esc_html__( 'Custom size image', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'img_format',
			[
				'label'     => esc_html__( 'Product image format', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'shop_catalog',
				'options'   => apply_filters( 'ftc_elements_image_sizes', '' ),
				'condition' => [
					'custom_size' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'heading_product_query_basic',
			[
				'label'     => __( 'Product Options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Limit products', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
				'title'   => __( 'Total number of products', 'ftc-element' ),
			]
		);

		$this->add_control(
			'offset',
			[
				'label'   => __( 'Offset', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Offset is a number of skipped products', 'ftc-element' ),
			]
		);

		$this->add_control(
			'heading_product_query',
			[
				'label'     => __( 'Products query options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select product categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'product_cat' ),
				'multiple' => true,
			]
		);

		$this->add_control(
			'exclude_cats',
			[
				'label'    => esc_html__( 'Exclude product categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'product_cat' ),
				'multiple' => true,
				/* 'condition' => [
					'categories' => [],
				], */
			]
		);

		$this->add_control(
			'filters',
			[
				'label'   => __( 'Products type', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => [
					'latest'       => __( 'Latest products', 'ftc-element' ),
					'featured'     => __( 'Featured products', 'ftc-element' ),
					'best_sellers' => __( 'Best selling products', 'ftc-element' ),
					'best_rated'   => __( 'Best rated products', 'ftc-element' ),
					'on_sale'      => __( 'Products on sale', 'ftc-element' ),
					'random'       => __( 'Mix order products', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'products_in',
			[
				'label'    => esc_html__( 'Select products', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => 3,
				'options'  => apply_filters( 'ftc_posts_array', 'product' ),
				'multiple' => true,
			]
		);
		$this->add_control(
			'heading_load_more',
			[
				'label'     => __( 'Load more', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'load_more',
			array(
				'label'        => esc_html__( 'Show Load more', 'ftc-element' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ftc-element' ),
				'label_off'    => esc_html__( 'Hide', 'ftc-element' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'label_load_more',
			array(
				'label'       => esc_html__( 'Load more Label', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Load more', 'ftc-element' ),
				'placeholder' => esc_html__( 'Load more', 'ftc-element' ),
				'condition'   => array(
					'load_more'      => 'yes',
				),
			)
		);
		$this->add_control(
			'style_load',
			[
				'label'   => __( 'Select style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'Style 3', 'ftc-element' ),
					'style_4' => __( 'Style 4', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'heading_display_potions',
			[
				'label'     => __( 'Reponsive options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'products_per_row',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 4,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'products_per_row_tab',
			[
				'label'   => __( 'Number of columns(tablets)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'products_per_row_mob',
			[
				'label'   => __( 'Number of columns(mobiles)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);
		/*Attribute in product*/

		$this->add_control(
			'heading_items_pro_settings',
			[
				'label'     => __( 'Attribute Product', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_price',
			[
				'label'     => esc_html__( 'Show price', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_add_to_cart',
			[
				'label'     => esc_html__( 'Show "Add to cart"', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_short_desc',
			[
				'label'     => esc_html__( 'Show product short description', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				//'default' => 'yes',
			]
		);
		$this->add_control(
			'show_image',
			[
				'label'     => esc_html__( 'Show product images', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_label',
			[
				'label'     => esc_html__( 'Show product label', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_title',
			[
				'label'     => esc_html__( 'Show product title', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_sku',
			[
				'label'     => esc_html__( 'Show product sku', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_rating',
			[
				'label'     => esc_html__( 'Show product rating', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default' => 'yes',
			]
		);


		$this->add_control(
			'show_categories',
			[
				'label'     => esc_html__( 'Show product categories (posted in)', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();

	}
	

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style = $this->get_settings( 'style' );
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;
		$offset         = ! empty( $settings['offset'] ) ? (int) $settings['offset'] : 0;
		$categories     = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$exclude_cats   = ! empty( $settings['exclude_cats'] ) ? $settings['exclude_cats'] : array();
		$filters        = ! empty( $settings['filters'] ) ? $settings['filters'] : 'latest';
		$products_in    = ! empty( $settings['products_in'] ) ? $settings['products_in'] : '';
		$img_format     = ! empty( $settings['img_format'] ) ? $settings['img_format'] : 'thumbnail';
		$custom_size     = ! empty( $settings['custom_size'] ) ? $settings['custom_size'] : '';
		$ppr            = ! empty( $settings['products_per_row'] ) ? (int) $settings['products_per_row'] : 3;
		$ppr_tab        = ! empty( $settings['products_per_row_tab'] ) ? (int) $settings['products_per_row_tab'] : 2;
		$ppr_mob        = ! empty( $settings['products_per_row_mob'] ) ? (int) $settings['products_per_row_mob'] : 2;
		$load_more      = ! empty( $settings['load_more'] ) ? $settings['load_more'] : '';
		$label_load_more = ! empty( $settings['label_load_more'] ) ? $settings['label_load_more'] : 'Load more';
		$style_load = ! empty( $settings['style_load'] ) ? $settings['style_load'] : '';
		$show_short_desc    = ! empty( $settings['show_short_desc'] ) ? $settings['show_short_desc'] : '';
		$show_price          = ! empty( $settings['show_price'] ) ? $settings['show_price'] : '';
		$show_add_to_cart    = ! empty( $settings['show_add_to_cart'] ) ? $settings['show_add_to_cart'] : '';
		$show_categories     = ! empty( $settings['show_categories'] ) ? $settings['show_categories'] : '';
		$show_image     = ! empty( $settings['show_image'] ) ? $settings['show_image'] : '';
		$show_label    = ! empty( $settings['show_label'] ) ? $settings['show_label'] : '';
		$show_title     = ! empty( $settings['show_title'] ) ? $settings['show_title'] : '';
		$show_sku     = ! empty( $settings['show_sku'] ) ? $settings['show_sku'] : '';
		$show_rating     = ! empty( $settings['show_rating'] ) ? $settings['show_rating'] : ''; 

		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}

		global $post;
		$editor_content = $this->parse_text_editor( $editor_content );
		$this->products = ftc_grid_class( intval( $ppr ), intval( $ppr_tab ), intval( $ppr_mob ) );
		$atts = compact('posts_per_page', 'offset', 'categories', 'exclude_cats', 'filters', 'products_in', 'img_format', 'custom_size', 'ppr', 'ppr_tab', 'ppr_mob','products_in','style','show_short_desc','show_price','show_add_to_cart','show_categories','show_image','show_label','show_title','show_sku','show_rating');
		$args = apply_filters( 'ftc_elements_query_args', $posts_per_page, $categories, $exclude_cats, $filters, $offset, $products_in ); // hook in includes/wc-functions.php.	
		// Add (inject) grid classes to products in loop.
		// ( in "content-product.php" template ).
		add_filter(
			'post_class', function( $classes ) {
				$classes[] = $this->products;
				$classes[] = 'item';
				return $classes;
			}, 10
		);
		$products = get_posts( $args );

		if ( ! empty( $products ) ) {
			$rand_id = 'ftc-product-wrapper-'.rand(0, 10000);
			echo '<div class="ftc-product-grid product-template woocommerce woocommerce-page columns-'.esc_attr($ppr).' '.esc_attr($stylee).' '.esc_attr($def_style_optionn).'" id="'.$rand_id.'" data-atts="'.htmlentities(json_encode($atts)).'">';
			echo '<div class="title-product-grid">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';
			echo '<div class="products">';

			foreach ( $products as $post ) {

				setup_postdata( $post );
				$options = array(
					'show_image'		=> $show_image
					,'show_label'		=> $show_label
					,'show_title'		=> $show_title
					,'show_sku'		=> $show_sku
					,'show_price'		=> $show_price
					,'show_short_desc'	=> $show_short_desc
					,'show_categories'	=> $show_categories
					,'show_rating'		=> $show_rating
					,'show_add_to_cart'	=> $show_add_to_cart
				);
				if(class_exists('Themeftc_Plugin')){
					ftc_remove_product_hooks_shortcode( $options );				
				}
				if($custom_size == 'yes'){
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
						<div class="item-description">
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</div>

						<?php do_action( 'ftc_after_shop_loop_item' ); ?>
					</div>
					<?php
				}else{
					wc_get_template_part( 'content', 'product' );
				}
			}

			echo '</div>';
			if($load_more){
				?>
				<div class="load-more-product <?php echo esc_attr($style_load) ?>">
					<a href="#" class="load-more button" data-paged="2">
						<?php echo $label_load_more ?>
					</a>
				</div>
				<?php
			}

			echo '</div>';
		}

		// "Clean" or "reset" post_class
		// avoid conflict with other "post_class" functions
		add_filter(
			'post_class', function( $classes ) {
				$classes_to_clean = array( $this->products, 'item' );
				$classes          = array_diff( $classes, $classes_to_clean );
				return $classes;
			}, 10
		);

		wp_reset_postdata();
		if(class_exists('Themeftc_Plugin')){
			ftc_restore_product_hooks_shortcode();
		}
		if(is_admin()){
			?><script type="text/javascript">
				(function ($) {
					"use strict";
					$('.ftc-product-grid').each(function(){
						var element = $(this);
						var atts = element.data('atts');
						var ass  = element.data('args');

						/* Show more */
						element.find('a.load-more').bind('click', function(){
							var button = $(this);
							if( button.hasClass('loading') ){
								return false;
							}
							button.addClass('loading');
							var paged = button.attr('data-paged');

							$.ajax({
								type : "POST",
								timeout : 30000,
								url : ftc_shortcode_params.ajax_uri,
								data : {action: 'ftc_products_elements_load_items', paged: paged, atts : atts,  ass : ass},
								error: function(xhr,err){

								},
								success: function(response) {
									button.removeClass('loading');
									button.attr('data-paged', ++paged);
									if( response != 0 && response != '' ){
										element.find('.products').append(response);
										// ftc_quickshop_action_element_product();
									}
									else{ /* No results */
										button.parent().remove();
									}
								}
							});
							return false;
						});
					});
					jQuery('a.quickview').prettyPhoto({
						deeplinking: false
						, opacity: 0.9
						, social_tools: false
						, default_width: 900
						, default_height: 450
						, theme: 'pp_woocommerce'
						, changepicturecallback: function () {
							jQuery('.pp_inline').find('form.variations_form').wc_variation_form();
							jQuery('.pp_inline').find('form.variations_form .variations select').change();
							jQuery('body').trigger('wc_fragments_loaded');

							jQuery('.pp_inline .variations_form').on('click', '.reset_variations', function () {
								jQuery(this).closest('.variations').find('.ftc-product-attribute .option').removeClass('selected');
							});

							jQuery('.pp_woocommerce').addClass('loaded');

							var _this = jQuery('.ftc-quickshop-wrapper .images-slider-wrapper');

							if (_this.find('.image-item').length <= 1) {
								return;
							}

							var owl = _this.find('.image-items').owlCarousel({
								items: 1
								, loop: true
								, nav: true
								, navText: [, ]
								, dots: false
								, navSpeed: 1000
								, slideBy: 1
								, rtl: jQuery('body').hasClass('rtl')
								, margin: 10
								, navRewind: false
								, autoplay: false
								, autoplayTimeout: 5000
								, autoplayHoverPause: false
								, autoplaySpeed: false
								, mouseDrag: true
								, touchDrag: true
								, responsiveBaseElement: _this
								, responsiveRefreshRate: 1000
								, onInitialized: function () {
									_this.addClass('loaded').removeClass('loading');
								}
							});

						}
					});
				})(jQuery);
				</script> <?php
			}

		}

		protected function content_template() {}

		public function render_plain_content( $instance = [] ) {}

	}

	Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Products() );
