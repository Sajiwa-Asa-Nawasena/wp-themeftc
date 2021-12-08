<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Footer_Element extends Widget_Base {

	public function get_name() {
		return 'ftc-footer-element';
	}

	public function get_title() {
		return __( 'FTC - Footer', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - Footer', 'ftc-element' ),
			]
		);

		$this->add_control(
			'footer',
			[
				'label'    => esc_html__( 'Select Footer', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_footer', '' ),
				'multiple' => false,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();

		$footer = ! empty( $settings['footer'] ) ? $settings['footer'] : '';

		if ( $footer) {

			 // echo get_post_field('post_content', $footer); 
			echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer);
}

}

protected function content_template() {}

public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Footer_Element() );
