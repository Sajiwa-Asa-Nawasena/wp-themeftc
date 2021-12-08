<?php 
namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FTC_Custom_Popup extends Widget_Base {
	public function get_name() {
		return 'ftc-custom-popup';
	}

	public function get_title() {
		return __( 'FTC - Custom Popup', 'ftc-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$gallery_columns = range( 1, 10 );
		$gallery_columns = array_combine( $gallery_columns, $gallery_columns );

		$this->start_controls_section(
			'section_custom_popup',
			[
				'label' => esc_html__( 'FTC - Custom Popup', 'ftc-element' ),
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

		$this->add_control(
			'heading_content',
			[
				'label' => __('Content Setting', 'ftc-element'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_content',
			[
				'label' => __('Title Content', 'ftc-element'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => __('Title Custom Popup', 'ftc-element'),
			]
		);

		$this->add_control(
			'heading_button',
			[
				'label' => __('Button Setting', 'ftc-element'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_button',
			[
				'label' => __('Text Button', 'ftc-element'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Button Popup',
			]
		);

		$this->add_control(
			'icon_button',
			[
				'label' => __('Icon Button', 'ftc-element'),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'icon_right',
			[
				'label' => __( 'Right Icon', 'ftc-element'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ftc-element' ),
				'label_off' => __( 'No', 'ftc-element' ),
				'default' => '',
			]
		);

		$this->add_control(
			'heading_popup',
			[
				'label' => __( 'Popup Content', 'ftc-element' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'type_popup',
			[
				'label' => __( 'Select type popup', 'ftc-element'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'simple_content' => __( 'Simple Content', 'ftc-element'),
					'contact_form' => __( 'Contact Form', 'ftc-element'),
					// 'google_map' => __( 'Google Map', 'ftc-element'),
					'image_gallery' => __( 'Image Gallery', 'ftc-element'),
					'video' => __( 'Video', 'ftc-element' ),
				],
				'default' => 'simple_content',
			]
		);

		$this->add_control(
			'simple_heading',
			[
				'label' => __('Simple Content', 'ftc-element'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['type_popup' => 'simple_content'],
			]
		);

		$this->add_control(
			'content_popup',
			[
				'label' => __( 'Content Popup', 'ftc-element'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
				'condition' => ['type_popup' => 'simple_content'],
			]
		);	

		$this->add_control(
			'button_simple',
			[
				'label' => __( 'Show Button', 'ftc-element'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ftc-element' ),
				'label_off' => __( 'No', 'ftc-element' ),
				'default' => 'yes',
				'condition' => ['type_popup' => 'simple_content'],
			]
		);

		$this->add_control(
			'text_button_popup',
			[
				'label' => __( 'Text Button', 'ftc-element'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Click here',
				'condition' => ['type_popup' => 'simple_content'],
			]
		);

		$this->add_control(
			'link_button_popup',
			[
				'label' => __( 'Link Button', 'ftc-element'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'ftc-element' ),
				'default' => [
					'url' => '#',
				],
				'condition' => ['type_popup' => 'simple_content'],		
			]
		);

		$this->add_control(
			'contact_form_heading',
			[
				'label'     => __( 'Contact Form', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['type_popup' => 'contact_form'],	
			]
		);

		$this->add_control(
			'cf7_slug',
			[
				'label'       => esc_html__( 'Select Contact Form', 'ftc-element' ),
				'description' => esc_html__( 'Contact form 7 - Plugin must be installed' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => apply_filters( 'ftc_posts_array', 'wpcf7_contact_form' ),
				'condition' => ['type_popup' => 'contact_form'],
			]
		);

		// $this->add_control(
		// 	'google_map_heading',
		// 	[
		// 		'label'     => __( 'Google Map', 'ftc-element' ),
		// 		'type'      => Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 		'condition' => ['type_popup' => 'google_map'],	
		// 	]
		// );

		// $default_address = __( 'London Eye, London, United Kingdom', 'ftc-element' );
		// $this->add_control(
		// 	'address',
		// 	[
		// 		'label' => __( 'Location', 'ftc-element' ),
		// 		'type' => Controls_Manager::TEXT,
		// 		'dynamic' => [
		// 			'active' => true,
		// 			'categories' => [
		// 				TagsModule::POST_META_CATEGORY,
		// 			],
		// 		],
		// 		'placeholder' => $default_address,
		// 		'default' => $default_address,
		// 		'label_block' => true,
		// 		'condition' => ['type_popup' => 'google_map'],
		// 	]
		// );

		// Video Popup
		$this->add_control(
			'video_popup',
			[
				'label'     => __( 'Video YouTube', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['type_popup' => 'video'],	
			]
		);

		$this->add_control(
			'youtube_url',
			[
				'label' => __( 'Link', 'ftc-element' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'ftc-element' ) . ' (YouTube)',
				'default' => 'https://www.youtube.com/embed/XHOmBV4js_E',
				'label_block' => true,
				'condition' => [
					'type_popup' => 'video'
				],
				'description' => __('Go to Youtube you choose to share the video and then copy the src of the embed code in the video share.', 'ftc-element')
			]
		);

		// Image gallery popup
		$this->add_control(
			'image_gallery_heading',
			[
				'label'     => __( 'Image Gallery', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				// 'condition' => ['type_popup' => 'image_gallery'],	
			]
		);

		$this->add_control(
			'wp_gallery',
			[
				'label' => __( '', 'ftc-element' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
				'dynamic' => [
					'active' => true,
				],
				// 'condition' => ['type_popup' => 'image_gallery'],	
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				// 'condition' => ['type_popup' => 'image_gallery'],
			]
		);

		$this->add_control(
			'gallery_columns',
			[
				'label' => __( 'Columns', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 4,
				'options' => $gallery_columns,
				// 'condition' => ['type_popup' => 'image_gallery'],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_box_content',
			[
				'label'     => esc_html__( 'Box Content', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'align_content',
			[
				'label'     => __( 'Alignment Content', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'text-left' => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'fa fa-align-left',
					],
					'text-center'     => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-align-center',
					],
					'text-right'   => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'text-center',
			]
		);

		$this->add_control(
			'style_button',
			[
				'label'     => __( 'Button Style', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'color_text',
			[
				'label'     => __( 'Text Color', 'ftc-element' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => __( 'Background Color', 'ftc-element' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label'     => __( 'Text Color Hover', 'ftc-element' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'bg_color_hover',
			[
				'label'     => __( 'Background Color Hover', 'ftc-element' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup:hover' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup',
			]
		);

		$this->add_control(
			'padding_button',
			[
				'label'     => __( 'Button Padding (px)', 'ftc-element' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_button',
			[
				'label'     => __( 'Border Radius', 'ftc-element' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin_left',
			[
				'label'     => __( 'Margin Left Icon (px)', 'ftc-element' ),
				'type'       => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup i' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin_right',
			[
				'label'     => __( 'Margin Right Icon (px)', 'ftc-element' ),
				'type'       => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .ftc_custom_popup .ftc_btn_popup i' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);
			
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$defaultStyle = $settings['def_style'];
		$boxContent = !empty($settings['title_content']) ? $settings['title_content'] : '';
		$textButton = !empty($settings['text_button']) ? $settings['text_button'] : 'Simple Popup';
		$iconButton = $settings['icon_button'];
		$descPopup = $settings['content_popup'];
		$typePopup = $settings['type_popup'];
		$textButtonPopup = !empty($settings['text_button_popup']) ? $settings['text_button_popup'] : 'Click Here';
		$cf7_slug = $settings['cf7_slug'];
		$linkButton = mt_rand(1, 9999);

		if ($defaultStyle == 'yes') {
			$defaultStyleClass = 'ftc_default_style';
			$defaultStyleOption = $settings['def_style_option'];
		} else {
			$defaultStyleClass = 'popup_custom_style';
			$defaultStyleOption = '';
		}

		$this->add_render_attribute( 'wrapper', 'class', 'ftc_custom_popup' );
		$this->add_render_attribute( 'wrapper', 'class', $defaultStyleClass );
		$this->add_render_attribute( 'wrapper', 'class', $defaultStyleOption );
		$this->add_render_attribute( 'wrapper', 'class', $settings['align_content']);

		$this->add_render_attribute( 'button', 'class', 'btn ftc_btn_popup');
		$this->add_render_attribute( 'button', 'id', 'button_popup_' . $linkButton);

		$this->add_render_attribute( 'modal', 'class', $defaultStyleClass);
		$this->add_render_attribute( 'modal', 'class', $defaultStyleOption );
		$this->add_render_attribute( 'modal', 'class', 'content_modal mfp-hide');
		$this->add_render_attribute( 'modal', 'class', 'modal_' . $typePopup);
		$this->add_render_attribute( 'modal', 'data-link', 'button_popup_' . $linkButton);

		if ($settings['icon_right'] == 'yes') {
			$this->add_render_attribute( 'button', 'class', 'right_icon');
			$buttonContent = '<span class="button-text">' . $textButton . '</span>';
			$buttonContent .= '<i class="' . $iconButton . '"></i>';
		} else {
			$buttonContent = '<i class="' . $iconButton . '"></i>';
			$buttonContent .= '<span class="button-text">' . $textButton . '</span>';
		}	
		
		$wrapperClass = $this->get_render_attribute_string( 'wrapper' );
		$buttonClass = $this->get_render_attribute_string( 'button' );
		$boxContent = $this->parse_text_editor($boxContent);
		$descPopup = $this->parse_text_editor($descPopup);

		if ( ! empty( $settings['link_button_popup']['url'] ) ) {
			$this->add_link_attributes( 'button_popup', $settings['link_button_popup'] );
		} 

		$this->add_render_attribute( 'button_popup', 'class', 'btn btn_popup_modal' );
		$this->add_render_attribute( 'button_popup', 'role', 'button' );

		$buttonPopup = $this->get_render_attribute_string( 'button_popup' );

		// gallery option
		$ids = wp_list_pluck( $settings['wp_gallery'], 'id' );

		$this->add_render_attribute( 'img_gallery', 'ids', implode( ',', $ids ) );
		$this->add_render_attribute( 'img_gallery', 'size', $settings['thumbnail_size'] );

		if ( $settings['gallery_columns'] ) {
			$this->add_render_attribute( 'img_gallery', 'columns', $settings['gallery_columns'] );
		}

		//video option
		$video_url = $settings['youtube_url'];
		
		?>
		<div <?php echo $wrapperClass; ?>>
			<div class="box_content">
				<?php echo $boxContent; ?>
			</div>
			<a href="#popup_content_<?php echo $linkButton; ?>" <?php echo $buttonClass ?>>
				<?php echo $buttonContent; ?>
			</a>
			<div id="popup_content_<?php echo $linkButton; ?>" <?php echo $this->get_render_attribute_string('modal'); ?>>
			<?php if ( $typePopup == 'simple_content' ) { ?>

				<div class="content_popup">
					<?php echo $descPopup; ?>
 				</div>
 				<?php if ($settings['button_simple']) {?>
 				<a <?php echo $this->get_render_attribute_string( 'button_popup' ); ?>>
 					<?php echo $textButtonPopup; ?>					
 				</a>
 				<?php } ?>

 			<?php } elseif ( $typePopup == 'contact_form') {

				if ( ! empty( $cf7_slug ) ) {

					if ( $post = get_page_by_path( $cf7_slug, OBJECT, 'wpcf7_contact_form' ) ) {
						$id = $post->ID;
					} else {
						$id = 0;
					}

					echo'<div class="ftc-contact-form">';

						echo do_shortcode( '[contact-form-7 id="' . $id . '"]' );

					echo '</div>';
				}
 			} elseif ( $typePopup == 'google_map' ) {
 				sprintf(
					'<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',
					rawurlencode( $settings['address'] ),
					esc_attr( $settings['address'] )
				);
 			} elseif ( $typePopup == 'image_gallery') {

				echo do_shortcode( '[gallery ' . $this->get_render_attribute_string( 'img_gallery' ) . ']' );

 			} elseif ( $typePopup == 'video') { ?>
 				<iframe width="100%" height="400" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
 			<?php } ?>
			</div>
		</div>
		<script>
			jQuery(document).ready( function () {
				jQuery('#button_popup_<?php echo $linkButton; ?>').magnificPopup({
					items: {
						src: '#popup_content_<?php echo $linkButton; ?>',
						type: 'inline'
					}
				})
			})
		</script>
		<?php
	}

	protected function content_template() {

	}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new FTC_Custom_Popup() );

