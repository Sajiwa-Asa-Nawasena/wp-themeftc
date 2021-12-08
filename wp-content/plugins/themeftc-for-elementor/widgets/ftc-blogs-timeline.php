<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Blog_Timeline extends Widget_Base {

	public function get_name() {
		return 'ftc-blog-timeline';
	}

	public function get_title() {
		return __( 'FTC - Blog TimeLine ', 'ftc-element' );
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
				'label' => esc_html__( 'FTC Blog TimeLine', 'ftc-element' ),
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Blogs TimeLine', 'ftc-element' ),
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
			'posts_per_page',
			[
				'label'   => __( 'Limit', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '3',
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
			'posts_per_row',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
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
			'posts_per_row_tab',
			[
				'label'   => __( 'Number of columns (on tablets)', 'ftc-element' ),
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
			'posts_per_row_mob',
			[
				'label'   => __( 'Number of columns (on mobiles)', 'ftc-element' ),
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

		$this->add_responsive_control(
			'horiz_spacing',
			[
				'label'     => __( 'Horizontal spacing', 'ftc-element' ),
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
					'{{WRAPPER}} .gap .post' => 'padding-left:{{SIZE}}px;padding-right:{{SIZE}}px;',
					'{{WRAPPER}} .gap'       => 'margin-left:-{{SIZE}}px; margin-right:-{{SIZE}}px;',
				],

			]
		);
		$this->add_responsive_control(
			'vert_spacing',
			[
				'label'     => __( 'Vertical spacing', 'ftc-element' ),
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
					'{{WRAPPER}} .gap .post' => 'margin-bottom:{{SIZE}}px;'
				],

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
				'label'     => __( 'Text blogs background', 'ftc-element' ),
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
				'label'     => __( 'Text blogs background (hover)', 'ftc-element' ),
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
				'label'      => esc_html__( 'Post text padding', 'ftc-element' ),
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
				'label'     => __( 'Post text alignment', 'ftc-element' ),
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
				'label'       => __( 'Border', 'ftc-element' ),
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

		$this->end_controls_section();

		// Ajax LOAD MORE settings.
		$this->start_controls_section(
			'section_ajax_load_more',
			[
				'label' => __( 'Load More Blogs Settings', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'use_load_more',
			[
				'label'     => esc_html__( 'Show load more', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'no',
			]
		);
		$this->add_control(
			'label_load_more',
			[
				'label'       => __( 'Label load more posts', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Load more',
				'condition'   => array(
					'use_load_more'      => 'yes',
				),
			]
		);

		$this->add_responsive_control(
			'load_more_padding',
			[
				'label'      => esc_html__( '"LOAD MORE" margin', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc-loadmore-posts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'use_load_more!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'loadmore_align',
			[
				'label'     => __( '"LOAD MORE"  alignment', 'ftc-element' ),
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
					'{{WRAPPER}} .ftc-loadmore-posts' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'use_load_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		// Get our input from the widget settings.
		$settings = $this->get_settings_for_display();

		$posts_per_page    = (int) $settings['posts_per_page'];
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$sticky            = $settings['sticky'];
		$offset            = (int) $settings['offset'];
		$posts_per_row     = (int) $settings['posts_per_row'];
		$posts_per_row_tab = (int) $settings['posts_per_row_tab'];
		$posts_per_row_mob = (int) $settings['posts_per_row_mob'];
		$categories        = $settings['categories'];
		$show_thumb        = $settings['show_thumb'];
		$img_format        = $settings['img_format'];
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style             = $settings['style'];
		$excerpt           = $settings['excerpt'];
		$excerpt_limit     = $settings['excerpt_limit'];
		$meta              = $settings['meta'];
		$meta_ordering     = $settings['meta_ordering'];
		$css_class         = $settings['css_class'];
		$use_load_more     = $settings['use_load_more'];
		$label_load_more   = ! empty( $settings['label_load_more'] ) ? $settings['label_load_more'] : 'Load more';


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

		$grid = ftc_grid_class( intval( $posts_per_row ), intval( $posts_per_row_tab ), intval( $posts_per_row_mob ) );

		// Query posts - "ftc_elements_query_args_post" hook in includes/inc/hook.php.
		$args  = apply_filters( 'ftc_elements_query_args_post', $posts_per_page, $categories, $sticky, $offset ); 
		$posts = get_posts( $args );

		if ( ! empty( $posts ) ) {
			echo '<div class="title-blogs-grid element">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';

			echo '<div class="ftc-elements-blogs-timeline swiper-wrapper' . ( $use_load_more ? ' loadmore-blogs' : '' ) . ' gap ' . esc_attr( $stylee ) . ' ' . esc_attr( $def_style_optionn ) . ' columns-'.esc_attr($posts_per_row).' ">';

			// If "Load more" is selected, turn on the arguments for Ajax call.
			if ( $use_load_more ) {

				$postoptions = wp_json_encode(
					array(
						'ppp'           => $posts_per_page,
						'sticky'        => $sticky,
						'categories'    => $categories,
						'style'         => $style,
						'img_format'    => $img_format,
						'excerpt'       => $excerpt,
						'excerpt_limit' => $excerpt_limit,
						'meta'          => $meta,
						'meta_ordering' => $meta_ordering,
						'css_class'     => $css_class,
						'grid'          => $grid,
						'startoffset'   => $offset,
						'label_load_more' => $label_load_more
					)
				);

				echo '<input type="hidden" class="posts-grid-settings" data-postoptions="' . esc_js( $postoptions ) . '">';
			}
			foreach ( $posts as $post ) {

				setup_postdata( $post );

				// Hook in includes/helpers.php.
				apply_filters( 'ftc_elements_loop_post_timeline', $style, $grid, $show_thumb, $img_format, $meta, $meta_ordering, $excerpt, $excerpt_limit, $css_class );
			}

			echo '</div>';

		}

		wp_reset_postdata();

		if ( $use_load_more ) {
			echo '<div class="ftc-loadmore-posts"><a href="#" class="ftc-loadmore more_posts button">' . $label_load_more  . '</a></div>';
		}

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Blog_Timeline() );
