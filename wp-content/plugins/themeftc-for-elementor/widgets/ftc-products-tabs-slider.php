<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class FTC_WC_Products_Tabs extends Widget_Base {


	public function get_name() {
		return 'ftc-products-tabs';
	}

	public function get_title() {
		return __( 'FTC - Products Tabs Slider', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_tabs',
			[
				'label' => __( 'FTC Products Tabs Slider', 'ftc-element' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'   => __( 'Type', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'ftc-element' ),
					'vertical'   => __( 'Vertical', 'ftc-element' ),
				],
				//'prefix_class' => 'elementor-tabs-view-',
			]
		);
		$this->add_control(
			'def_style',
			[
				'label' => esc_html__( 'Apply style default', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'yes' => __( 'Yes', 'ftc-element' ),
					'no' => __( 'No', 'ftc-element' ),
				],
				'default' => 'no',
			]
		);
		$this->add_control(
			'def_style_option',
			[
				'label' => __( 'Default style', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'def_style_1',
				'options' => [
					'def_style_1' => __( 'Default', 'ftc-element' ),
					'def_style_2' => __( 'Button Inside', 'ftc-element' ),
					'def_style_3' => __( 'Hover Gallery', 'ftc-element' ),
					'def_style_4' => __( 'Style 4', 'ftc-element' ),
					'def_style_5' => __( 'Style 5', 'ftc-element' ),
					'def_style_6' => __( 'Style 6', 'ftc-element' ),
					'def_style_7' => __( 'Style 7', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Customize Style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'default', 'ftc-element' ),
					'style_2'   => __( 'Style 2', 'ftc-element' ),
					'style_3'   => __( 'Style 3', 'ftc-element' ),
					'style_4'   => __( 'Style 4', 'ftc-element' ),
					'style_5'   => __( 'Style 5', 'ftc-element' ),
					'style_6'   => __( 'Style 6 (Only Show gallery)', 'ftc-element' ),
					'style_7'   => __( 'Style 7', 'ftc-element' ),
					'style_8'   => __( 'Style 8', 'ftc-element' ),
				],
				'condition' => ['def_style' => 'no'],
				//'prefix_class' => 'elementor-tabs-view-',
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'   => __( 'Tabs Items', 'ftc-element' ),
				'type'    => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'            => __( 'Tab Title #1', 'ftc-element' ),
						'posts_per_page'       => 6,
						'offset'               => 0,
						'products_per_row'     => 4,
						'products_per_row_tab' => 2,
						'products_per_row_mob' => 2,
						'categories'           => '',
						'exclude_cats'         => '',
						'filters'              => '',
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ tab_title }}}',
				'fields'  => [
					[
						'name'        => 'tab_title',
						'label'       => __( 'Tab title #', 'ftc-element' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => __( 'Tab Title #', 'ftc-element' ),
						'placeholder' => __( 'Tab Title', 'ftc-element' ),
						'label_block' => true,
					],

					[
						'name'  =>'image',
						'label' => __( 'Image icon', 'ftc-element' ),
						'type' => Controls_Manager::MEDIA,
						'dynamic' => [
							'active' => true,
						],
						'default' => [
							'url' => '',
						],
					],

					[
						'name'    => 'posts_per_page',
						'label'   => __( 'Total products', 'ftc-element' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => '6',
						'title'   => __( 'Enter total number of products to show', 'ftc-element' ),
					],

					[
						'name'    => 'offset',
						'label'   => __( 'Offset', 'ftc-element' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => '',
						'title'   => __( 'Offset is a number of skipped products', 'ftc-element' ),
					],

					[
						'name'     => 'categories',
						'label'    => esc_html__( 'Select product categories', 'ftc-element' ),
						'type'     => Controls_Manager::SELECT2,
						'default'  => array(),
						'options'  => apply_filters( 'ftc_elements_terms', 'product_cat' ),
						'multiple' => true,
					],

					[
						'name'     => 'exclude_cats',
						'label'    => esc_html__( 'Exclude product categories', 'ftc-element' ),
						'type'     => Controls_Manager::SELECT2,
						'default'  => array(),
						'options'  => apply_filters( 'ftc_elements_terms', 'product_cat' ),
						'multiple' => true,
					],

					[
						'name'    => 'filters',
						'label'   => __( 'Products filters', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'latest',
						'options' => [
							'latest'       => __( 'Latest products', 'ftc-element' ),
							'featured'     => __( 'Featured products', 'ftc-element' ),
							'best_sellers' => __( 'Best selling products', 'ftc-element' ),
							'best_rated'   => __( 'Best rated products', 'ftc-element' ),
							'on_sale'      => __( 'Products on sale', 'ftc-element' ),
							'random'       => __( 'Random products', 'ftc-element' ),
						],
					],

					[
						'name'     => 'products_in',
						'label'    => esc_html__( 'Select products', 'ftc-element' ),
						'type'     => Controls_Manager::SELECT2,
						'default'  => 3,
						'options'  => apply_filters( 'ftc_posts_array', 'product' ),
						'multiple' => true,
					],

					[
						'name'    => 'products_per_row',
						'label'   => __( 'Number of columns', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 4,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
							4 => __( '4', 'ftc-element' ),
							5 => __( '5', 'ftc-element' ),
							6 => __( '6', 'ftc-element' ),
						],
					],
					[
						'name'    => 'rows',
						'label'   => __( 'Number of rows', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 1,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
						],
					],

					[
						'name'    => 'desksmall_items',
						'label'   => __( 'Number of columns (desksmall_items)', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 4,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
							4 => __( '4', 'ftc-element' ),
							5 => __( '5', 'ftc-element' ),
						],
					],

					[
						'name'    => 'tablet_items',
						'label'   => __( 'Number of columns (tablet_items)', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 3,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
							4 => __( '4', 'ftc-element' ),
						],
					],
					[
						'name'    => 'tabletmini_items',
						'label'   => __( 'Number of columns (tabletmini_items)', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 3,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
							4 => __( '4', 'ftc-element' ),
						],
					],
					[
						'name'    => 'mobile_items',
						'label'   => __( 'Number of columns (mobile_items)', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 2,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
						],
					],
					[
						'name'    => 'mobilesmall_items',
						'label'   => __( 'Number of columns (mobilesmall_items)', 'ftc-element' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 1,
						'options' => [
							1 => __( '1', 'ftc-element' ),
							2 => __( '2', 'ftc-element' ),
							3 => __( '3', 'ftc-element' ),
						],
					],
					[ 
						'name'      => 'show_nav',
						'label'     => __( 'Show navigation', 'ftc-element' ),
						'type'      => Controls_Manager::SWITCHER,
						'label_off' => __( 'No', 'elementor' ),
						'label_on'  => __( 'Yes', 'elementor' ),
						'default'   => 'yes',
					],
					[ 
						'name'      => 'show_dots',
						'label'     => __( 'Show dots', 'ftc-element' ),
						'type'      => Controls_Manager::SWITCHER,
						'label_off' => __( 'No', 'elementor' ),
						'label_on'  => __( 'Yes', 'elementor' ),
						'default'   => 'yes',
					],
					[
						'name'    =>'margin',
						'label'   => __( 'Margin between products', 'ftc-element' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => 30,
						'min'     => 0,
						'step'    => 10,
					],
					[
						'name'    => 'timespeed',
						'label'   => __( 'Autoplay speed', 'ftc-element' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => 4000,
						'min'     => 0,
						'step'    => 1000,
						'title'   => __( 'Enter value in miliseconds (1s. = 1000ms.). Leave 0 (zero) do discard autoplay', 'ftc-element' ),
					],
					[
						'name'        => 'icon',
						'label'       => __( 'Tab icon', 'ftc-element' ),
						'type'        => Controls_Manager::ICON,
						'label_block' => true,
						'default'     => '',
					],


				],

			]
		);
$this->add_control(
	'heading_items_spacing_settings',
	[
		'label'     => __( 'Items spacing', 'ftc-element' ),
		'type'      => Controls_Manager::HEADING,
		'separator' => 'before',
	]
);
$this->add_control(
	'heading_icon',
	[
		'label'     => __( 'Tab icon', 'ftc-element' ),
		'type'      => Controls_Manager::HEADING,
		'separator' => 'before',
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
			'{{WRAPPER}} .tab-icon.fa' => 'font-size: {{SIZE}}{{UNIT}};',
		],

	]
);

$this->add_responsive_control(
	'icon_spacing',
	[
		'label'     => __( 'Tab icon spacing', 'ftc-element' ),
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
			'{{WRAPPER}} .tab-icon' => 'margin: 0 {{SIZE}}{{UNIT}};',
		],

	]
);

$this->add_control(
	'icon_position',
	[
		'label'        => __( 'Icon position', 'ftc-element' ),
		'type'      => Controls_Manager::SWITCHER,
		'label_off' => __( 'Right', 'elementor' ),
		'label_on'  => __( 'Left', 'elementor' ),
		'default'   => 'yes',
	]
);
$this->add_control(
	'image_position',
	[
		'label'        => __( 'Image icon position', 'ftc-element' ),
		'type'      => Controls_Manager::SWITCHER,
		'label_off' => __( 'Bottom', 'elementor' ),
		'label_on'  => __( 'Top', 'elementor' ),
		'default'   => 'yes',
	]
);

$this->add_responsive_control(
	'horiz_spacing',
	[
		'label'     => __( 'Products horizontal spacing', 'ftc-element' ),
		'type'      => Controls_Manager::SLIDER,
		'default'   => [
			'size' => '',
		],
		'range'     => [
			'px' => [
				'max'  => 50,
				'min'  => 0,
				'step' => 1,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .ftc-tab-products .product' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;',
		],
	]
);

$this->add_responsive_control(
	'vert_spacing',
	[
		'label'     => __( 'Products bottom spacing', 'ftc-element' ),
		'type'      => Controls_Manager::SLIDER,
		'default'   => [
			'size' => '20',
		],
		'range'     => [
			'px' => [
				'max'  => 100,
				'min'  => 0,
				'step' => 1,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .ftc-tab-products .product' => 'margin-bottom:{{SIZE}}px;',
		],

	]
);
		/*
		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'ftc-element' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		*/
		/*Attribute in product*/

		$this->add_control(
			'heading_items_pro_settings',
			[
				'label'     => __( 'Attribute Product', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_price',
			[
				'label'     => esc_html__( 'Show price', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_rating',
			[
				'label'     => esc_html__( 'Show rating', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_add_to_cart',
			[
				'label'     => esc_html__( 'Show "Add to cart"', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_short_desc',
			[
				'label'     => esc_html__( 'Show product short description', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				//'default' => 'yes',
			]
		);

		$this->add_control(
			'show_categories',
			[
				'label'     => esc_html__( 'Show product categories (posted in)', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_gallery',
			[
				'label'     => esc_html__( 'Show gallery images', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'no',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => __( 'Tabs', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label'     => __( 'Navigation Width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => '%',
				],
				'range'     => [
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-wrapper'         => 'flex-basis: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tabs-content-wrapper' => 'flex-basis: calc( 100% - {{SIZE}}{{UNIT}} )',
				],
				'condition' => [
					'type' => 'vertical',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Tabs Alignment', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'fa fa-align-right',
					],

				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tabs-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'vertical-align',
			[
				'label'     => __( 'Vertical Alignment', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Top', 'ftc-element' ),
						'icon'  => 'fa fa-caret-down',
					],
					'center'     => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-unsorted',
					],
					'flex-end'   => [
						'title' => __( 'Bottom', 'ftc-element' ),
						'icon'  => 'fa fa-caret-up',
					],

				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tabs-wrapper, {{WRAPPER}} .tabs-content-wrapper' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'type' => 'vertical',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'     => __( 'Border Width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 0,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-title, {{WRAPPER}} .tab-title:before, {{WRAPPER}} .tab-title:after, {{WRAPPER}} .tab-content, {{WRAPPER}} .tabs-content-wrapper, {{WRAPPER}} .tabs-content-wrapper:before' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => __( 'Border Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => [
					'{{WRAPPER}} .tab-title.active, {{WRAPPER}} .tab-title:before, {{WRAPPER}} .tab-title:after, {{WRAPPER}} .tab-content, {{WRAPPER}} .tabs-content-wrapper, {{WRAPPER}} .tabs-content-wrapper:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title.active'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tab-content.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'      => esc_html__( 'Tabs padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label'     => __( 'Title', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'border_title',
			[
				'label'     => __( 'Border Width Title', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 0,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-wrapper .tab-title' => 'border: {{SIZE}}{{UNIT}} solid;',
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
					'{{WRAPPER}} .tabs-wrapper .tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tab_color',
			[
				'label'     => __( 'Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'color: {{VALUE}};',
				],
				/* discarded - color from Elementor pallete
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				 */
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label'     => __( 'Active Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title.active' => 'color: {{VALUE}};',
				],
				/* discarded - color from Elementor pallete
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				], */
			]
		);
		$this->add_control(
			'tab_active_backcolor',
			[
				'label'     => __( 'Active Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title.active' => 'background-color: {{VALUE}};',
				],
				/* discarded - color from Elementor pallete
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				], */
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .tab-title',
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label'     => __( 'Content', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Content padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon_position = ! empty( $settings['icon_position'] ) ? $settings['icon_position'] : '';
		$image_position = ! empty( $settings['image_position'] ) ? $settings['image_position'] : '';
		$tabs = $this->get_settings( 'tabs' );
		$type = $this->get_settings( 'type' );
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style    = $this->get_settings( 'style' );
		$show_short_desc    = ! empty( $settings['show_short_desc'] ) ? $settings['show_short_desc'] : '';
		$show_price          = ! empty( $settings['show_price'] ) ? $settings['show_price'] : '';
		$show_rating          = ! empty( $settings['show_rating'] ) ? $settings['show_rating'] : '';
		$show_add_to_cart    = ! empty( $settings['show_add_to_cart'] ) ? $settings['show_add_to_cart'] : '';
		$show_categories     = ! empty( $settings['show_categories'] ) ? $settings['show_categories'] : '';
		$show_gallery     = ! empty( $settings['show_gallery'] ) ? $settings['show_gallery'] : 0;

		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}



		?>

		<div class="ftc-product-tabs product-tab-template <?php echo esc_attr($stylee); ?> <?php echo esc_attr($def_style_optionn); ?> <?php echo esc_attr( $type ); ?> " role="tablist">

			<?php
			$counter        = 1;
			$tab_status     = '';
			$content_status = '';
			?>

			<div class="tabs-wrapper" role="tab">
				<?php
				foreach ( $tabs as $item ) {
					$tab_status = ( 1 === $counter ) ? ' active' : '';
					if($icon_position ){
						echo '<i class="tab-icon ' . esc_attr( $item['icon'] ) . '"></i>';
					}
					echo '<div class="tab-title' . esc_attr( $tab_status ) . '" data-tab="' . esc_attr( $counter ) . '">';
					if($item['image']['url'] != '' && $image_position){
						echo '<img class="image-icon" src="' . $item['image']['url'] . '">';
					}
					echo '<div class="title">'.esc_html( $item['tab_title'] ).'</div>';
					if($item['image']['url'] != '' && !$image_position){
						echo '<img class="image-icon" src="' . $item['image']['url'] . '">';
					}
					echo  '</div>';
					if(!$icon_position ){
						echo '<i class="tab-icon ' . esc_attr( $item['icon'] ) . '"></i>';
					}

					$counter++;
				}
				?>
			</div>

			<?php $counter = 1; ?>
			<div class="tabs-content-wrapper <?php echo esc_attr($stylee); ?>" role="tabpanel">

				<?php
				foreach ( $tabs as $item ) {
					$content_status = ( 1 === $counter ) ? ' active' : '';
					$tab_title      = $item['tab_title'];
					$link_img      = $item['image']['url'];

					echo '<span class="tab-title tab-mobile-title' . esc_attr( $content_status ) . '" data-tab="' . esc_attr( $counter ) . '">' . esc_html( $tab_title ) . '</span>';

					$posts_per_page = $item['posts_per_page'];
					$ppr = $columns        = $item['products_per_row'];
					$rows           = $item['rows'];
					$show_nav       = $item['show_nav'];
					$show_dots      = $item['show_dots'];
					$offset         = $item['offset'];
					$ppr_tab        = $item['tabletmini_items'];
					$ppr_mob        = $item['mobile_items'];
					$categories     = $item['categories'];
					$exclude_cats   = $item['exclude_cats'];
					$filters        = $item['filters'];
					$products_in    = $item['products_in'];
					$mobilesmall_items = $item['mobilesmall_items'];
					$desksmall_items   = $item['desksmall_items'];
					$tablet_items      = $item['tablet_items'];
					$tabletmini_items  = $item['tabletmini_items'];
					$mobile_items      = $item['mobile_items'];
					$icon         = $item['icon'];
					$timespeed    = $item['timespeed'];
					$margin       = $item['margin'];


					// Start WC products.
					global $post;

					$this->products_grid = ftc_grid_class( intval( $ppr ), intval( $ppr_tab ), intval( $ppr_mob ) );

					$args = apply_filters( 'ftc_elements_query_args', $posts_per_page, $categories, $exclude_cats, $filters, $offset, $products_in ); // hook in includes/wc-functions.php

					// Add (inject) grid classes to products in loop
					// ( in "content-product.php" template )
					add_filter(
						'post_class', function( $classes ) {
							$classes[] = $this->products_grid;
							$classes[] = 'item';
							return $classes;
						}, 10
					);
					$nav = $dot = '';
					if($show_nav){
						$nav = 1;
					}
					else{
						$nav = 0;
					}
					if($show_dots){
						$dots = 1;
					}
					else{
						$dots = 0;
					}

					$products = get_posts( $args );
					if ( ! empty( $products ) ) {
						
						echo '<div class="ftc-tabs woocommerce woocommerce-page tab-content tab-' . esc_attr( $counter . $content_status ) . '">';
						echo '<div class="ftc-product products" data-columns="'. esc_attr($columns) .'" data-autoplay=""
						data-nav="'.$nav.'" data-dots="'.$dots.'" data-timespeed="'.$timespeed.'" data-margin="'.$margin.'" data-desksmall_items="'.esc_attr($desksmall_items).'"
						data-tablet_items="'. esc_attr($tablet_items).'" data-tabletmini_items="'.esc_attr($tabletmini_items).'" data-mobile_items="'. esc_attr($mobile_items).'"
						data-mobilesmall_items="'. esc_attr($mobilesmall_items).'">';
						$count = 0;
						foreach ( $products as $post ) {
							if( $rows > 1 && $count % $rows == 0 ){
								echo '<div class="ftc-tab-products">';
							}
							setup_postdata( $post );
							$options = array(
								'show_price'		=> $show_price
								,'show_rating'		=> $show_rating
								,'show_add_to_cart'		=> $show_add_to_cart
								,'show_short_desc'		=> $show_short_desc
								,'show_categories'			=> $show_categories
							);
							if(class_exists('Themeftc_Plugin')){
								ftc_remove_product_hooks_shortcode( $options );				
							}
							if($show_gallery){
								global $product, $smof_data;

								$lazy_load = isset($smof_data['ftc_prod_lazy_load']) && $smof_data['ftc_prod_lazy_load'] && !( defined( 'DOING_AJAX' ) && DOING_AJAX );
								if( defined( 'YITH_INFS' ) && (is_shop() || is_product_taxonomy()) ){ /* Compatible with YITH Infinite Scrolling */
									$lazy_load = false;
								}

// Ensure visibility
								if ( empty( $product ) || ! $product->is_visible() ) {
									return;
								}
								?>
								<div class="ftc-product product">
									<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>	
									<div class="images <?php echo esc_attr(($lazy_load)?'lazy-loading':'') ?>">
										<a href="<?php the_permalink(); ?>">
											<?php
											do_action( 'woocommerce_before_shop_loop_item_title' );
											?>
										</a>
										<?php
										do_action( 'woocommerce_shop_loop_item_title' );
										do_action( 'woocommerce_after_shop_loop_item_title' );
										?>
									</div>
									<div class="item-description"> 
										<?php echo ftc_template_element_gallery_image(); ?>
										<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
									</div>
									
									<?php do_action( 'ftc_after_shop_loop_item' ); ?>
								</div>
								<?php
							}
							else{
								wc_get_template_part( 'content', 'product' );
							}
							if( $rows > 1 && ($count % $rows == $rows - 1 || $count == (int)$post->post_count - 1) ){
								echo '</div>';
							}
							$count++;
						}

						echo '</div>';
						echo '</div>';
					}

					// "Clean" or "reset" post_class
					// avoid conflict with other "post_class" functions
					add_filter(
						'post_class', function( $classes ) {
							$classes_to_clean = array( $this->products_grid, 'item' );
							$classes          = array_diff( $classes, $classes_to_clean );
							return $classes;
						}, 10
					);

					wp_reset_postdata();
					if(class_exists('Themeftc_Plugin')){
						ftc_restore_product_hooks_shortcode();
					}
					?>

					<?php
					$counter++;
				} // end foreach.
				?> 
				<?php if(is_admin()) :?>
					<script type="text/javascript">
						(function (u) {
							"use strict";

							/*tab slider element product*/
							u('.ftc-tabs .ftc-product.products').each(function () {
								var element = u(this);
								var columns = element.data('columns');
								var nav = element.data('nav') ;  
								var dots = element.data('dots') ;             
								var desksmall_items = element.data('desksmall_items');
								var tabletmini_items = element.data('tabletmini_items');
								var tablet_items = element.data('tablet_items');
								var mobile_items = element.data('mobile_items');
								var mobilesmall_items = element.data('mobilesmall_items');
								var margin  =  element.data('margin');
								var timespeed  =  element.data('timespeed');      
								element.addClass('loading');
								element.owlCarousel({
									loop: true
									,nav: nav
									,dots: dots
									,navText: [,]
									,navSpeed: 1000
									,slideBy: 1
									,touchDrag: true
									,rtl: u('body').hasClass('rtl')
									,margin: margin
									,navRewind: false
									,autoplay: true
									,autoplayTimeout: timespeed
									,autoplayHoverPause: true
									,autoplaySpeed: 1000
									,autoHeight: true
									,responsive: {
										0:{
											items: mobilesmall_items
										},
										480:{
											items: mobile_items
										},
										700:{
											items: tablet_items
										},
										768:{
											items: tabletmini_items
										},
										991:{
											items: desksmall_items
										},
										1199:{
											items:columns
										}
									}
									,onInitialized: function(){
										element.addClass('loaded').removeClass('loading');
									}

								});

							});


						})(jQuery);


					</script>
				<?php endif;?>

			</div>
		</div>
		<?php
		echo '
		<script type="text/javascript" defer="defer">
		(function( $ ){
			"use strict";
			jQuery(document).ready( function($) {
				var products_tab = window.initFtcElementsTabs();
				window.dispatchEvent(new Event("resize"));
				});
				})( jQuery );
				</script>';
			}

	/**
	 * Render tabs widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_WC_Products_Tabs() );