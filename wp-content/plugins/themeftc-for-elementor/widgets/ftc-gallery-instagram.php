<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Gallery_Instagram extends Widget_Base {

	public function get_name() {
		return 'ftc-gallery-instagram';
	}

	public function get_title() {
		return __( 'FTC - Gallery Instagram ', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Gallery settings', 'ftc-element' ),   //section name for controler view
			]
		);

		$this->add_control(
			'username',
			[
				'label'       => __( 'Username or #tag : ', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Example: themeftc', 'ftc-element' ),
				'default'     => '',
				'label_block' => true,
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
			'wp_gallery',
			[
				'label' => __( 'Add Images', 'ftc-element' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'columns',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1  => __( '1', 'ftc-element' ),
					2  => __( '2', 'ftc-element' ),
					3  => __( '3', 'ftc-element' ),
					4  => __( '4', 'ftc-element' ),
					5  => __( '5', 'ftc-element' ),
					6  => __( '6', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label'       => esc_html__( 'Images size', 'ftc-element' ),
				'description' => '',
				'type'        => Controls_Manager::SELECT,
				'default'     => 'thumbnail',
				'options'     => [
					'thumbnail' => esc_html__( 'Thumbnail', 'ftc-element' ),
					'small'     => esc_html__( 'Small', 'ftc-element' ),
					'large'     => esc_html__( 'Large', 'ftc-element' ),
					'original'  => esc_html__( 'Original', 'ftc-element' ),

				],
			]
		);
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'ftc-element' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ftc-instagram li.images img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'slider',
			[
				'label' => esc_html__( 'Display slider', 'ftc-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on' => __( 'Yes', 'elementor' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'columns_slide',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
					6 => __( '6', 'ftc-element' ),
				],
				'condition' => ['slider' => 'yes'],
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
				],
				'condition' => ['slider' => 'yes'],
			]
		);

		$this->add_control(
			'desksmall_items',
			[
				'label'   => __( 'Number of columns (desksmall_items)', 'ftc-element' ),
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
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'tablet_items',
			[
				'label'   => __( 'Number of columns (tablet_items)', 'ftc-element' ),
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
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'tabletmini_items',
			[
				'label'   => __( 'Number of columns (tabletmini_items)', 'ftc-element' ),
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
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'mobile_items',
			[
				'label'   => __( 'Number of columns (mobile_items)', 'ftc-element' ),
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
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'mobilesmall_items',
			[
				'label'   => __( 'Number of columns (mobilesmall_items)', 'ftc-element' ),
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
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'show_nav',
			[
				'label'   => __( 'Show navigation', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'show_dots',
			[
				'label'   => __( 'Show dots', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'margin',
			[
				'label'   => __( 'Margin item', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'title'   => __( 'Margin between items', 'ftc-element' ),
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'timespeed',
			[
				'label'   => __( 'Autoplay speed', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4000,
				'min'     => 0,
				'step'    => 1000,
				'title'   => __( 'Enter value in miliseconds (1s. = 1000ms.). Leave 0 (zero) do discard autoplay', 'ftc-element' ),
				'condition' => ['slider' => 'yes'],
			]
		);
		$this->add_control(
			'target',
			[
				'label'       => esc_html__( 'Target', 'ftc-element' ),
				'description' => '',
				'type'        => Controls_Manager::SELECT,
				'default'     => '_self',
				'options'     => [
					'_self' => esc_html__( 'Self', 'ftc-element' ),
					'_blank'     => esc_html__( 'New tab', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'button',
			[
				'label'   => __( 'Button Follow', 'ftc-element' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label'     => __( 'Button Alignment', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-instagram .button-insta' => 'text-align: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'padding_spacing',
			[
				'label'     => __( 'Padding beetween items', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-instagram ul li' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;',
				],

			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover animation', 'ftc-element' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings           = $this->get_settings();
		$username           = $settings['username'];
		$wp_gallery         = $settings['wp_gallery'];
		$size               = $settings['size'];
		$target             = $settings['target'];
		$columns            = $settings['columns'];
		$button             = $settings['button'];
		$hover_animation    = $settings['hover_animation'];
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];

		$slider                = $settings['slider'];
		$columns_slide        = $settings['columns_slide'];
		$rows           = $settings['rows'];
		$show_nav       = $settings['show_nav'];
		$show_dots      = $settings['show_dots'];
		
		$mobilesmall_items = $settings['mobilesmall_items'];
		$desksmall_items   = $settings['desksmall_items'];
		$tablet_items      = $settings['tablet_items'];
		$tabletmini_items  = $settings['tabletmini_items'];
		$mobile_items      = $settings['mobile_items'];
		$timespeed    = $settings['timespeed'];
		$margin       = $settings['margin'];

		if($slider){
			$slider_class = 'slider';
		}
		else{
			$slider_class = '';
		}

		if($def_style == 'yes'){
			$def_style_optionn = $def_style_option;
		}
		else{
			$def_style_optionn = '';
		}


		$image_ids = wp_list_pluck( $settings['wp_gallery'], 'id' );
		$link_insta = 'https://instagram.com/'.esc_attr($username);


		$this->add_render_attribute( 'ul-class', 'class', 'columns-' . $columns );
		$this->add_render_attribute( 'ul-class', 'class', $size );
		$this->add_render_attribute( 'ul-class', 'class', $slider_class );

		$data_attr = array();
		$data_attr[] = 'data-margin="'.$margin.'"';
		$data_attr[] = 'data-nav="'.$show_nav.'"';
		$data_attr[] = 'data-dots="0"';
		$data_attr[] = 'data-timespeed="'.$timespeed.'"';			
		$data_attr[] = 'data-desksmall_items="'.$desksmall_items.'"';
		$data_attr[] = 'data-tablet_items="'.$tablet_items.'"';
		$data_attr[] = 'data-tabletmini_items="'.$tabletmini_items.'"';
		$data_attr[] = 'data-mobile_items="'.$mobile_items.'"';
		$data_attr[] = 'data-mobilesmall_items="'.$mobilesmall_items.'"';
		$data_attr[] = 'data-columns="'.$columns_slide.'"';
		$data_attr[] = 'data-show_nav="'.$show_nav.'"';
		$data_attr[] = 'data-show_dots="'.$show_dots.'"';
		?>

		<div class="ftc-element-instgram ftc-instagram <?php echo esc_attr( $def_style_optionn )  ?>">

			<ul <?php echo $this->get_render_attribute_string( 'ul-class' ); ?> <?php echo implode(' ', $data_attr); ?>>
				<?php 
				foreach( $image_ids as $image_id ){
					$images = wp_get_attachment_image_src( $image_id, $size );
					echo'<li class="images"><a href="'.esc_url($link_insta).'" target="'.esc_attr($target).'"><img src="'.$images[0].'" class="elementor-animation-'.esc_attr($hover_animation).'" alt="'.esc_attr($username).'" title="'.esc_attr($username).'"></a></li>';
					$images++;
				}
				?>
			</ul>
			<?php 
			if($button){
				echo '<div class="button-insta"><i class="fa fa-instagram"></i><a href="' . esc_url( $link_insta ) . '" class="instagram-user">' . esc_html__( 'Follow', 'ftc-element' ) . ' ' . esc_html( $username ) . '</a></div>';
			}
			?>

			<?php if(is_admin()) :?>
				<script type="text/javascript">
					(function (u) {
						"use strict";

						/*tab slider element product*/
						u('.ftc-instagram .slider').each(function () {
							var element = u(this);
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
								,rtl: u('body').hasClass('rtl')
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
					window.dispatchEvent(new Event("resize"));
				</script>
			<?php endif;?>
			<?php 
			echo '
		<script type="text/javascript" defer="defer">
		(function( $ ){
			"use strict";
			jQuery(document).ready( function($) {
				window.dispatchEvent(new Event("resize"));
				});
				})( jQuery );
				</script>';
			?>
		</div>

		<?php

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Gallery_Instagram() );
