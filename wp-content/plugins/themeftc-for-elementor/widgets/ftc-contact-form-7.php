<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_CF7_Forms extends Widget_Base {

	public function get_name() {
		return 'ftc-cf7-forms';
	}

	public function get_title() {
		return __( 'FTC - Contact Form 7 Forms', 'ftc-element' );
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
				'label' => esc_html__( 'Contact Form 7', 'ftc-element' ),   //section name for controler view
			]
		);

		$this->add_control(
			'cf7_slug',
			[
				'label'       => esc_html__( 'Select Contact Form', 'ftc-element' ),
				'description' => esc_html__( 'Contact form 7 - Plugin must be installed' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => apply_filters( 'ftc_posts_array', 'wpcf7_contact_form' ),
			]
		);
		$this->add_control(
			'style_contact',
			[
				'label'       => esc_html__( 'Select Style', 'ftc-element' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'style_c1',
				'options' => [
					'style_c1' => __( 'Default', 'ftc-element' ),
					'style_c2' => __( 'Style 2', 'ftc-element' ),
					'style_c3' => __( 'Style 3', 'ftc-element' ),
					'style_c4' => __( 'Style 4', 'ftc-element' ),
					'style_c5' => __( 'Style 5', 'ftc-element' ),
					'style_c6' => __( 'Style 6', 'ftc-element' ),
					'style_c7' => __( 'Style 7', 'ftc-element' ),
					'style_c8' => __( 'Style 8', 'ftc-element' ),
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
		$cf7_slug = $settings['cf7_slug'];
		$style_contact         = ! empty( $settings['style_contact'] ) ? $settings['style_contact'] : 'style_c1';
		
		if ( ! empty( $cf7_slug ) ) {

			if ( $post = get_page_by_path( $cf7_slug, OBJECT, 'wpcf7_contact_form' ) ) {
				$id = $post->ID;
			} else {
				$id = 0;
			}

			echo'<div class="ftc-contact-form ' . esc_attr( $style_contact ) . '">';

				echo do_shortcode( '[contact-form-7 id="' . $id . '"]' );

			echo '</div>';
		}

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_CF7_Forms() );
