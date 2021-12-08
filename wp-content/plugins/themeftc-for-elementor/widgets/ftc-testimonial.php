<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Testimonial extends Widget_Base {

	public function get_name() {
		return 'ftc-testimonial';
	}

	public function get_title() {
		return __( 'FTC - Testimonials', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - Testimonials', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Products Slider', 'ftc-element' ),
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
				'default' => __( 'Title Testimonial Slider', 'ftc-elements' ),
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
					'def_style_3' => __( 'Avatar left', 'ftc-element' ),
					'def_style_4' => __( 'Avatar right', 'ftc-element' ),
					'def_style_5' => __( 'Content boxed', 'ftc-element' ),
					'def_style_6' => __( 'Grid item', 'ftc-element' ),
					'def_style_7' => __( 'Comming soon', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Customize style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'ftc-element' ),
					'style_1'   => __( 'Style 1', 'ftc-element' ),
					'style_2'   => __( 'Style 2', 'ftc-element' ),
					'style_3'   => __( 'Style 3', 'ftc-element' ),
					'style_4'   => __( 'Style 4', 'ftc-element' ),
					'style_5'   => __( 'Style 5', 'ftc-element' ),
					'style_6'   => __( 'Style 6', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}  .title-testi-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'border-image',
			[
				'label'      => esc_html__( 'Border radius avatar', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc-element-testimonial .avatar-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'avatar_width',
			[
				'label'     => __( 'Max-width avatar', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 10,
					],
					'em' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ftc-element-testimonial .avatar-image img' => 'max-width:{{SIZE}}{{UNIT}};',
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
				'title'   => __( 'Total number of testimonials to show', 'ftc-element' ),
			]
		);
		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'ftc_testimonial_cat' ),
				'multiple' => true,
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
			'excerpt_words',
			[
				'label'   => __( 'Excerpt_words', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 20,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Excerpt_words of testimonials to show', 'ftc-element' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => __( 'Typography Excerpt', 'ftc-element' ),
		
				'selector' => '{{WRAPPER}} .infomation',
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => __( 'Excerpt Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .infomation' => 'color: {{VALUE}};',
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



		$this->add_control(
			'show_rating',
			[
				'label'     => esc_html__( 'Show rating', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_name',
			[
				'label'     => esc_html__( 'Show Name', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'name_color',
			[
				'label'     => __( 'Name Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'name_color_hover',
			[
				'label'     => __( 'Name Hover Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name:hover a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => __( 'Typography Name', 'ftc-element' ),

				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->add_control(
			'show_byline',
			[
				'label'     => esc_html__( 'Show Byline', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'no',
			]
		);
		$this->add_control(
			'byline_color',
			[
				'label'     => __( 'Byline Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .byline' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'byline_typography',
				'label'    => __( 'Typography Byline', 'ftc-element' ),
			
				'selector' => '{{WRAPPER}} .byline',
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
		$style = ! empty( $settings['style'] ) ? $settings['style'] : '';
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? $settings['posts_per_page'] : 6;
		$pps            = ! empty( $settings['columns'] ) ? (int) $settings['columns'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$space          = ! empty( $settings['space'] ) ? (int) $settings['space'] : 0;
		$pagination     = ! empty( $settings['pagination'] ) ? $settings['pagination'] : 'bullets';
		$buttons        = ! empty( $settings['buttons'] ) ? $settings['buttons'] : '';
		$show_byline        = ! empty( $settings['show_byline'] ) ? $settings['show_byline'] : '';
		$show_name        = ! empty( $settings['show_name'] ) ? $settings['show_name'] : '';

		$show_rating        = ! empty( $settings['show_rating'] ) ? $settings['show_rating'] : '';
		$buttons_style        = ! empty( $settings['buttons_style'] ) ? $settings['buttons_style'] : '';
		$autoplay       = ! empty( $settings['autoplay'] ) ? $settings['autoplay'] : 0;
		$loop           = ! empty( $settings['loop'] ) ? $settings['loop'] : 0;
		$categories     = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$columns = ! empty( $settings['columns'] ) ? $settings['columns'] : 3;
		$excerpt_words = ! empty( $settings['excerpt_words'] ) ? $settings['excerpt_words'] : 20;

		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}

		global $post, $ftc_testimonials;
		$editor_content = $this->parse_text_editor( $editor_content );

		$args = array(
			'post_type'				=> 'ftc_testimonial'
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
				'taxonomy' => 'ftc_testimonial_cat',
				'terms' => $categories,
				'operator'         => 'IN',
				'field' => 'slug',
				'include_children' => false
			);
		}

		$testimonials = get_posts($args);

		if ( ! empty( $testimonials )  ){
			?>
			<div class="ftc-element-testimonial swiper-container <?php echo esc_attr($stylee); ?> <?php echo esc_attr($def_style_optionn); ?>">
				<?php 	echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-rows="1" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-space_mobile="' . esc_attr( $space ) . '" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">'; ?>
				<?php 
				echo '<div class="title-testi-slider">';
				echo '<h2>'.$editor_content.'</h2>';
				echo '</div>';
				?>
				<div class="swiper-wrapper">
					
					<?php
					foreach ( $testimonials as $post) {

						setup_postdata( $post );

						$byline = get_post_meta($post->ID, 'ftc_byline', true);
						$url = get_post_meta($post->ID, 'ftc_url', true);
						if( $url == '' ){
							$url = '#';
						}
						$rating = get_post_meta($post->ID, 'ftc_rating', true);
						$rating_percent = '0';
						if( $rating != '-1' && $rating != '' ){
							$rating_percent = $rating * 100 / 5;
						}

						$gravatar_email = get_post_meta($post->ID, 'ftc_gravatar_email', true);
						$has_image = false;
						if( has_post_thumbnail() || ($gravatar_email != '' && is_email($gravatar_email)) ){
							$has_image = true;
						}
						?>
						
						<div class="item testimonial-content swiper-slide">
							<!-- style 1 -->
							<?php if($style == 'style_1') { ?>
								<div class="group-content">
							<?php if( isset($show_rating) && $show_rating && $rating != '-1' && $rating != '' ): ?>
								<div class="rating woocommerce">
									<div class="star-rating no-rating" title="<?php printf(esc_html__('Rated %s out of 5', 'themeftc'), $rating); ?>">
										<span style="width: <?php echo $rating_percent.'%'; ?>"><?php printf(esc_html__('Rated %s out of 5', 'themeftc'), $rating); ?></span>
									</div>
								</div>
							<?php endif?>
							<div class="infomation">
								<?php ftc_string_limit_words_element($post->post_content, $excerpt_words);?>
							</div>
							<div class="group-avatar">
								<div class="avatar-image">

									<?php echo $ftc_testimonials->get_image($post->ID); ?>
								</div>
								<?php if( isset($show_name) && $show_name){ ?>
									<h4 class="name">
										<a href="<?php echo esc_url($url); ?>" target="_blank">
											<?php echo get_the_title($post->ID); ?>
										</a>
									</h4>
								<?php } ?>

								<?php
								if( isset($show_byline) && $show_byline == 'yes'){?>
								<div class="byline">
									<?php echo esc_html($byline); ?>
								</div>
							</div>	
						<?php } ?>
								</div>


								<?php }else{ ?>
									<!--  -->


							<div class="avatar-image">

								<?php echo $ftc_testimonials->get_image($post->ID); ?>
							</div>
							<div class="group-content">

							<?php if( isset($show_rating) && $show_rating && $rating != '-1' && $rating != '' ): ?>
								<div class="rating woocommerce">
									<div class="star-rating no-rating" title="<?php printf(esc_html__('Rated %s out of 5', 'themeftc'), $rating); ?>">
										<span style="width: <?php echo $rating_percent.'%'; ?>"><?php printf(esc_html__('Rated %s out of 5', 'themeftc'), $rating); ?></span>
									</div>
								</div>
							<?php endif?>
							<div class="infomation">
								<?php ftc_string_limit_words_element($post->post_content, $excerpt_words);?>
							</div>
							<?php if( isset($show_name) && $show_name){ ?>
								<h4 class="name">
									<a href="<?php echo esc_url($url); ?>" target="_blank">
										<?php echo get_the_title($post->ID); ?>
									</a>
								</h4>
							<?php } ?>

							<?php
							if( isset($show_byline) && $show_byline == 'yes'){?>
							<div class="byline">
								<?php echo esc_html($byline); ?>
							</div>	
						<?php } ?>
						
					</div>
					<?php } ?>
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
					echo '<div class="navigation-slider '.$buttons_style.'">';
					echo '<div class="nav-next " screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
					echo '<div class="nav-prev " screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';
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

		Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Testimonial() );
