<?php
namespace Elementor;

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Widget_Base as Widget_Base;

class FTC_Image_Accordion extends Widget_Base {
    public function get_name() {
        return 'ftc-image-accordion';
    }

    public function get_title() {
        return esc_html__( 'FTC - Image Accordion', 'ftc-element' );
    }

    public function get_icon() {
        return 'ftc-icon';
    }

    public function get_categories() {
        return ['ftc-elements'];
    }

    protected function _register_controls() {
        /**
         * Image accordion Content Settings
         */
        $this->start_controls_section(
            'ftc_section_img_accordion_settings',
            [
                'label' => esc_html__( 'Image Accordion Settings', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_img_accordion_type',
            [
                'label'       => esc_html__( 'Accordion Style', 'ftc-element' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'on-hover',
                'label_block' => false,
                'options'     => [
                    'on-hover' => esc_html__( 'On Hover', 'ftc-element' ),
                    'on-click' => esc_html__( 'On Click (CMS)', 'ftc-element' ),
                ],
            ]
        );

        $this->add_control(
            'ftc_img_accordion_direction',
            [
                'label'       => esc_html__( 'Direction', 'ftc-element' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'on-hover',
                'label_block' => false,
                'options'     => [
                    'accordion-direction-horizontal' => esc_html__( 'Horizontal', 'ftc-element' ),
                    'accordion-direction-vertical'   => esc_html__( 'Vertical', 'ftc-element' ),
                ],
                'default'     => 'accordion-direction-horizontal',
            ]
        );

        $this->add_control(
            'ftc_img_accordion_content_horizontal_align',
            [
                'label'   => __( 'Content Horizontal Alignment', 'ftc-element' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
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
                'default' => 'center',
                'toggle'  => true,
            ]
        );
        $this->add_control(
            'ftc_img_accordion_content_vertical_align',
            [
                'label'   => __( 'Content Vertical Alignment', 'ftc-element' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top'    => [
                        'title' => __( 'Top', 'ftc-element' ),
                        'icon'  => 'fa fa-arrow-circle-up',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ftc-element' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'ftc-element' ),
                        'icon'  => 'fa fa-arrow-circle-down',
                    ],
                ],
                'default' => 'center',
                'toggle'  => true,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Select Tag', 'ftc-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => __('H1', 'ftc-element'),
                    'h2' => __('H2', 'ftc-element'),
                    'h3' => __('H3', 'ftc-element'),
                    'h4' => __('H4', 'ftc-element'),
                    'h5' => __('H5', 'ftc-element'),
                    'h6' => __('H6', 'ftc-element'),
                    'span' => __('Span', 'ftc-element'),
                    'p' => __('P', 'ftc-element'),
                    'div' => __('Div', 'ftc-element'),
                ],
            ]
        );

        $this->add_control(
            'ftc_img_accordions',
            [
                'type'        => Controls_Manager::REPEATER,
                'seperator'   => 'before',
                'default'     => [
                    ['ftc_accordion_bg' => Utils::get_placeholder_image_src() ],
                    ['ftc_accordion_bg' => Utils::get_placeholder_image_src() ],
                    ['ftc_accordion_bg' => Utils::get_placeholder_image_src() ],
                    ['ftc_accordion_bg' => Utils::get_placeholder_image_src() ],
                ],
                'fields'      => [
                    [
                        'name'         => 'ftc_accordion_is_active',
                        'label'        => __( 'Make it active?', 'ftc-element' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => __( 'Yes', 'ftc-element' ),
                        'label_off'    => __( 'No', 'ftc-element' ),
                        'return_value' => 'yes',
                    ],
                    [
                        'name'        => 'ftc_accordion_bg',
                        'label'       => esc_html__( 'Background Image', 'ftc-element' ),
                        'type'        => Controls_Manager::MEDIA,
                        'label_block' => true,
                        'default'     => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'        => 'ftc_accordion_tittle',
                        'label'       => esc_html__( 'Title', 'ftc-element' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Accordion item title', 'ftc-element' ),
                        'dynamic'     => ['active' => true],
                    ],
                    [
                        'name'        => 'ftc_accordion_content',
                        'label'       => esc_html__( 'Content', 'ftc-element' ),
                        'type'        => Controls_Manager::WYSIWYG,
                        'label_block' => true,
                        'default'     => esc_html__( 'Accordion content goes here!', 'ftc-element' ),
                    ],
                    [
                        'name'          => 'ftc_accordion_title_link',
                        'label'         => esc_html__( 'Title Link', 'ftc-element' ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                    ],
                ],
                'title_field' => '{{ftc_accordion_tittle}}',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Image accordion)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_img_accordion_style_settings',
            [
                'label' => esc_html__( 'Image Accordion Style', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_accordion_height',
            [
                'label'       => esc_html__( 'Height', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '400',
                'description' => 'Unit in px',
                'selectors'   => [
                    '{{WRAPPER}} .ftc-img-accordion ' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'ftc_accordion_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-img-accordion' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_accordion_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-img-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_accordion_container_margin',
            [
                'label'      => esc_html__( 'Margin', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-img-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ftc_accordion_border',
                'label'    => esc_html__( 'Border', 'ftc-element' ),
                'selector' => '{{WRAPPER}} .ftc-img-accordion',
            ]
        );

        $this->add_control(
            'ftc_accordion_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 4,
                ],
                'range'     => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-img-accordion' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ftc_accordion_shadow',
                'selector' => '{{WRAPPER}} .ftc-img-accordion',
            ]
        );

        $this->add_control(
            'ftc_accordion_img_overlay_color',
            [
                'label'     => esc_html__( 'Overlay Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, .3)',
                'selectors' => [
                    '{{WRAPPER}} .ftc-img-accordion a:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_accordion_img_hover_color',
            [
                'label'     => esc_html__( 'Hover Overlay Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, .5)',
                'selectors' => [
                    '{{WRAPPER}} .ftc-img-accordion a:hover::after'         => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-img-accordion a.overlay-active:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        /**
         * -------------------------------------------
         * Tab Style (Thumbnail Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_img_accordion_thumbnail_style_settings',
            [
                'label' => esc_html__( 'Image Accordion Thumbnail Style', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_image_accordion_thumbnail_margin',
            [
                'label'      => __( 'Margin', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-img-accordion a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ftc_image_accordion_thumbnail_padding',
            [
                'label'      => __( 'Padding', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-img-accordion a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ftc_image_accordion_thumbnail_radius',
            [
                'label'      => __( 'Border Radius', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-img-accordion a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'ftc_image_accordion_thumbnail_border',
                'label'    => __( 'Border', 'ftc-element' ),
                'selector' => '{{WRAPPER}} .ftc-img-accordion a',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Image accordion Content Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_img_accordion_typography_settings',
            [
                'label' => esc_html__( 'Color &amp; Typography', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_accordion_title_text',
            [
                'label'     => esc_html__( 'Title', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_accordion_title_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ftc-img-accordion .overlay h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_accordion_title_typography',
                'selector' => '{{WRAPPER}} .ftc-img-accordion .overlay h2',
            ]
        );

        $this->add_control(
            'ftc_accordion_content_text',
            [
                'label'     => esc_html__( 'Content', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_accordion_content_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ftc-img-accordion .overlay p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_accordion_content_typography',
                'selector' => '{{WRAPPER}} .ftc-img-accordion .overlay p',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $horizontal_alignment = 'ftc-img-accordion-horizontal-align-' . $settings['ftc_img_accordion_content_horizontal_align'];
        $vertical_alignment = 'ftc-img-accordion-vertical-align-' . $settings['ftc_img_accordion_content_vertical_align'];

        $this->add_render_attribute(
            'ftc-image-accordion',
            [
                'class' => [
                    'ftc-img-accordion',
                    $settings['ftc_img_accordion_direction'],
                    $horizontal_alignment,
                    $vertical_alignment,
                ],
            ]
        );

        $this->add_render_attribute( 'ftc-image-accordion', 'data-img-accordion-id', esc_attr( $this->get_id() ) );
        $this->add_render_attribute( 'ftc-image-accordion', 'data-img-accordion-type', $settings['ftc_img_accordion_type'] );

        if ( !empty( $settings['ftc_img_accordions'] ) ) {
            echo '<div ' . $this->get_render_attribute_string( 'ftc-image-accordion' ) . ' id="ftc-img-accordion-' . $this->get_id() . '">';
            foreach ( $settings['ftc_img_accordions'] as $img_accordion ) {
                $ftc_accordion_link = ( '#' === $img_accordion['ftc_accordion_title_link']['url'] ) ? '#/' : $img_accordion['ftc_accordion_title_link']['url'];
                $target = $img_accordion['ftc_accordion_title_link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $img_accordion['ftc_accordion_title_link']['nofollow'] ? 'rel="nofollow"' : '';
                $active = $img_accordion['ftc_accordion_is_active'];
                $activeCSS = ( $active === 'yes' ? ' flex: 3 1 0%;' : '' );

                echo '<a
                    href="' . esc_url( $ftc_accordion_link ) . '" ' . $target . ' ' . $nofollow . '
                    style="background-image: url(' . esc_url( $img_accordion['ftc_accordion_bg']['url'] ) . ');' . $activeCSS . '"
                    ' . ( $active === 'yes' ? ' class="overlay-active"' : '' ) . '
                >
		            <div class="overlay">
		                <div class="overlay-inner">
                            <div class="overlay-inner' . ( $active === 'yes' ? ' overlay-inner-show' : '' ) . '">
                                <'.$settings['title_tag'].'>' . $img_accordion['ftc_accordion_tittle'] . '</'.$settings['title_tag'].'>
                                <p>' . $img_accordion['ftc_accordion_content'] . '</p>
                            </div>
                        </div>
		            </div>
		          </a>';
            }
            echo '</div>';

            if ( 'on-hover' === $settings['ftc_img_accordion_type'] ) {
                echo '<style typr="text/css">
                    #ftc-img-accordion-' . $this->get_id() . ' a:hover {
                        flex: 3 1 0% !important;
                    }
                    #ftc-img-accordion-' . $this->get_id() . ' a:hover .overlay-inner * {
                        opacity: 1;
                        visibility: visible;
                        transform: none;
                        transition: all .3s .3s;
                    }
                </style>';
            }

        }
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Image_Accordion() );