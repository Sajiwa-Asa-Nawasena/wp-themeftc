<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class FTC_Logo extends Widget_Base {


	public function get_name() {
		return 'ftc_logo';
	}

	public function get_title() {
		return __( 'FTC - Logo', 'ftc-element' );
	}
	public function get_icon() {
		return 'ftc-icon';
	}
	public function get_categories() {
		return [ 'ftc-elements-header' ];
	}
	public function get_keywords() {
		return [ 'image', 'photo', 'visual' ];
	}
	public function get_script_depends() {
		return [ 'imagesloaded', 'jquery-swiper' ];
	}

	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'FTC Logo', 'ftc-element' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'ftc-element' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'ftc-element' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'editor',
			[
				'label' => __( 'Description logo', 'ftc-element' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '',
				'placeholder' => __( 'Enter your image caption', 'ftc-element' ),
			]
		);
		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'ftc-element' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$link = $settings['image']['url'];

		$set = $this->get_settings();
		$editor_content = ! empty( $set['editor'] ) ? $set['editor'] : '';

		$editor_content = $this->parse_text_editor( $editor_content );

		echo '<div class="ftc-element-logo">';
		
		echo '<div class="image-logo">';
		echo '<a href="'.esc_url(home_url()).'" class="ftc-home-url">';
		echo '<img src="'.esc_url($link).'" />';
		echo '</a>';
		echo '</div>';
		echo '<div class="description-logo">'.$editor_content.'</div>';
		echo '</div>';


	}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Logo() );
