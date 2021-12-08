<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Products_Widget extends Widget_Base {

	// products var - set here to use as "global" var in "post_class" hook
	public $products;

	public function get_name() {
		return 'ftc-products-widget';
	}

	public function get_title() {
		return __( 'FTC - Products Widget', 'ftc-element' );
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
				'label' => esc_html__( 'FTC Products Widget', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Products Widget', 'ftc-element' ),
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
				'default' => __( 'Title products widget', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc-product-grid .title-product-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'def_style_1' => __( 'Default', 'ftc-element' ),
					'def_style_2' => __( 'Boxed', 'ftc-element' ),
					'def_style_3' => __( 'Image on top', 'ftc-element' ),
					'def_style_4' => __( 'Image Bottom', 'ftc-element' ),
					'def_style_5' => __( 'Image Right', 'ftc-element' ),
					'def_style_6' => __( 'Style 6', 'ftc-element' ),
					'def_style_7' => __( 'Style 7', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
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
				'condition' => ['def_style!' => 'yes'],
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
			'show_rating',
			[
				'label'     => esc_html__( 'Show product rating', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default' => 'yes',
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
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;
		$offset         = ! empty( $settings['offset'] ) ? (int) $settings['offset'] : 0;
		$categories     = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$exclude_cats   = ! empty( $settings['exclude_cats'] ) ? $settings['exclude_cats'] : array();
		$filters        = ! empty( $settings['filters'] ) ? $settings['filters'] : 'latest';
		$products_in    = ! empty( $settings['products_in'] ) ? $settings['products_in'] : '';
		$ppr            = ! empty( $settings['products_per_row'] ) ? (int) $settings['products_per_row'] : 3;
		$ppr_tab        = ! empty( $settings['products_per_row_tab'] ) ? (int) $settings['products_per_row_tab'] : 2;
		$ppr_mob        = ! empty( $settings['products_per_row_mob'] ) ? (int) $settings['products_per_row_mob'] : 2;
		$style = ! empty( $settings['style'] ) ? $settings['style'] : '';
		$show_price          = ! empty( $settings['show_price'] ) ? $settings['show_price'] : '';
		$show_image     = ! empty( $settings['show_image'] ) ? $settings['show_image'] : '';
		$show_label    = ! empty( $settings['show_label'] ) ? $settings['show_label'] : '';
		$show_title     = ! empty( $settings['show_title'] ) ? $settings['show_title'] : '';
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
		$atts = compact('posts_per_page', 'offset', 'categories', 'exclude_cats', 'filters', 'products_in', 'ppr', 'ppr_tab', 'ppr_mob','products_in','style');
		$args = apply_filters( 'ftc_elements_query_args', $posts_per_page, $categories, $exclude_cats, $filters, $offset, $products_in ); // hook in includes/inc/main-functions.php.	
		
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
			echo '<div class="ftc-product-widget elements woocommerce columns-'.esc_attr($ppr).' '.esc_attr($stylee).' '.esc_attr($def_style_optionn).'" id="'.$rand_id.'" data-atts="'.htmlentities(json_encode($atts)).'">';
			echo '<div class="title-product-widget">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';
			echo '<div class="products-widget products woocommerce">';

			foreach ( $products as $post ) {

				setup_postdata( $post );
				$url = esc_url( get_permalink($post->ID) );
				$options = array(
					'show_image'		=> $show_image
					,'show_label'		=> $show_label
					,'show_title'		=> $show_title
					,'show_price'		=> $show_price
					,'show_rating'		=> $show_rating
				);
				if(class_exists('Themeftc_Plugin')){
					ftc_remove_product_hooks_shortcode( $options );				
				}
				$rand = rand(1000,9999);
				echo '<div class="ftc-product product">';
				echo '<div class="images">';
				if($show_image){
					echo '<div class="image-widget" id ="product-'.esc_attr($rand).'"><a href="'.esc_url($url).'">'.woocommerce_get_product_thumbnail('thumbnail').'</a></div>';
				}
				if($show_label){
					do_action('ftc_before_product_image');
				}
				echo '</div>';
				echo '<div class="meta-description">';
				$url = esc_url( get_permalink($post->ID) );
				if($show_title){
					echo "<h3 class=\"product_title product-name\">";
					echo "<a href='{$url}'>" . esc_attr(get_the_title()) . "</a>";
					echo "</h3>";
				}
				if($show_rating){
					woocommerce_template_loop_rating();
				}
				if($show_price){
					woocommerce_template_loop_price();
				}
				echo '</div>';
				echo '</div>';

			}

			echo '</div>';

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

	Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Products_Widget() );
