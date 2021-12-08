<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Countdown_Timer Widget
 */
class Countdown_Timer extends  Widget_Base{

    public function get_name() {
        return 'ftc-countdown-timer';
    }

    public function get_title() {
        return __( 'FTC - Countdown Timer', 'ftc-element' );
    }

    public function get_icon() {
        return 'ftc-icon';
    }
    public function get_categories() {
        return [ 'ftc-elements' ];
    }
    public function get_script_depends() {
        return [
            'ftc-element'
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_general',
            array(
                'label' => esc_html__( 'General', 'ftc-element' ),
            )
        );

        $default_date = date(
            'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS )
        );

        $this->add_control(
            'day',
            [
                'label'   => __( 'Days', 'ftc-element' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
                'min'     => 1,
                'max'     => 31,
                'step'    => 1,
                'title'   => __( 'Enter day', 'ftc-element' ),
            ]
        );
        $this->add_control(
            'month',
            [
                'label'   => __( 'Month', 'ftc-element' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
                'min'     => 0,
                'max'     => 12,
                'step'    => 1,
                'title'   => __( 'Enter month', 'ftc-element' ),
            ]
        );
        $this->add_control(
            'year',
            [
                'label'   => __( 'Year', 'ftc-element' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
                'min'     => 1,
                'max'     => 9999,
                'step'    => 1,
                'title'   => __( 'Enter year', 'ftc-element' ),
            ]
        );
        $this->add_control(
            'count_style',
            [
                'label'   => __( 'Select style for coutdown', 'ftc-element' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Style 1', 'ftc-element' ),
                    'style_2' => __( 'Style 2', 'ftc-element' ),
                    'style_3' => __( 'Style 3', 'ftc-element' ),
                    'style_4' => __( 'Style 4', 'ftc-element' ),
                ],
            ]
        );
        $this->add_control(
            'show_days',
            array(
                'label'        => esc_html__( 'Days', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ftc-element' ),
                'label_off'    => esc_html__( 'Hide', 'ftc-element' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'label_days',
            array(
                'label'       => esc_html__( 'Days Label', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Days', 'ftc-element' ),
                'placeholder' => esc_html__( 'Days', 'ftc-element' ),
                'condition'   => array(
                    'show_days'      => 'yes',
                ),
            )
        );

        $this->add_control(
            'show_hours',
            array(
                'label'        => esc_html__( 'Hours', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ftc-element' ),
                'label_off'    => esc_html__( 'Hide', 'ftc-element' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'label_hours',
            array(
                'label'       => esc_html__( 'Hours Label', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Hours', 'ftc-element' ),
                'placeholder' => esc_html__( 'Hours', 'ftc-element' ),
                'condition'   => array(
                    'show_hours'      => 'yes',
                ),
            )
        );

        $this->add_control(
            'show_min',
            array(
                'label'        => esc_html__( 'Minutes', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ftc-element' ),
                'label_off'    => esc_html__( 'Hide', 'ftc-element' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'label_min',
            array(
                'label'       => esc_html__( 'Minutes Label', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Minutes', 'ftc-element' ),
                'placeholder' => esc_html__( 'Minutes', 'ftc-element' ),
                'condition'   => array(
                    'show_min'      => 'yes',
                ),
            )
        );

        $this->add_control(
            'show_sec',
            array(
                'label'        => esc_html__( 'Seconds', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ftc-element' ),
                'label_off'    => esc_html__( 'Hide', 'ftc-element' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'label_sec',
            array(
                'label'       => esc_html__( 'Seconds Label', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Seconds', 'ftc-element' ),
                'placeholder' => esc_html__( 'Seconds', 'ftc-element' ),
                'condition'   => array(
                    'show_sec'      => 'yes',
                ),
            )
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();

        $day = ! empty( $settings['day'] ) ? (int) $settings['day'] : '';
        $month = ! empty( $settings['month'] ) ? (int) $settings['month'] : '';
        $year = ! empty( $settings['year'] ) ? (int) $settings['year'] : '';
        $label_days = ! empty( $settings['label_days'] ) ?  $settings['label_days'] : 'Days';
        $label_hours = ! empty( $settings['label_hours'] ) ?  $settings['label_hours'] : 'Hours';
        $label_min = ! empty( $settings['label_min'] ) ?  $settings['label_min'] : 'Minutes';
        $label_sec = ! empty( $settings['label_sec'] ) ?  $settings['label_sec'] : 'Seconds';
        $show_days = ! empty( $settings['show_days'] ) ?  $settings['show_days'] : '';
        $show_hours = ! empty( $settings['show_hours'] ) ?  $settings['show_hours'] : '';
        $show_min = ! empty( $settings['show_min'] ) ?  $settings['show_min'] : '';
        $show_sec = ! empty( $settings['show_sec'] ) ?  $settings['show_sec'] : '';
        $count_style = ! empty( $settings['count_style'] ) ?  $settings['count_style'] : '';

        if( empty($month) || empty($day) || empty($year) ){
            return;
        }

        if( !checkdate($month, $day, $year) ){
            return;
        }

        $date = mktime(0, 0, 0, $month, $day, $year);
        $current_time = current_time('timestamp');
        $delta = $date - $current_time;

        if( $delta <= 0 ){
            $day = $hour = $minute = $second = 0;
        }
        else{

        $time_day = 60 * 60 * 24;
        $time_hour = 60 * 60;
        $time_minute = 60;

        $day = floor( $delta / $time_day );
        $delta -= $day * $time_day;

        $hour = floor( $delta / $time_hour );
        $delta -= $hour * $time_hour;

        $minute = floor( $delta / $time_minute );
        $delta -= $minute * $time_minute;

        if( $delta > 0 ){
            $second = $delta;
        }
        else{
            $second = 0;
        }

        $day = zeroise($day, 2);
        $hour = zeroise($hour, 2);
        $minute = zeroise($minute, 2);
        $second = zeroise($second, 2);
}
        ?>
        <div class="ftc-countdown">
            <div class="counter-wrapper <?php echo $count_style ?> days-<?php echo strlen($day); ?>">
                <?php if($show_days) {
                    echo '<div class="days">';
                    echo '<div class="number-wrapper">';
                    echo '<span class="number">'.esc_html($day). '</span>';
                    echo '<div class="countdown-meta">';
                    esc_html_e($label_days);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                <?php if($show_hours) {
                    echo '<div class="hours">';
                    echo '<div class="number-wrapper">';
                    echo '<span class="number">'.esc_html($hour).'</span>';
                    echo '<div class="countdown-meta">';
                    esc_html_e($label_hours);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                } ?>
                <?php if($show_min) {
                    echo '<div class="minutes">';
                    echo '<div class="number-wrapper">';
                    echo '<span class="number">'.esc_html($minute).'</span>';
                    echo '<div class="countdown-meta">';
                    esc_html_e($label_min);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                } ?>
                <?php if($show_sec) {
                    echo '<div class="seconds">';
                    echo '<div class="number-wrapper">';
                    echo '<span class="number">'.esc_html($second).'</span>';
                    echo '<div class="countdown-meta">';
                    esc_html_e($label_sec);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }?>
            </div>
        </div>
        <?php

    }

}
Plugin::instance()->widgets_manager->register_widget_type( new Countdown_Timer() );