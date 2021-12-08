<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FTC_360_Rotation extends Widget_Base {

	public function get_name() {
		return 'ftc-360-rotation';
	}

	public function get_title() {
		return __( 'FTC - 360 Rotation', 'ftc-element' );
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
				'label' => esc_html__( 'FTC - 360 Rotation', 'ftc-element' ),
			]
		);

		$this->add_control(
			'wp_gallery',
			[
				'label' => __( 'Add Images', 'ftc-element' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'navigation_360',
			[
				'label' => __( 'Navigation', 'ftc-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ftc-element' ),
				'label_off' => __( 'No', 'ftc-element' ),
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$wp_gallery = $settings['wp_gallery'];
		$image_size = $settings['thumbnail_size'];
		$rand_nb = mt_rand( 1, 9999);

		if ( ! $wp_gallery ) {
			return;
		}

		$img_array = '';

		$image_ids = wp_list_pluck( $wp_gallery, 'id');
		$count_image = count($wp_gallery);
		$i = 0;

		$this->add_render_attribute( 'wrapper', 'id', 'ftc_360_rotation_' . $rand_nb);
		$this->add_render_attribute( 'wrapper', 'class', 'ftc_360_rotation threesixty ftc_default_style');

		if ($settings['navigation_360'] == 'yes') {
			$navigation = 'true';
		} else {
			$navigation = 'false';
		}

		foreach ($image_ids as $image_id) {
			$i++;
			$images = wp_get_attachment_image_src( $image_id, $image_size );
			$img_array .= "'" . $images[0] . "'";
			if ($i < $count_image ) {
				$img_array .= ",";
			}
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<ul class="threesixty_images"></ul>
			<div class="spinner">
	            <span>0%</span>
	        </div>
		</div>
		<script>
			jQuery(document).ready( function($){
				$('#ftc_360_rotation_<?php echo $rand_nb; ?>').ThreeSixty({
					totalFrames: <?php echo $count_image; ?>,
					endFrame: <?php echo $count_image; ?>,
					currentFrame: 1,
					imgList: ".threesixty_images",
					imgArray: [ <?php echo $img_array; ?> ],
					progress: ".spinner",
					navigation: <?php echo $navigation; ?>,
					responsive: true,
				});
			})
		</script>
		<?php
	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}
}

Plugin::instance()->widgets_manager->register_widget_type( new FTC_360_Rotation() );
