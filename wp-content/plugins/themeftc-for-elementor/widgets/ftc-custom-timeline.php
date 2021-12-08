<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FTC_Custom_Timeline extends Widget_Base {

	public function get_name() {
		return 'ftc-custom-timeline';
	}

	public function get_title() {
		return __( 'FTC - Custom Timeline', 'ftc-element' );
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
			'section_main', [
				'label' => esc_html__( 'Content Timeline', 'ftc-element' ),
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
    			'default' => 'yes',
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
				],
				'condition' => ['def_style' => 'yes'],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title In Timeline', 'ftc-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Item In Line',
			]
		);

		$repeater->add_control(
			'position_content', [
				'label' => __( 'Position Content', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'content_left' => __( 'Content Left', 'ftc-element'),
					'content_right' => __( 'Content Right', 'ftc-element'),
					'full_content' => __( 'Full Content', 'ftc-element'),
				],
				'default' => 'content_left',
			]
		);

		$repeater->add_control(
			'heading_content', [
				'label' => __( 'Content', 'ftc-element' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'title_content', [
				'label' => __( 'Title', 'ftc-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Add Your Heading Text Here'),
			]
		);

		$repeater->add_control(
			'sub_title_content', [
				'label' => __( 'Sub Title', 'ftc-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Add Your Sub Heading Text Here'),
			]
		);

		$repeater->add_control(
			'desc_content', [
				'label' => __( 'Description Content', 'ftc-element' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' ),
			]
		);

		$repeater->add_control(
			'content_button', [
				'label' => __( 'Show Button', 'ftc-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'ftc-element' ),
				'label_off' => __( 'Off', 'ftc-element' ),
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'text_button', [
				'label' => __( 'Text Button', 'ftc-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Read More',
			]
		);

		$repeater->add_control(
			'link_button', [
				'label' => __( 'Link', 'ftc-element' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'ftc-element' ),
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'heading_image', [
				'label' => __( 'Image', 'ftc-element' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'list_image', [
				'label' => __( 'Image Item', 'ftc-element' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);	

		$repeater->add_control(
			'desc_image', [
				'label' => __( 'Description Image', 'ftc-element' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' ),
			]
		);

		$this->add_control(
			'list_item', [
				'label' => __( 'Add Item', 'ftc-element' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// Style Content
		$this->start_controls_section(
			'section_style_content', [
				'label' => __( 'Content', 'ftc-element' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_style_title_in_line', [
				'label' => __( 'Style Title In Timeline', 'ftc-element'),
       			'type' => Controls_Manager::HEADING,
			]
		);	

		$this->add_control(
			'color_title_in_line', [
				'label' => __( 'Text Color', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .breakpoint_title' => 'color: {{VALUE}}',
       			]
			]
		);

		$this->add_control(
			'bg_color_title_in_line', [
				'label' => __( 'Background Color', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .breakpoint_title' => 'background-color: {{VALUE}}',
       			]
			]
		);
		$this->add_control(
			'color_title_in_line_hover', [
				'label' => __( 'Text Color Hover', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .breakpoint_title:hover' => 'color: {{VALUE}}',
       			]
			]
		);

		$this->add_control(
			'bg_color_title_in_line_hover', [
				'label' => __( 'Background Color Hover', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .breakpoint_title:hover' => 'background-color: {{VALUE}}',
       			]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	            'name' => 'ftc_typography_1',
				'selector' => '{{WRAPPER}} .ftc_timeline_items .breakpoint_title',
			]
		);

		// Style Content
		$this->add_control(
			'heading_style_content', [
				'label' => __( 'Style Content', 'ftc-element'),
       			'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'align_content',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .ftc_timeline_item .content_item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_content_title', [
				'label' => __( 'Color Title', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .title_content' => 'color: {{VALUE}}',
       			]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	            'name' => 'ftc_typography_2',
				'selector' => '{{WRAPPER}} .ftc_timeline_items .content_item .title_content',
			]
		);

		$this->add_control(
			'color_content_sub_title', [
				'label' => __( 'Color Sub Title', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .subtitle_content' => 'color: {{VALUE}}',
       			]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	            'name' => 'ftc_typography_3',
				'selector' => '{{WRAPPER}} .ftc_timeline_items .content_item .subtitle_content',
			]
		);

		$this->add_control(
			'color_content_desc', [
				'label' => __( 'Color Description', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .desc_content' => 'color: {{VALUE}}',
       			]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	            'name' => 'ftc_typography_4',
				'selector' => '{{WRAPPER}} .ftc_timeline_items .content_item .desc_content',
			]
		);

		// Style button
		$this->add_control(
			'heading_style_button', [
				'label' => __( 'Style Button', 'ftc-element'),
       			'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	            'name' => 'ftc_typography_5',
				'selector' => '{{WRAPPER}} .ftc_timeline_items .content_item .btn_readmore_timeline a',
			]
		);
		$this->add_control(
			'color_button', [
				'label' => __( 'Color', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .btn_readmore_timeline a' => 'color: {{VALUE}}',
       			]
			]
		);
		$this->add_control(
			'bg_color_button', [
				'label' => __( 'Background Color', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .btn_readmore_timeline' => 'background-color: {{VALUE}}',
       			]
			]
		);
		$this->add_control(
			'color_button_hover', [
				'label' => __( 'Color Hover', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .btn_readmore_timeline:hover a' => 'color: {{VALUE}}',
       			]
			]
		);
		$this->add_control(
			'bg_color_button_hover', [
				'label' => __( 'Background Color Hover', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .content_item .btn_readmore_timeline:hover' => 'background-color: {{VALUE}}',
       			]
			]
		);


		// Style Image
		$this->add_control(
			'heading_style_image', [
				'label' => __( 'Style Image', 'ftc-element'),
       			'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'ftc-element' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'color_image_desc', [
				'label' => __( 'Color Description', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_items .image_desc' => 'color: {{VALUE}}',
       			]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	            'name' => 'ftc_typography_6',
				'selector' => '{{WRAPPER}} .ftc_timeline_items .image_item .image_desc',
			]
		);

		$this->end_controls_section();

		// Style Line 
		$this->start_controls_section(
			'section_style_line', [
				'label' => __( 'Line', 'ftc-element' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_line', [
				'label' => __( 'Color Line', 'ftc-element'),
       			'type' => Controls_Manager::COLOR,
       			'default' => '',
       			'selectors' => [
       				'{{WRAPPER}} .ftc_timeline_line' => 'background-color: {{VALUE}}',
       				'{{WRAPPER}} .ftc_timeline_line .start_line' => 'background-color: {{VALUE}}',
       				'{{WRAPPER}} .ftc_timeline_line .end_line' => 'background-color: {{VALUE}}',
       			]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$list_item = $settings['list_item'];

		if (empty($list_item)) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'ftc_custom_timeline');
		if ($settings['def_style'] == 'yes') {
			$this->add_render_attribute( 'wrapper', 'class', 'ftc_style_default');
			$this->add_render_attribute( 'wrapper', 'class',  $settings['def_style_option']);
		} else {
			$this->add_render_attribute( 'wrapper', 'class', 'ftc_style_custom');
		}

		?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<div class="ftc_timeline_line">
					<div class="start_line"></div>
					<div class="end_line"></div>
				</div>
				<div class="ftc_timeline_items">
					<?php foreach ($list_item as $item) { 
						if (empty($item['link_button']['url'])){
							$this->add_render_attribute( 'button', 'href', '#');
						} else {
							$this->add_link_attributes( 'button', $item['link_button'] );
						}
						
					?>
						<div class="ftc_timeline_breakpoint">
							<span class="breakpoint_title"><?php echo $item['list_title']; ?></span>
						</div>
						<div class="ftc_timeline_item <?php echo 'ftc_position_' . $item['position_content']; ?>">
							<div class="content_item">
								<h3 class="title_content"> <?php echo $item['title_content']; ?></h3>
								<h5 class="subtitle_content"><?php echo $item['sub_title_content']; ?></h5>
								<div class="desc_content"><?php echo $item['desc_content']; ?></div>
								<?php if ($item['content_button'] == 'yes') { ?>
								<div class="btn btn_readmore_timeline"><a <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php echo $item['text_button']; ?></a></div>
								<?php } ?>
							</div>
							<div class="image_item">
								<img class="img-responsive elementor-animation-<?php echo $settings['hover_animation']; ?>" src="<?php echo $item['list_image']['url']; ?>">
								<div class="image_desc">
									<?php echo $item['desc_image']; ?>
								</div>
							</div>
						</div>						
					<?php } ?>
				</div>
			</div>
		<?php
	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}
}

Plugin::instance()->widgets_manager->register_widget_type( new FTC_Custom_Timeline() );
