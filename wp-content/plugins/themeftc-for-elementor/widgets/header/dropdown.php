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
class FTC_Dropdown_Header extends Widget_Base {


	public function get_name() {
		return 'ftc_dropdown_header';
	}

	public function get_title() {
		return __( 'FTC - Dropdown', 'ftc-element' );
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
				'label' => __( 'FTC Dropdown', 'ftc-element' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon Dropdown', 'ftc-element' ),
				'type' => Controls_Manager::ICON,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'heading_slider',
			[
				'label'     => __( 'Content Dropdown', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'cart',
			[
				'label'     => esc_html__( 'Show Shopping Cart', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'wishlist',
			[
				'label'     => esc_html__( 'Show Wishlist', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'account',
			[
				'label'     => esc_html__( 'Show My Account', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'currency',
			[
				'label'     => esc_html__( 'Show Curency Swicher ', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'language',
			[
				'label'     => esc_html__( 'Show Language Swicher ', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'checkout',
			[
				'label'     => esc_html__( 'Show Checkout ', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'custom_editor',
			[
				'label'     => esc_html__( 'Show Custom Content', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'no',
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
				'default' => __( 'Custom content', 'ftc-elements' ),
				 'condition' => [
					'custom_editor' => 'yes',
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
					'{{WRAPPER}} .header-dropdown-element .content-dropdown' =>'{{VALUE}} : 0',

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
		$cart = ! empty( $set['cart'] ) ? $set['cart'] : '';
		$wishlist = ! empty( $set['wishlist'] ) ? $set['wishlist'] : '';
		$account = ! empty( $set['account'] ) ? $set['account'] : '';
		$currency = ! empty( $set['currency'] ) ? $set['currency'] : '';
		$language = ! empty( $set['language'] ) ? $set['language'] : '';
		$checkout = ! empty( $set['checkout'] ) ? $set['checkout'] : '';
		$custom_editor = ! empty( $set['custom_editor'] ) ? $set['custom_editor'] : '';
		$editor_content = ! empty( $set['editor'] ) ? $set['editor'] : '';
		$editor_content = $this->parse_text_editor( $editor_content );

		echo '<div class="header-dropdown-element">';
		echo '<div class="header-icon">';
		echo '<i class="'.esc_attr($icon).'"></i>';
		echo '</div>';
		echo '<div class="content-dropdown">';
		if($cart){
			echo ftc_tiny_cart();
		}
		if($wishlist){
			echo ftc_tini_wishlist();
		}
		if ($account) {
			echo ftc_tiny_account();
		}
		if($currency){
			echo ftc_woocommerce_multilingual_currency_switcher();
		}
		if($language){
			echo ftc_wpml_language_selector();
		}
		if($checkout){
			if (ftc_has_woocommerce()){
				?>
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="ftc-checkout-menu">
					<?php echo esc_html__('Checkout', 'ornaldo'); ?></a>
					<?php
				}
			}
			if($custom_editor){
				echo $editor_content;
			}
			echo '</div>';
			echo '</div>';
			?>
			<script type="text/javascript">
				(function ($) {
					"use strict";
					$('.header-dropdown-element').each(function(){
						$(this).find('.header-icon i').on('click', function(){
							$(this).closest('.header-dropdown-element').find('.content-dropdown').slideToggle();
						});
					});
				});
			</script>
			<?php


		}
	}
	Plugin::instance()->widgets_manager->register_widget_type( new FTC_Dropdown_Header() );
