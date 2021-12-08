<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FTC_Products_Deal_Slider extends Widget_Base {

	public function get_name() {
		return 'ftc-products-deal-sliders';
	}

	public function get_title() {
		return __( 'FTC - Products Deal Slider', 'ftc-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	public function get_script_depends() {
		return [ 'jquery-swiper' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_main',
			[
				'label' => esc_html__( 'FTC Products Deal slider', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Products Deal', 'ftc-element' ),
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
				'default' => __( 'Title Products Deal', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'heading_product_query_basic',
			[
				'label'     => __( 'Basic product query options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Total products', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Enter total number of products to show', 'ftc-element' ),
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
				'title'   => __( 'Offset is number of skipped products', 'ftc-element' ),
			]
		);

		$this->add_control(
			'heading_filtering',
			[
				'label'     => __( 'Additional query options', 'ftc-element' ),
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
					'categories' => '',
				], */
			]
		);

		$this->add_control(
			'filters',
			[
				'label'   => __( 'Products filters', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => [
					'latest'       => __( 'Latest products', 'ftc-element' ),
					'featured'     => __( 'Featured products', 'ftc-element' ),
					'best_sellers' => __( 'Best selling products', 'ftc-element' ),
					'best_rated'   => __( 'Best rated products', 'ftc-element' ),
					'on_sale'      => __( 'Products on sale', 'ftc-element' ),
					'random'       => __( 'Mix orders', 'ftc-element' ),
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
			'heading_slider',
			[
				'label'     => __( 'Slider options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'posts_per_slide',
			[
				'label'   => __( 'Products per slide', 'ftc-element' ),
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
			'posts_per_slide_tab',
			[
				'label'   => __( 'Products per slide (tablets)', 'ftc-element' ),
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

		$this->add_control(
			'posts_per_slide_mob',
			[
				'label'   => __( 'Products per slide (mobiles)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
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
			'space',
			[
				'label'   => __( 'Space between slides', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 30,
				'min'     => 0,
				'step'    => 10,
			]
		);

		// Pagination.
		$this->add_control(
			'pagination',
			[
				'label'   => __( 'Slider pagination', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'none'        => __( 'None', 'ftc-element' ),
					'bullets'     => __( 'Bullets', 'ftc-element' ),
					'progressbar' => __( 'Progress bar', 'ftc-element' ),
					'fraction'    => __( 'Fraction', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-progressbar-fill'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-fraction'      => 'color: {{VALUE}};',
				],
				'condition' => [
					'pagination!' => 'none',
				],
			]
		);

		// Slider navigation.
		$this->add_control(
			'buttons',
			[
				'label'     => esc_html__( 'Show navigation buttons', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'buttons_style',
			[
				'label'     => __( 'Style Navigation buttons', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'options' => [
					''        => __( 'Default', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'Style 3', 'ftc-element' ),
					'style_4' => __( 'Style 4', 'ftc-element' ),
				],
				'condition' => [
					'buttons!' => '',
				],
			]
		);
		$this->add_control(
			'buttons_color',
			[
				'label'     => __( 'Navigation buttons color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'buttons!' => '',
				],
			]
		);
		// Autoplay.
		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay speed', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'step'    => 1000,
				'title'   => __( 'Enter value in miliseconds (1s. = 1000ms.). Leave 0 (zero) do discard autoplay', 'ftc-element' ),
			]
		);
		// Loop the slider.
		$this->add_control(
			'loop',
			[
				'label'     => esc_html__( 'Loop slides', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();

		// TAB 2 - STYLES FOR POSTS.
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Slider items base', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'def_style_2' => __( 'Hover Button', 'ftc-element' ),
					'def_style_3' => __( 'Image Right', 'ftc-element' ),
					'def_style_4' => __( 'Content Inside', 'ftc-element' ),
					'def_style_5' => __( 'Boxed', 'ftc-element' ),
					'def_style_6' => __( 'Style 6', 'ftc-element' ),
					'def_style_7' => __( 'Style 7', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Customize style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1' => __( 'Style 1', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'Style 3', 'ftc-element' ),
					'style_4' => __( 'Style 4', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);

		$this->add_control(
			'img_format',
			[
				'label'     => esc_html__( 'Product image format', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'thumbnail',
				'options'   => apply_filters( 'ftc_elements_image_sizes', '' ),
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_responsive_control(
			'product_text_height',
			[
				'label'     => __( 'Product height', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 400,
				],
				'range'     => [
					'px' => [
						'max'  => 800,
						'min'  => 0,
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .inner-wrap' => 'height: {{SIZE}}px;',
				],
				'condition' => [
					'style' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_control(
			'slider_items_padding_border',
			[
				'label'     => __( 'Slider items padding and border', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_responsive_control(
			'slider_items_padding',
			[
				'label'      => esc_html__( 'Slider items padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'label'     => __( 'Slider items border' ),
				'name'      => 'productslider_post_border',
				'selector'  => '{{WRAPPER}} .inner-wrap',
				'condition' => [
					'style!' => [ 'catalog' ],
				],
			]
		);

		$this->end_controls_section();

		// Section product info elements.
		$this->start_controls_section(
			'section_info_elements',
			[
				'label'     => esc_html__( 'Product info elements', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style!' => [ 'catalog' ],
				],
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
			'show_categories',
			[
				'label'     => esc_html__( 'Show product categories (posted in)', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_responsive_control(
			'product_elements_spacing',
			[
				'label'     => __( 'Elements vertical spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-text h4'          => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text .meta'       => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text .price-wrap' => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text .add-to-cart-wrap' => 'padding: 0 0 {{SIZE}}px;',
					'{{WRAPPER}} .post-text p'           => 'padding: 0 0 {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;
		$offset         = ! empty( $settings['offset'] ) ? (int) $settings['offset'] : 0;
		$pps            = ! empty( $settings['posts_per_slide'] ) ? (int) $settings['posts_per_slide'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$buttons_style  = ! empty( $settings['buttons_style'] ) ? $settings['buttons_style'] : '';
		$space          = ! empty( $settings['space'] ) ? (int) $settings['space'] : 0;
		$pagination     = ! empty( $settings['pagination'] ) ? $settings['pagination'] : 'bullets';
		$buttons        = ! empty( $settings['buttons'] ) ? $settings['buttons'] : '';
		$autoplay       = ! empty( $settings['autoplay'] ) ? $settings['autoplay'] : 0;
		$loop           = ! empty( $settings['loop'] ) ? $settings['loop'] : 0;
		$categories     = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$exclude_cats   = ! empty( $settings['exclude_cats'] ) ? $settings['exclude_cats'] : array();
		$filters        = ! empty( $settings['filters'] ) ? $settings['filters'] : '';
		$products_in    = ! empty( $settings['products_in'] ) ? $settings['products_in'] : '';
		$img_format     = ! empty( $settings['img_format'] ) ? $settings['img_format'] : 'thumbnail';
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style          = ! empty( $settings['style'] ) ? $settings['style'] : 'style_1';
		$show_short_desc     = ! empty( $settings['show_short_desc'] ) ? $settings['show_short_desc'] : '';
		$show_price          = ! empty( $settings['show_price'] ) ? $settings['show_price'] : '';
		$show_add_to_cart    = ! empty( $settings['show_add_to_cart'] ) ? $settings['show_add_to_cart'] : '';
		$show_categories      = ! empty( $settings['show_categories'] ) ? $settings['show_categories'] : '';
		$css_class      = ! empty( $settings['css_class'] ) ? $settings['css_class'] : '';
		$img_cont_pos   = ! empty( $settings['img_container_pos'] ) ? $settings['img_container_pos'] : 'center';


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

		$grid = ftc_grid_class( intval( $pps ), intval( $pps_tab ), intval( $pps_mob ) );

		// Query posts: ( hook in includes/main-functions.php ).
			$args = array(
				'post_type'		    => 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'offset'               => $offset
				,'posts_per_page' 		=> $posts_per_page
				,'orderby' 				=> 'date menu_order'
				,'order' 				=> 'DESC'
				,'meta_query' => array(
					array(
						'key'		=> '_sale_price_dates_to'
						,'value'	=> current_time( 'timestamp', true )
						,'compare'	=> '>'
						,'type'		=> 'numeric'
					)
					,array(
						'key'		=> '_sale_price_dates_from'
						,'value'	=> current_time( 'timestamp', true )
						,'compare'	=> '<'
						,'type'		=> 'numeric'
					)
				)
			);
			if ( ! empty( $categories ) ) {
				$args['tax_query'][] = array(
					'taxonomy'         => 'product_cat',
					'field'            => 'slug',
					'operator'         => 'IN',
					'terms'            => $categories,
					'include_children' => true,
				);
			}
		apply_filters('ftc_filter_product_by_product_element', $args ,$filters);
		$products = get_posts( $args );

		if ( ! empty( $products ) ) {

			// CSS classes for main slider container.
			$this->add_render_attribute( 'container', 'class', 'ftc_products_deal_slider swiper-container' );
			$this->add_render_attribute( 'container', 'class', $stylee );
			$this->add_render_attribute( 'container', 'class', $def_style_optionn );
			$this->add_render_attribute( 'container', 'class', 'container-' . $img_cont_pos );
			$this->add_render_attribute( 'container', 'class', 'columns-'.$pps );

			echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';

			// Slider settings for JS function.
			echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-space_mobile="' . esc_attr( $space ) . '" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">';
			echo '<div class="title-products-deal">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';

			echo '<ul class="ftc-products swiper-wrapper products woocommerce">';

			foreach ( $products as $post ) {

				setup_postdata( $post );
					apply_filters( 'ftc_elements_deal_loop_product', $style, $img_format, $show_categories, $show_short_desc, $show_price, $show_add_to_cart, $css_class );// hook in includes/wc-functions.php.

				}

			echo '</ul>'; // .swipper-wrapper.
			if ( 'none' !== $pagination ) {
				echo '<div class="swiper-pagination"></div>';
			}

			if ( $buttons ) {
				echo '<div class="navigation-slider '.$buttons_style.'">';
				echo '<div class="nav-next" screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
				echo '<div class="nav-prev" screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';
				echo '</div>';
			}
			echo '</div>';
		}

		wp_reset_postdata();
		if(class_exists('Themeftc_Plugin')){
			ftc_restore_product_hooks_shortcode();
		}

		echo '
		<script type=text/javascript" defer="defer">
		(function( $ ){
			"use strict";
			jQuery(document).ready( function($) {
				var products_slider = window.ftc_elements_swiper();
				});
				})( jQuery );
				</script>';

			}

			protected function content_template() {}

			public function render_plain_content( $instance = [] ) {}

		}

		Plugin::instance()->widgets_manager->register_widget_type( new FTC_Products_Deal_Slider() );
