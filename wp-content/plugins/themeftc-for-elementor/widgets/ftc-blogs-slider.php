<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Blog_Slider extends Widget_Base {

	public function get_name() {
		return 'ftc-posts-slider';
	}

	public function get_title() {
		return __( 'FTC - Blogs Slider', 'ftc-element' );
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
				'label' => esc_html__( 'FTC Blogs Slider', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Blogs', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
				'default' => __( 'Title Blogs', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}  .title-blogs-grid.element' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'style_blog',
			[
				'label'   => __( 'Style Blog Slider', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_v1',
				'options' => [
					'style_v1' => __( 'Default', 'ftc-element' ),
					'style_v2' => __( 'Style 2', 'ftc-element' ),
					'style_v3' => __( 'Style 3', 'ftc-element' ),
					'style_v4' => __( 'Style 4', 'ftc-element' ),
					'style_v5' => __( 'Style 5', 'ftc-element' ),
					'style_v6' => __( 'Style 6', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Limit', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '6',
				'title'   => __( 'Enter total number of posts to show', 'ftc-element' ),
			]
		);

		$this->add_control(
			'offset',
			[
				'label'   => __( 'Offset', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '',
				'title'   => __( 'Offset is number of skipped posts', 'ftc-element' ),
			]
		);

		$this->add_control(
			'heading_filtering',
			[
				'label'     => __( 'Blog Query options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select blog categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'category' ),
				'multiple' => true,
			]
		);

		$this->add_control(
			'sticky',
			[
				'label'     => esc_html__( 'Show only sticky posts', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				//'default' => 'yes',
			]
		);

		$this->add_control(
			'heading_grid_options',
			[
				'label'     => __( 'Grid options', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rows',
			[
				'label'   => __( 'Number of rows', 'ftc-element' ),
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
			'posts_per_slide',
			[
				'label'   => __( 'Number of cumlumns', 'ftc-element' ),
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
			]
		);

		$this->add_control(
			'posts_per_slide_tab',
			[
				'label'   => __( 'Products per slide (tablets)', 'ftc-element' ),
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
			]
		);

		$this->add_control(
			'posts_per_slide_mob',
			[
				'label'   => __( 'Products per slide (mobiles)', 'ftc-element' ),
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
			]
		);

		$this->add_control(
			'space',
			[
				'label'   => __( 'Space between slides', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 30,
				'min'     => 0,
				'step'    => 10,
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
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-progressbar-fill'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-fraction'      => 'color: {{VALUE}};',
				],
				'condition' => [
					'pagination!' => 'none',
				],
			]
		);

		// Slider navigation.
		$this->add_control(
			'buttons',
			[
				'label'     => esc_html__( 'Show navigation buttons', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
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
			]
		);


		$this->end_controls_section();

		// TAB 2 - STYLES FOR POSTS.
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style for layout', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_readmore',
			[
				'label'   => __( 'Label Read more', 'ftc-element' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read more',
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
					'def_style_2' => __( 'Content Boxed', 'ftc-element' ),
					'def_style_3' => __( 'Content Right', 'ftc-element' ),
					'def_style_4' => __( 'Content Inside', 'ftc-element' ),
					'def_style_5' => __( 'Date Inside', 'ftc-element' ),
					'def_style_6' => __( 'Meta Inside', 'ftc-element' ),
					'def_style_7' => __( 'Boxed', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Customize Style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1' => __( 'Style 1', 'ftc-element' ),
					'style_2' => __( 'Style 2', 'ftc-element' ),
					'style_3' => __( 'Style 3', 'ftc-element' ),
					'style_4' => __( 'Style 4', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label'     => esc_html__( 'Show blog image', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'img_format',
			[
				'label'     => esc_html__( 'Blog image format', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'thumbnail',
				'options'   => apply_filters( 'ftc_elements_image_sizes', '' ),
				'condition' => [
					'show_thumb!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label'     => esc_html__( 'Show excerpt', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'meta',
			[
				'label'     => esc_html__( 'Show post meta', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'meta_sorter_label',
			[
				'label'      => esc_html__( 'Sort meta info', 'ftc-element' ),
				'type'       => 'sorter_label',
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'meta_part_enabled',
			[
				'label'     => esc_html__( 'Enable', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'meta_ordering',
			[
				'label'        => __( 'Option meta', 'ftc-element' ),
				'type'         => \Elementor\Controls_Manager::REPEATER,
				'fields'       => $repeater->get_controls(),
				'item_actions' => [
					'duplicate' => false,
					'add'       => false,
					'remove'    => false,
				],
				'default'      => [
					[
						'meta_sorter_label' => 'Date',
						'meta_part_enabled' => 'yes',
					],
					[
						'meta_sorter_label' => 'Author',
						'meta_part_enabled' => 'yes',
					],
					[
						'meta_sorter_label' => 'Posted in',
						'meta_part_enabled' => 'yes',
					],
				],
				'title_field'  => '{{{ meta_sorter_label }}}',
				'condition'    => [
					'meta!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'post_overal_padding',
			[
				'label'      => esc_html__( 'Post overal padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .inner-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// CONTENT BOX STYLES.
		$this->start_controls_section(
			'section_post_text',
			[
				'label' => __( 'Style for text', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_post_background' );
		$this->start_controls_tab(
			'tab_post_background_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'post_text_background_color',
			[
				'label'     => __( 'Content background', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .post-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		// HOVER.
		$this->start_controls_tab(
			'tab_product_background_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);
		$this->add_control(
			'post_text_background_color_hover',
			[
				'label'     => __( 'Content background (hover)', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .inner-wrap:hover .post-overlay' => 'background-color: {{VALUE}};',
				],
				/* 'condition' => [
					'style' => ['style_3','style_4'],
				], */
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'post_text_height',
			[
				'label'     => __( 'Post height', 'ftc-element' ),
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
					'{{WRAPPER}} .inner-wrap' => 'height: {{SIZE}}px;',
				],
				'condition' => [
					'style' => [ 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_responsive_control(
			'post_thumb_width',
			[
				'label'     => __( 'Post thumb width (%)', 'ftc-element' ),
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
					// thumb style 2.
					'{{WRAPPER}} .post-thumb'         => 'width:{{SIZE}}%;',
					'{{WRAPPER}} .style_2 .post-text' => 'width: calc( 100% - {{SIZE}}%);',
					// thumb style 4.
					'{{WRAPPER}} .post-thumb-back'    => 'right: calc( 100% - {{SIZE}}%); width: auto;',

				],
				'condition' => [
					'style'       => [ 'style_2', 'style_4' ],
					'show_thumb!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'post_content_width',
			[
				'label'     => __( 'Post content width (%)', 'ftc-element' ),
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
					'{{WRAPPER}} .style_4 .post-overlay' => 'left: calc( 100% - {{SIZE}}%);',
					'{{WRAPPER}} .style_4 .post-text'    => 'left: calc( 100% - {{SIZE}}%);',
				],
				'condition' => [
					'style' => [ 'style_4' ],
				],
			]
		);

		$this->add_responsive_control(
			'post_text_padding',
			[
				'label'      => esc_html__( 'Content text padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_text_align',
			[
				'label'     => __( 'Content alignment', 'ftc-element' ),
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
					'{{WRAPPER}} .post-text' => 'text-align: {{VALUE}};',
				],

			]
		);

		$this->add_responsive_control(
			'content_vertical_alignment',
			[
				'label'     => __( 'Vertical align', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'flex-start' => __( 'Top', 'ftc-element' ),
					'center'     => __( 'Middle', 'ftc-element' ),
					'flex-end'   => __( 'Bottom', 'ftc-element' ),
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .post-text'  => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .inner-wrap' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'style' => [ 'style_2', 'style_3', 'style_4' ],
				],
			]
		);

		$this->add_responsive_control(
			'post_elements_spacing',
			[
				'label'     => __( 'Elements vertical spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-text > *:not(.ftc-readmore)' => 'margin-bottom: {{SIZE}}px; padding-bottom: 0;',
					/*,
					 '{{WRAPPER}} .post-text .meta' => 'margin-bottom: {{SIZE}}px;',
					'{{WRAPPER}} .post-text p' => 'margin-bottom: {{SIZE}}px;',
					'{{WRAPPER}} .post-text a.ftc-readmore  ' => 'margin-bottom: {{SIZE}}px;', */
				],

			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => __( 'Border ', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .inner-wrap',
			]
		);

		$this->end_controls_section();

		// Title styles.
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Hover tabs.
		$this->start_controls_tabs( 'tabs_button_style' );

		// Normal.
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
					'{{WRAPPER}} .post-text h4 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_back_color',
			[
				'label'     => __( 'Title Back Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .post-text h4' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		// Hover.
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
					'{{WRAPPER}} .inner-wrap:hover .post-text h4 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_back_color_hover',
			[
				'label'     => __( 'Title Back Color on Hover', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover .post-text h4' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// end tabs.

		// Title border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'postgrid_title_border',
				'label'       => __( 'Title Border', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .post-text h4',
			]
		);

		$this->add_responsive_control(
			'postgrid_title_padding',
			[
				'label'      => esc_html__( 'Title padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-text h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Title typohraphy.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .post-text h4',
			]
		);

		$this->end_controls_section();

		// Meta controls.
		$this->start_controls_section(
			'section_meta',
			[
				'label'     => __( 'Meta', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'meta!' => '',
				],
			]
		);

		// Meta hover tabs.
		$this->start_controls_tabs( 'tabs_meta_style' );

		// Normal.
		$this->start_controls_tab(
			'tab_meta_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);

		$this->add_control(
			'meta_text_color',
			[
				'label'     => __( 'Meta Text Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text .meta span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_links_color',
			[
				'label'     => __( 'Meta Links Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text .meta a, {{WRAPPER}} .post-text .meta a:active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover.
		$this->start_controls_tab(
			'tab_meta_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);
		$this->add_control(
			'meta_text_hover_color',
			[
				'label'     => __( 'Meta Text Hover Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover .post-text .meta span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'meta_links_hover_color',
			[
				'label'     => __( 'Meta Links Hover Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover .post-text .meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'meta_font_size',
			[
				'label'     => esc_html__( 'Meta font size (%)', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .post-text .meta' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],

			]
		);
		$this->end_controls_section();

		// Excerpt controls.
		$this->start_controls_section(
			'section_excerpt',
			[
				'label'     => __( 'Excerpt', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_limit',
			[
				'label'   => __( 'Excerpt Limit (words)', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '20',
				'title'   => __( 'Max. number of words in excerpt', 'ftc-element' ),
			]
		);

		// EXCERPT HOVER TABS.
		$this->start_controls_tabs( 'tabs_excerpt_style' );
		// NORMAL.
		$this->start_controls_tab(
			'tab_excerpt_normal',
			[
				'label' => __( 'Normal', 'ftc-element' ),
			]
		);
		// Excerpt text color.
		$this->add_control(
			'excerpt_text_color',
			[
				'label'     => __( 'Excerpt Text Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .post-text .ftc-readmore' => 'color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_tab();

		// HOVER.
		$this->start_controls_tab(
			'tab_excerpt_hover',
			[
				'label' => __( 'Hover', 'ftc-element' ),
			]
		);
		// Excerpt text color.
		$this->add_control(
			'excerpt_text_hover_color',
			[
				'label'     => __( 'Excerpt Text Hover Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap:hover .post-text p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .inner-wrap:hover .post-text .ftc-readmore' => 'color: {{VALUE}};',
				],

			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Excerpt typohraphy.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => __( 'Excerpt typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .post-text p',

			]
		);

		// Excerpt padding.
		$this->add_responsive_control(
			'postgrid_excerpt_padding',
			[
				'label'      => esc_html__( 'Excerpt padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Excerpt border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'postgrid_excerpt_border',
				'label'       => __( 'Excerpt Border', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .post-text p',
			]
		);

		$this->add_control(
			'readmore_title',
			[
				'label'     => __( '"Read more" button custom css', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'css_class',
			[
				'label'       => __( 'Enter css class(es) for "Read more"', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'title'       => __( 'Style the "Read more" with css class(es) defined in your theme, plugin or customizer', 'ftc-element' ),
				'label_block' => true,
			]
		);

		// Button text color.
		$this->add_control(
			'readmore_text_color',
			[
				'label'     => __( 'Readmore Text Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-text .ftc-readmore' => 'color: {{VALUE}};',
				],

			]
		);
		
		// Button text color.
		$this->add_control(
			'readmore_text_hover_color',
			[
				'label'     => __( 'Readmore Hover Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-wrap .post-text .ftc-readmore:hover' => 'color: {{VALUE}};',
				],

			]
		);
		// Excerpt padding.
		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Button padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-text .ftc-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Excerpt border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => __( 'Button Border', 'ftc-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .post-text .ftc-readmore',
			]
		);
		// Title typohraphy.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Button Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .post-text a.ftc-readmore',
			]
		);
		$this->end_controls_section();


	}

	protected function render() {

		// Get our input from the widget settings.
		$settings = $this->get_settings_for_display();

		$posts_per_page    = (int) $settings['posts_per_page'];
		$sticky            = $settings['sticky'];
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$style_blog          = ! empty( $settings['style_blog'] ) ? $settings['style_blog'] : 'style_v1';
		$offset            = (int) $settings['offset'];
		$rows           = ! empty( $settings['rows'] ) ? (int) $settings['rows'] : 1;
		$pps            = ! empty( $settings['posts_per_slide'] ) ? (int) $settings['posts_per_slide'] : 3;
		$pps_tab        = ! empty( $settings['posts_per_slide_tab'] ) ? (int) $settings['posts_per_slide_tab'] : 2;
		$pps_mob        = ! empty( $settings['posts_per_slide_mob'] ) ? (int) $settings['posts_per_slide_mob'] : 1;
		$space          = ! empty( $settings['space'] ) ? (int) $settings['space'] : 0;
		$pagination     = ! empty( $settings['pagination'] ) ? $settings['pagination'] : 'bullets';
		$buttons        = ! empty( $settings['buttons'] ) ? $settings['buttons'] : '';
		$buttons_style  = ! empty( $settings['buttons_style'] ) ? $settings['buttons_style'] : '';
		$autoplay       = ! empty( $settings['autoplay'] ) ? $settings['autoplay'] : 0;
		$loop           = ! empty( $settings['loop'] ) ? $settings['loop'] : 0;
		$categories        = $settings['categories'];
		$show_thumb        = $settings['show_thumb'];
		$img_format        = $settings['img_format'];
		$label_readmore    = $settings['label_readmore'];
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style             = $settings['style'];
		$excerpt           = $settings['excerpt'];
		$excerpt_limit     = $settings['excerpt_limit'];
		$meta              = $settings['meta'];
		$meta_ordering     = $settings['meta_ordering'];
		$css_class         = $settings['css_class'];

		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}

		global $post;
		$editor_content = $this->parse_text_editor( $editor_content );
		$grid = '';

		// Query posts - "ftc_elements_query_args_post" hook in includes/helpers.php.
		$args  = apply_filters( 'ftc_elements_query_args_post', $posts_per_page, $categories, $sticky, $offset ); 
		$posts = get_posts( $args );

		if ( ! empty( $posts ) ) {
			echo '<div class="title-blogs-grid element">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';
			echo '<div class="ftc-blogs-slider swiper-container ' . esc_attr( $style_blog ) . '">';
			echo '<input type="hidden" data-pps="' . esc_attr( $pps ) . '" data-rows="' . esc_attr( $rows ) . '" data-ppst="' . esc_attr( $pps_tab ) . '" data-ppsm="' . esc_attr( $pps_mob ) . '" data-space="' . esc_attr( $space ) . '" data-space_mobile="30" data-pagin="' . esc_attr( $pagination ) . '" data-autoplay="' . esc_attr( (int) $autoplay ) . '" ' . ( $loop ? 'data-loop="true"' : '' ) . ' class="slider-config">';

			echo '<div class="blogs-slider blog-template-elementor swiper-wrapper ' . esc_attr( $stylee ) . ' ' . esc_attr( $def_style_optionn ) . ' ">';

			// If "Load more" is selected, turn on the arguments for Ajax call.

			foreach ( $posts as $post ) {

				setup_postdata( $post );

				// Hook in includes/helpers.php.
				apply_filters( 'ftc_elements_loop_post_slider', $style, $grid, $label_readmore, $show_thumb, $img_format, $meta, $meta_ordering, $excerpt, $excerpt_limit, $css_class );

			}

			echo '</div>';
			
			echo '<div class="swiper-pagination '.($pagination ? '' : 'hidden').'"></div>';
			
			
			echo '</div>';
			if ( $buttons ) {
				echo '<div class="navigation-slider '.$buttons_style.'">';
				echo '<div class="nav-next " screen-reader>' . esc_html__( 'Next', 'ftc-element' ) . '</div>';
				echo '<div class="nav-prev " screen-reader>' . esc_html__( 'Previous', 'ftc-element' ) . '</div>';
				echo '</div>';
			}
		}

		wp_reset_postdata();
		echo '
		<script type="text/javascript" defer="defer">
		(function( $ ){
			"use strict";
			jQuery(document).ready( function($) {
				var blogs_slider = window.ftc_elements_swiper();
				});
				})( jQuery );
				</script>';

			}

			protected function content_template() {}

			public function render_plain_content( $instance = [] ) {}

		}

		Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Blog_Slider() );
