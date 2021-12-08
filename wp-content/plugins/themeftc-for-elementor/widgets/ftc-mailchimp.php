<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Mailchimp extends Widget_Base {

	public function get_name() {
		return 'ftc-mc4wp-forms';
	}

	public function get_title() {
		return __( 'FTC - MailChimp 4 WP Forms', 'ftc-element' );
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
				'label' => esc_html__( 'MailChimp for WP', 'ftc-element' ),
			]
		);

		$this->add_control(
			'mc4wp_slug',
			[
				'label'       => esc_html__( 'Select Newsletter Form', 'ftc-element' ),
				'description' => esc_html__( '"MailChimp for WP" - with free version only one form is available - purchase Premuim version of "MailChimp 4 WP" for more forms.', 'ftc-element' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array_merge(
					[ '' => esc_html__( 'Select the newlsetter form', 'ftc-element' ) ],
					apply_filters( 'ftc_posts_array', 'mc4wp-form' )
				),
			]
		);

		$this->add_control(
			'orientation',
			[
				'label'       => esc_html__( 'Orientation', 'ftc-element' ),
				'description' => esc_html__( 'stack form elements vertically or horizontally', 'ftc-element' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'row',
				'options'     => [
					'row'    => esc_html__( 'Horizontal', 'ftc-element' ),
					'column' => esc_html__( 'Vertical', 'ftc-element' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .ftc-elements_mc4wp .mc4wp-form-fields' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Form Alignment', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'fa fa-align-right',
					],
					'stretch'    => [
						'title' => __( 'Justify', 'ftc-element' ),
						'icon'  => 'fa fa-align-justify',
					],

				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_width',
			[
				'label'          => __( 'Form Width', 'ftc-element' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => '',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%' ],
				'range'          => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} .mc4wp-form-fields' => 'width: {{SIZE}}{{UNIT}}',
				],

			]
		);

		$this->add_responsive_control(
			'email_input_width',
			[
				'label'     => __( 'Email Input Width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => 'px',
					'size' => '',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=email]' => 'width: {{SIZE}}{{UNIT}}',
				],

			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'      => esc_html__( 'Input elements margins', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input, {{WRAPPER}} .mc4wp-form-fields select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings   = $this->get_settings();
		$mc4wp_slug = $settings['mc4wp_slug'];

		if ( ! empty( $mc4wp_slug ) ) {

			if ( $post = get_page_by_path( $mc4wp_slug, OBJECT, 'mc4wp-form' ) ) {
				$id = $post->ID;
			} else {
				$id = 0;
			}

			echo'<div class="ftc-elements_mc4wp elementor-shortcode">';

				echo do_shortcode( '[mc4wp_form id="' . $id . '"]' );

			echo '</div>';
		}

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Mailchimp() );
