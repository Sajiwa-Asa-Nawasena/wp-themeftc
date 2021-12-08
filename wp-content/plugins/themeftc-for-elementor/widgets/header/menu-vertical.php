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
class FTC_Vertical_Menu extends Widget_Base {


	public function get_name() {
		return 'ftc_vertical_menu';
	}

	public function get_title() {
		return __( 'FTC - Vertical Menu', 'ftc-element' );
	}
	public function get_icon() {
		return 'ftc-icon';
	}
	public function get_categories() {
		return [ 'ftc-elements-header' ];
	}
	private function get_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->term_id ] = $menu->name;
		}

		return $options;
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
				'label' => __( 'FTC Vertical Menu', 'ftc-element' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon', 'ftc-element' ),
				'type' => Controls_Manager::ICON,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc-vertical-menu .title-menu i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title Vertical Menu', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Add title in here', 'ftc-element' ),
				'default'     => __( 'Vertical Menu', 'ftc-element' ),
			]
		);
		$menus = $this->get_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'       => __( 'Select menu', 'ftc-element' ),
					'type'        => Controls_Manager::SELECT,
					'options'     => $menus,
					'default'     => array_keys( $menus )[0],
					'separator'   => 'after',
					'description' => sprintf( __( 'To manage nav menus, navigate to <a href="%s" target="_blank">Menus admin</a>.', 'ftc-element' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( __( '<strong>It seems no menus are created.</strong><br>Navigate to <a href="%s" target="_blank">Menus admin</a> and create one.', 'ftc-element' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}


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
		$title  = ! empty( $set['title'] ) ? $set['title'] : 'Vertical Menu';
		$menu   = ! empty( $set['menu'] ) ? $set['menu'] : '';
		
		?>
		<div class="ftc-element ftc-vertical-menu">
			<div class="title-menu">
				
				<h3 class="title"><i class="<?php echo esc_attr($icon)?>"></i><?php echo esc_attr($title); ?></h3>
			</div>
			<div class="menu-dropdown">
				<?php wp_nav_menu( array( 'theme_location' => 'vertical' , 'menu' => $menu , 'menu_id' => 'vertical-menu') ); ?>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Vertical_Menu() );
