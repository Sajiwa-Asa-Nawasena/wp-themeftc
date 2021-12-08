<?php
namespace Elementor;


// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Image Hotspots Widget
 */
class Ftc_Hotspots extends Widget_Base {

    /**
     * Retrieve image hotspots widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'ftc-hotspots';
    }

    /**
     * Retrieve image hotspots widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'FTC - Image Hotspots', 'ftc-element' );
    }

    /**
     * Retrieve the list of categories the image hotspots widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'ftc-element' ];
    }

    /**
     * Retrieve image hotspots widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'ftc-icon';
    }
    
    /**
     * Retrieve the list of scripts the image hotspots widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [
           'pp-tooltip',
           'powerpack-frontend'
       ];
   }

    /**
     * Register image hotspots widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @access protected
     */
    protected function _register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*  CONTENT TAB
        /*-----------------------------------------------------------------------------------*/
        
        /**
         * Content Tab: Image
         */
        $this->start_controls_section(
            'section_image',
            [
                'label'                 => __( 'Image', 'ftc-element' ),
            ]
        );

        $this->add_control(
           'image',
           [
            'label'                 => __( 'Image', 'ftc-element' ),
            'type'                  => Controls_Manager::MEDIA,
            'default'               => [
             'url' => Utils::get_placeholder_image_src(),
         ],
     ]
 );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'image',
                'label'                 => __( 'Image Size', 'ftc-element' ),
                'default'               => 'full',
            ]
        );
        
        $this->add_responsive_control(
            'image_align',
            [
                'label'                 => __( 'Alignment', 'ftc-element' ),
                'type'                  => Controls_Manager::CHOOSE,
                'label_block'           => true,
                'options'               => [
                    'left'      => [
                        'title' => __( 'Left', 'ftc-element' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'ftc-element' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'ftc-element' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class'          => 'ftc-hotspot-img-align%s-',
                'selectors'     => [
                    '{{WRAPPER}} .ftc-hot-spot-image' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        /**
         * Content Tab: Hotspots
         */
        $this->start_controls_section(
            'section_hotspots',
            [
                'label'                 => __( 'Hotspots', 'ftc-element' ),
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->start_controls_tabs( 'hot_spots_tabs' );

        $repeater->start_controls_tab( 'tab_content', [ 'label' => __( 'Content', 'ftc-element' ) ] );
        
        $repeater->add_control(
            'hotspot_admin_label',
            [
                'label'           => __( 'Admin Label', 'ftc-element' ),
                'type'            => Controls_Manager::TEXT,
                'label_block'     => false,
                'default'         => '',
            ]
        );
        
        $repeater->add_control(
            'hotspot_type',
            [
                'label'           => __( 'Type', 'ftc-element' ),
                'type'            => Controls_Manager::SELECT,
                'default'         => 'number',
                'options'         => [
                    'icon'  => __( 'Icon', 'ftc-element' ),
                    'text'  => __( 'Text', 'ftc-element' ),
                    'number' => __( 'Number', 'ftc-element' ),
                ],
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
             'label'                  => __( 'Icon', 'ftc-element' ),
             'type'                   => Controls_Manager::ICONS,
             'label_block'            => true,
             'default'                => [
              'value'       => '',
              'library' => '',
          ],
          'fa4compatibility'        => 'hotspot_icon',
          'conditions'        => [
            'terms' => [
                [
                    'name' => 'hotspot_type',
                    'operator' => '==',
                    'value' => 'icon',
                ],
            ],
        ],
    ]
);
        
        $repeater->add_control(
            'hotspot_text',
            [
                'label'           => __( 'Text', 'ftc-element' ),
                'type'            => Controls_Manager::TEXT,
                'label_block'     => false,
                'default'         => '#',
                'conditions'        => [
                    'terms' => [
                        [
                            'name' => 'hotspot_type',
                            'operator' => '==',
                            'value' => 'text',
                        ],
                    ],
                ],
            ]
        );
        
        $repeater->add_control(
            'tooltip',
            [
                'label'           => __( 'Show Tooltip', 'ftc-element' ),
                'type'            => Controls_Manager::SWITCHER,
                'default'         => '',
                'label_on'        => __( 'Show', 'ftc-element' ),
                'label_off'       => __( 'Hide', 'ftc-element' ),
                'return_value'    => 'yes',
            ]
        );
        $repeater->add_control(
            'tooltip_position_local',
            [
                'label'                 => __( 'Tooltip Position', 'ftc-element' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'global',
                'options'               => [
                    'global'        => __( 'Global', 'ftc-element' ),
                    'top'           => __( 'Top', 'ftc-element' ),
                    'bottom'        => __( 'Bottom', 'ftc-element' ),
                    'left'          => __( 'Left', 'ftc-element' ),
                    'right'         => __( 'Right', 'ftc-element' ),
                    'top-left'      => __( 'Top Left', 'ftc-element' ),
                    'top-right'     => __( 'Top Right', 'ftc-element' ),
                    'bottom-left'   => __( 'Bottom Left', 'ftc-element' ),
                    'bottom-right'  => __( 'Bottom Right', 'ftc-element' ),
                ],
                'conditions'        => [
                    'terms' => [
                        [
                            'name' => 'tooltip',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'tooltip_content',
            [
                'label'           => __( 'Tooltip Content', 'ftc-element' ),
                'type'            => Controls_Manager::WYSIWYG,
                'default'         => __( 'Tooltip Content', 'ftc-element' ),
                'conditions'        => [
                    'terms' => [
                        [
                            'name' => 'tooltip',
                            'operator' => '==',
                            'value' => 'yes',
                            'show_tooltip' =>'yes'
                        ],
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'show_product',
            [
                'label'           => __( 'Show Product', 'ftc-element' ),
                'type'            => Controls_Manager::SWITCHER,
                'default'         => 'yes',
                'label_on'        => __( 'Show', 'ftc-element' ),
                'label_off'       => __( 'Hide', 'ftc-element' ),
            ]
        );
        $repeater->add_control(
            'products_in',
            [
                'label'    => esc_html__( 'Select products', 'ftc-element' ),
                'type'     => Controls_Manager::SELECT2,
                'default'  => '',
                'options'  => apply_filters( 'ftc_posts_array', 'product' ),
                'multiple' => true,
            ]
        );
        
        $repeater->end_controls_tab();
        
        $repeater->start_controls_tab( 'tab_position', [ 'label' => __( 'Position', 'ftc-element' ) ] );

        $repeater->add_control(
            'left_position',
            [
                'label'         => __( 'Left Position', 'ftc-element' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 0.1,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_control(
            'top_position',
            [
                'label'         => __( 'Top Position', 'ftc-element' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 0.1,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
                ],
            ]
        );
        
        $repeater->end_controls_tab();
        
        $repeater->start_controls_tab( 'tab_style', [ 'label' => __( 'Style', 'ftc-element' ) ] );

        $repeater->add_control(
            'hotspot_color_single',
            [
                'label'                 => __( 'Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.ftc-hot-spot-wrap, {{WRAPPER}} {{CURRENT_ITEM}} .ftc-hot-spot-inner, {{WRAPPER}} {{CURRENT_ITEM}} .ftc-hot-spot-inner:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.ftc-hot-spot-wrap .pp-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'hotspot_bg_color_single',
            [
                'label'                 => __( 'Background Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.ftc-hot-spot-wrap, {{WRAPPER}} {{CURRENT_ITEM}} .ftc-hot-spot-inner, {{WRAPPER}} {{CURRENT_ITEM}} .ftc-hot-spot-inner:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'hotspot_border_color_single',
            [
                'label'                 => __( 'Border Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.ftc-hot-spot-wrap' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'hot_spots',
            [
                'label'                 => '',
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [
                        'hotspot_admin_label'   => __( 'Hotspot #1', 'ftc-element' ),
                        'hotspot_text'          => __( '1', 'ftc-element' ),
                        'selected_icon'         => 'fa fa-plus',
                        'left_position'         => 20,
                        'top_position'          => 30,
                    ],
                ],
                'fields'                => array_values( $repeater->get_controls() ),
                'title_field'           => '{{{ hotspot_admin_label }}}',
            ]
        );
        
        $this->add_control(
            'hotspot_pulse',
            [
                'label'                 => __( 'Glow Effect', 'ftc-element' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'ftc-element' ),
                'label_off'             => __( 'No', 'ftc-element' ),
                'return_value'          => 'yes',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Tooltip Settings
         */
        $this->start_controls_section(
            'section_tooltip',
            [
                'label'                 => __( 'Tooltip Settings', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'tooltip_trigger',
            [
                'label'                 => __( 'Trigger', 'ftc-element' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'hover',
                'options'               => [
                    'hover'     => __( 'Hover', 'ftc-element' ),
                    'click'     => __( 'Click', 'ftc-element' ),
                ],
                'frontend_available'    => true,
            ]
        );
        
        $this->add_control(
            'tooltip_size',
            [
                'label'                 => __( 'Size', 'ftc-element' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'default',
                'options'               => [
                    'default'       => __( 'Default', 'ftc-element' ),
                    'tiny'          => __( 'Tiny', 'ftc-element' ),
                    'small'         => __( 'Small', 'ftc-element' ),
                    'large'         => __( 'Large', 'ftc-element' )
                ],
            ]
        );
        
        $this->add_control(
            'tooltip_position',
            [
                'label'                 => __( 'Global Position', 'ftc-element' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'top',
                'options'               => [
                    'top'           => __( 'Top', 'ftc-element' ),
                    'bottom'        => __( 'Bottom', 'ftc-element' ),
                    'left'          => __( 'Left', 'ftc-element' ),
                    'right'         => __( 'Right', 'ftc-element' ),
                    'top-left'      => __( 'Top Left', 'ftc-element' ),
                    'top-right'     => __( 'Top Right', 'ftc-element' ),
                    'bottom-left'   => __( 'Bottom Left', 'ftc-element' ),
                    'bottom-right'  => __( 'Bottom Right', 'ftc-element' ),
                ],
            ]
        );

        $this->add_control(
            'distance',
            [
                'label'                 => __( 'Distance', 'ftc-element' ),
                'description'           => __( 'The distance between the hotspot and the tooltip.', 'ftc-element' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => '',
                ],
                'range'                 => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 100,
                    ],
                ],
                'selectors'             => [
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-top'          => 'transform: translateY(-{{SIZE}}{{UNIT}});',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-bottom'       => 'transform: translateY({{SIZE}}{{UNIT}});',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-left'             => 'transform: translateX(-{{SIZE}}{{UNIT}});',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-right'        => 'transform: translateX({{SIZE}}{{UNIT}});',
                ]
            ]
        );

        $tooltip_animations = [
            ''                  => __( 'Default', 'ftc-element' ),
            'bounce'            => __( 'Bounce', 'ftc-element' ),
            'flash'             => __( 'Flash', 'ftc-element' ),
            'pulse'             => __( 'Pulse', 'ftc-element' ),
            'rubberBand'        => __( 'rubberBand', 'ftc-element' ),
            'shake'             => __( 'Shake', 'ftc-element' ),
            'swing'             => __( 'Swing', 'ftc-element' ),
            'tada'              => __( 'Tada', 'ftc-element' ),
            'wobble'            => __( 'Wobble', 'ftc-element' ),
            'bounceIn'          => __( 'bounceIn', 'ftc-element' ),
            'bounceInDown'      => __( 'bounceInDown', 'ftc-element' ),
            'bounceInLeft'      => __( 'bounceInLeft', 'ftc-element' ),
            'bounceInRight'     => __( 'bounceInRight', 'ftc-element' ),
            'bounceInUp'        => __( 'bounceInUp', 'ftc-element' ),
            'bounceOut'         => __( 'bounceOut', 'ftc-element' ),
            'bounceOutDown'     => __( 'bounceOutDown', 'ftc-element' ),
            'bounceOutLeft'     => __( 'bounceOutLeft', 'ftc-element' ),
            'bounceOutRight'    => __( 'bounceOutRight', 'ftc-element' ),
            'bounceOutUp'       => __( 'bounceOutUp', 'ftc-element' ),
            'fadeIn'            => __( 'fadeIn', 'ftc-element' ),
            'fadeInDown'        => __( 'fadeInDown', 'ftc-element' ),
            'fadeInDownBig'     => __( 'fadeInDownBig', 'ftc-element' ),
            'fadeInLeft'        => __( 'fadeInLeft', 'ftc-element' ),
            'fadeInLeftBig'     => __( 'fadeInLeftBig', 'ftc-element' ),
            'fadeInRight'       => __( 'fadeInRight', 'ftc-element' ),
            'fadeInRightBig'    => __( 'fadeInRightBig', 'ftc-element' ),
            'fadeInUp'          => __( 'fadeInUp', 'ftc-element' ),
            'fadeInUpBig'       => __( 'fadeInUpBig', 'ftc-element' ),
            'fadeOut'           => __( 'fadeOut', 'ftc-element' ),
            'fadeOutDown'       => __( 'fadeOutDown', 'ftc-element' ),
            'fadeOutDownBig'    => __( 'fadeOutDownBig', 'ftc-element' ),
            'fadeOutLeft'       => __( 'fadeOutLeft', 'ftc-element' ),
            'fadeOutLeftBig'    => __( 'fadeOutLeftBig', 'ftc-element' ),
            'fadeOutRight'      => __( 'fadeOutRight', 'ftc-element' ),
            'fadeOutRightBig'   => __( 'fadeOutRightBig', 'ftc-element' ),
            'fadeOutUp'         => __( 'fadeOutUp', 'ftc-element' ),
            'fadeOutUpBig'      => __( 'fadeOutUpBig', 'ftc-element' ),
            'flip'              => __( 'flip', 'ftc-element' ),
            'flipInX'           => __( 'flipInX', 'ftc-element' ),
            'flipInY'           => __( 'flipInY', 'ftc-element' ),
            'flipOutX'          => __( 'flipOutX', 'ftc-element' ),
            'flipOutY'          => __( 'flipOutY', 'ftc-element' ),
            'lightSpeedIn'      => __( 'lightSpeedIn', 'ftc-element' ),
            'lightSpeedOut'     => __( 'lightSpeedOut', 'ftc-element' ),
            'rotateIn'          => __( 'rotateIn', 'ftc-element' ),
            'rotateInDownLeft'  => __( 'rotateInDownLeft', 'ftc-element' ),
            'rotateInDownLeft'  => __( 'rotateInDownRight', 'ftc-element' ),
            'rotateInUpLeft'    => __( 'rotateInUpLeft', 'ftc-element' ),
            'rotateInUpRight'   => __( 'rotateInUpRight', 'ftc-element' ),
            'rotateOut'         => __( 'rotateOut', 'ftc-element' ),
            'rotateOutDownLeft' => __( 'rotateOutDownLeft', 'ftc-element' ),
            'rotateOutDownLeft' => __( 'rotateOutDownRight', 'ftc-element' ),
            'rotateOutUpLeft'   => __( 'rotateOutUpLeft', 'ftc-element' ),
            'rotateOutUpRight'  => __( 'rotateOutUpRight', 'ftc-element' ),
            'hinge'             => __( 'Hinge', 'ftc-element' ),
            'rollIn'            => __( 'rollIn', 'ftc-element' ),
            'rollOut'           => __( 'rollOut', 'ftc-element' ),
            'zoomIn'            => __( 'zoomIn', 'ftc-element' ),
            'zoomInDown'        => __( 'zoomInDown', 'ftc-element' ),
            'zoomInLeft'        => __( 'zoomInLeft', 'ftc-element' ),
            'zoomInRight'       => __( 'zoomInRight', 'ftc-element' ),
            'zoomInUp'          => __( 'zoomInUp', 'ftc-element' ),
            'zoomOut'           => __( 'zoomOut', 'ftc-element' ),
            'zoomOutDown'       => __( 'zoomOutDown', 'ftc-element' ),
            'zoomOutLeft'       => __( 'zoomOutLeft', 'ftc-element' ),
            'zoomOutRight'      => __( 'zoomOutRight', 'ftc-element' ),
            'zoomOutUp'         => __( 'zoomOutUp', 'ftc-element' ),
        ];
        
        $this->add_control(
            'tooltip_animation_in',
            [
                'label'                 => __( 'Animation In', 'ftc-element' ),
                'type'                  => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        
        $this->add_control(
            'tooltip_animation_out',
            [
                'label'                 => __( 'Animation Out', 'ftc-element' ),
                'type'                  => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        
        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*  STYLE TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Style Tab: Image
         */
        $this->start_controls_section(
            'section_image_style',
            [
                'label'                 => __( 'Image', 'ftc-element' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'image_width',
            [
                'label'                 => __( 'Width', 'ftc-element' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .ftc-hot-spot-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Hotspot
         */
        $this->start_controls_section(
            'section_hotspots_style',
            [
                'label'                 => __( 'Hotspot', 'ftc-element' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'hotspot_icon_size',
            [
                'label'                 => __( 'Size', 'ftc-element' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => '14' ],
                'range'                 => [
                    'px' => [
                        'min'   => 6,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .ftc-hot-spot-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_normal',
            [
                'label'                 => __( 'Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#fff',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-hot-spot-wrap, {{WRAPPER}} .ftc-hot-spot-inner, {{WRAPPER}} .ftc-hot-spot-inner:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ftc-hot-spot-wrap .pp-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .ftc-hot-spot-wrap, {{WRAPPER}} .ftc-hot-spot-inner, {{WRAPPER}} .ftc-hot-spot-inner:before, {{WRAPPER}} .ftc-hotspot-icon-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
           Group_Control_Border::get_type(),
           [
            'name'                  => 'icon_border_normal',
            'label'                 => __( 'Border', 'ftc-element' ),
            'placeholder'           => '1px',
            'default'               => '1px',
            'selector'              => '{{WRAPPER}} .ftc-hot-spot-wrap'
        ]
    );

        $this->add_control(
           'icon_border_radius',
           [
            'label'                 => __( 'Border Radius', 'ftc-element' ),
            'type'                  => Controls_Manager::DIMENSIONS,
            'size_units'            => [ 'px', '%' ],
            'selectors'             => [
             '{{WRAPPER}} .ftc-hot-spot-wrap, {{WRAPPER}} .ftc-hot-spot-inner, {{WRAPPER}} .ftc-hot-spot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
         ],
     ]
 );

        $this->add_responsive_control(
           'icon_padding',
           [
            'label'                 => __( 'Padding', 'ftc-element' ),
            'type'                  => Controls_Manager::DIMENSIONS,
            'size_units'            => [ 'px', '%' ],
            'selectors'             => [
             '{{WRAPPER}} .ftc-hot-spot-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
         ],
     ]
 );

        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
            'name'                  => 'icon_box_shadow',
            'selector'              => '{{WRAPPER}} .ftc-hot-spot-wrap',
            'separator'             => 'before',
        ]
    );

        $this->end_controls_section();

        /**
         * Style Tab: Tooltip
         */
        $this->start_controls_section(
            'section_tooltips_style',
            [
                'label'                 => __( 'Tooltip', 'ftc-element' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tooltip_bg_color',
            [
                'label'                 => __( 'Background Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'background-color: {{VALUE}};',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-top .pp-tooltip-callout:after'    => 'border-top-color: {{VALUE}};',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-bottom .pp-tooltip-callout:after' => 'border-bottom-color: {{VALUE}};',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-left .pp-tooltip-callout:after'   => 'border-left-color: {{VALUE}};',
                    '.pp-tooltip.pp-tooltip-{{ID}}.tt-right .pp-tooltip-callout:after'  => 'border-right-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tooltip_color',
            [
                'label'                 => __( 'Text Color', 'ftc-element' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tooltip_width',
            [
                'label'         => __( 'Width', 'ftc-element' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 50,
                        'max'   => 400,
                        'step'  => 1,
                    ],
                ],
                'selectors'             => [
                    '.pp-tooltip.pp-tooltip-{{ID}}' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'tooltip_typography',
                'label'                 => __( 'Typography', 'ftc-element' ),
             
                'selector'              => '.pp-tooltip.pp-tooltip-{{ID}}',
            ]
        );

        $this->add_group_control(
           Group_Control_Border::get_type(),
           [
            'name'                  => 'tooltip_border',
            'label'                 => __( 'Border', 'ftc-element' ),
            'placeholder'           => '1px',
            'default'               => '1px',
            'selector'              => '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content'
        ]
    );

        $this->add_control(
           'tooltip_border_radius',
           [
            'label'                 => __( 'Border Radius', 'ftc-element' ),
            'type'                  => Controls_Manager::DIMENSIONS,
            'size_units'            => [ 'px', '%' ],
            'selectors'             => [
             '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
         ],
     ]
 );

        $this->add_responsive_control(
           'tooltip_padding',
           [
            'label'                 => __( 'Padding', 'ftc-element' ),
            'type'                  => Controls_Manager::DIMENSIONS,
            'size_units'            => [ 'px', '%' ],
            'selectors'             => [
             '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
         ],
     ]
 );

        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
            'name'                  => 'tooltip_box_shadow',
            'selector'              => '.pp-tooltip.pp-tooltip-{{ID}} .pp-tooltip-content',
        ]
    );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $fallback_defaults = [
           'fa fa-check',
           'fa fa-times',
           'fa fa-dot-circle-o',
       ];
       $tooltip_trigger = ! empty( $settings['tooltip_trigger'] ) ? $settings['tooltip_trigger'] : 'hover';
       if ( empty( $settings['image']['url'] ) ) {
           return;
       }
       ?>
       <div class="ftc-image-hotspots ftc-element-hotspots">
        <div class="ftc-hot-spot-image">
            <?php
            $i = 1;
            foreach ( $settings['hot_spots'] as $index => $item ) :
                $products_in  = $item['products_in'];
                $args = apply_filters( 'ftc_elements_query_args', '1', '', '', '', '', $products_in );
                $products = get_posts( $args );

                $this->add_render_attribute( 'hotspot' . $i, 'class', 'ftc-hot-spot-wrap elementor-repeater-item-' . esc_attr( $item['_id'] ) );
                $this->add_render_attribute( 'hotspot' . $i, 'class', $tooltip_trigger ) ;

                if ( $item['tooltip'] == 'yes' && $item['tooltip_content'] != '' ) {
                    $this->add_render_attribute( 'hotspot' . $i, 'class', 'ftc-hot-spot-tooptip' );
                    $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip', $item['tooltip_content'] );

                    if ( $item['tooltip_position_local'] != 'global' ) {
                        $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-position', 'tt-' . $item['tooltip_position_local'] );
                    } else {
                        $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-position', 'tt-' . $settings['tooltip_position'] );
                    }

                    if ( $settings['tooltip_size'] ) {
                        $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-size', $settings['tooltip_size'] );
                    }

                    if ( $settings['tooltip_width'] ) {
                        $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-width', $settings['tooltip_width']['size'] );
                    }

                    if ( $settings['tooltip_animation_in'] ) {
                        $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-animation-in', $settings['tooltip_animation_in'] );
                    }

                    if ( $settings['tooltip_animation_out'] ) {
                        $this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-animation-out', $settings['tooltip_animation_out'] );
                    }
                }

                $this->add_render_attribute( 'hotspot_inner_' . $i, 'class', 'ftc-hot-spot-inner' );

                if ( $settings['hotspot_pulse'] == 'yes' ) {
                    $this->add_render_attribute( 'hotspot_inner_' . $i, 'class', 'hotspot-animation' );
                }

                $migration_allowed = Icons_Manager::is_migration_allowed();

                    // add old default
                if ( ! isset( $item['hotspot_icon'] ) && ! $migration_allowed ) {
                  $item['hotspot_icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-plus';
              }

              $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
              $is_new = ! isset( $item['hotspot_icon'] ) && $migration_allowed;
              $tooltip      = $item['tooltip'];
              $show_product      = $item['show_product'];
              ?>
              <span <?php echo $this->get_render_attribute_string( 'hotspot' . $i ); ?>>
                <span <?php echo $this->get_render_attribute_string( 'hotspot_inner_' . $i ); ?>>
                   <span class="ftc-hotspot-icon-wrap">
                    <?php
                    if ( $item['hotspot_type'] == 'icon' ) {
                      if ( ! empty( $item['hotspot_icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) {
                       echo '<span class="ftc-hotspot-icon pp-icon">';
                       if ( $is_new || $migrated ) {
                        Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                    } else { ?>
                     <i class="<?php echo esc_attr( $item['hotspot_icon'] ); ?>" aria-hidden="true"></i>
                 <?php }
                 echo '</span>';
             }
         }
         elseif ( $item['hotspot_type'] == 'text' ) {
          printf( '<span class="ftc-hotspot-icon-wrap"><span class="ftc-hotspot-text">%1$s</span></span>', esc_attr( $item['hotspot_text'] ) );
      }
      elseif ( $item['hotspot_type'] == 'number' ) {
          printf( '<span class="ftc-hotspot-icon-wrap"><span class="ftc-hotspot-number">'.$i.'</span></span>', esc_attr($i) );
      }
      ?>
  </span>
</span>

<div class="content woocommerce item-<?php echo $i;?> elementor-animation-<?php echo $settings['tooltip_animation_in']; ?>" >
    <?php if($tooltip ) { ?>
        <div class="content-text"><?php echo $item['tooltip_content'] ?></div>
    <?php } ?>
    <?php 
    if($show_product){
        if ( ! empty( $products )) {
            foreach ( $products as $post ) {
                setup_postdata( $post );
                $link_pro = esc_url( get_permalink( $post->ID ) );
                ?>
                <div class="ftc-product product">
                    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                    <div class="images">
                        <a href="<?php echo $link_pro ?>">
                            <?php
                            do_action( 'woocommerce_before_shop_loop_item_title' );
                            ?>
                        </a>
                        <?php
                        do_action( 'woocommerce_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                        ?>

                    </div>
                    <div class="item-description">
                      <?php   
                      remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_title', 20);
                      ?>
                      <h3 class="product-title"><a href="<?php echo $link_pro ?>"><?php echo get_the_title($post->ID); ?></a></h3>

                      <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                  </div>
                  <?php do_action( 'ftc_after_shop_loop_item' ); ?>
              </div>
              <?php
          }
      }
  }
  ?>
</div>
</span>
<?php $i++; endforeach; ?>

<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
</div>
</div>
<?php
?>
<?php if(is_admin()){ ?>
<script type="text/javascript">
    "use strict";
    (function(u){
        u('.ftc-hot-spot-image').each(function () {
          u('.ftc-hot-spot-wrap.click .ftc-hot-spot-inner').bind('click', function () {
            u(this).toggleClass('active');
            u(this).closest('.ftc-hot-spot-wrap.click').find('.content').toggle();
        });
      });
        u('.ftc-product.product').each(function(){
                var changeSrc =  u(this).find('.cover_image img').attr("data-src");
                var changeSrc2 =  u(this).find('.hover_image img').attr("data-src");
                u(this).find('.cover_image img').attr("src", changeSrc);
                u(this).find('.no_image img').attr("src", changeSrc);
                u(this).find('.hover_image img').attr("src", changeSrc2);
         
        });
    })(jQuery);
</script>
<?php } ?>
<?php

}

    /**
     * Render image hotspots widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @access protected
     */
    protected function _content_template() {

    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Hotspots() );