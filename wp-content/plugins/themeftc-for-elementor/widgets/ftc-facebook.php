<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Facebook extends Widget_Base {

	public function get_name() {
		return 'ftc-facebook';
	}

	public function get_title() {
		return __( 'FTC - Facebook Page', 'ftc-element' );
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
				'label' => esc_html__( 'Facebook settings', 'ftc-element' ),   //section name for controler view
			]
		);
		$this->add_control(
			'heading_title_pro',
			[
				'label'     => __( 'Title Products Slider', 'ftc-element' ),
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
				'default' => __( 'Title', 'ftc-elements' ),
			]
		);
		$this->add_control(
			'url',
			[
				'label'       => __( 'Url Facebook Page : ', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Example: facebook.com/....', 'ftc-element' ),
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'show_faces',
			[
				'label'   => __( 'Show Faces', 'ftc-element' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_posts',
			[
				'label'   => __( 'Show Post', 'ftc-element' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_cover_photo',
			[
				'label'   => __( 'Show cover photo', 'ftc-element' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'small_header',
			[
				'label'   => __( 'Small header', 'ftc-element' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'box_height',
			[
				'label'   => __( 'Margin between slides', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 250,
				'min'     => 0,
				'step'    => 10,
			]
		);



		$this->end_controls_section();
	}

	protected function render() {

		$settings           = $this->get_settings();
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$box_height= ! empty( $settings['box_height'] ) ? $settings['box_height'] : 250;
		$url                = $settings['url'];
		$show_posts         = $settings['show_posts'];
		$show_faces         = $settings['show_faces'];
		$show_cover_photo   = $settings['show_cover_photo'];
		$small_header          = $settings['small_header'];
		$editor_content = ! empty( $settings['editor'] ) ? $settings['editor'] : '';
		$editor_content = $this->parse_text_editor( $editor_content );

		?>
		<div class="ftc-facebook-elementor">
			<?php 
			echo '<div class="title-element-facebook">';
			echo '<h2>'.$editor_content.'</h2>';
			echo '</div>';
			?>
			<div class="fb-page" data-href="<?php echo esc_url($url) ?>" data-small-header="<?php echo esc_attr($small_header) ?>" data-adapt-container-width="true" data-height="<?php echo esc_attr($box_height) ?>" 
				data-hide-cover="<?php echo esc_attr($show_cover_photo) ?>" data-show-facepile="<?php echo esc_attr($show_faces) ?>" data-show-posts="<?php echo esc_attr($show_posts) ?>">
			</div>
		</div>

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<?php	

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Facebook () );
