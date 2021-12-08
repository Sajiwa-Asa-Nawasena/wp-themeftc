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
class FTC_Shopping_Cart extends Widget_Base {


	public function get_name() {
		return 'ftc_shooping_cart';
	}

	public function get_title() {
		return __( 'FTC - Shopping Cart', 'ftc-element' );
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
				'label' => __( 'FTC Shopping Cart', 'ftc-element' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon Cart', 'ftc-element' ),
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
		$editor_content = ! empty( $set['editor'] ) ? $set['editor'] : '';

		$editor_content = $this->parse_text_editor( $editor_content );
		
	
		global $smof_data;
            ?>
            <div class="ftc-tini-cart">
                <div class="cart-item">
                    <a class="ftc-cart-tini <?php if($smof_data['ftc_cart_layout'] == 'off-canvas') {
                        echo "cart-item-canvas";
                    } ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                    <?php echo ftc_cart_total(); ?>
                </a>
            </div>
            <?php if($smof_data['ftc_cart_layout'] == 'dropdown'): ?>
                <div class="tini-cart-inner">
                    <div class="woocommerce widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                            <?php echo woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Shopping_Cart() );
