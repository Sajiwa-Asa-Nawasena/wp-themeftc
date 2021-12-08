<?php
/**
 * Deprecated methods, backed up for eventual future use
 * in case of errors, replace methods widgets_registered() and widgets_list()
 *
 * @since 1.0.0
 * @package WordPress
 * @subpackage FTC Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Old_FTC_Elements {
	public function widgets_registered() {

		// get our own widgets up and running:
		// copied from widgets-manager.php
		if ( class_exists( 'Elementor\Plugin' ) ) {

			if ( is_callable( 'Elementor\Plugin', 'instance' ) ) {

				$the_elementor = Elementor\Plugin::instance();

				if ( isset( $the_elementor->widgets_manager ) ) {

					if ( method_exists( $the_elementor->widgets_manager, 'register_widget_type' ) ) {

						$widgets = self::$instance->widgets_list();

						foreach ( $widgets as $file => $class ) {
							$widget_file   = 'plugins/elementor/' . $file . '.php';
							$template_file = locate_template( $widget_file );

							if ( ! $template_file || ! is_readable( $template_file ) ) {
								$template_file = plugin_dir_path( __FILE__ ) . 'widgets/' . $file . '.php';
							}

							if ( $template_file && is_readable( $template_file ) ) {
								require_once $template_file;

								$widget_class = 'Elementor\\' . $class;

								$the_elementor->widgets_manager->register_widget_type( new $widget_class );
							}
						} // end foreach.
					}
					// end if( method_exists.
				}
				// end if ( isset( $the_elementor.
			}
			// end if ( is_callable( 'Elementor\Plugin'.
		}
		//if ( class_exists( 'Elementor\Plugin' ) ).
	}

	public function widgets_list() {

		$widgets_list = array(
			'ftc-blogs-grid' => 'Ftc_Posts_Grid',
		);

		if ( FTC_WOO_ACTIVE ) {
			$widgets_list['ftc-products']        = 'Ftc_Products';
			$widgets_list['ftc-products-slider'] = 'Ftc_WC_Products_Slider';
			$widgets_list['ftc-single-product']  = 'Ftc_WC_Single_Product';
			$widgets_list['ftc-product-categories']      = 'Ftc_WC_Categories';
		}

		if ( FTC_REVSLIDER_ACTIVE ) {
			$widgets_list['ftc-revolution-slider'] = 'Ftc_Rev_Slider';
		}

		return $widgets_list;

	}
}
