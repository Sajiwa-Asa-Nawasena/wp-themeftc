<?php 
/*Custom core replace*/
add_action('template_redirect', 'ftc_custom_redirect');
function ftc_custom_redirect(){
	if( is_singular('product') ){
		add_filter('wp_calculate_image_sizes', '__return_false', 9999);
		add_filter('wp_calculate_image_srcset', '__return_false', 9999);
		remove_filter('the_content', 'wp_make_content_images_responsive');
	}
}
/* Allow HTML in Category Descriptions */
remove_filter('pre_term_description', 'wp_filter_kses');
remove_filter('pre_link_description', 'wp_filter_kses');
remove_filter('pre_link_notes', 'wp_filter_kses');
remove_filter('term_description', 'wp_kses_data');

/* Remove WP Version Param From Any Enqueued Scripts */
if (!function_exists('ftc_remove_wp_ver_css_js')) {

    function ftc_remove_wp_ver_css_js($src) {
        if (strpos($src, 'ver=')) {
            $src = esc_url(remove_query_arg('ver', $src));
        }
        return $src;
    }

}
/*funtion.php*/
add_filter('style_loader_src', 'ftc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'ftc_remove_wp_ver_css_js', 9999);

/*update-param.php*/
if ( ! function_exists( 'ftc_image_hotspot' ) && function_exists( 'vc_add_shortcode_param' ) ) {
vc_add_shortcode_param( 'ftc_image_hotspot', 'ftc_image_hotspot' );
}
add_action('template_redirect', 'ftc_custom_count_redirect');
function ftc_custom_count_redirect(){
    global $wp_query, $post, $ftc_page_datas, $smof_data;
/* Update Post Views Count */
        // if( !isset( $_COOKIE['ftc_post_view_'.''] ) && !ftc_crawler_detect() ){
        //     setcookie('ftc_post_view_'.$post->ID, '1', time()+86400, '/'); /* set cookie 1 day */
        //     $views_count = get_post_meta($post->ID, '_ftc_post_views_count', true);
        //     if( $views_count ){
        //         $views_count++;
        //         update_post_meta($post->ID, '_ftc_post_views_count', $views_count);
        //     }
        //     else{
        //         update_post_meta($post->ID, '_ftc_post_views_count', 1);
        //     }
        // }
    }

    function ftc_crawler_detect(){
    if( isset($_SERVER['HTTP_USER_AGENT']) ){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $crawlers = array(
            'Google'            => 'Google'
            ,'MSN'              => 'msnbot'
            ,'Rambler'          => 'Rambler'
            ,'Yahoo'            => 'Yahoo'
            ,'AbachoBOT'        => 'AbachoBOT'
            ,'accoona'          => 'Accoona'
            ,'AcoiRobot'        => 'AcoiRobot'
            ,'ASPSeek'          => 'ASPSeek'
            ,'CrocCrawler'      => 'CrocCrawler'
            ,'Dumbot'           => 'Dumbot'
            ,'FAST-WebCrawler'  => 'FAST-WebCrawler'
            ,'GeonaBot'         => 'GeonaBot'
            ,'Gigabot'          => 'Gigabot'
            ,'Lycos spider'     => 'Lycos'
            ,'MSRBOT'           => 'MSRBOT'
            ,'Altavista robot'  => 'Scooter'
            ,'AltaVista robot'  => 'Altavista'
            ,'ID-Search Bot'    => 'IDBot'
            ,'eStyle Bot'       => 'eStyle'
            ,'Scrubby robot'    => 'Scrubby'
            ,'Facebook'         => 'facebookexternalhit'
            ,'robot'            => 'robot'
            ,'spider'           => 'spider'
            ,'crawler'          => 'crawler'
            ,'curl'             => 'curl'
        );
        $crawlers_agents = implode('|', $crawlers);
        
        if( preg_match('/'.$crawlers_agents.'/i', $user_agent) ){
            return true;
        }
        return false;
    }
    return false;
}
?>