<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Nav extends Widget_Base {

	public function get_name() {
		return 'ftc-nav';
	}

	public function get_title() {
		return __( 'FTC - Nav Menu', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	public function get_script_depends() {
		return [ 'smartmenus' ];
	}

	private $selector = '.ftc-elements-nav-menu';

	private function get_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->term_id ] = $menu->name;
		}

		return $options;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'General', 'ftc-element' ),
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

		$this->add_control(
			'layout',
			[
				'label'              => __( 'Layout', 'ftc-element' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'horizontal',
				'options'            => [
					'horizontal' => __( 'Horizontal', 'ftc-element' ),
					'vertical'   => __( 'Vertical', 'ftc-element' ),
					'dropdown'   => __( 'Dropdown', 'ftc-element' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'align_items',
			[
				'label'        => __( 'Menu align', 'ftc-element' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => [
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
				'prefix_class' => 'mme-menu-align-',
				'condition'    => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'hover_style',
			[
				'label'        => __( 'Hover style', 'ftc-element' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'background',
				'options'      => [
					'none'        => __( 'None', 'ftc-element' ),
					'underline'   => __( 'Underline', 'ftc-element' ),
					'overline'    => __( 'Overline', 'ftc-element' ),
					'double-line' => __( 'Double Line', 'ftc-element' ),
					'framed'      => __( 'Framed', 'ftc-element' ),
					'background'  => __( 'Background', 'ftc-element' ),
					'text'        => __( 'Text', 'ftc-element' ),
				],
				'prefix_class' => 'mme-hover-style-',
				'condition'    => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'animation_line',
			[
				'label'     => __( 'Animation', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => 'Fade',
					'slide'    => 'Slide',
					'grow'     => 'Grow',
					'drop-in'  => 'Drop In',
					'drop-out' => 'Drop Out',
				],
				'condition' => [
					'layout!'     => 'dropdown',
					'hover_style' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label'     => __( 'Animation', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'    => 'Fade',
					'grow'    => 'Grow',
					'shrink'  => 'Shrink',
					'draw'    => 'Draw',
					'corners' => 'Corners',
				],
				'condition' => [
					'layout!'     => 'dropdown',
					'hover_style' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_background',
			[
				'label'     => __( 'Animation', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'                   => 'Fade',
					'grow'                   => 'Grow',
					'shrink'                 => 'Shrink',
					'sweep-left'             => 'Sweep Left',
					'sweep-right'            => 'Sweep Right',
					'sweep-up'               => 'Sweep Up',
					'sweep-down'             => 'Sweep Down',
					'shutter-in-vertical'    => 'Shutter In Vertical',
					'shutter-out-vertical'   => 'Shutter Out Vertical',
					'shutter-in-horizontal'  => 'Shutter In Horizontal',
					'shutter-out-horizontal' => 'Shutter Out Horizontal',
				],
				'condition' => [
					'layout!'     => 'dropdown',
					'hover_style' => 'background',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label'     => __( 'Animation', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => 'Grow',
					'shrink' => 'Shrink',
					'sink'   => 'Sink',
					'float'  => 'Float',
					'skew'   => 'Skew',
					'rotate' => 'Rotate',
				],
				'condition' => [
					'layout!'     => 'dropdown',
					'hover_style' => 'text',
				],
			]
		);

		$this->add_control(
			'indicator',
			[
				'label'        => __( 'Submenu Indicator', 'ftc-element' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'classic',
				'options'      => [
					'none'    => __( 'None', 'ftc-element' ),
					'classic' => __( 'Classic', 'ftc-element' ),
					'chevron' => __( 'Chevron', 'ftc-element' ),
					'angle'   => __( 'Angle', 'ftc-element' ),
					'plus'    => __( 'Plus', 'ftc-element' ),
				],
				'prefix_class' => 'elementor-nav-menu--indicator-',
			]
		);

		$this->add_control(
			'heading_mobile_dropdown',
			[
				'label'     => __( 'Mobile Dropdown', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown',
			[
				'label'        => __( 'Breakpoint', 'ftc-element' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __( 'Mobile (767px >)', 'ftc-element' ),
					'tablet' => __( 'Tablet (1023px >)', 'ftc-element' ),
				],
				'prefix_class' => 'elementor-nav-menu--dropdown-',
				'condition'    => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'full_width',
			[
				'label'              => __( 'Full Width', 'ftc-element' ),
				'type'               => Controls_Manager::SWITCHER,
				'description'        => __( 'Stretch the dropdown of the menu to full width.', 'ftc-element' ),
				'prefix_class'       => 'elementor-nav-menu--',
				'return_value'       => 'stretch',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'text_align',
			[
				'label'        => __( 'Align', 'ftc-element' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'aside',
				'options'      => [
					'aside'  => __( 'Aside', 'ftc-element' ),
					'center' => __( 'Center', 'ftc-element' ),
				],
				'prefix_class' => 'elementor-nav-menu__text-align-',
			]
		);

		$this->add_control(
			'toggle',
			[
				'label'              => __( 'Toggle Button', 'ftc-element' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'burger',
				'options'            => [
					''       => __( 'None', 'ftc-element' ),
					'burger' => __( 'Hamburger', 'ftc-element' ),
				],
				'prefix_class'       => 'elementor-nav-menu--toggle elementor-nav-menu--',
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'toggle_align',
			[
				'label'                => __( 'Toggle Align', 'ftc-element' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'center',
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
				'selectors_dictionary' => [
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				],
				'selectors'            => [
					'{{WRAPPER}} .elementor-menu-toggle' => '{{VALUE}}',
				],
				'condition'            => [
					'toggle!' => '',
				],
				'label_block'          => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main_items',
			[
				'label'     => __( 'Menu Main Items', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'dropdown',
				],

			]
		);

		$this->add_control(
			'menu_main_items_desc',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Main items are first (or top) level items.', 'ftc-element' ),
				'separator'       => 'after',
				'content_classes' => 'elementor-control-field-description',
			]
		);

		$this->add_control(
			'heading_items_style',
			[
				'type'  => Controls_Manager::HEADING,
				'label' => __( 'Items Style', 'ftc-element' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'main_items_typography',
				'label'     => __( 'Items typography', 'ftc-element' ),
		
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} ' . $this->selector . ' > .menu-item > .mme-navmenu-link',
			]
		);

		$this->start_controls_tabs( 'tabs_item_style' );

		$this->start_controls_tab(
			'tab_item_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'textcolor_menu_item',
			[
				'label'     => __( 'Items text color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' .menu-item .mme-navmenu-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);

		$this->add_control(
			'textcolor_item_hover',
			[
				'label'     => __( 'Items text color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' .menu-item .mme-navmenu-link:hover,
					{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active,
					{{WRAPPER}} .elementor-nav-menu--main .elementor-item.highlighted,
					{{WRAPPER}} .elementor-nav-menu--main .elementor-item:focus' => 'color: {{VALUE}}',
				],
				/* 'condition' => [
					'hover_style!' => 'background',
				], */
			]
		);

		$this->add_control(
			'style_color_item_hover',
			[
				'label'     => __( 'Hover style color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' .menu-item .mme-navmenu-link:hover:before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'hover_style!' => [ 'none', 'text' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => __( 'Active', 'ftc-element' ),
			]
		);

		$this->add_control(
			'color_item_active',
			[
				'label'     => __( 'Items text color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' .menu-item .mme-navmenu-link:hover:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_color_item_active',
			[
				'label'     => __( 'Active style color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' .menu-item .mme-navmenu-link:active:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'hover_style!' => [ 'none', 'text' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pointer_width',
			[
				'label'     => __( 'Hover style lines width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'devices'   => [ self::RESPONSIVE_DESKTOP, self::RESPONSIVE_TABLET ],
				'range'     => [
					'px' => [
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' > .menu-item > .mme-navmenu-link:before' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'hover_style' => [ 'underline', 'overline', 'double-line', 'framed' ],
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_menu_item',
			[
				'label'     => __( 'Horizontal items padding', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'devices'   => [ 'desktop', 'tablet' ],
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' > .menu-item > .mme-navmenu-link' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'padding_vertical_menu_item',
			[
				'label'     => __( 'Vertical items padding', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'devices'   => [ 'desktop', 'tablet' ],
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' > .menu-item > .mme-navmenu-link' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'items_spacing',
			[
				'label'     => __( 'Items spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'devices'   => [ 'desktop', 'tablet' ],
				'selectors' => [
					'{{WRAPPER}} ' . $this->selector . ' > .menu-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius_menu_item',
			[
				'label'      => __( 'Border Radius', 'ftc-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'devices'    => [ 'desktop', 'tablet' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
					'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:after' => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:before' => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
					'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:after' => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'hover_style' => 'background',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_submenus',
			[
				'label' => __( 'Sub menus', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'submenus_description',
			[
				'raw'             => __( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'ftc-element' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->start_controls_tabs( 'tabs_submenu_item_style' );

		$this->start_controls_tab(
			'tab_submenu_item_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'color_submenu_item',
			[
				'label'     => __( 'Text Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown a, {{WRAPPER}} .elementor-menu-toggle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_submenu_item',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submenu_item_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);

		$this->add_control(
			'color_submenu_item_hover',
			[
				'label'     => __( 'Text Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown a:hover, {{WRAPPER}} .elementor-menu-toggle:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_submenu_item_hover',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown a:hover,
					{{WRAPPER}} .elementor-nav-menu--dropdown a.highlighted' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'submenu_typography',
				'label'     => __( 'Typography', 'ftc-element' ),
			
				'exclude'   => [ 'line_height' ],
				'selector'  => '{{WRAPPER}} .elementor-nav-menu--dropdown',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'submenu_border',
				'label'     => __( 'Border', 'ftc-element' ),
				'selector'  => '{{WRAPPER}} .elementor-nav-menu--dropdown',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'submenu_border_radius',
			[
				'label'      => __( 'Border Radius', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementor-nav-menu--dropdown li:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .elementor-nav-menu--dropdown li:last-child' => 'border-radius: {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'submenu_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elementor-nav-menu--main .elementor-nav-menu--dropdown, {{WRAPPER}} .elementor-nav-menu__container.elementor-nav-menu--dropdown',
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_submenu_item',
			[
				'label'     => __( 'Horizontal Padding', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',

			]
		);

		$this->add_responsive_control(
			'padding_vertical_submenu_item',
			[
				'label'     => __( 'Vertical Padding', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_submenu_divider',
			[
				'label'     => __( 'Divider', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'submenu_divider',
				'label'    => __( 'Divider', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown li:not(:last-child)',
				'exclude'  => [ 'width' ],
			]
		);

		$this->add_control(
			'submenu_divider_width',
			[
				'label'     => __( 'Border Width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--dropdown li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'dropdown_divider_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'submenu_top_distance',
			[
				'label'     => __( 'Distance', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-nav-menu--main > .elementor-nav-menu > li > .elementor-nav-menu--dropdown, {{WRAPPER}} .elementor-nav-menu__container.elementor-nav-menu--dropdown' => 'margin-top: {{SIZE}}{{UNIT}} !important',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			[
				'label'     => __( 'Toggle Button', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'toggle!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.elementor-menu-toggle' => 'color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-menu-toggle' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label'     => __( 'Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.elementor-menu-toggle:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color_hover',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-menu-toggle:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'toggle_size',
			[
				'label'     => __( 'Size', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_border_width',
			[
				'label'     => __( 'Border Width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-menu-toggle' => 'border-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'toggle_border_radius',
			[
				'label'      => __( 'Border Radius', 'ftc-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$available_menus = $this->get_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings = $this->get_active_settings();

		// new Ftc_Nav_Html( $settings['menu'], $settings['layout'] );
		 get_template_part( 'template-parts/navigation/navigation', 'primary' );

	}

	public function render_plain_content() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Nav() );
