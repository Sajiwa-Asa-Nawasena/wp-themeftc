<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FTC_Timer_Elementor_Widget extends Widget_Base {

	public function get_name() { 		//Function for get the slug of the element name.
		return 'ftc-countdown-timer';
	}

	public function get_title() { 		//Function for get the name of the element.
		return __( 'FTC - Countdown Timer', 'ftc-element' );
	}

	public function get_icon() { 		//Function for get the icon of the element.
		return 'ftc-icon';
	}
	
	public function get_categories() { 		//Function for include element into the category.
		return [ 'ftc-elements' ];
	}
	
    /* 
	 * Adding the controls fields for the countdown timer
	 */
    protected function _register_controls() {
    	$this->start_controls_section(
    		'ftc_section',
    		[
    			'label' => __( 'Countdown', 'ftc-element' ),
    		]
    	);
    	$this->add_control(
    		'ftc_due_date',
    		[
    			'label' => __( 'Due Date', 'ftc-element' ),
    			'type' => Controls_Manager::DATE_TIME,
    			'default' => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
    			'description' => sprintf( __( 'Date set according to your timezone: %s.', 'ftc-element' ), Utils::get_timezone_string() ),

    		]
    	);
    	$this->add_control(
    		'ftc_show_days',
    		[
    			'label' => __( 'Days', 'ftc-element' ),
    			'type' => Controls_Manager::SWITCHER,
    			'label_on' => __( 'Show', 'ftc-element' ),
    			'label_off' => __( 'Hide', 'ftc-element' ),
    			'return_value' => 'yes',
    			'default' => 'yes',
    		]
    	);
    	$this->add_control(
    		'ftc_show_hours',
    		[
    			'label' => __( 'Hours', 'ftc-element' ),
    			'type' => Controls_Manager::SWITCHER,
    			'label_on' => __( 'Show', 'ftc-element' ),
    			'label_off' => __( 'Hide', 'ftc-element' ),
    			'return_value' => 'yes',
    			'default' => 'yes',
    		]
    	);
    	$this->add_control(
    		'ftc_show_minutes',
    		[
    			'label' => __( 'Minutes', 'ftc-element' ),
    			'type' => Controls_Manager::SWITCHER,
    			'label_on' => __( 'Show', 'ftc-element' ),
    			'label_off' => __( 'Hide', 'ftc-element' ),
    			'return_value' => 'yes',
    			'default' => 'yes',
    		]
    	);
    	$this->add_control(
    		'ftc_show_seconds',
    		[
    			'label' => __( 'Seconds', 'ftc-element' ),
    			'type' => Controls_Manager::SWITCHER,
    			'label_on' => __( 'Show', 'ftc-element' ),
    			'label_off' => __( 'Hide', 'ftc-element' ),
    			'return_value' => 'yes',
    			'default' => 'yes',
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
    				'def_style_1' => __( 'Default', 'ftc-element' ),
    				'def_style_2' => __( 'Line', 'ftc-element' ),
    				'def_style_3' => __( 'Number Boxed', 'ftc-element' ),
    				'def_style_4' => __( 'Circle', 'ftc-element' ),
    				'def_style_5' => __( 'Background Image', 'ftc-element' ),
    				'def_style_6' => __( 'Style 6', 'ftc-element' ),
    				'def_style_7' => __( 'Style 7', 'ftc-element' )
    			],
    			'condition' => [
    				'def_style!' => '',
    			],
    		]
    	);
    	$this->add_control(
    		'style',
    		[
    			'label'   => __( 'Customize style', 'ftc-element' ),
    			'type'    => Controls_Manager::SELECT,
    			'default' => '',
    			'options' => [
    				''       => __( 'Default', 'ftc-element' ),
    				'style_1'     => __( 'Style 1', 'ftc-element' ),
    				'style_2' => __( 'Style 2', 'ftc-element' ),
    				'style_3'   => __( 'Style 3', 'ftc-element' ),
    				'style_4'      => __( 'Style 4', 'ftc-element' ),
    				'style_5'       => __( 'Style 5', 'ftc-element' ),
    			],
    		]
    	);
    	$this->end_controls_section(); 		
    	$this->start_controls_section(
    		'ftc_label_text_section',
    		[
    			'label' => __( 'Change Labels Text' , 'ftc-element' )
    		]
    	);
    	$this->add_control(
    		'ftc_change_labels',
    		[
    			'label' => __( 'Change Labels', 'ftc-element' ),
    			'type' => Controls_Manager::SWITCHER,
    			'label_on' => __( 'Yes', 'ftc-element' ),
    			'label_off' => __( 'No', 'ftc-element' ),
    			'return_value' => 'yes',
    			'default' => 'no',
    		]
    	);
    	$this->add_control(
    		'ftc_label_days',
    		[
    			'label' => __( 'Days', 'ftc-element' ),
    			'type' => Controls_Manager::TEXT,
    			'default' => __( 'Days', 'ftc-element' ),
    			'placeholder' => __( 'Days', 'ftc-element' ),
    			'condition' => [
    				'ftc_change_labels' => 'yes',
    				'ftc_show_days' => 'yes',
    			],
    		]
    	);
    	$this->add_control(
    		'ftc_label_hours',
    		[
    			'label' => __( 'Hours', 'ftc-element' ),
    			'type' => Controls_Manager::TEXT,
    			'default' => __( 'Hours', 'ftc-element' ),
    			'placeholder' => __( 'Hours', 'ftc-element' ),
    			'condition' => [
    				'ftc_change_labels' => 'yes',
    				'ftc_show_hours' => 'yes',
    			],
    		]
    	);
    	$this->add_control(
    		'ftc_label_minuts',
    		[
    			'label' => __( 'Minutes', 'ftc-element' ),
    			'type' => Controls_Manager::TEXT,
    			'default' => __( 'Minutes', 'ftc-element' ),
    			'placeholder' => __( 'Minutes', 'ftc-element' ),
    			'condition' => [
    				'ftc_change_labels' => 'yes',
    				'ftc_show_minutes' => 'yes',
    			],
    		]
    	);
    	$this->add_control(
    		'ftc_label_seconds',
    		[
    			'label' => __( 'Seconds', 'ftc-element' ),
    			'type' => Controls_Manager::TEXT,
    			'default' => __( 'Seconds', 'ftc-element' ),
    			'placeholder' => __( 'Seconds', 'ftc-element' ),
    			'condition' => [
    				'ftc_change_labels' => 'yes',
    				'ftc_show_seconds' => 'yes',
    			],
    		]
    	);
    	$this->end_controls_section();

    	$this->start_controls_section(   
    		'ftc_style_section',
    		[
    			'label' => __( 'Box', 'ftc-element' ),
    			'tab'   => Controls_Manager::TAB_STYLE,
    		]
    	);
    	$this->add_responsive_control(
    		'ftc_box_align',
    		[
    			'label'         => esc_html__( 'Alignment', 'ftc-element' ),
    			'type'          => Controls_Manager::CHOOSE,
    			'options'       => [
    				'left'      => [
    					'title'=> esc_html__( 'Left', 'ftc-element' ),
    					'icon' => 'fa fa-align-left',
    				],
    				'center'    => [
    					'title'=> esc_html__( 'Center', 'ftc-element' ),
    					'icon' => 'fa fa-align-center',
    				],
    				'right'     => [
    					'title'=> esc_html__( 'Right', 'ftc-element' ),
    					'icon' => 'fa fa-align-right',
    				],
    			],
    			'toggle'        => false,
    			'default'       => 'center',
    			'selectors'     => [
    				'{{WRAPPER}} .ftc-countdown-element' => 'text-align: {{VALUE}};',
    			],
    		]
    	);
    	$this->add_control(
    		'ftc_box_background_color',
    		[
    			'label' => __( 'Background Color', 'ftc-element' ),
    			'type' => Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .items' => 'background-color: {{VALUE}};',
    			],
    			'separator' => 'after',
    		]
    	);
    	$this->add_responsive_control(
    		'ftc_box_spacing',
    		[
    			'label' => __( 'Box Gap', 'ftc-element' ),
    			'type' => Controls_Manager::SLIDER,
    			'default' => [
    				'size' => 10,
    			],
    			'range' => [
    				'px' => [
    					'min' => 0,
    					'max' => 100,
    				],
    			],
    			'selectors' => [
    				'body:not(.rtl) {{WRAPPER}} .items:not(:first-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
    				'body:not(.rtl) {{WRAPPER}} .items:not(:last-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
    				'body.rtl {{WRAPPER}} .items:not(:first-of-type)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
    				'body.rtl {{WRAPPER}} .items:not(:last-of-type)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
    			],
    		]
    	);
    	$this->add_responsive_control(
    		'ftc_digit_spacing',
    		[
    			'label' => __( 'Digit Gap', 'ftc-element' ),
    			'type' => Controls_Manager::SLIDER,
    			'range' => [
    				'px' => [
    					'min' => 50,
    					'max' => 300,
    				],
    			],
    			'devices' => [ 'desktop', 'tablet', 'mobile' ],
    			'desktop_default' => [
    				'size' => '',
    				'unit' => 'px',
    			],
    			'tablet_default' => [
    				'size' => '',
    				'unit' => 'px',
    			],
    			'mobile_default' => [
    				'size' => '',
    				'unit' => 'px',
    			],
    			'selectors' => [
    				'{{WRAPPER}} .items .ftc-number' => 'height: calc( {{SIZE}}{{UNIT}}/2 );',
    			],
    		]
    	);
    	$this->add_group_control(
    		Group_Control_Border::get_type(),
    		[
    			'name' => 'box_border',
    			'selector' => '{{WRAPPER}} .items',
    			'separator' => 'before',
    		]
    	);
    	$this->add_control(
    		'ftc_box_border_radius',
    		[
    			'label' => __( 'Border Radius', 'ftc-element' ),
    			'type' => Controls_Manager::DIMENSIONS,
    			'size_units' => [ 'px', '%' ],
    			'selectors' => [
    				'{{WRAPPER}} .items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    			],
    		]
    	);
    	$this->end_controls_section();

    	$this->start_controls_section(
    		'ftc_number_style_section',
    		[
    			'label' => __( 'Number', 'ftc-element' ),
    			'tab'   => Controls_Manager::TAB_STYLE,
    		]
    	);
    	$this->add_control(
    		'ftc_digit_background_color',
    		[
    			'label' => __( 'Background Color', 'ftc-element' ),
    			'type' => Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .items .ftc-number' => 'background-color: {{VALUE}};',
    			],
    			'separator' => 'after',
    		]
    	);
    	$this->add_control(
    		'ftc_number_color',
    		[
    			'label' => __( 'Color', 'ftc-element' ),
    			'type' => Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .ftc-number' => 'color: {{VALUE}};',
    			],
    		]
    	);
    	$this->add_group_control(
    		Group_Control_Typography::get_type(),
    		[
    			'name' => 'eac_number_typography',
    			'selector' => '{{WRAPPER}} .ftc-number',
    		]
    	);
    	$this->end_controls_section();   

    	$this->start_controls_section(
    		'ftc_labels_style_section',
    		[
    			'label' => __( 'Labels', 'ftc-element' ),
    			'tab'   => Controls_Manager::TAB_STYLE,
    		]
    	);
    	$this->add_control(
    		'ftc_label_background_color',
    		[
    			'label' => __( 'Background Color', 'ftc-element' ),
    			'type' => Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .ftc-label' => 'background-color: {{VALUE}};',
    			],
    			'separator' => 'after',
    		]
    	);
    	$this->add_control(
    		'ftc_label_color',
    		[
    			'label' => __( 'Color', 'ftc-element' ),
    			'type' => Controls_Manager::COLOR,
    			'selectors' => [
    				'{{WRAPPER}} .ftc-label' => 'color: {{VALUE}};',
    			],
    		]
    	);
    	$this->add_group_control(
    		Group_Control_Typography::get_type(),
    		[
    			'name' => 'eac_label_typography',
    			'selector' => '{{WRAPPER}} .ftc-label',
    			
    		]
    	);
    	$this->end_controls_section();   
    }

	/**
	 * Render countdown timer widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		
		$day = $settings['ftc_show_days'];
		$hours = $settings['ftc_show_hours'];
		$minute = $settings['ftc_show_minutes'];
		$seconds = $settings['ftc_show_seconds'];
		$def_style = $settings['def_style'];
		$def_style_option = $settings['def_style_option'];
		$style = $settings['style'];


		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}
		?>
		<div class="ftc-countdown-element <?php echo esc_attr($stylee)?> <?php echo esc_attr($def_style_optionn) ?> ">
			<div id="countdown-timer-<?php echo esc_attr($this->get_id()); ?>" class="countdown-timer-init"></div>
		</div>
		<script>
			jQuery(function(){
				jQuery('#countdown-timer-<?php echo esc_attr($this->get_id()); ?>').countdowntimer({
					dateAndTime : "<?php echo preg_replace('/-/', '/', $settings['ftc_due_date']); ?>",
					regexpMatchFormat: "([0-9]{1,3}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
					regexpReplaceWith: "<?php if ($day == "yes"){?><div class='items'><div class='ftc-number'>$1</div><span class='ftc-label'><?php echo $settings['ftc_label_days']; ?></span> </div><?php } ?><?php if ($hours == "yes"){?> <div class='items'><div class='ftc-number'>$2 </div><span class='ftc-label'><?php echo $settings['ftc_label_hours']; ?></span></div><?php } ?><?php if ($minute == "yes"){?><div class='items'> <div class='ftc-number'> $3 </div><span class='ftc-label'><?php echo $settings['ftc_label_minuts']; ?></span> </div><?php } ?><?php if ($seconds == "yes"){?><div class='items'><div class='ftc-number'> $4</div><span class='ftc-label'><?php echo $settings['ftc_label_seconds']; ?></span></div><?php } ?>",
				});				
			});

		</script>
		<?php
	}

    /**
	 * Render countdown widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
    protected function _content_template() { 

    }	
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Timer_Elementor_Widget() );