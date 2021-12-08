<?php
namespace Elementor;

// use Elementor\Controls_Manager;
// use Elementor\Controls_Stack;
// use Elementor\Core\Files\CSS\Post;
// use Elementor\Element_Base;
// use Elementor\Widget_Base;
// use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class FTC_Products_Tabs_Grid extends Widget_Base {
	/*
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		$this->add_actions();
	}
	 */
	public function get_name() {
		return 'ftc-products-tabs-grid';
	}

	public function get_title() {
		return __( 'FTC - Products Tabs Grid', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}
	public function get_categories() {
		return [ 'ftc-elements' ];
	}
	public function get_script_depends() {
		return [ 'jquery-swiper' ];
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
				'label' => __( 'FTC Tabs Products Grid', 'ftc-element' ),
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
					'def_style_1' => __( 'Style 1', 'ftc-element' ),
					'def_style_2' => __( 'Style 2', 'ftc-element' ),
					'def_style_3' => __( 'Style 3', 'ftc-element' ),
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
				'label'   => __( 'Customize style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'ftc-element' ),
					'style_1'   => __( 'Style 1', 'ftc-element' ),
					'style_2'   => __( 'Style 2', 'ftc-element' ),
					'style_3'   => __( 'Style 3', 'ftc-element' ),
					'style_4'   => __( 'Style 4', 'ftc-element' ),
					'style_5'   => __( 'Style 5', 'ftc-element' ),
					'style_6'   => __( 'Style 6', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'       => __( 'Tabs Items', 'ftc-element' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						'tab_title'            => __( 'Tab #1', 'ftc-element' ),
						'posts_per_page'       => 4,
						'offset'               => 0,
						'products_per_row'     => 4,
						'products_per_row_tab' => 3,
						'products_per_row_mob' => 2,
						'space'                 => 30,
						'pagination'           => 'none',
						'buttons'              => 'yes',
						'buttons_style'        => '',
						'categories'           => '',
						'exclude_cats'         => '',
						'filters'              => '',
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ tab_title }}}',
				'fields'      => [
					[
						'name'        => 'tab_title',
						'label'       => __( 'Tab title', 'ftc-element' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => __( 'Tab Title', 'ftc-element' ),
						'placeholder' => __( 'Tab Title', 'ftc-element' ),
						'label_block' => true,
					],

					[
						'name'    => 'posts_per_page',
						'label'   => __( 'Total products', 'ftc-element' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => '4',
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
						'name'        => 'categories',
						'label'       => esc_html__( 'Select product categories', 'ftc-element' ),
						'type'        => Controls_Manager::SELECT2,
						'default'     => array(),
						'options'     => apply_filters( 'ftc_elements_terms', 'product_cat' ),
						'multiple'    => true,
						'label_block' => true,
					],

					[
						'name'        => 'exclude_cats',
						'label'       => esc_html__( 'Exclude product categories', 'ftc-element' ),
						'type'        => Controls_Manager::SELECT2,
						'default'     => array(),
						'options'     => apply_filters( 'ftc_elements_terms', 'product_cat' ),
						'multiple'    => true,
						'label_block' => true,
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
					'{{WRAPPER}} .ftc-products-tabs-slider > div' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;'
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
					'{{WRAPPER}} ftc-products-tabs-slider > div' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;',
					'{{WRAPPER}} ' => 'margin-bottom:{{SIZE}}px;',
				],

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => __( 'Tabs style', 'ftc-element' ),
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
				'prefix_class' => 'mm-wc-tabs-align-',
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'      => esc_html__( 'Tab padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-title > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Tab styles title
		$this->add_control(
			'heading_tab_styles',
			[
				'label'     => __( 'Tab styles', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// ACTIVE, HOVER, INACTIVE.
		$this->start_controls_tabs( 'tabstyles' );

		// Styles for active tab
		$this->start_controls_tab(
			'style_active',
			[
				'label' => __( 'Active', 'ftc-element' ),
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label'     => __( 'Active tab title color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title.active' => 'color: {{VALUE}};',
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
		$this->add_control(
			'active_tab_desc',
			[
				'raw'             => __( 'Active tab background also applies to active content. Content styles can be overriden bellow, under "Tab content style" settings.', 'ftc-element' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->end_controls_tab();// End active tab styles.

		// Styles for tab hover.
		$this->start_controls_tab(
			'style_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);
		$this->add_control(
			'tab_color_hover',
			[
				'label'     => __( 'Hover tab title color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title:not(.active):hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'background_color_hover',
			[
				'label'     => __( 'Hover background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title:not(.active):hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		// Styles for tab Inactive.
		$this->start_controls_tab(
			'style_inactive',
			[
				'label' => __( 'Inactive', 'ftc-element' ),
			]
		);
		$this->add_control(
			'inacitve_tab_color',
			[
				'label'     => __( 'Inactive tab title color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'inactive_background_color',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();// End inactive tab styles.

		$this->end_controls_tabs();
		// End of style control tabs.

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typography',
				'label'    => __( 'Title typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .tab-title',
			
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
					'{{WRAPPER}} .tab-title, {{WRAPPER}} .tab-title:before, {{WRAPPER}} .tab-title:after, {{WRAPPER}} .tabs-content-wrapper, {{WRAPPER}} .tabs-content-wrapper:before' => 'border-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .tab-title.active, {{WRAPPER}} .tab-title:before, {{WRAPPER}} .tab-title:after, {{WRAPPER}} .tabs-content-wrapper, {{WRAPPER}} .tabs-content-wrapper:before' => 'border-color: {{VALUE}};',
				],
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_content',
			[
				'label' => __( 'Tab content style', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label'     => __( 'Content background Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-content.active' => 'background-color: {{VALUE}};',
				],
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

		$this->add_control(
			'content_border_width',
			[
				'label'     => __( 'Content border Width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				/* 'default'   => [
					'size' => 1,
				], */
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-content-wrapper, {{WRAPPER}} .tabs-content-wrapper:before' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab-title.active:not(.tab-mobile-title):before, {{WRAPPER}} .tab-title.active:not(.tab-mobile-title):after' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		/*
		$this->add_control(
			'product_tabs_custom_css',
			[
				'type'        => Controls_Manager::CODE,
				'label'       => __( 'Custom CSS', 'ftc-element' ),
				'language'    => 'css',
				'render_type' => 'ui',
				'show_label'  => false,
				'separator'   => 'none',
			]
		);
		*/
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
		$tabs  = $this->get_settings('tabs');
		$type  = $this->get_settings('type');
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style  = $this->get_settings('style');
		$idint = substr( $this->get_id_int(), 0, 3 );

		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}


		?>

		<div class="ftc-product-tabs product-tab-template <?php echo esc_attr($stylee)?> <?php echo esc_attr($def_style_optionn)?> <?php echo esc_attr( $type ); ?> elementor-tabs" role="tablist">

			<?php
			$counter        = 1;
			$tab_status     = '';
			$content_status = '';
			?>

			<div class="ftc-tab-grid tabs-wrapper" role="tab">
				<?php
				foreach ( $tabs as $item ) {
					$tab_status = ( 1 === $counter ) ? ' active' : '';
					if($icon_position ){
						echo '<i class="tab-icon ' . esc_attr( $item['icon'] ) . '"></i>';
					}
					echo '<div class="tab-title' . esc_attr( $tab_status ) . '" data-tab="' . esc_attr( $counter ) . '">' . esc_html( $item['tab_title'] ) . '</div>';
					if(!$icon_position ){
						echo '<i class="tab-icon ' . esc_attr( $item['icon'] ) . '"></i>';
					}

					$counter++;
				}
				?>
			</div>

			<?php $counter = 1; ?>
			<div class="tabs-content-wrapper " role="tabpanel">

				<?php
				foreach ( $tabs as $item ) {
					$content_status = ( 1 === $counter ) ? ' active' : '';
					$tab_title      = $item['tab_title'];
					echo '<span class="tab-title tab-mobile-title' . esc_attr( $content_status ) . '" data-tab="' . esc_attr( $counter ) . '">' . esc_html( $tab_title ) . '</span>';

					$ppp          = $item['posts_per_page'];
					$offset       = $item['offset'];
					$columns         = $item['products_per_row'];
					$categories   = $item['categories'];
					$exclude_cats = $item['exclude_cats'];
					$filters      = $item['filters'];
					$products_in  = $item['products_in'];
					$icon         = $item['icon'];

					// Start WC products.
					global $post;

					// Hook in includes/wc-functions.php.
					$args = apply_filters( 'ftc_elements_query_args', $ppp, $categories, $exclude_cats, $filters, $offset, $products_in );

					// Add (inject) grid classes to products in loop
					// ( in "content-product.php" template )

					$products = get_posts( $args );
					if ( ! empty( $products ) ) {

						echo '<div class="ftc-tabs woocommerce loading woocommerce-page  tab-content  tab-' . esc_attr( $counter . $content_status ) . ' columns-'.esc_attr($columns).'">';
						echo '<div class="ftc-products-tabs products">';

						foreach ( $products as $post ) {

							setup_postdata( $post );
							wc_get_template_part( 'content', 'product' );

						}

						echo '</div>';
						echo '</div>';
					}

					// "Clean" or "reset" post_class
					// avoid conflict with other "post_class" functions
					wp_reset_postdata();
					$counter++;
				} // end foreach.
				?>
			</div>
		</div>
		<?php
		echo '
		<script type=""text/javascript" defer="defer">
		(function( $ ){
			"use strict";
			jQuery(document).ready( function($) {
				var products_tab = window.initFtcElementsTabs();
				});
				})( jQuery );
				</script>';
			}

	/*
	protected function add_actions() {
		add_action( 'elementor/element/parse_css', [ $this, 'add_post_css' ], 10, 2 );
	}
	 */
	/**
	 * Render tabs widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new FTC_Products_Tabs_Grid() );
