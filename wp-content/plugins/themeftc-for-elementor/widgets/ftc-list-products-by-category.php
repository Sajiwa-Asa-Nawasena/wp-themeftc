<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FTC_List_Products_Categories extends Widget_Base {

	public function get_name() {
		return 'ftc-list-product-by-categories';
	}

	public function get_title() {
		return __( 'FTC - List Product by Categories', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - List Prouct by Categories', 'ftc-element' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => esc_html__( 'Select product categories', 'ftc-element' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => array(),
				'options'     => apply_filters( 'ftc_elements_terms', 'product_cat' ),
				'multiple'    => true,
				'label_block' => true,
			]
		);

		$this->add_control(
			'add_query_args',
			[
				'label'       => __( 'Additional filters (per category)', 'ftc-element' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => array(),
				'options'     => [
					'on_sale'      => esc_html__( 'On sale', 'ftc-element' ),
					'featured'     => esc_html__( 'Featured', 'ftc-element' ),
					'best_sellers' => esc_html__( 'Best sellers', 'ftc-element' ),
					'best_rated'   => esc_html__( 'Best rated', 'ftc-element' ),
				],
				'multiple'    => true,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_slider',
			[
				'label'     => __( 'Products list by Categories options', 'ftc-element' ),
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
			'product_per_row',
			[
				'label'   => __( 'Product per row', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 4,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
					6 => __( '6', 'ftc-element' ),
				],
			]
		);
		$this->add_responsive_control(
			'horiz_spacing',
			[
				'label'     => __( 'Grid horizontal spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 50,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .category' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;',
					'{{WRAPPER}} .mme-row'  => 'margin-left:-{{SIZE}}px; margin-right:-{{SIZE}}px;',
				],

			]
		);

		$this->add_responsive_control(
			'inner_spacing',
			[
				'label'     => __( 'Tab title spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 100,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-category-tab .tab-title' => 'margin-right:{{SIZE}}px;',
				],

			]
		);
		$this->add_control(
			'slider',
			[
				'label'        => esc_html__( 'Display slider', 'ftc-element' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'ftc-element' ),
				'label_off'    => esc_html__( 'No', 'ftc-element' ),
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Category item layout', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => __( 'Base style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1' => __( 'Style 1', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'Style 3', 'ftc-element' ),
					'style_4' => __( 'Style 4', 'ftc-element' ),
				],
			]
		);

		$this->add_responsive_control(
			'title_text_align',
			[
				'label'     => __( 'Categories alignment', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ftc-list-product-by-categories .product-category-tab' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cat_vertical_alignment',
			[
				'label'     => __( 'Vertical Align Product Info', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'flex-start' => __( 'Top', 'ftc-element' ),
					'center'     => __( 'Middle', 'ftc-element' ),
					'flex-end'   => __( 'Bottom', 'ftc-element' ),
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .category__text-wrap' => 'align-self: {{VALUE}};',
				],
				'condition' => [
					'style' => [ 'style_1', 'style_2', 'style_4' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Colors, typography, border', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// HOVER TABS.
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Title Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ftc-list-product-by-categories .product-category-tab a.tab-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ftc-list-product-by-categories .product-category-tab a.tab-title' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		// HOVER.
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Active', 'ftc-element' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Color on avtive', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ftc-list-product-by-categories .product-category-tab a.tab-title.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label'     => __( 'Background color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ftc-list-product-by-categories .product-category-tab a.tab-title.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}}  .ftc-list-product-by-categories .product-category-tab a.tab-title h4',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => __( 'Border', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .category__inner-wrap',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings_for_display();
		// Settings vars.
		$categories       = $settings['categories'];
		$add_query_args   = $settings['add_query_args'];
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6;
		$ppr = ! empty( $settings['product_per_row'] ) ? (int) $settings['product_per_row'] : 4;           
		$style            = $settings['style'];
		$slider        = ! empty( $settings['slider'] ) ? $settings['slider'] : '';

		$id = $this->get_id();

		// All the styles for categories holder.
		$this->add_render_attribute( 'categories-holder-css', 'class', 'ftc-list-product-by-categories' );
		$this->add_render_attribute( 'categories-holder-css', 'class', $style );

		// Each singular category styles.
		$grid = '';
		$this->add_render_attribute( 'category-css', 'class', 'category ' . $grid );
		// Additional query args.
		$args = '';
		if ( ! empty( $add_query_args ) ) {
			$args = '?';
			foreach ( $add_query_args as $arg ) {
				$args .= $arg . ( end( $add_query_args ) === $arg ? '' : '&amp;' );
			}
		}

		if ( empty( $categories ) ) {
			return;
		}

		// Categories holder.
		echo '<div ' . $this->get_render_attribute_string( 'categories-holder-css' ) . '>';
		echo '<div class="product-category-tab">';
		foreach ( $categories as $index => $cat ) {

			$count = $index + 1;

			$term_data = apply_filters( 'ftc_elements_term_data_cate', 'product_cat', $cat, ''); // hook in inc/helpers.php

			if ( empty( $term_data ) ) {
				continue;
			}

			$term_id    = isset( $term_data['term_id'] ) ? $term_data['term_id'] : '';
			$term_title = isset( $term_data['term_title'] ) ? $term_data['term_title'] : '';
			$term_link  = isset( $term_data['term_link'] ) ? $term_data['term_link'] . $args : '#';
			$image_url  = isset( $term_data['image_url'] ) ? $term_data['image_url'] : '';

			// Category item data-id / data-delay.
			$this->add_render_attribute( 'data-id' . $count, 'data-id', $id . '-' . $count );
			echo '<a ' . $this->get_render_attribute_string( 'data-id' . $count ). ' title="' . esc_attr( $term_title ) . '" class="tab-title tab-'.$index.'" data-tab="'.$index.'">';
			echo '<h4 class="title">' . esc_html( $term_title ) . '</h4>';
			echo '</a>';

		}
		echo '</div>';
		echo '<div class="content-product woocommerce products columns-'.$ppr.'">';
		foreach ( $categories as $index => $cate ) {

			$args = array(
				'post_type'				=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' 		=> $posts_per_page,
				'orderby' 				=> 'date',
				'order' 				=> 'desc'
			);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'terms' => $cate,
					'field' => 'slug',
					'include_children' => false
				)
			);
			$products = get_posts($args);
			echo '<div class="products tab tab-'.$index.' ' .($slider ? 'slider' : ''). ' " data-tab="'.$index.'" data-columns="'.$ppr.'" data-slide="'.$slider.'" data-autoplay="1" data-dots="1" data-timespeed="4000" data-margin="30" data-desksmall_items="4"
			data-tablet_items="3" data-tabletmini_items="3" data-mobile_items="2"
			data-mobilesmall_items="1">';

			foreach ( $products as $post ) {
				setup_postdata( $post );
				$link_pro = esc_url( get_permalink( $post->ID ) );
				?>
				<div class="ftc-product product">
					<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

					<div class="images">
						<a href="<?php echo $link_pro ?>">
							<?php
							do_action( 'woocommerce_before_shop_loop_item_title' );
							?>
						</a>
						<?php
						do_action( 'woocommerce_shop_loop_item_title' );
						do_action( 'woocommerce_after_shop_loop_item_title' );
						?>

					</div>
					<div class="item-description">
						<?php   
						remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_title', 20);
						?>
						<h3 class="product_title product-name"><a href="<?php echo $link_pro ?>"><?php echo get_the_title($post->ID); ?></a></h3>

						<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
					</div>
					<?php do_action( 'ftc_after_shop_loop_item' ); ?>
				</div>
				<?php
			}
			wp_reset_postdata();

			echo '</div>';
		}
		echo '</div>';
		echo '</div>';
		if(is_admin()){
			?>
			<script type="text/javascript">
				(function ($) {
					"use strict";
					var tabs = $('.ftc-list-product-by-categories');
					tabs.each( function(){

        var $_Tabs = $(this); // Single tabs holder
        
        var tabsWrapper = $_Tabs.find('.product-category-tab'),
        tabTitles   = tabsWrapper.find('.tab-title'),
        tabsContent = $_Tabs.find('.content-product'),
        content     = tabsContent.find('.products');
        
        //tabTitles.click( function(event) {
        	$('.tab-0').addClass('active');
        	$( document ).on( 'click', '.tab-title', function(event) {
        		$(this).addClass('active');
        		$(this).siblings().removeClass('active');

          // Hide inactive tab titles and show active one and content
          var tab = $(this).data('tab');
          content.not('.tab-'+ tab).css('display', 'none').removeClass('active');
          tabsContent.find('.tab-' + tab).fadeIn().addClass('active');
      });

        });

					$('.ftc-list-product-by-categories .content-product .products.tab.slider').each(function () {
						var element = $(this);
						var columns = element.data('columns');
						var nav = element.data('nav') ;  
						var dots = element.data('dots') ;             
						var desksmall_items = element.data('desksmall_items');
						var tabletmini_items = element.data('tabletmini_items');
						var tablet_items = element.data('tablet_items');
						var mobile_items = element.data('mobile_items');
						var mobilesmall_items = element.data('mobilesmall_items');
						var margin  =  element.data('margin');
						var timespeed  =  element.data('timespeed');      
						element.addClass('loading');
						element.owlCarousel({
							loop: true
							,nav: nav
							,dots: dots
							,navText: [,]
							,navSpeed: 1000
							,slideBy: 1
							,touchDrag: true
							,rtl: $('body').hasClass('rtl')
							,margin: margin
							,navRewind: false
							,autoplay: true
							,autoplayTimeout: timespeed
							,autoplayHoverPause: true
							,autoplaySpeed: 1000
							,autoHeight: true
							,responsive: {
								0:{
									items: mobilesmall_items
								},
								480:{
									items: mobile_items
								},
								700:{
									items: tablet_items
								},
								768:{
									items: tabletmini_items
								},
								991:{
									items: desksmall_items
								},
								1199:{
									items:columns
								}
							}
							,onInitialized: function(){
								element.addClass('loaded').removeClass('loading');
							}

						});

					});				
				})(jQuery);
			</script>
			<?php
		}


	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new FTC_List_Products_Categories() );
