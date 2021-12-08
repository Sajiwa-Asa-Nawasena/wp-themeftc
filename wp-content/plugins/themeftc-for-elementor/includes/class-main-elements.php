<?php
/**
 *
 * @package WordPress
 * @subpackage ThemeFTC Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FTC Elements Class
 */
class FTC_Elements {

	/**
	 * This Class instance
	 *
	 * @var object
	 */
	private static $instance = null;

	/**
	 * Get instance
	 *
	 * @return $instance
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Initialize plugin
	 *
	 * @return void
	 */
	public function init() {

		if ( self::$instance->elementor_activation_check() ) {

			self::$instance->includes();

			// Add " Elements" widget categories.
			add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );

			// Register "elements" widgets.
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );

			// Add custom controls to Elementor section.
			add_action( 'elementor/element/after_section_end', [ $this, 'custom_section_controls' ], 10, 5 );
			add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );

			// Load textdomain.
			add_action( 'plugins_loaded', array( self::$instance, 'load_plugin_textdomain' ) );

			// Check for plugin dependecies.
			add_action( 'plugins_loaded', array( self::$instance, 'plugins_dependency_checks' ) );

			// Register CPT's
			add_action( 'init', array( self::$instance, 'register_cpts' ) );

			// Enqueue script and styles for Elementor editor.
			add_action( 'elementor/editor/before_enqueue_scripts', array( self::$instance, 'editor_scripts' ), 999 );
			// add_action( 'elementor/editor/before_enqueue_scripts', array( self::$instance, 'ftc_elements_admin_js',998 ) );

			// Enqueue scripts and styles for frontend.
			add_action( 'wp_enqueue_scripts', array( self::$instance, 'ftc_elements_styles' ) );
			add_action( 'wp_enqueue_scripts', array( self::$instance, 'ftc_elements_scripts' ) );
			
		} else {

			add_action( 'admin_notices', array( self::$instance, 'admin_notice' ) );
		}

	}
	private function __construct() {
		$this->add_actions();
		
	}
	protected function add_actions() {
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );

	}
    /**
	 * Enqueue editor styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
    public function enqueue_editor_styles() {

    	wp_enqueue_style(
    		'ftc-elements-font',
    		FTC_ELEMENTS_URL . 'assets/css/back.css',
    		[],
    		''
    	);
    }


	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
		 * Defines all constants
		 *
		 */
	/**
	 * Register custom post types
	 *
	 * @return false
	 */
	public function register_cpts() {

		if ( current_theme_supports( 'ftc-elements-cpt' ) && ELEMENTOR_IS_ACTIVE ) {

			// include file with Custom Post Types registration
			// MM Mega Menu, MM Header, MM Footer.
			require FTC_ELEMENTS_DIR . '/includes/core/cpt.php';

		}

		return false;

	}

	/**
	 * Check for Elementor activation
	 *
	 * @return $elements_is_active
	 */
	private function elementor_activation_check() {

		$ftc_elements_is_active = false;

		//if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {
		if ( in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {

			$ftc_elements_is_active = true;
			$this->define( 'ELEMENTOR_IS_ACTIVE', true );
		} else {
			$this->define( 'ELEMENTOR_IS_ACTIVE', false );
		}

		return $ftc_elements_is_active;

	}

	/**
	 * Activation checks for various plugins (dependencies)
	 *
	 * @return void
	 */
	public function plugins_dependency_checks() {
		// VARIOUS PLUGINS ACTIVATION CHECKS.
		require_once FTC_ELEMENTS_DIR . 'includes/active-plugins.php';

	}

	/**
	 * Register categories for widgets (elements)
	 * 
	 * @return void
	 */
	public function add_widget_categories() {

		$elements_manager = Elementor\Plugin::instance()->elements_manager;
		$elements_manager->add_category(
			'ftc-elements',
			[
				'title' => __( 'ThemeFTC Elements', 'ftc-element' ),
				'icon'  => 'eicon-font',
			],
			1
		);
		$elements_manager->add_category(
			'ftc-elements-header',
			[
				'title' => __( 'ThemeFTC Header Content ', 'ftc-element' ),
				'icon'  => 'eicon-font',
			],
			1
		);
	}

	/**
	 * Register widgets (elements) for Elementor
	 *
	 * @return void
	 */
	public function widgets_registered() {

		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-blogs-grid.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-blogs-slider.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-blogs-timeline.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-buttons.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-single-image.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-product-deal-slider.php';
		// require_once FTC_ELEMENTS_DIR . 'widgets/ftc-countdown-timer.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/circle-countdown.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/countdown.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-products-tabs-grid.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-portfolios.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-testimonial.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-facebook.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-hotspot.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-team-member.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-brand.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-footer.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-price-table.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-flip-box.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-accordion-image.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-price-list.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-dropcap.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-dual-heading.php';	
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-360-rotation.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-custom-popup.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-custom-timeline.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/ftc-logo.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/shopping-cart.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/wishlist.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/my-account.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/dropdown.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/checkout.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/search.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/menu-vertical.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/language-switch.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/header/currency-switch.php';
		
		// require_once FTC_ELEMENTS_DIR . 'widgets/header/ftc-logo.php';
		// require_once FTC_ELEMENTS_DIR . 'widgets/header/shopping-cart.php';


		// Revolution Slider plugin element.
		if ( FTC_REVSLIDER_ACTIVE ) {
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-revolution-slider.php';
		}
		// WooCommerce plugin elements.
		if ( FTC_WOO_ACTIVE ) {
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-product-categories.php';
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-products.php';
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-products-widget.php';
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-products-slider.php';
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-single-product.php';
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-products-tabs-slider.php';
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-list-products-by-category.php';
		}
		// Contact Form 7 plugin element.
		if ( FTC_ELEMENTS_CF7_ON ) {
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-contact-form-7.php';
		}
		// MailChimp 4 WP plugin element.
		if ( FTC_ELEMENTS_MC4WP_ON ) {
			require_once FTC_ELEMENTS_DIR . 'widgets/ftc-mailchimp.php';
		}

		// Instagram element.
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-instagram.php';
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-gallery-instagram.php';

		// slider.
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-all-slider.php';
		
		require_once FTC_ELEMENTS_DIR . 'widgets/ftc-menu-nav.php';
	}

	/**
	 * Custom controls for section
	 *
	 * @param  object $element - element type.
	 * @param  integer $section_id - id of section element.
	 * @param  array $args - section argumets.
	 * @return void
	 */
	public function custom_section_controls( $element, $section_id, $args ) {

		if ( 'section' === $element->get_name() && 'section_typo' === $section_id ) {

			$element->start_controls_section(
				'ftc_elements_section_sticky',
				[
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
					'label' => __( 'Sticky section', 'ftc-element' ),
				]
			);

			$element->add_control(
				'ftc_elements_sticky',
				[
					'label'        => __( 'Section sticky method', 'ftc-element' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'default'      => 'not-sticked',
					'options'      => array(
						'not-sticked'    => __( 'Not sticked', 'ftc-element' ),
						'sticked-header' => __( 'Sticked header', 'ftc-element' ),
						'sticked-inner'  => __( 'Sticked inside column', 'ftc-element' ),
						'sticked-footer' => __( 'Sticked footer', 'ftc-element' ),
					),
					'prefix_class' => 'selection-is-',
				]
			);

			$element->end_controls_section();
		}
	}

	public function register_controls() {

		require FTC_ELEMENTS_DIR . '/includes/core/class-ftc-control.php';

		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		$controls_manager->register_control( 'sorter_label', new FTC_Control_Sorter() );
	}

	/**
	 * Plugin file inclusions (requirements)
	 *
	 * @return void
	 */
	public function includes() {

		require FTC_ELEMENTS_DIR . '/includes/Parsedown.php';
		require FTC_ELEMENTS_DIR . '/includes/admin.php';
		require FTC_ELEMENTS_DIR . '/includes/ajax_posts.php';
		require FTC_ELEMENTS_DIR . '/includes/ajax_load_product.php';
		require FTC_ELEMENTS_DIR . '/includes/inc/hook.php';
		require FTC_ELEMENTS_DIR . '/includes/inc/main-functions.php';
		require FTC_ELEMENTS_DIR . '/includes/instagram.php';
		require FTC_ELEMENTS_DIR . '/includes/class-menu-nav.php';

	}

	/**
	 * Load Plugin Text Domain
	 *
	 * @return false
	 * Looks for the plugin translation files in certain directories and loads
	 * them to allow the plugin to be localised
	 */
	public function load_plugin_textdomain() {

		$lang_dir = apply_filters( 'ftc_elements_lang_dir', trailingslashit( FTC_ELEMENTS_DIR . 'languages' ) );

		// Traditional WordPress plugin locale filter.
		$locale = apply_filters( 'plugin_locale', get_locale(), 'ftc-element' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'ftc-element', $locale );

		// Setup paths to current locale file.
		$mofile_local = $lang_dir . $mofile;

		if ( file_exists( $mofile_local ) ) {
			// Look in the /wp-content/plugins/themeftc-for-elements/languages/ folder.
			load_textdomain( 'ftc-element', $mofile_local );
		} else {
			// Load the default language files.
			load_plugin_textdomain( 'ftc-element', false, $lang_dir );
		}

		return false;
	}

	/**
	 * Enqueue plugin styles
	 *
	 * @return void
	 */
	public function ftc_elements_styles() {

		// CSS styles.
		global $smof_data;
		wp_register_style( 'ftc-element', FTC_ELEMENTS_URL . 'assets/css/default.css', array(), FTC_ELEMENTS_VERSION );
		wp_enqueue_style( 'ftc-element' );
		wp_register_style( 'ftc-element-default', FTC_ELEMENTS_URL . 'assets/css/style_default.css', array(), FTC_ELEMENTS_VERSION );
		wp_enqueue_style( 'ftc-element-default' );
		
		$topic = 'ornaldo' ;

		wp_register_style( 'ftc-element-'.$topic, FTC_ELEMENTS_URL . 'assets/css/'.$topic.'.css', array(), FTC_ELEMENTS_VERSION );
		wp_enqueue_style( 'ftc-element-'.$topic );

		wp_register_style( 'ftc-element-responsive'.$topic, FTC_ELEMENTS_URL . 'assets/css/responsive/responsive-'.$topic.'.css', array(), FTC_ELEMENTS_VERSION );
		wp_enqueue_style( 'ftc-element-responsive'.$topic );

		add_filter( 'body_class', function( $classes, $topic = 'ornaldo' ) {
			global $smof_data;
			$topic = '';
			if(isset($smof_data['ftc_style_for_elementor'])){
				$topic = $smof_data['ftc_style_for_elementor'] ;
			}
			return array_merge( $classes, array($topic) );
		} );
		
	}

	/**
	 * Enqueue plugin JS scrips
	 *
	 * @return void
	 */
	public function ftc_elements_scripts() {
		wp_enqueue_script('countdown-timer-script', FTC_ELEMENTS_URL . 'assets/js/jquery.countdown.js', array(), '1.0.0', true);
		wp_enqueue_script('countdown-circle', FTC_ELEMENTS_URL . 'assets/js/TimeCircles.js', array(), '1.0.0', true);
		wp_enqueue_script( 'countdown-circle', FTC_ELEMENTS_URL . 'assets/js/TimeCircles.js', array( 'jQuery' ), FTC_ELEMENTS_VERSION, true );
		// Register and enqueue plugin JS scripts.
		wp_register_script( 'ftc-elements-js', FTC_ELEMENTS_URL . 'assets/js/main-elements.min.js', '', FTC_ELEMENTS_VERSION, true );
		wp_enqueue_script( 'ftc-elements-js', FTC_ELEMENTS_URL . 'assets/js/main-elements.min.js', array( 'jQuery' ), FTC_ELEMENTS_VERSION, true );
		wp_enqueue_script( 'carousel', FTC_ELEMENTS_URL . 'assets/js/owl.carousel.min.js', '' , FTC_ELEMENTS_VERSION, true );
		wp_enqueue_script( 'carousel', FTC_ELEMENTS_URL . 'assets/js/owl.carousel.min.js', array( 'jQuery' ), FTC_ELEMENTS_VERSION, true );
		wp_enqueue_script( 'carousel' );
		wp_enqueue_script( 'ftcs-js', FTC_ELEMENTS_URL . 'assets/js/frontend.js','' , FTC_ELEMENTS_VERSION, true );
		wp_enqueue_script( 'ftcs-js', FTC_ELEMENTS_URL . 'assets/js/frontend.js', array( 'jQuery' ), FTC_ELEMENTS_VERSION, true );
		wp_enqueue_script( 'ftcs-js' );
		

		// Smartmenus scripts - postponed until v.1.0.0
		//wp_register_script( 'smartmenus', FTC_ELEMENTS_URL . 'assets/js/jquery.smartmenus.min.js' );

		$ajaxurl = '';
		if ( FTC_ELEMENTS_WPML_ON ) {
			$ajaxurl .= admin_url( 'admin-ajax.php?lang=' . ICL_LANGUAGE_CODE );
		} else {
			$ajaxurl .= admin_url( 'admin-ajax.php' );
		}

		wp_localize_script( 'ftc-elements-js', 'ftcLoadjs', array(
			'ajaxurl'      => esc_url( $ajaxurl ),
			'loadingposts' => esc_html__( 'Loading ...', 'ftc-element' ),
			'noposts'      => esc_html__( 'No more found', 'ftc-element' ),
			'loadmore'     => esc_html__( 'Load more', 'ftc-element' ),
		) );

	}

	/**
	 * Enqueue editor scritps
	 *
	 * @return void
	 */
	public function editor_scripts() {

		wp_enqueue_script(
			'ftc-elements-editor',
			FTC_ELEMENTS_URL . 'assets/js/editor.js',
			[
				'elementor-editor', // dependency.
			],
			'',
			true // in_footer
		);
		wp_enqueue_script(
			'ftc-elements-car',
			FTC_ELEMENTS_URL . 'assets/js/owl.carousel.min.js',
			[
				'elementor-editor', // dependency.
			],
			'',
			true // in_footer
		);

	}


	/**
	 * Admin notice for plugin activation
	 *
	 * @return void
	 */
	public function admin_notice() {

		$class   = 'error updated settings-error notice is-dismissible';
		$message = __( '"The ThemeFTC for Elementor plugin needs to activate the Elementor plugin to work, let the Elementor plugin use it".', 'ftc-element' );
		echo '<div class="' . esc_attr( $class ) . '"><p>' . esc_html( $message ) . '</p></div>';

	}


} // end 

FTC_Elements::get_instance()->init();
