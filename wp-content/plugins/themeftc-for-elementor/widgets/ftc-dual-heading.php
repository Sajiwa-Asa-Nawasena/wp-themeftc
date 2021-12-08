<?php
namespace Elementor;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;

class Ftc_Dual_Heading extends Widget_Base {

	public function get_name() {
		return 'ftc-dual-heading';
	}

	public function get_title() {
		return esc_html__( 'FTC - Dual Heading', 'ftc-element');
	}

	public function get_icon() {
		return 'ftc-icon';
	}

   	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

  		/**
  		 * Dual Color Heading Content Settings
  		 */
  		$this->start_controls_section(
  			'ftc_content_settings',
  			[
  				'label' => esc_html__( 'Content Settings', 'ftc-element')
  			]
  		);

  		$this->add_control(
		  'ftc_dch_type',
		  	[
		   	'label'       	=> esc_html__( 'Content Style', 'ftc-element'),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'dch-default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'dch-default'  					=> esc_html__( 'Default', 'ftc-element'),
		     		'dch-icon-on-top'  				=> esc_html__( 'Icon on top', 'ftc-element'),
		     		'dch-icon-subtext-on-top'  	=> esc_html__( 'Icon &amp; sub-text on top', 'ftc-element'),
		     		'dch-subtext-on-top'  			=> esc_html__( 'Sub-text on top', 'ftc-element'),
		     	],
		  	]
		);

		$this->add_control(
			'ftc_show_dch_icon_content',
			[
				'label' => __( 'Show Icon', 'ftc-element'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'ftc-element'),
				'label_off' => __( 'Hide', 'ftc-element'),
				'return_value' => 'yes',
				'separator' => 'after',
			]
		);
		/**
		 * Condition: 'ftc_show_dch_icon_content' => 'yes'
		 */
		$this->add_control(
			'ftc_dch_icon_new',
			[
				'label' => esc_html__( 'Icon', 'ftc-element'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ftc_dch_icon',
				'default' => [
					'value' => 'fas fa-snowflake',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ftc_show_dch_icon_content' => 'yes'
				]
			]
		);

		$this->add_control(
            'title_tag',
            [
                'label' => __('Title Tag', 'ftc-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => __('H1', 'ftc-element'),
                    'h2' => __('H2', 'ftc-element'),
                    'h3' => __('H3', 'ftc-element'),
                    'h4' => __('H4', 'ftc-element'),
                    'h5' => __('H5', 'ftc-element'),
                    'h6' => __('H6', 'ftc-element'),
                    'span' => __('Span', 'ftc-element'),
                    'p' => __('P', 'ftc-element'),
                    'div' => __('Div', 'ftc-element'),
                ],
            ]
        );

		$this->add_control(
			'ftc_dch_first_title',
			[
				'label' => esc_html__( 'Title ( First Part )', 'ftc-element'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Dual Heading', 'ftc-element'),
				'dynamic' => [ 'action' => true ]
			]
		);

		$this->add_control(
			'ftc_dch_last_title',
			[
				'label' => esc_html__( 'Title ( Last Part )', 'ftc-element'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Example', 'ftc-element'),
				'dynamic' => [ 'action' => true ]
			]
		);

		$this->add_control(
			'ftc_dch_subtext',
			[
				'label' => esc_html__( 'Sub Text', 'ftc-element'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Insert a meaningful line to evaluate the headline.', 'ftc-element')
			]
		);

		$this->add_responsive_control(
			'ftc_dch_content_alignment',
			[
				'label' => esc_html__( 'Alignment', 'ftc-element'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ftc-element'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ftc-element'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ftc-element'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'ftc-dual-header-content-align-'
			]
		);

		$this->end_controls_section();

		if(!apply_filters('ftc/pro_enabled', false)) {
			$this->start_controls_section(
				'ftc_section_pro',
				[
					'label' => __( 'Go Premium for More Features', 'ftc-element')
				]
			);
		
			$this->add_control(
				'ftc_control_get_pro',
				[
					'label' => __( 'Unlock more possibilities', 'ftc-element'),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => __( '', 'ftc-element'),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Get the  <a href="https://wpdeveloper.net/in/upgrade-essential-addons-elementor" target="_blank">Pro version</a> for more stunning elements and customization options.</span>'
				]
			);
			
			$this->end_controls_section();
		}

		/**
		 * -------------------------------------------
		 * Tab Style ( Dual Heading Style )
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ftc_section_dch_style_settings',
			[
				'label' => esc_html__( 'Dual Heading Style', 'ftc-element'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ftc_dch_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ftc-element'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ftc-dual-header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ftc_dch_container_padding',
			[
				'label' => esc_html__( 'Padding', 'ftc-element'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ftc-dual-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'ftc_dch_container_margin',
			[
				'label' => esc_html__( 'Margin', 'ftc-element'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .ftc-dual-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ftc_dch_border',
				'label' => esc_html__( 'Border', 'ftc-element'),
				'selector' => '{{WRAPPER}} .ftc-dual-header',
			]
		);

		$this->add_control(
			'ftc_dch_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ftc-element'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ftc-dual-header' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ftc_dch_shadow',
				'selector' => '{{WRAPPER}} .ftc-dual-header',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ftc_section_dch_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'ftc-element'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'ftc_show_dch_icon_content' => 'yes'
		     	]
			]
		);

		$this->add_control(
    		'ftc_dch_icon_size',
    		[
        		'label' => __( 'Icon Size', 'ftc-element'),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 36,
        		],
        		'range' => [
					'px' => [
						'min' => 20,
						'max' => 500,
						'step' => 1,
					]
        		],
        		'selectors' => [
					'{{WRAPPER}} .ftc-dual-header i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ftc-dual-header img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
        		]
    		]
		);

		$this->add_control(
			'ftc_dch_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'ftc-element'),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ftc-dual-header i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ftc_section_dch_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'ftc-element'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ftc_dch_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'ftc-element'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ftc_dch_base_title_color',
			[
				'label' => esc_html__( 'Main Color', 'ftc-element'),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ftc-dual-header .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ftc_dch_dual_title_color',
			[
				'label' => esc_html__( 'Dual Color', 'ftc-element'),
				'type' => Controls_Manager::COLOR,
				'default' => '#1abc9c',
				'selectors' => [
					'{{WRAPPER}} .ftc-dual-header .title span.lead' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ftc_dch_first_title_typography',
				'selector' => '{{WRAPPER}} .ftc-dual-header .title, {{WRAPPER}} .ftc-dual-header .title span',
			]
		);

		$this->add_control(
			'ftc_dch_sub_title_heading',
			[
				'label' => esc_html__( 'Sub-title Style ', 'ftc-element'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ftc_dch_subtext_color',
			[
				'label' => esc_html__( 'Color', 'ftc-element'),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .ftc-dual-header .subtext' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'ftc_dch_subtext_typography',
				'selector' => '{{WRAPPER}} .ftc-dual-header .subtext',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon_migrated = isset($settings['__fa4_migrated']['ftc_dch_icon_new']);
		$icon_is_new = empty($settings['ftc_dch_icon']);

	?>
	<?php if( 'dch-default' == $settings['ftc_dch_type'] ) : ?>
	<div class="ftc-dual-header">
		<<?php echo $settings['title_tag']; ?> class="title"><span class="lead"><?php esc_html_e( $settings['ftc_dch_first_title'], 'ftc-element'); ?></span> <span><?php esc_html_e( $settings['ftc_dch_last_title'], 'ftc-element'); ?></span></<?php echo $settings['title_tag']; ?>>
	   <span class="subtext"><?php echo $settings['ftc_dch_subtext']; ?></span>
	   <?php if( 'yes' == $settings['ftc_show_dch_icon_content'] ) : ?>
			<?php if($icon_is_new || $icon_migrated) { ?>
				<?php if ( isset( $settings['ftc_dch_icon_new']['value']['url'] ) ) : ?>
					<img src="<?php echo esc_attr( $settings['ftc_dch_icon_new']['value']['url'] ); ?>" alt="<?php echo esc_attr(get_post_meta($settings['ftc_dch_icon_new']['value']['id'], '_wp_attachment_image_alt', true)); ?>"/>
				<?php else : ?>
					<i class="<?php echo esc_attr( $settings['ftc_dch_icon_new']['value'] ); ?>"></i>
				<?php endif; ?>
			<?php } else { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon'] ); ?>"></i>
			<?php } ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if( 'dch-icon-on-top' == $settings['ftc_dch_type'] ) : ?>
	<div class="ftc-dual-header">
		<?php if( 'yes' == $settings['ftc_show_dch_icon_content'] ) : ?>
			<?php if($icon_is_new || $icon_migrated) { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon_new']['value'] ); ?>"></i>
			<?php } else { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon'] ); ?>"></i>
			<?php } ?>
		<?php endif; ?>
		<<?php echo $settings['title_tag']; ?> class="title"><span class="lead"><?php esc_html_e( $settings['ftc_dch_first_title'], 'ftc-element'); ?></span> <span><?php esc_html_e( $settings['ftc_dch_last_title'], 'ftc-element'); ?></span></<?php echo $settings['title_tag']; ?>>
	   <span class="subtext"><?php echo $settings['ftc_dch_subtext']; ?></span>
	</div>
	<?php endif; ?>

	<?php if( 'dch-icon-subtext-on-top' == $settings['ftc_dch_type'] ) : ?>
	<div class="ftc-dual-header">
		<?php if( 'yes' == $settings['ftc_show_dch_icon_content'] ) : ?>
			<?php if($icon_is_new || $icon_migrated) { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon_new']['value'] ); ?>"></i>
			<?php } else { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon'] ); ?>"></i>
			<?php } ?>
		<?php endif; ?>
	   <span class="subtext"><?php echo $settings['ftc_dch_subtext']; ?></span>
	   <<?php echo $settings['title_tag']; ?> class="title"><span class="lead"><?php esc_html_e( $settings['ftc_dch_first_title'], 'ftc-element'); ?></span> <span><?php esc_html_e( $settings['ftc_dch_last_title'], 'ftc-element'); ?></span></<?php echo $settings['title_tag']; ?>>
	</div>
	<?php endif; ?>

	<?php if( 'dch-subtext-on-top' == $settings['ftc_dch_type'] ) : ?>
	<div class="ftc-dual-header">
	   <span class="subtext"><?php echo $settings['ftc_dch_subtext']; ?></span>
			<<?php echo $settings['title_tag']; ?> class="title"><span class="lead"><?php esc_html_e( $settings['ftc_dch_first_title'], 'ftc-element'); ?></span> <span><?php esc_html_e( $settings['ftc_dch_last_title'], 'ftc-element'); ?></span></<?php echo $settings['title_tag']; ?>>
		<?php if( 'yes' == $settings['ftc_show_dch_icon_content'] ) : ?>
			<?php if($icon_is_new || $icon_migrated) { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon_new']['value'] ); ?>"></i>
			<?php } else { ?>
				<i class="<?php echo esc_attr( $settings['ftc_dch_icon'] ); ?>"></i>
			<?php } ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Dual_Heading() );