<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Buttons extends Widget_Base {

	public function get_name() {
		return 'ftc-buttons';
	}

	public function get_title() {
		return __( 'FTC - Buttons', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Buttons Section', 'ftc-element' ),
			]
		);

		$this->add_control(
			'inherit',
			[
				'label'     => __( 'Inherit theme buttons style', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'ftc-element' ),
				'label_on'  => __( 'Yes', 'ftc-element' ),
			]
		);

		$this->add_control(
			'style_selectors',
			[
				'label'       => __( 'Add theme button style selectors', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Add theme style selector(s) here', 'ftc-element' ),
				'default'     => __( 'button', 'ftc-element' ),
				'label_block' => true,
				'condition'   => [
					'inherit!' => '',
				],
			]
		);

		$this->add_control(
			'orientation',
			[
				'label'   => __( 'Orientation', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'horizontal' => __( 'Horizontal', 'ftc-element' ),
					'vertical'   => __( 'Vertical', 'ftc-element' ),
				],
				'default' => 'horizontal',

			]
		);

		$this->add_control(
			'button_list',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						'text' => __( 'Button #1', 'ftc-element' ),
						'icon' => 'fa fa-check',
					],
				],
				'fields'      => [
					[
						'name'        => 'text',
						'label'       => __( 'Button text', 'ftc-element' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => __( 'Button Text', 'ftc-element' ),
						'default'     => __( 'Button Text', 'ftc-element' ),
					],
					[
						'name'        => 'icon',
						'label'       => __( 'Button icon', 'ftc-element' ),
						'type'        => Controls_Manager::ICON,
						'label_block' => true,
						'default'     => 'fa fa-check',
					],
					[
						'name'        => 'position_icon',
						'label'       => __( 'Icon Right', 'ftc-element' ),
						'type'      => Controls_Manager::SWITCHER,
						'label_off' => __( 'No', 'elementor' ),
						'label_on'  => __( 'Yes', 'elementor' ),
						'default'   => 'yes',
						'selectors' => [
							'{{WRAPPER}} span.button-icon-left{{CURRENT_ITEM}}' => 'display:none;',

						],
					],

					[
						'name'        => 'link',
						'label'       => __( 'Button link', 'ftc-element' ),
						'type'        => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => __( 'http://your-link.com', 'ftc-element' ),
					],

					[
						'name'      => 'text_color',
						'label'     => __( 'Text color', 'ftc-element' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} a.ftc-content-buttons{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
						],
					],
					[
						'name'      => 'back_color',
						'label'     => __( 'Background color', 'ftc-element' ),
						'type'      => Controls_Manager::COLOR,
						
						'selectors' => [
							'{{WRAPPER}} a.ftc-content-buttons{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
						],
					],

					[
						'name'      => 'text_color_hover',
						'label'     => __( 'Text hover color', 'ftc-element' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} a.ftc-content-buttons{{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
						],
					],
					[
						'name'      => 'back_color_hover',
						'label'     => __( 'Background hover color', 'ftc-element' ),
						'type'      => Controls_Manager::COLOR,
						
						'selectors' => [
							'{{WRAPPER}} a.ftc-content-buttons{{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
						],
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ text }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'ftc-element' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Buttons settings', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'    => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'        => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'      => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'fa fa-align-right',
					],
					'space-between' => [
						'title' => __( 'Justified', 'ftc-element' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ftc-buttons' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'orientation' => 'horizontal',
				],
			]
		);

		$this->add_responsive_control(
			'align_vertical',
			[
				'label'     => __( 'Alignment', 'ftc-element' ),
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
						'title' => __( 'Justified', 'ftc-element' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ftc-buttons' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'orientation' => 'vertical',
				],
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label'     => __( 'Buttons Horizontal Spacing', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-content-buttons' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'orientation' => 'horizontal',
				],
			]
		);

		$this->add_responsive_control(
			'space_between_vert',
			[
				'label'     => __( 'Buttons Vertical Spacing', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-content-buttons' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .ftc-content-buttons .button-icon .fa' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'     => __( 'Margin-right', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-content-buttons .button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_responsive_control(
			'icon_spacingg',
			[
				'label'     => __( 'Margin-left', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-content-buttons .button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} a.ftc-content-buttons .button-text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => __( 'Border', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ftc-content-buttons',
				'condition'   => [
					'inherit!' => 'yes',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.ftc-content-buttons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'inherit!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .ftc-content-buttons',
				'condition' => [
					'inherit!' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Button Padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.ftc-content-buttons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
				'condition'  => [
					'inherit!' => 'yes',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover animation', 'ftc-element' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$position_icon = ! empty( $settings['position_icon'] ) ? $settings['position_icon'] : '';

		// Buttons wrapper classes.
		$this->add_render_attribute( 'wrapper', 'class', 'ftc-buttons' );
		$this->add_render_attribute( 'wrapper', 'class', $settings['orientation'] );

		// Add animation class to all buttons.
		$this->add_render_attribute( 'buttons', 'class', 'elementor-button' );
		?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php
			$buttons = $settings['button_list'];
			if($position_icon){
				$this->add_render_attribute( 'icon', 'class', 'button-icon button-icon-right' );
			}
			else{
				$this->add_render_attribute( 'icon', 'class', 'button-icon button-icon-right' );
			}
			$this->add_render_attribute( 'text', 'class', 'button-text' );
			foreach ( $buttons as $index => $item ) {

				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'button_list', $index );

				$link     = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#';
				$link_key = 'link_' . $index;

				// Add general class attribute.
				$this->add_render_attribute( $link_key, 'class', 'ftc-content-buttons' );
				// Add item specific class attribute.
				$this->add_render_attribute( $link_key, 'class', 'elementor-repeater-item-' . $item['_id'] );
				// Add style selectors if theme inheritance is on.
				if ( $settings['inherit'] && $settings['style_selectors'] ) {
					$this->add_render_attribute( $link_key, 'class', $settings['style_selectors'] );
				}
				// Add hover animation class
				if ( $settings['hover_animation'] ) {
					$this->add_render_attribute( $link_key, 'class', 'elementor-animation-' . $settings['hover_animation'] );
				}
				// Add link attribute.
				$this->add_render_attribute( $link_key, 'href', $link );
				// Add target attribute.
				if ( $item['link']['is_external'] ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}
				// Add nofollow attribute.
				if ( $item['link']['nofollow'] ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}

				echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';

				if ( $item['icon'] && !$item['position_icon'] ) {
					echo '<span ' . $this->get_render_attribute_string( 'icon' ) . '>';
					echo '<i class="' . esc_attr( $item['icon'] ) . '"></i>';
					echo '</span>';
				}
				?>

				<?php if ( $item['text'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ) . $this->get_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></span>
				<?php } ?>
				<?php
				if ( $item['icon'] && $item['position_icon'] ) {
					echo '<span ' . $this->get_render_attribute_string( 'icon' ) . '>';
					echo '<i class="' . esc_attr( $item['icon'] ) . '"></i>';
					echo '</span>';
				}
				?>
				<?php
				echo '</a>';

				?>

			<?php } // end foreach ?>

		</div>

		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new FTc_Buttons() );
