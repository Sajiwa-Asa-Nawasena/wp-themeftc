<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;
/**
 * Flipbox Widget
 */
class FTC_Flipbox extends Widget_Base {
    
       public function get_name() {
        return 'ftc-flipbox';
    }

    public function get_title() {
        return esc_html__( 'FTC - Flip Box', 'ftc-element' );
    }

    public function get_icon() {
        return 'ftc-icon';
    }

    public function get_categories() {
        return ['ftc-elements'];
    }

    protected function _register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

  		/**
         * Content Tab: Front
         */
  		$this->start_controls_section(
  			'section_front',
  			[
  				'label'                 => esc_html__( 'Front', 'ftc-element' )
  			]
  		);

		$this->add_control(
			'icon_type',
			[
				'label'                 => esc_html__( 'Icon Type', 'ftc-element' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'none' => [
						'title'   => __( 'None', 'ftc-element' ),
						'icon'    => 'fa fa-ban',
					],
					'image' => [
						'title'   => __( 'Image', 'ftc-element' ),
						'icon'    => 'fa fa-picture-o',
					],
					'icon' => [
						'title'   => __( 'Icon', 'ftc-element' ),
						'icon'    => 'fa fa-star',
					],
				],
				'default'               => 'icon',
			]
		);

        $this->add_control(
            'icon_image',
            [
                'label'                 => esc_html__( 'Choose Image', 'ftc-element' ),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'             => [
                    'icon_type' => 'image'
                ]
            ]
        );
		
		$this->add_control(
			'select_icon',
			[
				'label'					=> __( 'Icon', 'ftc-element' ),
				'type'					=> Controls_Manager::ICONS,
				'fa4compatibility'		=> 'icon',
				'default'				=> [
					'value'		=> 'fas fa-star',
					'library'	=> 'fa-solid',
				],
                'condition'             => [
                    'icon_type'     => 'icon',
                ],
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'thumbnail',
                'default'               => 'full',
                'condition'             => [
                    'icon_type'         => 'image',
                    'icon_image[url]!'  => '',
                ],
            ]
        );
		
		$this->add_control(
			'title_front',
			[
				'label'                 => esc_html__( 'Title', 'ftc-element' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => esc_html__( 'This is the heading', 'ftc-element' ),
				'separator'             => 'before'
			]
		);
		$this->add_control(
			'description_front',
			[
				'label'                 => esc_html__( 'Description', 'ftc-element' ),
				'type'                  => Controls_Manager::TEXTAREA,
				'label_block'           => true,
				'default'               => __( 'This is the front content. Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'ftc-element' ),
			]
		);

		$this->end_controls_section();

  		/**
         * Content Tab: Back
         */
  		$this->start_controls_section(
  			'section_back',
  			[
  				'label'                 => esc_html__( 'Back', 'ftc-element' )
  			]
  		);

		$this->add_control(
			'icon_type_back',
			[
				'label'                 => esc_html__( 'Icon Type', 'ftc-element' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'none' => [
						'title'   => __( 'None', 'ftc-element' ),
						'icon'    => 'fa fa-ban',
					],
					'image' => [
						'title'   => __( 'Image', 'ftc-element' ),
						'icon'    => 'fa fa-picture-o',
					],
					'icon' => [
						'title'   => __( 'Icon', 'ftc-element' ),
						'icon'    => 'fa fa-star',
					],
				],
				'default'               => 'icon',
			]
		);

        $this->add_control(
            'icon_image_back',
            [
                'label'                 => esc_html__( 'Flipbox Image', 'ftc-element' ),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'             => [
                    'icon_type_back'	=> 'image'
                ]
            ]
        );
		
		$this->add_control(
			'select_icon_back',
			[
				'label'					=> __( 'Icon', 'ftc-element' ),
				'type'					=> Controls_Manager::ICONS,
				'fa4compatibility'		=> 'icon_back',
				'default'				=> [
					'value'		=> 'far fa-snowflake',
					'library'	=> 'fa-regular',
				],
                'condition'             => [
                    'icon_type_back'     => 'icon',
                ],
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'thumbnail_back',
                'default'               => 'full',
                'condition'             => [
                    'icon_type_back'        => 'image',
                    'icon_image_back[url]!' => '',
                ],
            ]
        );
		
		$this->add_control(
			'title_back',
			[
				'label'                 => esc_html__( 'Title', 'ftc-element' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => esc_html__( 'This is the heading', 'ftc-element' ),
				'separator'             => 'before'
			]
		);
        
		$this->add_control(
			'description_back',
			[
				'label'                 => esc_html__( 'Description', 'ftc-element' ),
				'type'                  => Controls_Manager::TEXTAREA,
				'label_block'           => true,
				'default'               => __( 'This is the front content. Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'ftc-element' ),
			]
		);

		$this->add_control(
            'link_type',
            [
                'label'                 => __( 'Link Type', 'ftc-element' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'none',
                'options'               => [
                    'none'      => __( 'None', 'ftc-element' ),
                    'title'     => __( 'Title', 'ftc-element' ),
                    'button'    => __( 'Button', 'ftc-element' ),
                    'box'       => __( 'Box', 'ftc-element' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label'                 => __( 'Link', 'ftc-element' ),
                'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
				],
                'placeholder'           => 'https://www.your-link.com',
                'default'               => [
                    'url' => '#',
                ],
                'condition'             => [
                    'link_type!'   => 'none',
                ],
            ]
        );

        $this->add_control(
            'flipbox_button_text',
            [
                'label'                 => __( 'Button Text', 'ftc-element' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
                'default'               => __( 'Get Started', 'ftc-element' ),
                'condition'             => [
                    'link_type'   => 'button',
                ],
            ]
        );
		
		$this->add_control(
			'select_button_icon',
			[
				'label'					=> __( 'Button Icon', 'ftc-element' ),
				'type'					=> Controls_Manager::ICONS,
				'fa4compatibility'		=> 'button_icon',
                'condition'             => [
                    'link_type'   => 'button',
                ],
			]
		);
        
        $this->add_control(
            'button_icon_position',
            [
                'label'                 => __( 'Icon Position', 'ftc-element' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'after',
                'options'               => [
                    'after'     => __( 'After', 'ftc-element' ),
                    'before'    => __( 'Before', 'ftc-element' ),
                ],
                'condition'             => [
                    'link_type'     => 'button',
                    'select_button_icon[value]!'  => '',
                ],
            ]
        );
        
		$this->end_controls_section();

  		/**
         * Content Tab: Settings
         */
  		$this->start_controls_section(
  			'section_settings',
  			[
  				'label'                 => esc_html__( 'Settings', 'ftc-element' )
  			]
  		);

		$this->add_responsive_control(
			'height',
			[
				'label'                 => __( 'Height', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => [ 'px', 'vh' ],
				'range'                 => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'                 => __( 'Border Radius', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-back, {{WRAPPER}} .ftc-flipbox-front' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

  		$this->add_control(
            'flip_effect',
		  	[
                'label'                 => esc_html__( 'Flip Effect', 'ftc-element' ),
		     	'type'                  => Controls_Manager::SELECT,
		     	'default'               => 'flip',
		     	'label_block'           => false,
		     	'options'               => [
		     		'flip'     => esc_html__( 'Flip', 'ftc-element' ),
		     		'slide'    => esc_html__( 'Slide', 'ftc-element' ),
		     		'push'     => esc_html__( 'Push', 'ftc-element' ),
		     		'zoom-in'  => esc_html__( 'Zoom In', 'ftc-element' ),
		     		'zoom-out' => esc_html__( 'Zoom Out', 'ftc-element' ),
		     		'fade'     => esc_html__( 'Fade', 'ftc-element' ),
		     	],
				'separator'             => 'before',
		  	]
		);

  		$this->add_control(
            'flip_direction',
		  	[
                'label'                 => esc_html__( 'Flip Direction', 'ftc-element' ),
		     	'type'                  => Controls_Manager::SELECT,
		     	'default'               => 'left',
		     	'label_block'           => false,
		     	'options'               => [
		     		'left'     => esc_html__( 'Left', 'ftc-element' ),
		     		'right'    => esc_html__( 'Right', 'ftc-element' ),
		     		'up'       => esc_html__( 'Top', 'ftc-element' ),
		     		'down'     => esc_html__( 'Bottom', 'ftc-element' ),
		     	],
				'condition'             => [
					'flip_effect!' => [
						'fade',
						'zoom-in',
						'zoom-out',
					],
				],
		  	]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Docs Links
		 *
		 * @since 1.4.8
		 * @access protected
		 */
		$this->start_controls_section(
			'section_help_docs',
			[
				'label' => __( 'Help Docs', 'ftc-element' ),
			]
		);
		
		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				/* translators: %1$s doc link */
				'raw'             => sprintf( __( '%1$s Widget Overview %2$s', 'ftc-element' ), '<a href="https://ftc-elementelements.com/docs/ftc-element/widgets/flip-box/flip-box-widget-overview/?utm_source=widget&utm_medium=panel&utm_campaign=userkb" target="_blank" rel="noopener">', '</a>' ),
				'content_classes' => 'ftc-editor-doc-links',
			]
		);

		$this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/
        
        /**
         * Style Tab: Front
         */
		$this->start_controls_section(
			'section_front_style',
			[
				'label'                 => esc_html__( 'Front', 'ftc-element' ),
				'tab'                   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'padding_front',
			[
				'label'                 => esc_html__( 'Padding', 'ftc-element' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
	 		        '{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			],
			]
		);
        
		$this->add_responsive_control(
			'content_alignment_front',
			[
				'label'                 => esc_html__( 'Alignment', 'ftc-element' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'left' => [
						'title'   => esc_html__( 'Left', 'ftc-element' ),
						'icon'    => 'fa fa-align-left',
					],
					'center' => [
						'title'   => esc_html__( 'Center', 'ftc-element' ),
						'icon'    => 'fa fa-align-center',
					],
					'right' => [
						'title'   => esc_html__( 'Right', 'ftc-element' ),
						'icon'    => 'fa fa-align-right',
					],
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-overlay' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_position_front',
			[
				'label'                 => __( 'Vertical Position', 'ftc-element' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'top' => [
						'title' => __( 'Top', 'ftc-element' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ftc-element' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ftc-element' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary'  => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'background_front',
				'types'            	    => [ 'classic','gradient' ],
				'selector'              => '{{WRAPPER}} .ftc-flipbox-front',
                'separator'             => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
            [
                'name'                  => 'border_front',
                'label'                 => esc_html__( 'Border Style', 'ftc-element' ),
                'selector'              => '{{WRAPPER}} .ftc-flipbox-front',
                'separator'             => 'before'
            ]
		);
        
		$this->add_control(
			'overlay_front',
			[
				'label'                 => esc_html__( 'Overlay', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'overlay_front',
				'types'            	    => [ 'classic','gradient' ],
                'exclude'               => [ 'image' ],
				'selector'              => '{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-overlay',
			]
		);
        
		$this->add_control(
			'image_style_heading_front',
			[
				'label'                 => esc_html__( 'Image', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'icon_type'	=> 'image'
                ]
			]
		);

		$this->add_responsive_control(
			'image_spacing_front',
			[
				'label'                 => __( 'Spacing', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition'             => [
                    'icon_type'	=> 'image'
                ]
			]
		);

        $this->add_responsive_control(
            'image_size_front',
            [
                'label'                 => esc_html__( 'Size (%)', 'ftc-element' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => ''
                ],
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-icon-image > img' => 'width: {{SIZE}}%;'
                ],
                'condition'             => [
                    'icon_type'	=> 'image'
                ]
            ]
        );
        
		$this->add_control(
			'icon_style_heading_front',
			[
				'label'                 => esc_html__( 'Icon', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'icon_type'	=> 'icon'
                ]
			]
		);

		$this->add_control(
			'icon_color_front',
			[
				'label'                 => esc_html__( 'Color', 'ftc-element' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#ffffff',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ftc-flipbox-icon-image svg' => 'fill: {{VALUE}};',
				],
                'condition'             => [
                    'icon_type'	=> 'icon'
                ]
			]
		);

		$this->add_responsive_control(
			'icon_size_front',
			[
				'label'                 => __( 'Icon Size', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 40,
					'unit' => 'px',
				],
				'range'                 => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image, {{WRAPPER}} .ftc-flipbox-icon-image i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
                'condition'             => [
                    'icon_type'	=> 'icon'
                ]
			]
		);

		$this->add_responsive_control(
			'icon_spacing_front',
			[
				'label'                 => __( 'Spacing', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition'             => [
                    'icon_type'	=> 'icon'
                ]
			]
		);

		$this->add_control(
			'title_heading_front',
			[
				'label'                 => esc_html__( 'Title', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before'
			]
		);

		$this->add_control(
			'title_color_front',
			[
				'label'                 => esc_html__( 'Color', 'ftc-element' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#fff',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-heading' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'                  => 'title_typography_front',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-heading',
			]
		);

		$this->add_control(
			'description_heading_front',
			[
				'label'                 => esc_html__( 'Description', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before'
			]
		);

		$this->add_control(
			'description_color_front',
			[
				'label'                 => esc_html__( 'Color', 'ftc-element' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#fff',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'                  => 'description_typography_front',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-front .ftc-flipbox-content',
			]
		);

		$this->end_controls_section();
        
        /**
         * Style Tab: Back
         */
		$this->start_controls_section(
			'section_back_style',
			[
				'label'                 => esc_html__( 'Back', 'ftc-element' ),
				'tab'                   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'padding_back',
			[
				'label'                 => esc_html__( 'Padding', 'ftc-element' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
	 		        '{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			],
			]
		);
        
		$this->add_responsive_control(
			'content_alignment_back',
			[
				'label'                 => esc_html__( 'Alignment', 'ftc-element' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'left' => [
						'title'   => esc_html__( 'Left', 'ftc-element' ),
						'icon'    => 'fa fa-align-left',
					],
					'center' => [
						'title'   => esc_html__( 'Center', 'ftc-element' ),
						'icon'    => 'fa fa-align-center',
					],
					'right' => [
						'title'   => esc_html__( 'Right', 'ftc-element' ),
						'icon'    => 'fa fa-align-right',
					],
				],
				'default'               => 'center',
				'selectors' => [
					'{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-overlay' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_position_back',
			[
				'label'                 => __( 'Vertical Position', 'ftc-element' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'top' => [
						'title' => __( 'Top', 'ftc-element' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ftc-element' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ftc-element' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary'  => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);
         
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'background_back',
				'types'            	    => [ 'classic','gradient' ],
				'selector'              => '{{WRAPPER}} .ftc-flipbox-back',
                'separator'             => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
            [
                'name'                  => 'border_back',
                'label'                 => esc_html__( 'Border Style', 'ftc-element' ),
                'selector'              => '{{WRAPPER}} .ftc-flipbox-back',
                'separator'             => 'before'
            ]
		);
        
		$this->add_control(
			'overlay_back',
			[
				'label'                 => esc_html__( 'Overlay', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
			]
		);
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'overlay_back',
				'types'            	    => [ 'classic','gradient' ],
                'exclude'               => [ 'image' ],
				'selector'              => '{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-overlay',
			]
		);
        
		$this->add_control(
			'image_style_heading_back',
			[
				'label'                 => esc_html__( 'Image', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'icon_type_back'	=> 'image'
                ]
			]
		);

		$this->add_responsive_control(
			'image_spacing_back',
			[
				'label'                 => __( 'Spacing', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition'             => [
                    'icon_type_back'	=> 'image'
                ]
			]
		);

        $this->add_responsive_control(
            'image_size_back',
            [
                'label'                 => esc_html__( 'Size (%)', 'ftc-element' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => ''
                ],
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-icon-image-back > img' => 'width: {{SIZE}}%;'
                ],
                'condition'             => [
                    'icon_type_back'	=> 'image'
                ]
            ]
        );
        
		$this->add_control(
			'icon_style_heading_back',
			[
				'label'                 => esc_html__( 'Icon', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'icon_type_back'	=> 'icon'
                ]
			]
		);

		$this->add_control(
			'icon_color_back',
			[
				'label'                 => esc_html__( 'Color', 'ftc-element' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#ffffff',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image-back i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ftc-flipbox-icon-image-back svg' => 'fill: {{VALUE}};',
				],
                'condition'             => [
                    'icon_type_back'	=> 'icon'
                ]
			]
		);

		$this->add_responsive_control(
			'icon_size_back',
			[
				'label'                 => __( 'Icon Size', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 40,
					'unit' => 'px',
				],
				'range'                 => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image-back, {{WRAPPER}} .ftc-flipbox-icon-image-back i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
                'condition'             => [
                    'icon_type_back'	=> 'icon'
                ]
			]
		);

		$this->add_responsive_control(
			'icon_spacing_back',
			[
				'label'                 => __( 'Spacing', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-icon-image-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition'             => [
                    'icon_type_back'	=> 'icon'
                ]
			]
		);

		$this->add_control(
			'title_heading_back',
			[
				'label'                 => esc_html__( 'Title', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before'
			]
		);

		$this->add_control(
			'title_color_back',
			[
				'label'                 => esc_html__( 'Color', 'ftc-element' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#fff',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-heading' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'                  => 'title_typography_back',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-heading',
			]
		);

		$this->add_control(
			'description_heading_back',
			[
				'label'                 => esc_html__( 'Description', 'ftc-element' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before'
			]
		);

		$this->add_control(
			'description_color_back',
			[
				'label'                 => esc_html__( 'Color', 'ftc-element' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'                  => 'description_typography_back',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-back .ftc-flipbox-content',
			]
		);

		$this->end_controls_section();

        /**
         * Style Tab: Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_info_box_button_style',
            [
                'label'                 => __( 'Button', 'ftc-element' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

		$this->add_control(
			'button_size',
			[
				'label'                 => __( 'Size', 'ftc-element' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'md',
				'options'               => [
					'xs' => __( 'Extra Small', 'ftc-element' ),
					'sm' => __( 'Small', 'ftc-element' ),
					'md' => __( 'Medium', 'ftc-element' ),
					'lg' => __( 'Large', 'ftc-element' ),
					'xl' => __( 'Extra Large', 'ftc-element' ),
				],
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);

		$this->add_responsive_control(
			'button_spacing',
			[
				'label'                 => __( 'Spacing', 'ftc-element' ),
				'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => 15
                ],
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __( 'Normal', 'ftc-element' ),
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-button' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Text Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ftc-flipbox-button .ftc-button-icon svg' => 'fill: {{VALUE}}',
                ],
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'button_border_normal',
				'label'                 => __( 'Border', 'ftc-element' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-button',
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'ftc-element' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'ftc-element' ),
                'selector'              => '{{WRAPPER}} .ftc-flipbox-button',
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

		$this->add_responsive_control(
			'button_padding',
			[
				'label'                 => __( 'Padding', 'ftc-element' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .ftc-flipbox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-button',
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);
        
        $this->add_control(
            'info_box_button_icon_heading',
            [
                'label'                 => __( 'Button Icon', 'ftc-element' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
					'link_type'    => 'button',
                    'select_button_icon[value]!' => '',
                ],
            ]
        );

		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label'                 => __( 'Margin', 'ftc-element' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'       => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
                'condition'             => [
					'link_type'    => 'button',
                    'select_button_icon[value]!' => '',
                ],
				'selectors'             => [
					'{{WRAPPER}} .ftc-info-box .ftc-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'ftc-element' ),
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-button:hover' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-button:hover' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-flipbox-button:hover' => 'border-color: {{VALUE}}',
                ],
				'condition'             => [
					'link_type'    => 'button',
				],
            ]
        );

		$this->add_control(
			'button_animation',
			[
				'label'                 => __( 'Animation', 'ftc-element' ),
				'type'                  => Controls_Manager::HOVER_ANIMATION,
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow_hover',
				'selector'              => '{{WRAPPER}} .ftc-flipbox-button:hover',
				'condition'             => [
					'link_type'    => 'button',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();

	}

	protected function render() {

   		$settings = $this->get_settings_for_display();

	  	$flipbox_if_html_tag = 'div';
	  	$this->add_render_attribute('flipbox-card', 'class', 'ftc-flipbox-flip-card');

	  	$this->add_render_attribute(
	  		'flipbox-container',
	  		[
	  			'class'	=> [
	  				'ftc-flipbox-container',
	  				'ftc-animate-' . esc_attr( $settings['flip_effect'] ),
	  				'ftc-direction-' . esc_attr( $settings['flip_direction'] )
	  			]
	  		]
	  	);

	?>

	<div <?php echo $this->get_render_attribute_string('flipbox-container'); ?>>

	    <div <?php echo $this->get_render_attribute_string('flipbox-card'); ?>>

	        <?php
                // Front
                $this->render_front();
        
                // Back
                $this->render_back();
            ?>

	    </div>
	</div>
	<?php
	}

	protected function render_front() {
   		$settings = $this->get_settings_for_display();
			
		$this->add_render_attribute( 'icon-front', 'class', 'ftc-flipbox-icon-image' );
		
		if( 'icon' === $settings['icon_type'] ) {
			$this->add_render_attribute( 'icon-front', 'class', 'ftc-icon' );
		}
		
		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'fa fa-star';
		}

		$has_icon = ! empty( $settings['icon'] );
		
		if ( $has_icon ) {
			$this->add_render_attribute( 'front-i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'front-i', 'aria-hidden', 'true' );
		}
		
		if ( ! $has_icon && ! empty( $settings['select_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['select_icon'] );
		$is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
        ?>
        <div class="ftc-flipbox-front">
            <div class="ftc-flipbox-overlay">
                <div class="ftc-flipbox-inner">
                    <div <?php echo $this->get_render_attribute_string('icon-front'); ?>>
                        <?php if( 'icon' === $settings['icon_type'] && $has_icon ) { ?>
							<?php
							if ( $is_new || $migrated ) {
								Icons_Manager::render_icon( $settings['select_icon'], [ 'aria-hidden' => 'true' ] );
							} elseif ( ! empty( $settings['icon'] ) ) {
								?><i <?php echo $this->get_render_attribute_string( 'front-i' ); ?>></i><?php
							}
							?>
                        <?php } elseif ( 'image' === $settings['icon_type'] ) { ?>
                            <?php
                                $flipbox_image = $settings['icon_image'];
                                $flipbox_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image['id'], 'thumbnail', $settings );
                                $flipbox_image_url = ( empty( $flipbox_image_url ) ) ? $flipbox_image['url'] : $flipbox_image_url;                                                 
                            ?>
                            <?php if ( $flipbox_image_url ) { ?>
                                <img src="<?php echo esc_url( $flipbox_image_url ); ?>" alt="">
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <h3 class="ftc-flipbox-heading">
                        <?php echo esc_html__( $settings['title_front'], 'ftc-element' ); ?>
                    </h3>

                    <div class="ftc-flipbox-content">
                       <?php echo __( $settings['description_front'], 'ftc-element' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
	}

	protected function render_back() {
   		$settings = $this->get_settings_for_display();
        
	  	$pp_title_html_tag = 'h3';
        
	  	$this->add_render_attribute('title-container', 'class', 'ftc-flipbox-heading');
        
		$flipbox_image_back = $settings['icon_image_back'];
	  	$flipbox_back_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image_back['id'], 'thumbnail_back', $settings );
	  	$flipbox_back_image_url = ( empty( $flipbox_back_image_url ) ) ? $flipbox_image_back['url'] : $flipbox_back_image_url;

	  	if ( $settings['icon_type_back'] != 'none' ) {
			
			$this->add_render_attribute( 'icon-back', 'class', 'ftc-flipbox-icon-image-back' );
		
			if ( ! isset( $settings['icon_back'] ) && ! Icons_Manager::is_migration_allowed() ) {
				// add old default
				$settings['icon'] = 'fa fa-snowflake-o';
			}

			$has_icon_back = ! empty( $settings['icon_back'] );

			if ( $has_icon_back ) {
				$this->add_render_attribute( 'back-i', 'class', $settings['icon_back'] );
				$this->add_render_attribute( 'back-i', 'aria-hidden', 'true' );
			}

			if ( ! $has_icon_back && ! empty( $settings['select_icon_back']['value'] ) ) {
				$has_icon_back = true;
			}
			$migrated_icon_back = isset( $settings['__fa4_migrated']['select_icon_back'] );
			$is_new_icon_back = ! isset( $settings['icon_back'] ) && Icons_Manager::is_migration_allowed();
			
	  		if ( 'image' == $settings['icon_type_back'] ) {
	  			$this->add_render_attribute(
	  				'icon-image-back',
	  				[
	  					'src'	=> $flipbox_back_image_url,
	  					'alt'	=> 'flipbox-image'
	  				]
	  			);
	  		} elseif ( 'icon' == $settings['icon_type_back'] ) {
				$this->add_render_attribute( 'icon-back', 'class', 'ftc-icon' );
	  		}
	  	}

	  	if ( $settings['link_type'] != 'none' ) {
	  		if ( ! empty( $settings['link']['url'] ) ) {
	  			if ( $settings['link_type'] == 'title' ) {

	  				$pp_title_html_tag = 'a';

	  				$this->add_render_attribute( 'title-container', 'class', 'ftc-flipbox-linked-title' );
					
					$this->add_link_attributes( 'title-container', $settings['link'] );
					
	  			} elseif ( $settings['link_type'] == 'button' ) {

	  				$this->add_render_attribute( 'button', 'class', [ 'elementor-button', 'ftc-flipbox-button', 'elementor-size-' . $settings['button_size'], ] );
					
					$this->add_link_attributes( 'button', $settings['link'] );
					
	  			}
	  		}
	  	}
        ?>
        <div class="ftc-flipbox-back">
            <?php
                if ( $settings['link_type'] == 'box' && $settings['link']['url'] != '' ) {
                $this->add_render_attribute( 'box-link', 'class', 'ftc-flipbox-box-link' );
					
				$this->add_link_attributes( 'box-link', $settings['link'] );
                ?>
                <a <?php echo $this->get_render_attribute_string('box-link'); ?>></a>
            <?php } ?>
            <div class="ftc-flipbox-overlay">
                <div class="ftc-flipbox-inner">
                    <?php if( 'none' != $settings['icon_type_back'] ) { ?>
                        <div <?php echo $this->get_render_attribute_string('icon-back'); ?>>
                            <?php if ( 'image' == $settings['icon_type_back'] ) { ?>
                                <img <?php echo $this->get_render_attribute_string('icon-image-back'); ?>>
                            <?php } elseif ( 'icon' == $settings['icon_type_back'] && $has_icon_back ) { ?>
								<?php
								if ( $is_new_icon_back || $migrated_icon_back ) {
									Icons_Manager::render_icon( $settings['select_icon_back'], [ 'aria-hidden' => 'true' ] );
								} elseif ( ! empty( $settings['icon_back'] ) ) {
									?><i <?php echo $this->get_render_attribute_string( 'back-i' ); ?>></i><?php
								}
								?>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if ( $settings['title_back'] ) { ?>
                        <<?php echo $pp_title_html_tag,' ', $this->get_render_attribute_string('title-container'); ?>>
                            <?php echo esc_html__( $settings['title_back'], 'ftc-element' ); ?>
                        </<?php echo $pp_title_html_tag; ?>>
                    <?php } ?>

                    <div class="ftc-flipbox-content">
                       <?php echo __( $settings['description_back'], 'ftc-element' ); ?>
                    </div>

                    <?php if( $settings['link_type'] == 'button' && ! empty($settings['flipbox_button_text']) ) : ?>
                        <a <?php echo $this->get_render_attribute_string('button'); ?>>
                            <?php if ( 'before' == $settings['button_icon_position'] ) : ?>
                                <?php $this->render_button_icon() ?>
                            <?php endif; ?>
                            <?php echo esc_attr($settings['flipbox_button_text']); ?>
                            <?php if ( 'after' == $settings['button_icon_position'] ) : ?>
                                <?php $this->render_button_icon() ?>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
	}

	protected function render_button_icon() {
   		$settings = $this->get_settings_for_display();
		
		if ( ! isset( $settings['button_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = '';
		}

		$has_button_icon = ! empty( $settings['button_icon'] );

		if ( $has_button_icon ) {
			$this->add_render_attribute( 'back-i', 'class', $settings['button_icon'] );
			$this->add_render_attribute( 'back-i', 'aria-hidden', 'true' );
		}

		if ( ! $has_button_icon && ! empty( $settings['select_button_icon']['value'] ) ) {
			$has_button_icon = true;
		}
		$migrated_button_icon = isset( $settings['__fa4_migrated']['select_button_icon'] );
		$is_new_button_icon = ! isset( $settings['button_icon'] ) && Icons_Manager::is_migration_allowed();

		if ( 'image' == $settings['icon_type_back'] ) {
			$this->add_render_attribute(
				'icon-image-back',
				[
					'src'	=> $flipbox_back_image_url,
					'alt'	=> 'flipbox-image'
				]
			);
		} elseif ( 'icon' == $settings['icon_type_back'] ) {
			$this->add_render_attribute( 'icon-back', 'class', 'ftc-icon' );
		}
		
		if ( $has_button_icon ) {
			echo '<span class="ftc-button-icon">';
			if ( $is_new_button_icon || $migrated_button_icon ) {
				Icons_Manager::render_icon( $settings['select_button_icon'], [ 'aria-hidden' => 'true' ] );
			} elseif ( ! empty( $settings['button_icon'] ) ) {
				?><i <?php echo $this->get_render_attribute_string( 'back-i' ); ?>></i><?php
			}
			echo '</span>';
		}
	}

	protected function content_template() { }
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Flipbox() );
