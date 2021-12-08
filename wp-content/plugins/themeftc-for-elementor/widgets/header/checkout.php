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
class FTC_Header_Checkout extends Widget_Base {


	public function get_name() {
		return 'ftc_header_checkout';
	}

	public function get_title() {
		return __( 'FTC - Checkout', 'ftc-element' );
	}
	public function get_icon() {
		return 'ftc-icon';
	}
	public function get_categories() {
		return [ 'ftc-elements-header' ];
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
				'label' => __( 'FTC Checkout', 'ftc-element' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon Checkout', 'ftc-element' ),
				'type' => Controls_Manager::ICON,
				'dynamic' => [
					'active' => true,
				],
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
		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Icon size', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.ftc-checkout-menu i' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_responsive_control(
			'text_size',
			[
				'label'     => __( 'Text size', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.ftc-checkout-menu' => 'font-size: {{SIZE}}{{UNIT}};',
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

		$set = $this->get_settings();
		$icon = ! empty( $set['icon'] ) ? $set['icon'] : '';
		
		if (ftc_has_woocommerce()){
			?>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="ftc-checkout-menu">
				  <i class="<?php echo esc_attr($icon)?>"></i>
				<?php esc_html_e('Checkout', 'karo'); ?></a>
			<?php
		}
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Header_Checkout );
