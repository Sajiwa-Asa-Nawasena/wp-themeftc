<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Rev_Slider extends Widget_Base {

	public function get_name() {
		return 'ftc-rev-slider';
	}

	public function get_title() {
		return __( 'FTC - Revolution Slider', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - Revolution Slider', 'ftc-element' ),
			]
		);

		$this->add_control(
			'slider',
			[
				'label'    => esc_html__( 'Select revolution slider', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_rev_sliders', '' ),
				'multiple' => false,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();

		$slider = ! empty( $settings['slider'] ) ? $settings['slider'] : '';

		if ( $slider ) {

			$slider_shortcode = '[rev_slider alias="' . $slider . '"]';

			echo do_shortcode( $slider_shortcode );

		}

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Rev_Slider() );
