<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class FTC_Header_Ajax_Search extends Widget_Base {


	public function get_name() {
		return 'ftc_ajax_search';
	}

	public function get_title() {
		return __( 'FTC - Ajax Search', 'ftc-element' );
	}
	public function get_icon() {
		return 'ftc-icon';
	}
	public function get_categories() {
		return [ 'ftc-elements-header' ];
	}

	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'FTC Ajax Search', 'ftc-element' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => __( 'Choose style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					'style_1' => __( 'Icon click', 'ftc-element' ),
					'style_2' => __( 'Form search', 'ftc-element' ),
					'style_3' => __( 'Search for categories', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'placeholder',
			[
				'label'       => __( 'Placeholder search', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Search...', 'ftc-element' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius Input', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ftc_search_ajax input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'ftc-element' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$set = $this->get_settings();
		$style = ! empty( $set['style'] ) ? $set['style'] : 'style_1';
		$placeholder = ! empty( $set['placeholder'] ) ? $set['placeholder'] : 'Search...';
		if($style == 'style_1'){
			$search_for_product = ftc_has_woocommerce();
			if ($search_for_product) {
				$taxonomy = 'product_cat';
				$post_type = 'product';            
			} else {
				$taxonomy = 'category';
				$post_type = 'post';
			}

			$rand = rand(0, 1000);
			$form = '<div class="ftc-search">
			<button type="submit" class="search-button"><span>' . esc_html__('Search','karo') . '</span></button>
			<form method="get" id="searchform' . $rand . '" action="' . esc_url(home_url('/')) . '">

			<div class="ftc_search_ajax"  style="display:none">
			<input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" placeholder="' . $placeholder . '" autocomplete="off" />
			<input type="submit" title="' . esc_attr__('Search', 'karo') . '" id="searchsubmit' . $rand . '" value="' . esc_attr__('Search', 'karo') . '" />
			<input type="hidden" name="post_type" value="' . $post_type . '" />
			<input type="hidden" name="taxonomy" value="' . $taxonomy . '" />
			</div></form></div>';

			echo $form;
		}
	
	if($style == 'style_2'){
		$search_for_product = ftc_has_woocommerce();
		if ($search_for_product) {
			$taxonomy = 'product_cat';
			$post_type = 'product';            
		} else {
			$taxonomy = 'category';
			$post_type = 'post';
		}

		$rand = rand(0, 1000);
		$form = '<div class="ftc-search style_2">
		<button type="submit" class="search-button"><span>' . esc_html__('Search','karo') . '</span></button>
		<form method="get" id="searchform' . $rand . '" action="' . esc_url(home_url('/')) . '">

		<div class="ftc_search_ajax">
		<input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" placeholder="' . $placeholder . '" autocomplete="off" />
		<input type="submit" title="' . esc_attr__('Search', 'karo') . '" id="searchsubmit' . $rand . '" value="' . esc_attr__('Search', 'karo') . '" />
		<input type="hidden" name="post_type" value="' . $post_type . '" />
		<input type="hidden" name="taxonomy" value="' . $taxonomy . '" />
		</div></form></div>';

		echo $form;
	}
	if($style == 'style_3'){
		$search_for_product = ftc_has_woocommerce();
        if ($search_for_product) {
            $taxonomy = 'product_cat';
            $post_type = 'product';            
        } else {
            $taxonomy = 'category';
            $post_type = 'post';
        }

        $options = '<option value="">' . esc_html__('All categories', 'karo') . '</option>';
        $options .= ftc_search_by_category_get_option_html($taxonomy, 0, 0);

        $rand = rand(0, 1000);
        $form = '<div class="ftc-search style_3">
        <button type="submit" class="search-button"><span>' . esc_html__('Search','karo') . '</span></button>
        <form method="get" id="searchform' . $rand . '" action="' . esc_url(home_url('/')) . '">
        <select class="select-category" name="term">' . $options . '</select>
        <div class="ftc_search_ajax">
        <input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" placeholder="' . $placeholder . '" autocomplete="off" />
        <input type="submit" title="' . esc_attr__('Search', 'karo') . '" id="searchsubmit' . $rand . '" value="' . esc_attr__('Search', 'karo') . '" />
        <input type="hidden" name="post_type" value="' . $post_type . '" />
        <input type="hidden" name="taxonomy" value="' . $taxonomy . '" />
        </div></form></div>';

        echo $form;
	}
}
}
Plugin::instance()->widgets_manager->register_widget_type( new FTC_Header_Ajax_Search() );
