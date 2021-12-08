<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ftc_Elementor_Widget_Dropcaps extends Widget_Base {

    public function get_name() {
        return 'ftc-dropcap';
    }
    
    public function get_title() {
        return __( 'FTC - Dropcaps', 'ftc-element' );
    }

    public function get_icon() {
        return 'ftc-icon';
    }
    public function get_categories() {
        return [ 'ftc-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'dropcaps_content',
            [
                'label' => __( 'Dropcaps', 'ftc-element' ),
            ]
        );

            $this->add_control(
                'dropcaps_style',
                [
                    'label' => __( 'Style', 'ftc-element' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Style 1', 'ftc-element' ),
                        '2'   => __( 'Style 2', 'ftc-element' ),
                        '3'   => __( 'Style 3', 'ftc-element' ),
                        '4'   => __( 'Style 4', 'ftc-element' ),
                        '5'   => __( 'Style 5', 'ftc-element' ),
                    ],
                ]
            );

            $this->add_control(
                'dropcaps_text',
                [
                    'label'         => __( 'Content', 'ftc-element' ),
                    'type'          => Controls_Manager::TEXTAREA,
                    'default'       => __( 'Lorem ipsum dolor sit amet, consec adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip exl Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'ftc-element' ),
                    'placeholder'   => __( 'Enter Your Dropcaps Content.', 'ftc-element' ),
                    'separator'=>'before',
                ]
            );
            
        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'ftc_dropcaps_style_section',
            [
                'label' => __( 'Style', 'ftc-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'ftc-element' ),
                    'type' => Controls_Manager::COLOR,
                    
                    'default' => '#333',
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p,{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_background',
                    'label' => __( 'Background', 'ftc-element' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner',
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __( 'Padding', 'ftc-element' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => __( 'Margin', 'ftc-element' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'label' => __( 'Border', 'ftc-element' ),
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner',
                ]
            );

            $this->add_responsive_control(
                'content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'ftc-element' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style dropcaps latter tab section
        $this->start_controls_section(
            'ftc_dropcaps_latter_style_section',
            [
                'label' => __( 'Dropcap Latter', 'ftc-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'content_dropcaps_color',
                [
                    'label' => __( 'Color', 'ftc-element' ),
                    'type' => Controls_Manager::COLOR,
                    
                    'default' => '#d6d6d6',
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_dropcaps_typography',
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter,{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_dropcaps_background',
                    'label' => __( 'Background', 'ftc-element' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter,{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter',
                ]
            );

            $this->add_responsive_control(
                'content_dropcaps_padding',
                [
                    'label' => __( 'Padding', 'ftc-element' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'content_dropcaps_margin',
                [
                    'label' => __( 'Margin', 'ftc-element' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_dropcaps_border',
                    'label' => __( 'Border', 'ftc-element' ),
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter',
                    'selector' => '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter',
                ]
            );

            $this->add_responsive_control(
                'content_dropcaps_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'ftc-element' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner:first-of-type:first-letter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .ftc-dropcaps-area .ftc-dropcaps-inner p:first-of-type:first-letter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'ftc_dropcaps_attr', 'class', 'ftc-dropcaps-area' );
        $this->add_render_attribute( 'ftc_dropcaps_attr', 'class', 'ftc-dropcaps-style-'.$settings['dropcaps_style'] );
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'ftc_dropcaps_attr' ); ?>>
                <?php
                    if( !empty( $settings['dropcaps_text'] ) ){
                        echo '<div class="ftc-dropcaps-inner">'.wpautop( $settings['dropcaps_text'] ).'</div>';
                    }
                ?>
            </div>

        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Elementor_Widget_Dropcaps() );

