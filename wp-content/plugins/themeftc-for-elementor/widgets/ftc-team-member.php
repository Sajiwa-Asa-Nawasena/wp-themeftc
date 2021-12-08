<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Team_Member extends Widget_Base {

	public function get_name() {
		return 'ftc-team-member';
	}

	public function get_title() {
		return __( 'FTC - Team Member', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - Team member', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title team member', 'ftc-element' ),
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
				'default' => __( 'Title Team Member', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}  .title-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ftc-team-member .image-thumbnail' => 'max-width:{{SIZE}}{{UNIT}};',
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
					'def_style_2' => __( 'Avatar rounded', 'ftc-element' ),
					'def_style_3' => __( 'Avatar align-left', 'ftc-element' ),
					'def_style_4' => __( 'Avatar align-right', 'ftc-element' ),
					'def_style_5' => __( 'Comming soon', 'ftc-element' ),
					'def_style_6' => __( 'Comming soon', 'ftc-element' ),
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
					'style_1' => __( 'Style 1', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'style 3', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);
		$this->add_control(
			'target',
			[
				'label'   => __( 'Target', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '_self',
				'options' => [
					'_self' => __( 'Self', 'ftc-element' ),
					'_blank' => __( 'Blank', 'ftc-element' ),
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
			'products_in',
			[
				'label'    => esc_html__( 'Select team member', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => 3,
				'options'  => apply_filters( 'ftc_posts_array', 'ftc_team' ),
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
		$target            = ! empty( $settings['target'] ) ? (int) $settings['target'] : '_self';
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
		$columns = ! empty( $settings['columns'] ) ? $settings['columns'] : 3;
		$products_in = ! empty( $settings['products_in'] ) ? $settings['products_in'] : array();
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style       = ! empty( $settings['style'] ) ? $settings['style'] : '';
		$excerpt_words = ! empty( $settings['excerpt_words'] ) ? $settings['excerpt_words'] : 20;

		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}



		global $post, $ftc_team_members;
		$thumb_size_name = isset($ftc_team_members->thumb_size_name)?$ftc_team_members->thumb_size_name:'ftc_team_thumb';
		$editor_content = $this->parse_text_editor( $editor_content );

		$args = array(
			'post_type'				=> 'ftc_team'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> true
			,'posts_per_page' 		=> $posts_per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'columns' 				=> 3
		);
		$args['post_name__in'] = $products_in;

		$team = get_posts($args);

		if ( ! empty( $team )  ){
			echo '<div class="ftc-element-team swiper-container '.esc_attr($stylee).' '.esc_attr($def_style_optionn).' ">';
			echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-rows="1" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-space_mobile="30" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">';
			echo '<div class="title-team-member">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';
			echo '<div class="swiper-wrapper">';
			foreach ($team as $post) {
				$profile_link = get_post_meta($post->ID, 'ftc_profile_link', true);
				if( $profile_link == '' ){
					$profile_link = '#';
				}
				$name = get_the_title($post->ID);
				$role = get_post_meta($post->ID, 'ftc_role', true);

				$facebook_link = get_post_meta($post->ID, 'ftc_facebook_link', true);
				$twitter_link = get_post_meta($post->ID, 'ftc_twitter_link', true);
				$google_plus_link = get_post_meta($post->ID, 'ftc_google_plus_link', true);
				$linkedin_link = get_post_meta($post->ID, 'ftc_linkedin_link', true);
				$rss_link = get_post_meta($post->ID, 'ftc_rss_link', true);
				$dribbble_link = get_post_meta($post->ID, 'ftc_dribbble_link', true);
				$pinterest_link = get_post_meta($post->ID, 'ftc_pinterest_link', true);
				$instagram_link = get_post_meta($post->ID, 'ftc_instagram_link', true);
				$custom_link = get_post_meta($post->ID, 'ftc_custom_link', true);
				$custom_link_icon_class = get_post_meta($post->ID, 'ftc_custom_link_icon_class', true);

				$social_content = '';

				if( $facebook_link ){
					$social_content .= '<li><a class="facebook" href="'.esc_url($facebook_link).'" target="'.$target.'"><i class="fa fa-facebook"></i></a></li>';
				}
				if( $twitter_link ){
					$social_content .= '<li><a class="twitter" href="'.esc_url($twitter_link).'" target="'.$target.'"><i class="fa fa-twitter"></i></a></li>';
				}
				if( $google_plus_link ){
					$social_content .= '<li><a class="google-plus" href="'.esc_url($google_plus_link).'" target="'.$target.'"><i class="fa fa-google-plus"></i></a></li>';
				}
				if( $linkedin_link ){
					$social_content .= '<li><a class="linked" href="'.esc_url($linkedin_link).'" target="'.$target.'"><i class="fa fa-linkedin"></i></a></li>';
				}
				if( $rss_link ){
					$social_content .= '<li><a class="rss" href="'.esc_url($rss_link).'" target="'.$target.'"><i class="fa fa-rss"></i></a></li>';
				}
				if( $dribbble_link ){
					$social_content .= '<li><a class="dribbble" href="'.esc_url($dribbble_link).'" target="'.$target.'"><i class="fa fa-dribbble"></i></a></li>';
				}
				if( $pinterest_link ){
					$social_content .= '<li><a class="pinterest" href="'.esc_url($pinterest_link).'" target="'.$target.'"><i class="fa fa-pinterest-p"></i></a></li>';
				}
				if( $instagram_link ){
					$social_content .= '<li><a class="instagram" href="'.esc_url($instagram_link).'" target="'.$target.'"><i class="fa fa-instagram"></i></a></li>';
				}
				if( $custom_link ){
					$social_content .= '<li><a class="custom" href="'.esc_url($custom_link).'" target="'.$target.'"><i class="fa '.esc_attr($custom_link_icon_class).'"></i></a></li>';
				}
				?>
				<div class="ftc-team-member swiper-slide">
					<div class="content-info">
						<?php if( has_post_thumbnail() ): ?>
							<div class="image-thumbnail">
								<figure>
									<?php the_post_thumbnail($thumb_size_name); ?>
								</figure>
								<div class="socials">
									<ul>
										<?php echo $social_content; ?>
									</ul>
								</div>
							</div>
						<?php endif; ?>

						<header>
							<h3><a class="name" href="<?php echo esc_url($profile_link); ?>"><?php echo esc_html($name); ?></a></h3>
							<span class="role"><?php echo esc_html($role); ?></span>
							<div class="excerpt"><?php ftc_string_limit_words_element($post->post_content, $excerpt_words);?></div>
						</header>
					</div>				
				</div>
				<?php
			}
			echo '</div>';
			if ( 'none' !== $pagination ) {
				echo '<div class="swiper-pagination"></div>';
			}
			if ( $buttons ) {
				echo '<div class="navigation-slider '.$buttons_style.'">';
				echo '<div class="nav-next " screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
				echo '<div class="nav-prev " screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';

				echo '</div>';
			}

			wp_reset_postdata();
			if(is_admin()){
				echo '<script type=""text/javascript" defer="defer">
				(function( $ ){
					"use strict";
					jQuery(document).ready( function($) {
						var products_slider = window.ftc_elements_swiper();
						});
						})( jQuery );
						</script>';
					}

				}
			}

			protected function content_template() {}

			public function render_plain_content( $instance = [] ) {}

		}

		Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Team_Member() );
