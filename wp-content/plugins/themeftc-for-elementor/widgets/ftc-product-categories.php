<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_WC_Categories extends Widget_Base {

	public function get_name() {
		return 'ftc-categories';
	}

	public function get_title() {
		return __( 'FTC - Product Categories', 'ftc-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_main',
			[
				'label' => esc_html__( 'FTC List Categories', 'ftc-element' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'product_cat' ),
				'multiple' => true,
			]
		);

		$this->add_control(
			'add_query_args',
			[
				'label'    => __( 'Additional filters (per category)', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => [
					'on_sale'      => esc_html__( 'On sale', 'ftc-element' ),
					'featured'     => esc_html__( 'Featured', 'ftc-element' ),
					'best_sellers' => esc_html__( 'Best sellers', 'ftc-element' ),
					'best_rated'   => esc_html__( 'Best rated', 'ftc-element' ),
				],
				'multiple' => true,
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
					'def_style_2' => __( 'Boxed', 'ftc-element' ),
					'def_style_3' => __( 'Content Inside', 'ftc-element' ),
					'def_style_4' => __( 'Hover', 'ftc-element' ),
					'def_style_5' => __( 'Background Item', 'ftc-element' ),
					'def_style_6' => __( 'Title On Top', 'ftc-element' ),
					'def_style_7' => __( 'Style 7', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'    => __( 'Customize Style', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT,
				'default'  => '',
				'options'  => [
					''      => esc_html__( 'Default', 'ftc-element' ),
					'style_2'     => esc_html__( 'Style 2', 'ftc-element' ),
					'style_3' => esc_html__( 'Style 3', 'ftc-element' ),
					'style_4'   => esc_html__( 'Style 4', 'ftc-element' ),
					'style_5'   => esc_html__( 'Style 5', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);

		$this->add_responsive_control(
			'horiz_spacing',
			[
				'label'     => __( 'Grid horizontal spacing', 'ftc-element' ),
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
					'{{WRAPPER}} .category' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;',
				],

			]
		);

		$this->add_responsive_control(
			'vert_spacing',
			[
				'label'     => __( 'Grid bottom spacing', 'ftc-element' ),
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
					'{{WRAPPER}} .category' => 'margin-bottom:{{SIZE}}px;',
				],

			]
		);

		$this->add_responsive_control(
			'inner_spacing',
			[
				'label'     => __( 'Inner spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '0',
				],
				'range'     => [
					'px' => [
						'max'  => 100,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ftc-categories' => 'margin:{{SIZE}}px;',
				],

			]
		);

		$this->add_control(
			'image',
			[
				'label'     => esc_html__( 'Show category image', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'img_format',
			[
				'label'     => esc_html__( 'Categories image format', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'thumbnail',
				'options'   => apply_filters( 'ftc_elements_image_sizes', '' ),
				'condition' => [
					'image!' => '',
				],
			]
		);

		$this->add_control(
			'prod_count',
			[
				'label'     => esc_html__( 'Show products count', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_button',
			[
				'label'        => esc_html__( 'Show button', 'ftc-element' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ftc-element' ),
				'label_off'    => esc_html__( 'Hide', 'ftc-element' ),
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'label_button',
			[
				'label'       => esc_html__( 'Button Label', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Shop now', 'ftc-element' ),
				'condition'   => array(
					'show_button'      => 'yes',
				),			
			]
		);
		$this->add_control(
			'slider',
			[
				'label'        => esc_html__( 'Display slider', 'ftc-element' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'ftc-element' ),
				'label_off'    => esc_html__( 'No', 'ftc-element' ),
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'posts_per_slide',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
					6 => __( '6', 'ftc-element' ),
				],
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);

		$this->add_control(
			'posts_per_slide_tab',
			[
				'label'   => __( 'Number of columns (tablets)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
					6 => __( '6', 'ftc-element' ),
				],
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);

		$this->add_control(
			'posts_per_slide_mob',
			[
				'label'   => __( 'Number of columns (mobiles)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
					6 => __( '6', 'ftc-element' ),
				],
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);

		$this->add_control(
			'space',
			[
				'label'   => __( 'Margin between slides', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 30,
				'min'     => 0,
				'step'    => 10,
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);

		// Pagination.
		$this->add_control(
			'pagination',
			[
				'label'   => __( 'Slider pagination', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [
					'none'        => __( 'None', 'ftc-element' ),
					'bullets'     => __( 'Bullets', 'ftc-element' ),
					'progressbar' => __( 'Progress bar', 'ftc-element' ),
					'fraction'    => __( 'Fraction', 'ftc-element' ),
				],
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);
		$this->add_control(
			'buttons',
			[
				'label'     => esc_html__( 'Show navigation buttons', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);
		$this->add_control(
			'buttons_style',
			[
				'label'     => __( 'Style Navigation buttons', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'options' => [
					''        => __( 'Default', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'Style 3', 'ftc-element' ),
					'style_4' => __( 'Style 4', 'ftc-element' ),
				],
				'condition' => [
					'buttons!' => '',
					'slider'   =>'yes',
				],
			]
		);
		$this->add_control(
			'buttons_color',
			[
				'label'     => __( 'Navigation buttons color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-next' => 'color: {{VALUE}};',
					'{{WRAPPER}} .nav-prev' => 'color: {{VALUE}};',
				],
				'condition' => [
					'buttons!' => '',
					'slider'   =>'yes',
				],
			]
		);
		// Autoplay.
		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay speed', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'step'    => 1000,
				'title'   => __( 'Enter value in miliseconds (1s. = 1000ms.). Leave 0 (zero) do discard autoplay', 'ftc-element' ),
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);
		// Loop the slider.
		$this->add_control(
			'loop',
			[
				'label'     => esc_html__( 'Loop slides', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
				'condition'   => array(
					'slider'      => 'yes',
				),	
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_respon',
			[
				'label' => esc_html__( 'Reponsive Categories', 'ftc-element' ),
			]
		);

		$this->add_control(
			'cats_per_row',
			[
				'label'   => __( 'Number of colums', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'cats_per_row_tab',
			[
				'label'   => __( 'Number of columns (tablets)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'cats_per_row_mob',
			[
				'label'   => __( 'Number of columns  (mobiles)', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Category item layout', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'categories_height',
			[
				'label'     => __( 'Height Block', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 800,
						'min'  => 0,
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .category' => 'height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'cat_image_width',
			[
				'label'     => __( 'Image width', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 100,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .category .images-category' => 'width: {{SIZE}}%;',
				],
				'condition' => [
					'style' => 'style_2',
				],
			]
		);

		$this->add_responsive_control(
			'post_text_align',
			[
				'label'     => __( 'Categories alignment', 'ftc-element' ),
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
					'{{WRAPPER}} .item-desciption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cat_vertical_alignment',
			[
				'label'     => __( 'Vertical Align Product Info', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'flex-start' => __( 'Top', 'ftc-element' ),
					'center'     => __( 'Middle', 'ftc-element' ),
					'flex-end'   => __( 'Bottom', 'ftc-element' ),
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .item-desciption' => 'align-self: {{VALUE}};',
				],
				'condition' => [
					'style' => [ 'style_1', 'style_2', 'style_4' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style more', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover animation', 'ftc-element' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		// HOVER TABS.
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Title Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .category' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		// HOVER.
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Color on Hover', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => __( 'Border', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ftc-categories',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();
		// Settings vars.
		$categories       = ! empty( $settings['categories'] ) ? $settings['categories'] : array();
		$slider            = ! empty( $settings['slider'] ) ? $settings['slider'] : '';
		$pps            = ! empty( $settings['posts_per_slide'] ) ? (int) $settings['posts_per_slide'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$space          = ! empty( $settings['space'] ) ? (int) $settings['space'] : 0;
		$pagination     = ! empty( $settings['pagination'] ) ? $settings['pagination'] : 'bullets';
		$buttons        = ! empty( $settings['buttons'] ) ? $settings['buttons'] : '';
		$buttons_style  = ! empty( $settings['buttons_style'] ) ? $settings['buttons_style'] : '';
		$autoplay       = ! empty( $settings['autoplay'] ) ? $settings['autoplay'] : 0;
		$loop           = ! empty( $settings['loop'] ) ? $settings['loop'] : 0;
		$add_query_args   = ! empty( $settings['add_query_args'] ) ? $settings['add_query_args'] : array();
		$cats_per_row     = ! empty( $settings['cats_per_row'] ) ? (int) $settings['cats_per_row'] : 3;
		$cats_per_row_tab = ! empty( $settings['cats_per_row_tab'] ) ? (int) $settings['cats_per_row_tab'] : 1;
		$cats_per_row_mob = ! empty( $settings['cats_per_row_mob'] ) ? (int) $settings['cats_per_row_mob'] : 1;
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style            = ! empty( $settings['style'] ) ? $settings['style'] : 'style_1';
		$image            = ! empty( $settings['image'] ) ? $settings['image'] : '';
		$img_format       = ! empty( $settings['img_format'] ) ? $settings['img_format'] : 'thumbnail';
		$prod_count       = ! empty( $settings['prod_count'] ) ? $settings['prod_count'] : '';
		$show_button       = ! empty( $settings['show_button'] ) ? $settings['show_button'] : '';
		$label_button       = ! empty( $settings['label_button'] ) ? $settings['label_button'] : 'Shop now';
		$hover_animation      = ! empty( $settings['hover_animation'] ) ? $settings['hover_animation'] : '';


		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}


		$id = $this->get_id();

		// All the styles for categories holder.
		$this->add_render_attribute( 'categories-holder-css', 'class', 'ftc-product-categories' );
		if($slider){
			$this->add_render_attribute( 'categories-holder-css', 'class', 'swiper-container' );
		}
		$this->add_render_attribute( 'categories-holder-css', 'class', $stylee  );
		$this->add_render_attribute( 'categories-holder-css', 'class', $def_style_optionn  );

		// Each singular category styles.
		$grid = ftc_grid_class( intval( $cats_per_row ), intval( $cats_per_row_tab ), intval( $cats_per_row_mob ) );
		$this->add_render_attribute( 'category-css', 'class', 'category' );
		if($slider){
			$this->add_render_attribute( 'category-css', 'class', 'swiper-slide' );
		}
		if(!$slider){
			$this->add_render_attribute( 'category-css', 'class', $grid);
		}

		// Additional query args.
		$args = '';
		if ( ! empty( $add_query_args ) ) {
			$args = '?';
			foreach ( $add_query_args as $arg ) {
				$args .= $arg . ( end( $add_query_args ) === $arg ? '' : '&amp;' );
			}
		}

		if ( empty( $categories ) ) {
			return;
		}

		// Categories holder.
		echo '<div ' . $this->get_render_attribute_string( 'categories-holder-css' ) . '>';
		if($slider){
			echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-rows="1" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-space_mobile="' . esc_attr( $space ) . '" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">';

			echo '<div class="swiper-wrapper">';
		}

		foreach ( $categories as $index => $cat ) {

			$count = $index + 1;

			$term_data = apply_filters( 'ftc_elements_term_data_cate', 'product_cat', $cat, $img_format ); // hook in inc/helpers.php

			if ( empty( $term_data ) ) {
				continue;
			}

			$term_id    = isset( $term_data['term_id'] ) ? $term_data['term_id'] : '';
			$term_title = isset( $term_data['term_title'] ) ? $term_data['term_title'] : '';
			$term_link  = isset( $term_data['term_link'] ) ? $term_data['term_link'] . $args : '#';
			$image_url  = isset( $term_data['image_url'] ) ? $term_data['image_url'] : '';

			// Category item data-id /
			$rand_id = rand(1000, 9999);

			echo '<a id="ftc-category-'.$rand_id.'"' .' ' . $this->get_render_attribute_string( 'category-css' ) . ' href="' . esc_url( $term_link ) . '" title="' . esc_attr( $term_title ) . '" ' . $this->get_render_attribute_string( 'item-anim-data' ) . ' ' . $this->get_render_attribute_string( 'data-delay' . $count ) . '>';

			echo '<div class="ftc-categories">';

			if ( $image ) {
				echo '<div class="images-category"><img class="elementor-animation-'.$hover_animation.'" src="' . esc_url( $image_url ) . '"/></div>';
			}

			echo '<div class="item-desciption">';

			if ( $term_title ) {
				echo '<h3 class="title">' . esc_html( $term_title ) . '</h3>';
			}

			if ( $prod_count && $term_id ) {
				echo apply_filters( 'ftc_product_count_category', $term_id );
			}
			if ( $show_button ) {
				echo '<div class="button-shop">';
				echo '<p class="btn-category">'.$label_button.'</p>';
				echo '</div>';
			}
			echo '</div>';

				echo '</div>'; //.inner-wrap

				echo '</a>';

			}
			if($slider){
				echo '</div>';

				if ( 'none' !== $pagination ) {
					echo '<div class="swiper-pagination"></div>';
				}
				if ( $buttons ) {
					echo '<div class="navigation-slider '.$buttons_style.'">';
					echo '<div class="nav-next " screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
					echo '<div class="nav-prev " screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';
					echo '</div>';
				}
			}
			echo '</div>';
			if(is_admin()){
				echo'
				<script type=text/javascript" defer="defer">
				(function( $ ){
					"use strict";
					jQuery(document).ready( function($) {
						var products_slider = window.ftc_elements_swiper();
						});
						})( jQuery );
						</script>';
					}

				}

				protected function content_template() {}

				public function render_plain_content( $instance = [] ) {}

			}

			Plugin::instance()->widgets_manager->register_widget_type( new Ftc_WC_Categories() );
