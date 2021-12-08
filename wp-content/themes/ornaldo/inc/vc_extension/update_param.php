<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Add param for vc_row */
vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Layout', 'ornaldo')
	,'param_name' 	=> 'layout'
	,'value' 		=> array(
				esc_html__('Wide', 'ornaldo') 		=> 'ftc-row-wide'
				,esc_html__('Boxed', 'ornaldo') 	=> 'ftc-row-boxed'
	)
	,'description' 	=> esc_html__('Only support Fullwidth Template', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Type', 'ornaldo')
	,'param_name' 	=> 'bg_type'
	,'value' 		=> array(
					esc_html__('Default', 'ornaldo')			=> 'no_bg'
					,esc_html__('Parallax', 'ornaldo')			=> 'image'
					,esc_html__('Youtube Video', 'ornaldo')		=> 'u_iframe'
					,esc_html__('Hosted Video', 'ornaldo')		=> 'video'
	)
	,'group'		=> esc_html__('Background', 'ornaldo')
	,'description' 	=> esc_html__('Note: Youtube Video does not work on mobile', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'attach_image'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Image', 'ornaldo')
	,'param_name' 	=> 'bg_image_new'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('image'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Parallax Speed', 'ornaldo')
	,'param_name' 	=> 'parallax_speed'
	,'value' 		=> '0.1'
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('image'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Youtube Video URL', 'ornaldo')
	,'param_name' 	=> 'u_video_url'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('MP4 Video URL', 'ornaldo')
	,'param_name' 	=> 'video_url'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('video'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('WebM / Ogg Video URL', 'ornaldo')
	,'param_name' 	=> 'video_url_2'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('video'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'attach_image'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Placeholder Image', 'ornaldo')
	,'param_name' 	=> 'video_poster'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe', 'video'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Start Time', 'ornaldo')
	,'param_name' 	=> 'u_start_time'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'description' 	=> esc_html__('In seconds', 'ornaldo')
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Stop Time', 'ornaldo')
	,'param_name' 	=> 'u_stop_time'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'description' 	=> esc_html__('In seconds', 'ornaldo')
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_add_param('vc_row', array(
	'type' 			=> 'checkbox'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Extra Options', 'ornaldo')
	,'param_name' 	=> 'video_opts'
	,'value' 		=> array(
					esc_html__('Loop', 'ornaldo') 			=> 'loop'
					,esc_html__('Muted', 'ornaldo') 		=> 'muted'
					,esc_html__('Auto Play', 'ornaldo') 	=> 'auto_play'
	)
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe', 'video'))
	,'group'		=> esc_html__('Background', 'ornaldo')
));

vc_remove_param('vc_row', 'parallax');
vc_remove_param('vc_row', 'parallax_image');
vc_remove_param('vc_row', 'parallax_speed_bg');
vc_remove_param('vc_row', 'video_bg');
vc_remove_param('vc_row', 'video_bg_url');
vc_remove_param('vc_row', 'video_bg_parallax');
vc_remove_param('vc_row', 'parallax_speed_video');

/* Add param for vc_tabs */
vc_add_param('vc_tabs', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Style', 'ornaldo')
	,'param_name' 	=> 'style'
	,'value' 		=> array(
					esc_html__('Default', 'ornaldo') 							=> 'default'
					,esc_html__('Default - No Border', 'ornaldo') 				=> 'default_no_border'
					,esc_html__('Tab Title With Background Color', 'ornaldo') 	=> 'background_color'
					,esc_html__('Tab Title With Top Border', 'ornaldo') 		=> 'top_border'
	)
));

vc_remove_param('vc_tta_accordion', 'style');
vc_remove_param('vc_tta_accordion', 'shape');
vc_remove_param('vc_tta_accordion', 'color');
vc_remove_param('vc_tta_accordion', 'no_fill');
vc_remove_param('vc_tta_accordion', 'spacing');
vc_remove_param('vc_tta_accordion', 'gap');
vc_remove_param('vc_tta_accordion', 'c_align');
vc_remove_param('vc_tta_accordion', 'c_position');

vc_remove_param('vc_tta_tour', 'style');
vc_remove_param('vc_tta_tour', 'shape');
vc_remove_param('vc_tta_tour', 'color');
vc_remove_param('vc_tta_tour', 'spacing');
vc_remove_param('vc_tta_tour', 'gap');
vc_remove_param('vc_tta_tour', 'no_fill_content_area');
vc_remove_param('vc_tta_tour', 'controls_size');
vc_remove_param('vc_tta_tour', 'pagination_style');
vc_remove_param('vc_tta_tour', 'pagination_color');
vc_remove_param('vc_tta_tour', 'alignment');

vc_remove_param('vc_tta_tabs', 'shape');
vc_remove_param('vc_tta_tabs', 'style');
vc_remove_param('vc_tta_tabs', 'color');
vc_remove_param('vc_tta_tabs', 'alignment');
vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
vc_remove_param('vc_tta_tabs', 'spacing');
vc_remove_param('vc_tta_tabs', 'gap');
vc_remove_param('vc_tta_tabs', 'pagination_style');
vc_remove_param('vc_tta_tabs', 'pagination_color');

/* Add param for vc_tta_tabs */
vc_add_param('vc_tta_tabs', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Style', 'ornaldo')
	,'param_name' 	=> 'ftc_style'
	,'value' 		=> array(
					esc_html__('Default', 'ornaldo') 							=> 'default'
					,esc_html__('Default - No Border', 'ornaldo') 				=> 'default_no_border'
					,esc_html__('Tab Title With Background Color', 'ornaldo') 	=> 'background_color'
					,esc_html__('Tab Title With Top Border', 'ornaldo') 		=> 'top_border'
	)
));
vc_add_param('vc_tta_section', array(
                                'type' => 'checkbox',
                                'param_name' => 'ftc_add_image',
                                'heading' => esc_html__( 'Add image?', 'ornaldo' ),
                                'description' => esc_html__( 'Add image next to section title.', 'ornaldo' ),
                        )
);
vc_add_param('vc_tta_section', array(
                                'type' 			=> 'attach_image'
				,'admin_label' 	=> true
				,'value' 		=> ''
                                ,'param_name' 	=> 'ftc_image_title'
                                ,'heading' 		=> esc_html__('Image', 'ornaldo')
                                ,'dependency' => array(
                                        'element' => 'ftc_add_image',
                                        'value' => 'true',
                                )
                        )
);
/**
* Image hotspot field
*/
if ( ! function_exists( 'ftc_image_hotspot' ) && function_exists( 'vc_add_shortcode_param' ) ) {
	function ftc_image_hotspot( $settings, $value ) {
		ob_start();
		$uniqid = uniqid();

		$position = explode( '||', $value );
		$left = ( isset( $position[0] ) && $position[0] ) ? $position[0] : '50';
		$top = ( isset( $position[1] ) && $position[1] ) ? $position[1] : '50';

		echo '<input type="hidden" class="ftc-image-hotspot-position wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '">';
		echo '<div class="ftc-image-hotspot-preview">';
			echo '<div class="ftc-image-hotspot" style="left: ' . $left . '%; top: ' . $top . '%;"></div>';
			echo '<div class="ftc-image-hotspot-image"></div>';
			echo '<div class="ftc-image-hotspot-overlay"></div>';
		echo '</div>';
		 
		?>
		<script type="text/javascript">
			(function( $ ){
				var $point = $('.ftc-image-hotspot');
				var $frame = $('.ftc-image-hotspot-preview');
				var $overlay = $('.ftc-image-hotspot-overlay');
				var $positionField = $('.ftc-image-hotspot-position');
				var isDragging = false;
				var timer;

				$overlay.on('mousedown', function (event) {
					isDragging = true;
					event.preventDefault();
				}).on('mouseup', function () {
					isDragging = false;
				}).on('mouseleave', function () {
					timer = setTimeout(function () {
						$overlay.trigger('mouseup');
					}, 500);
				}).on('mouseenter', function () {
					clearTimeout(timer);
				}).on('mousemove', function (event) {
					if (!isDragging) return;
					setPosition(event);
				}).on('click', function (event) {
					setPosition(event);
				}).on('dragstart', function (event) {
					event.preventDefault();
				});

				function setPosition(event) {
					var position = {
						x: (event.offsetX / $frame.width() * 100).toFixed(3),
						y: (event.offsetY / $frame.height() * 100).toFixed(3)
					};

					$point.css({
						left: position.x + '%',
						top: position.y + '%'
					});

					$positionField.attr('value', position.x + '||' + position.y).trigger('change');
				}
			})(jQuery);
		</script>
		<?php
		return ob_get_clean();
	}

	vc_add_shortcode_param( 'ftc_image_hotspot', 'ftc_image_hotspot' );
}
?>