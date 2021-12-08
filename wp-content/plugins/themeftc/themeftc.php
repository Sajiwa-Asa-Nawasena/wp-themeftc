<?php 
/**
 * Plugin Name: ThemeFTC
 * Plugin URI: http://themeftc.com
 * Description: Add shortcodes and custom post types for ThemeFTC's theme
 * Version: 1.1.0
 * Author: ThemeFTC Team
 * Author URI: http://themeftc.com
 */
class Themeftc_Plugin{

	function __construct(){
		$this->include_files();
		$this->ftc_removeDemoModeLink();
	}
	
	function include_files(){
		$file_names = array('banner', 'brands_slider', 'footer', 'product_deals', 'single_image', 'testimonial','blogs','blogs_tabs','product_categories','product_filter_by_color','products','recent_comments','feedburner_subscription');
		foreach( $file_names as $file_name ){
			$file = plugin_dir_path( __FILE__ ) . '/includes/' . $file_name . '.php';
			if( file_exists($file) ){
				require_once($file);
			}
		}
		require_once plugin_dir_path( __FILE__ ) . '/core_editor/core.php' ;
		require_once plugin_dir_path( __FILE__ ) . '/meta_boxes/advanceoptions.php' ;
		require_once plugin_dir_path( __FILE__ ) . '/shortcode/register.php' ;
		require_once plugin_dir_path( __FILE__ ) . '/shortcode/shortcodes.php' ;
	}
	function ftc_removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}

	
}
new Themeftc_Plugin();

?>