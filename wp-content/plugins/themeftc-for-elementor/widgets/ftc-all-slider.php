<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class FTC_Slider extends Widget_Base {


	public function get_name() {
		return 'ftc-all-slider';
	}

	public function get_title() {
		return __( 'FTC - All Slider', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'jquery-swiper' ];
	}
	/**
	 * Register slides widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_slides',
			[
				'label' => __( 'Slider', 'ftc-element' ),
				'tab'  => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );

		// Content tab.
		$repeater->start_controls_tab(
			'slide_text_tab',
			[
				'label' => __( 'Text', 'ftc-element' ),
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'ftc-element' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'thumbnail',
				'separator' => 'none',
			]
		);
		$repeater->add_control(
			'slide_title',
			[
				'label'       => __( 'Slide title', 'ftc-element' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Slide Title', 'ftc-element' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slide_content',
			[
				'label'      => __( 'Slide content', 'ftc-element' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'default'    => __( 'This is main content of this section', 'ftc-element' ),
				'show_label' => false,
			]
		);

		$repeater->end_controls_tab();

		// Buttons tab.
		$repeater->start_controls_tab(
			'slide_buttons_tab',
			[
				'label' => __( 'Buttons', 'ftc-element' ),
			]
		);

		$repeater->add_control(
			'button_1_text',
			[
				'label'       => __( 'Button #1', 'ftc-element' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Button #1 text', 'ftc-element' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_1_link',
			[
				'label'       => __( 'Link button #1', 'ftc-element' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'http://your-link.com', 'ftc-element' ),
			]
		);

		$repeater->add_control(
			'button_2_text',
			[
				'label'       => __( 'Button #2', 'ftc-element' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_2_link',
			[
				'label'       => __( 'Link button #2', 'ftc-element' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'http://your-link.com', 'ftc-element' ),
			]
		);

		$repeater->end_controls_tab();

		// Background image tab.
		$repeater->start_controls_tab(
			'background_tab',
			[
				'label' => __( 'BG', 'ftc-element' ),
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'slide_image',
				'label'    => __( 'Slide image', 'ftc-element' ),
				// 'types'    => [ 'classic', 'gradient', 'video' ],
				'types'    => [ 'classic', 'video' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slide-background',
			]
		);

		$repeater->add_control(
			'slide_overlay_color',
			[
				'label'     => __( 'Overlay color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				// 'conditions' => [
				// 	'terms' => [
				// 		[
				// 			'name' => 'slide_overlay',
				// 			'value' => 'yes',
				// 		],
				// 	],
				// ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_overlay_blend_mode',
			[
				'label'     => __( 'Blend Mode', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''            => __( 'Normal', 'ftc-element' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn'  => 'Color Burn',
					'hue'         => 'Hue',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'exclusion'   => 'Exclusion',
					'luminosity'  => 'Luminosity',
				],
				// 'conditions' => [
				// 	'terms' => [
				// 		[
				// 			'name' => 'background_overlay',
				// 			'value' => 'yes',
				// 		],
				// 	],
				// ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-background-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$repeater->end_controls_tab();

		// Style tab.
		$repeater->start_controls_tab(
			'slide_style_tab',
			[
				'label' => __( 'Style', 'ftc-element' ),
			]
		);

		$repeater->add_control(
			'heading_content_alignment',
			[
				'label'     => __( 'Content alignment', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'horizontal_align',
			[
				'label'                => __( 'Horizontal align', 'ftc-element' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'       => 'center',
				'selectors'            => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'align-items: flex-start; text-align: left',
					'center' => 'align-items: center; text-align: center',
					'right'  => 'align-items: flex-end; text-align: right',
				],

			]
		);

		$repeater->add_control(
			'vertical_align',
			[
				'label'                => __( 'Vertical align', 'ftc-element' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'top'    => [
						'title' => __( 'Top', 'ftc-element' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ftc-element' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ftc-element' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors'            => [
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'justify-content: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],

			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label'       => __( 'Slider items', 'ftc-element' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'slide_title'   => __( 'Slide 1 Title', 'ftc-element' ),
						'slide_content' => __( 'This is main content of this section', 'ftc-element' ),
					],
					[
						'slide_title'   => __( 'Slide #2', 'ftc-element' ),
						'slide_content' => __( 'This is main content of this section', 'ftc-element' ),
					],
				],
				'title_field' => '{{{ slide_title }}}',
			]
		);

		$this->add_control(
			'heading_slider_settings',
			[
				'label'     => __( 'Slider settings', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		

		$this->add_responsive_control(
			'slider_height',
			[
				'label'     => __( 'Slider height', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 1500,
						'min'  => 0,
						'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide' => 'height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slides_content_style',
			[
				'label' => __( 'Slides content style', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slide_content_padding',
			[
				'label'      => esc_html__( 'Content padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slide_content_spacing',
			[
				'label'     => __( 'Content elements spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '20',
				],
				'range'     => [
					'px' => [
						'max'  => 1500,
						'min'  => 0,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide > *' => 'margin-bottom:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_slide_title',
			[
				'label'     => __( 'Title', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_title_typography',
				'selector' => '{{WRAPPER}} .slide-title',
				
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label'     => __( 'Content', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_content_typography',
				'selector' => '{{WRAPPER}} .slide-content',
			
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' => __( 'Buttons style', 'ftc-element' ),
				'tab'  => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'buttons_padding',
			[
				'label'      => esc_html__( 'Buttons padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .slide-buttons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'buttons_back_color',
			[
				'label'     => __( 'Buttons back color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#30aa40',
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_back_hover_color',
			[
				'label'     => __( 'Buttons hover back color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_font_color',
			[
				'label'     => __( 'Buttons font color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_hover_font_color',
			[
				'label'     => __( 'Buttons hover font color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_border_width',
			[
				'label'     => __( 'Buttons border width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '0',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a' => 'border-width:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'buttons_border_radius',
			[
				'label'     => __( 'Buttons border radius', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '3',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a' => 'border-radius:{{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'buttons_border_color',
			[
				'label'     => __( 'Buttons border color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .slide-buttons a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_slider',
			[
				'label'     => __( 'Slider options', 'ftc-element' ),
				'tab'  => Controls_Manager::TAB_CONTENT,
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
					'style_5' => __( 'Style 5', 'ftc-element' ),
					'style_6' => __( 'Style 6', 'ftc-element' ),
				],
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
				'default' => 0,
				'min'     => 0,
				'step'    => 1,
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
					'bullets'     => __( 'Style 1', 'ftc-element' ),
					'progressbar' => __( 'Style 2', 'ftc-element' ),
					'fraction'    => __( 'Style 3', 'ftc-element' ),
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
	}

	/**
	 * Render slide buttons
	 *
	 * @param string $index - slide index.
	 * @param array  $button_link - slide button link.
	 * @param string $button_text - slide button text.
	 * @param string $button_class - css class.
	 * @return void
	 */
	private function _render_buttons( $index = '', $button_link = [], $button_text = '', $button_class = '' ) {

		$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'button_list', $index );

		$link     = ! empty( $button_link['url'] ) ? $button_link['url'] : '#';
		$link_key = 'link_' . $index;

		// Add general class attribute.
		$this->add_render_attribute( $link_key, 'class', 'ftc-button ' . $button_class );

		// Add link attribute.
		$this->add_render_attribute( $link_key, 'href', $link );
		// Add target attribute.
		if ( $button_link['is_external'] ) {
			$this->add_render_attribute( $link_key, 'target', '_blank' );
		}
		// Add nofollow attribute.
		if ( $button_link['nofollow'] ) {
			$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
		}

		echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
		echo esc_html( $button_text );
		echo '</a>';

	}


	/**
	 * Render slides widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$pps            = ! empty( $settings['posts_per_slide'] ) ? (int) $settings['posts_per_slide'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$style          = ! empty( $settings['style'] ) ? $settings['style'] : 'style_1';
		$buttons_style  = ! empty( $settings['buttons_style'] ) ? $settings['buttons_style'] : '';

		if ( $settings['slides'] ) {
			echo '<div class="ftc-all-slider '. esc_attr( $style ) .' swiper-container">';

			echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '"  data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $settings['space'] ) . '" data-space_mobile="30" data-pagin="' . esc_attr( $settings['pagination'] ) . '" data-autoplay="' . esc_attr( (int) $settings['autoplay'] ) . '" ' . ( $settings['loop'] ? 'data-loop="true"' : '' ) . ' class="slider-config">';

			echo '<div class="swiper-wrapper">';

			foreach ( $settings['slides'] as $index => $item ) {
				echo '<div class="elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' swiper-slide">';
				echo '<header class="header-slider" >';
				echo '<div class="image-content" >';
				if($item['image']) {
					// echo '<img src="' . $item['image']['url'] . '">';
					echo Group_Control_Image_Size::get_attachment_image_html( $item ); 
				}
				echo '</div>';
				echo '</header>';
				echo '<div class="group-slider">';
				echo '<h2 class="slide-title">' . esc_html( $item['slide_title'] ) . '</h2>';
				echo '<div class="slide-content">' . wp_kses_post( $item['slide_content'] ) . '</div>';

				echo '<div class="slide-buttons">';
				if ( $item['button_1_text'] ) {
					$this->_render_buttons( $index, $item['button_1_link'], $item['button_1_text'], 'button-1' );
				}
				if ( $item['button_2_text'] ) {
					$this->_render_buttons( $index, $item['button_2_link'], $item['button_2_text'], 'button-2' );
				}
				echo '</div>';
				echo '</div>';

				echo '<div class="slide-overlay"></div>';
				echo '<div class="slide-background"></div>';

				echo '</div>';
			}

			echo '</div>'; // .swiper-wrapper

			

			echo '</div>'; // .swiper-container
			// Pagination and arrows.
			if ( 'none' !== $settings['pagination'] ) {
				echo '<div class="swiper-pagination"></div>';
			}
			if ( $settings['buttons'] ) {
				echo '<div class="navigation-slider '.$buttons_style.'">';
				echo '<div class="nav-next" screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
				echo '<div class="nav-prev" screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';
				echo '</div>';
			}

			echo '
			<script>
			(function( $ ){
				"use strict";
				jQuery(document).ready( function($) {
					var ftc_slider = window.ftc_elements_swiper();
					});
					})( jQuery );
					</script>';
				}
				?>

				<?php
			}

	/**
	 * Render slides widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Slider() );
