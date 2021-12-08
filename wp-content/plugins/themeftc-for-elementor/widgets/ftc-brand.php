<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Brand extends Widget_Base {

	public function get_name() {
		return 'ftc-brand';
	}

	public function get_title() {
		return __( 'FTC - Brand', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - Brand', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Brand', 'ftc-element' ),
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
				'default' => __( 'Title Brand', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}  .title-brand-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'def_style_3' => __( 'Rounded', 'ftc-element' ),
					'def_style_4' => __( 'Bordered', 'ftc-element' ),
					'def_style_5' => __( 'Background Box', 'ftc-element' ),
					'def_style_6' => __( 'Background Color', 'ftc-element' ),
					'def_style_7' => __( 'Background Image', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_responsive_control(
			'brand_width',
			[
				'label'     => __( 'Max-width brand', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 300,
						'min'  => 0,
						'step' => 10,
					],
					'em' => [
						'min' => 0,
						'max' => 300,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ftc-element-brand  .item img' => 'max-width:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'border-item',
			[
				'label'      => esc_html__( 'Border item', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc-element-brand .item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Limit', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Total number of brand to show', 'ftc-element' ),
			]
		);
		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'ftc_brand_cat' ),
				'multiple' => true,
			]
		);
		$this->add_control(
			'active_link',
			[
				'label'     => esc_html__( 'Active link', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'rows',
			[
				'label'   => __( 'Number of rows', 'ftc-element' ),
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
			'columns',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
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
		$this->add_control(
			'posts_per_slide_tab',
			[
				'label'   => __( 'Number of columns (tablets)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
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

		$this->add_control(
			'posts_per_slide_mob',
			[
				'label'   => __( 'Number of columns (mobiles)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
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

		$this->add_control(
			'space',
			[
				'label'   => __( 'Margin between slides', 'ftc-element' ),
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

	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? $settings['posts_per_page'] : 6;
		$pps            = ! empty( $settings['columns'] ) ? (int) $settings['columns'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$space          = ! empty( $settings['space'] ) ? (int) $settings['space'] : 0;
		$pagination     = ! empty( $settings['pagination'] ) ? $settings['pagination'] : 'bullets';
		$buttons        = ! empty( $settings['buttons'] ) ? $settings['buttons'] : '';
		$buttons_style        = ! empty( $settings['buttons_style'] ) ? $settings['buttons_style'] : '';
		$autoplay       = ! empty( $settings['autoplay'] ) ? $settings['autoplay'] : 0;
		$loop           = ! empty( $settings['loop'] ) ? $settings['loop'] : 0;
		$categories     = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$rows = ! empty( $settings['rows'] ) ? $settings['rows'] : 1;
		$columns = ! empty( $settings['columns'] ) ? $settings['columns'] : 3;
		$active_link = ! empty( $settings['active_link'] ) ? $settings['active_link'] : '';
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];

		if($def_style == 'yes'){
			$def_style_optionn = $def_style_option;
		}
		else{
			$def_style_optionn = '';
		}

		global $post;
		$editor_content = $this->parse_text_editor( $editor_content );

		$args = array(
			'post_type'				=> 'ftc_brand'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> true
			,'posts_per_page' 		=> $posts_per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'columns' 				=> 3
		);

	// $categories = str_replace(' ', '', $categories);
	// if( count($categories) > 0 ){
	// 	$categories = explode(',', $categories);
	// }

		if ( ! empty( $categories ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'ftc_brand_cat',
				'terms' => $categories,
				'operator'         => 'IN',
				'field' => 'slug',
				'include_children' => false
			);
		}

		$brands = get_posts($args);

		if ( ! empty( $brands )  ){
			?>
			<div class="ftc-element-brand swiper-container <?php echo esc_attr( $def_style_optionn )  ?>">
				<?php 	echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-rows="' . esc_attr( $rows ) . '" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-space_mobile="30" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">'; ?>
				<?php 
				echo '<div class="title-brand-slider">';
				echo '<h2>'.$editor_content.'</h2>';
				echo '</div>';
				?>
				<div class="swiper-wrapper">
					<?php
					foreach ( $brands as $post) {

						setup_postdata( $post );
						$brand_url = get_post_meta($post->ID, 'ftc_brand_url', true);
						$brand_target = get_post_meta($post->ID, 'ftc_brand_target', true);
						?>
						<div class="item swiper-slide">
							<a href="<?php echo esc_url($brand_url); ?>" target="<?php echo esc_attr($brand_target); ?>">
								<?php 
								if( has_post_thumbnail() ){
									the_post_thumbnail('ftc_brand_thumb');
								}
								?>
							</a>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				if ( 'none' !== $pagination ) {
					echo '<div class="swiper-pagination"></div>';
				}
				if ( $buttons ) {
					echo '<div class="navigation-slider">';
					echo '<div class="nav-next '.$buttons_style.'" screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
					echo '<div class="nav-prev '.$buttons_style.'" screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';
					echo '</div>';
				}
				?>
			</div>
			<?php
		}

		wp_reset_postdata();
		if(is_admin()){
			echo '<script type="text/javascript" defer="defer">
			(function( $ ){
				"use strict";
				jQuery(document).ready( function($) {
					var products_slider = window.ftc_elements_swiper();
					});
					})( jQuery );
					</script>';
				}

			}

			protected function content_template() {}

			public function render_plain_content( $instance = [] ) {}

		}

		Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Brand() );
