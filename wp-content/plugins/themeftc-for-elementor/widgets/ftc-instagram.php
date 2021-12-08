<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FTc_Instagram extends Widget_Base {

	public function get_name() {
		return 'ftc-instagram';
	}

	public function get_title() {
		return __( 'FTC - Instagram Feed', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Instagram settings', 'ftc-element' ),   //section name for controler view
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
			'title',
			[
				'label'       => __( 'Title : ', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Instagram',
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'post_title_align',
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
					'{{WRAPPER}} .widget.widget_ftc_instagram_new .widgettitle' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}}  .widget.widget_ftc_instagram_new .widgettitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'username_hashtag',
			[
				'label'       => __( 'Username or #tag : ', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Example: @themeftc', 'ftc-element' ),
				'default'     => '',
				'label_block' => true,
			]
		);
		$this->add_control(
			'photos_number',
			[
				'label'       => __( 'Number of images displayed ', 'ftc-element' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 5,
				'label_block' => true,
			]
		);
		$this->add_control(
			'columns',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
					6 => __( '6', 'ftc-element' ),
					7 => __( '6', 'ftc-element' ),
					8 => __( '6', 'ftc-element' ),
					9 => __( '6', 'ftc-element' ),
					10 => __( '6', 'ftc-element' ),
					11 => __( '6', 'ftc-element' ),
					12 => __( '6', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'photo_space',
			[
				'label'   => __( 'Space item', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'title'   => __( 'Space between items', 'ftc-element' ),
			]
		);
		// $this->add_control(
		// 	'container_size',
		// 	[
		// 		'label'     => __( 'Width Container Section', 'ftc-element' ),
		// 		'type'      => Controls_Manager::NUMBER,
		// 		'default'   =>  300,
		// 		]
		// );

		$this->add_control(
			'link_text',
			[
				'label'       => __( 'Label button Follow : ', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Example: Follow...', 'ftc-element' ),
				'default'     => 'Follow Instagram',
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'post_label_align',
			[
				'label'     => __( 'Position button alignment', 'ftc-element' ),
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
					'{{WRAPPER}} p.ftc-instagram-follow-link' => 'text-align: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'back_color',
			[
				'label'     => __( 'Background color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} p.ftc-instagram-follow-link a.ftc-button-follow' => 'background-color: {{VALUE}};',
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
		$this->add_control(
			'is_slider',
			[
				'label'           => __( 'Display in Slider', 'ftc-element' ),
				'type'            => Controls_Manager::SWITCHER,
				'default'         => 'no',
				'label_on'        => __( 'Yes', 'ftc-element' ),
				'label_off'       => __( 'No', 'ftc-element' ),
			]
		);
		$this->add_control(
			'show_nav',
			[
				'label'           => __( 'Show navigation', 'ftc-element' ),
				'type'            => Controls_Manager::SWITCHER,
				'default'         => 'yes',
				'label_on'        => __( 'Yes', 'ftc-element' ),
				'label_off'       => __( 'No', 'ftc-element' ),
			]
		);
		$this->add_control(
			'auto_play',
			[
				'label'           => __( 'Auto play', 'ftc-element' ),
				'type'            => Controls_Manager::SWITCHER,
				'default'         => 'yes',
				'label_on'        => __( 'yes', 'ftc-element' ),
				'label_off'       => __( 'No', 'ftc-element' ),
			]
		);


		$this->end_controls_section();
	}

	protected function render() {

		$settings           = $this->get_settings();
		$title              = $settings['title'];
		$username_hashtag   = $settings['username_hashtag'];
		$photos_number      = $settings['photos_number'];
		$columns            = $settings['columns'];
		$photo_space          = $settings['photo_space'];
		// $container_size             = $settings['container_size'];
		$link_text            = $settings['link_text'];
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$hover_animation    = $settings['hover_animation'];
		$is_slider    = $settings['is_slider'];
		$auto_play    = $settings['auto_play'];
		$show_nav   = $settings['show_nav'];

		if($def_style == 'yes'){
			$def_style_optionn = $def_style_option;
		}
		else{
			$def_style_optionn = '';
		}
		?>
		<div class="ftc-element-instagram <?php echo $def_style_optionn ; ?>" >
			<?php
			echo do_shortcode('[ftc_insta_photo_feed title="'.$title.'" username="'.$username_hashtag .'" container_size="1920" columns="'.$columns.'" photo_space="'.$photo_space.'" photos_number="'.$photos_number.'" link_text="'.$link_text.'" hover_animation="'.$hover_animation.'" is_slider="'.$is_slider.'" auto_play="'.$auto_play.'" show_nav="'.$show_nav.'"]');
			?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new FTc_Instagram() );
