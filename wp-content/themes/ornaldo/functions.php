<?php
/* * * Include TGM Plugin Activation ** */
require_once get_template_directory() . '/inc/includes/class-tgm-plugin-activation.php';

/* * * Get header - Include TGM Plugin Activation ** */

if( ! function_exists( 'ftc_get_header_template' ) ) {
function ftc_get_header_template( $new = false ) {
$args = array(
'post_type' => 'ftc_header'
,'post_status' => 'publish'
,'posts_per_page' => -1
);

$posts = new WP_Query($args);

if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
foreach( $posts->posts as $p ){
$header_blocks[$p->ID] = $p->post_title;
}
}
return $header_blocks;

}
}
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
require get_template_directory() . '/inc/back-compat.php';
return;
}


/* * * Theme Options ** */
// require_once get_template_directory() . '/admin/index.php';
require_once get_template_directory() . '/inc/register_sidebar.php';
require_once get_template_directory() . '/admin/base_options.php';
require_once get_template_directory() . '/admin/theme_options.php';
/*ajax add to cart*/
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() {

            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
            $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
            $variation_id = absint($_POST['variation_id']);
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);

            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

                do_action('woocommerce_ajax_added_to_cart', $product_id);

                if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);
                }

                WC_AJAX :: get_refreshed_fragments();
            } else {

                $data = array(
                    'error' => true,
                    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

                echo wp_send_json($data);
            }

            wp_die();
        }
        add_action( 'wp_footer', 'ftc_nofication_added_to_cart');

function ftc_nofication_added_to_cart(){
    echo '<span class="ftc-single-added">'.esc_html__('Added to cart','ornaldo').'</span>';
} 

function ftc_setup() {

    add_theme_support( 'wc-product-gallery-lightbox' );

    /*Custom Gutenberg*/
 add_editor_style('editor-styles');
  add_editor_style( 'assets/css/style-editor.css' );
  add_theme_support( 'dark-editor-style' );
  add_theme_support( 'responsive-embeds' );
  // Add support for default block styles.
  add_theme_support( 'wp-block-styles' );
    // Add support for full and wide align images.
  add_theme_support( 'align-wide' );
	add_theme_support('woocommerce');

add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => __( 'Small', 'ornaldo' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => __( 'Normal', 'ornaldo' ),
            'size' => 14,
            'slug' => 'normal'
        ),
        array(
            'name' => __( 'Large', 'ornaldo' ),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => __( 'Huge', 'ornaldo' ),
            'size' => 48,
            'slug' => 'huge'
        )
    ) );

add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'strong magenta', 'ornaldo' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => __( 'light grayish magenta', 'ornaldo' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => __( 'very light gray', 'ornaldo' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => __( 'very dark gray', 'ornaldo' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
    ) );

    /*Custom Gutenberg*/
    /* Add editor-style.css file */
    add_editor_style();

    load_theme_textdomain('ornaldo');

    /* Add default posts and comments RSS feed links to head. */
    add_theme_support('automatic-feed-links');

    /* Let WordPress manage the document title. */
    add_theme_support('title-tag');


    /* Enable support for Post Thumbnails on posts and pages. */
    add_theme_support('post-thumbnails');

    add_image_size('ftc-featured-image', 2000, 1200, true);

    add_image_size('ftc-thumbnail-avatar', 100, 100, true);

    add_theme_support('wc-product-gallery-slider');

    /* Set the default content width */
    $GLOBALS['content_width'] = 1200;
  


    
   

    /* Translation */
    load_theme_textdomain('ornaldo', get_template_directory() . '/languages');

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file)){
        require_once( $locale_file );
    }

    /* This theme uses wp_nav_menu() in two locations. */
    register_nav_menus(array(
        'primary' => esc_html__('Primary Navigation', 'ornaldo'),
    ));
    register_nav_menus(array(
        'vertical' => esc_html__('Vertical Navigation', 'ornaldo'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     */
    add_theme_support('post-formats', array('audio', 'gallery', 'quote', 'video'));

    // Add theme support for Custom Background
    $defaults = array(
        'default-color' => ''
        , 'default-image' => ''
    );
    add_theme_support('custom-background', $defaults);


    add_theme_support('woocommerce');
      /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
     */
    add_editor_style( array( 'assets/css/editor-style.css', ftc_fonts_url() ) );


    add_theme_support( 'custom-header');
}

add_action('after_setup_theme', 'ftc_setup');

if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] != 'type_2'){
        add_action('after_setup_theme', 'ftc_setup_main_image');

        function ftc_setup_main_image(){
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-slider' );
    }
    }
function ftc_fonts_url() {
    $fonts_url = '';

    /**
     * Translators: If there are characters in your language that are not
     * supported by Libre Franklin, translate this to 'off'. Do not translate
     * into your own language.
     */
    $dosis = _x( 'on', 'Roboto font: on or off', 'ornaldo' );

    if ( 'off' !== $dosis ) {
        $font_families = array();

        $font_families[] = 'Roboto:400,500,700|Roboto Slab:400,700';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) )
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}



        /* * * Register google font ** */
        function ftc_register_google_font($iframe = false) {
            global $smof_data;
            $fonts = array();

            if ( isset($smof_data['ftc_body_font_enable_google_font']) && $smof_data['ftc_body_font_enable_google_font']) {
                $fonts[] = array(
                    'name' => $smof_data['ftc_body_font_google']['font-family'] 
                    , 'bold' => '300,400,500,600,700,800,900'
                );
            }

            if ( isset($smof_data['ftc_secondary_body_font_enable_google_font']) && $smof_data['ftc_secondary_body_font_enable_google_font']) {
                $fonts[] = array(
                    'name' => $smof_data['ftc_secondary_body_font_google']['font-family'] 
                    , 'bold' => '300,400,500,600,700,800,900'
                );
            }

            /* Default fonts */
            $fonts[] = array(
                'name' => 'Lato'
                , 'bold' => '300,400,500,600,700,800,900'
            );

            $fonts[] = array(
                'name' => 'Raleway'
                , 'bold' => '300,400,500,600,700,800,900'
            );

            foreach ($fonts as $font) {
                ftc_load_google_font($font['name'], $font['bold'], $iframe);
            }
        }

        function ftc_load_google_font($font_name = '', $font_bold = '300,400,500,600,700,800,900', $iframe = false) {
            if (strlen($font_name) > 0) {
                $font_name_id = sanitize_title($font_name);

                $font_url = add_query_arg('family', urlencode($font_name . ':' . $font_bold . '&subset=latin,latin-ext'), '//fonts.googleapis.com/css');
                if (!$iframe) {
                    wp_enqueue_style("font-{$font_name_id}", $font_url);
                } else {
                    echo '<link rel="stylesheet" type="text/css" id="font_' . $font_name_id . '" media="all" href="' . esc_url($font_url) . '" />';
                }
            }
        }

/**
 * Enqueue scripts and styles.
 */
function ftc_scripts() {
    global $smof_data, $ftc_page_datas;
    ftc_register_google_font();
    wp_enqueue_style('editor-styles', get_template_directory_uri() . '/assets/css/style-editor.css');

    wp_enqueue_script( 'swipebox-min', get_template_directory_uri().'/assets/js/jquery.swipebox.min.js', array(), null, true);
    wp_enqueue_script( 'swipebox', get_template_directory_uri().'/assets/js/jquery.swipebox.js', array(), null, true);

    wp_deregister_style('font-awesome');
    wp_deregister_style('yith-wcwl-font-awesome');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
    wp_enqueue_style('pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style('editor-styles', get_template_directory_uri() . '/assets/css/style-editor.css');
    wp_enqueue_style( 'pretty-photo', get_template_directory_uri() . '/assets/css/prettyPhoto.css' );  

    /* Theme stylesheet. */
    wp_enqueue_style('ftc-style', get_stylesheet_uri());

    wp_enqueue_style('ftc-default', get_template_directory_uri() . '/assets/css/default.css');

    wp_register_style('ftc-responsive', get_template_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_style('ftc-responsive');

    /* Enqueue scripts */
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/assets/js/owl.carousel.min.js', array(), null, true);

    wp_enqueue_script( 'throttle-debounce', get_template_directory_uri().'/assets/js/jquery.ba-throttle-debounce.min.js', array(), null, true);

    wp_enqueue_script( 'hover-intent', get_template_directory_uri().'/assets/js/jquery.hoverintent.js', array(), null, true); 

    wp_enqueue_script( 'parallax', get_template_directory_uri().'/assets/js/jquery.parallax.js', array(), null, true);
    wp_enqueue_script( 'jq-sticky', get_template_directory_uri().'/assets/js/jquery.sticky.js', array(), null, true);

    wp_enqueue_script( 'pretty-photo', get_template_directory_uri().'/assets/js/jquery.prettyphoto.min.js', array(), null, true);

    wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/js/isotope.min.js', array(), null, true);

    wp_enqueue_script( 'tween-lite', get_template_directory_uri().'/assets/js/tweenlite.min.js', array(), null, true); 

    wp_enqueue_script( 'tween-max', get_template_directory_uri().'/assets/js/tweenmax.min.js', array(), null, true);

    wp_enqueue_script( 'waypoint', get_template_directory_uri().'/assets/js/waypoint.min.js', array(), null, true);

    wp_enqueue_script('cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array( 'jquery' ), null, true );

    wp_enqueue_script( 'count-to', get_template_directory_uri().'/assets/js/jquery.countto.js', array(), null, true);  

    wp_enqueue_script( 'mb-ytplayer', get_template_directory_uri().'/assets/js/jquery.mb.ytplayer.js', array(), null, true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), null, true);
    wp_enqueue_script('threesixty', get_template_directory_uri() . '/assets/js/threesixty.min.js', array(), null, true);
    wp_enqueue_script('smartmenus', get_template_directory_uri().'/assets/js/jquery.smartmenus.js', array(), null, true);



    /*Infinite Shop */
    wp_enqueue_script( 'infinite', get_template_directory_uri().'/assets/js/infinite-scroll.pkgd.min.js', array(), null, true);
    /*end */
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/js/html5.js', array(), '3.7.3');
    if( wp_is_mobile() ){
        wp_enqueue_script('mobile-js', get_template_directory_uri() . '/assets/js/mobile.js', array(), null, true);
    }

    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    if (is_singular('product') && isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] == 'vertical') {
        wp_enqueue_script('jquery-caroufredsel', get_template_directory_uri() . '/assets/js/jquery.caroufredsel-6.2.1.min.js', array(), null, true);
    }
    
    if (is_singular('product') && $smof_data['ftc_prod_cloudzoom']) {
        wp_enqueue_script('cloud-zoom', get_template_directory_uri() . '/assets/js/cloud-zoom.js', array('jquery'), null, true);
    }

    wp_enqueue_script('jquery-scrollto', get_template_directory_uri() . '/assets/js/jquery.scrollto.js', array('jquery'), '2.1.2', true);
    
    wp_enqueue_script('ftc-global', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true);

    if (defined('ICL_LANGUAGE_CODE')) {
        $ajax_uri = admin_url('admin-ajax.php?lang=' . ICL_LANGUAGE_CODE, 'relative');
    } else {
        $ajax_uri = admin_url('admin-ajax.php', 'relative');
    }

    $data = array(
        'ajax_uri' => $ajax_uri,
        '_ftc_enable_responsive' => isset($smof_data['ftc_responsive']) ? (int) $smof_data['ftc_responsive'] : 1,
        '_ftc_enable_ajax_search' => isset($smof_data['ftc_ajax_search']) ? (int) $smof_data['ftc_ajax_search'] : 1,
        'cookies_version' => $smof_data['cookies_version'],
        '_ftc_enable_sticky_header' => isset($smof_data['ftc_enable_sticky_header']) ? (int)$smof_data['ftc_enable_sticky_header'] : 1,
    );
    wp_localize_script('ftc-global', 'ftc_shortcode_params', $data);

    wp_enqueue_script('wc-add-to-cart-variation');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'ftc_scripts', 1000);

/*** Register Back End Scripts ***/
function ftc_register_admin_scripts(){
    wp_enqueue_media();
    wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );
    wp_enqueue_style( 'font-awesome' );
    
    wp_register_style( 'ftc-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css' );
    wp_enqueue_style( 'ftc-admin-style' );
    wp_register_style('ftc-theme-options', get_template_directory_uri() . '/admin/css/options.css');
    wp_enqueue_style('ftc-theme-options');
    
    wp_register_script( 'ftc-admin-script', get_template_directory_uri().'/assets/js/admin-main.js', array('jquery'), null, true);
    wp_enqueue_script( 'ftc-admin-script' );
    $data = array(
        'ajax_uri' => admin_url( 'admin-ajax.php' ),
    );
    wp_localize_script('ftc-admin-script', 'ftc_shortcode_params', $data);
}
add_action('admin_enqueue_scripts', 'ftc_register_admin_scripts');

/*** Popup Newletter ***/
if ( ! function_exists( 'ftc_popup_newsletter' ) ) {
    function ftc_popup_newsletter() {
     global $smof_data; 
     if(isset($smof_data['ftc_bg_popup_image']['url']) && !empty($smof_data['ftc_bg_popup_image']['url']))
        echo '<div class="popupshadow" style="display:none"></div>';
    echo '<div class="newsletterpopup" style="display:none; background-image: url('. esc_url($smof_data['ftc_bg_popup_image']['url']) .')">';
    echo '<span class="close-popup"></span>
    <div class="wp-newletter">';
    dynamic_sidebar('popup-newletter');
    echo '</div>';
    echo '<span class="dont_show_popup"><input id="ftc_dont_show_again" type="checkbox"><label for="ftc_dont_show_again">' .esc_attr__('Don\'t show popup again', 'ornaldo'). '</label></span>';
    echo '</div>';
}
}

/* Remove WP Version Param From Any Enqueued Scripts */
if (!function_exists('ftc_remove_wp_ver_css_js')) {

    function ftc_remove_wp_ver_css_js($src) {
        if (strpos($src, 'ver=')) {
            $src = esc_url(remove_query_arg('ver', $src));
        }
        return $src;
    }

}
add_filter('style_loader_src', 'ftc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'ftc_remove_wp_ver_css_js', 9999);

/* * * Get excerpt ** */
if (!function_exists('ftc_the_excerpt_max_words')) {

    function ftc_the_excerpt_max_words($word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true) {
        if ($post) {
         if ( has_excerpt() ){
          $excerpt = get_the_excerpt();
      } else {
        $excerpt = get_the_content();
        $excerpt = apply_filters( 'the_content', $excerpt );
        $excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
    }
} else {
    $excerpt = get_the_excerpt();
}

if ($strip_tags) {
    $excerpt = wp_strip_all_tags($excerpt);
    $excerpt = strip_shortcodes($excerpt);
}

if ($word_limit != -1)
    $result = ftc_string_limit_words($excerpt, $word_limit);
else
    $result = $excerpt;

$result .= $extra_str;

if ($echo) {
    echo do_shortcode($result);
}
return $result;
}
}

if (!function_exists('ftc_string_limit_words')) {
    function ftc_string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, ($word_limit + 1));
        if(count($words) > $word_limit) {
            array_pop($words);
//add a ... at last article when more than limit word count
            echo implode(' ', $words)."..."; } else {
//otherwise
                echo implode(' ', $words); }
            }
        }


        /* * * Page Layout Columns Class ** */
        if (!function_exists('ftc_page_layout_columns_class')) {

            function ftc_page_layout_columns_class($page_column) {
                $data = array();

                if (empty($page_column)) {
                    $page_column = '0-1-0';
                }

                $layout_config = explode('-', $page_column);
                $left_sidebar = (int) $layout_config[0];
                $right_sidebar = (int) $layout_config[2];
                $main_class = ($left_sidebar + $right_sidebar) == 2 ? 'col-sm-6 col-xs-12' : ( ($left_sidebar + $right_sidebar) == 1 ? 'col-sm-9 col-xs-12' : 'col-sm-12 col-xs-12' );

                $data['left_sidebar'] = $left_sidebar;
                $data['right_sidebar'] = $right_sidebar;
                $data['main_class'] = $main_class;
                $data['left_sidebar_class'] = 'col-sm-3 col-xs-12';
                $data['right_sidebar_class'] = 'col-sm-3 col-xs-12';


                return $data;
            }
        }
        function is_elementor(){
            global $post;
            if(class_exists('Elementor\Plugin')){
                return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
            } 
        }
        /* Ajax nonce*/
add_action('wp_enqueue_scripts', 'ftc_ajax_platform_script_enqueue');
function ftc_ajax_platform_script_enqueue () {
    wp_enqueue_script(
        'platform',
        get_template_directory_uri(). '/assets/js/platform.js',
        array('jquery'), '1.0', true);

    wp_localize_script('platform', 'ftc_platform', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('platform_security')
    ));
}

        /* * * Is Active WooCommmerce ** */
        if (!function_exists('ftc_has_woocommerce')) {

            function ftc_has_woocommerce() {
                $_actived = apply_filters('active_plugins', get_option('active_plugins'));
                if (in_array("woocommerce/woocommerce.php", $_actived) && class_exists('woocommerce')) {
                    return true;
                }
                return false;
            }
        }
        if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'type_2'){
          add_filter('body_class', function($classes){
          return array_merge( $classes, array( 'ftc-single-grid' ) );
         });
        }

        /* * * Include files in woo folder ** */
        $file_names = array('functions', 'term', 'quickshop', 'grid_list_toggle', 'hooks');
        foreach ($file_names as $file) {
            $file_path = get_template_directory() . '/inc/woo/' . $file . '.php';
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }

        /* Custom Sidebar */
        add_action('sidebar_admin_page', 'ftc_custom_sidebar_form');

        function ftc_custom_sidebar_form() {
            ?>
            <form action="<?php echo admin_url('widgets.php'); ?>" method="post" id="ftc-form-add-sidebar">
                <input type="text" name="sidebar_name" id="sidebar_name" placeholder="<?php echo esc_html_e('Custom Sidebar Name', 'ornaldo') ?>" />
                <button class="button-primary" id="ftc-add-sidebar"><?php echo esc_html_e('Add Sidebar', 'ornaldo') ?></button>
            </form>
            <?php
        }

        function ftc_get_custom_sidebars() {
            $option_name = 'ftc_custom_sidebars';
            $custom_sidebars = get_option($option_name);
            return is_array($custom_sidebars) ? $custom_sidebars : array();
        }

        add_action('wp_ajax_ftc_add_custom_sidebar', 'ftc_add_custom_sidebar');

        function ftc_add_custom_sidebar() {
            check_ajax_referer( 'platform_security', 'security' );
            if (isset($_POST['sidebar_name'])) {
                $option_name = 'ftc_custom_sidebars';
                if (!get_option($option_name) || get_option($option_name) == '') {
                    delete_option($option_name);
                }

                $sidebar_name = sanitize_text_field($_POST['sidebar_name']);

                if (get_option($option_name)) {
                    $custom_sidebars = ftc_get_custom_sidebars();
                    if (!in_array($sidebar_name, $custom_sidebars)) {
                        $custom_sidebars[] = $sidebar_name;
                    }
                    $result1 = update_option($option_name, $custom_sidebars);
                } else {
                    $custom_sidebars = array();
                    $custom_sidebars[] = $sidebar_name;
                    $result2 = add_option($option_name, $custom_sidebars);
                }

                if ($result1) {
                    wp_die('Updated');
                } elseif ($result2) {
                    wp_die('Added');
                } else {
                    wp_die('Error');
                }
            }
            wp_die('');
        }

        add_action('wp_ajax_ftc_delete_custom_sidebar', 'ftc_delete_custom_sidebar');

        function ftc_delete_custom_sidebar() {
            check_ajax_referer( 'platform_security', 'security' );
            if (isset($_POST['sidebar_name'])) {
                $option_name = 'ftc_custom_sidebars';
                $del_sidebar = trim($_POST['sidebar_name']);
                $custom_sidebars = ftc_get_custom_sidebars();
                foreach ($custom_sidebars as $key => $value) {
                    if ($value == $del_sidebar) {
                        unset($custom_sidebars[$key]);
                        break;
                    }
                }
                $custom_sidebars = array_values($custom_sidebars);
                update_option($option_name, $custom_sidebars);
                wp_die('Deleted');
            }
            wp_die('');
        }

        /* * * Require Advance Options ** */
        require_once get_template_directory() . '/inc/register_sidebar.php';
        require_once get_template_directory() . '/inc/theme_control.php';
     

        /** Include widget files * */
        $file_names = array('feedburner_subscription', 'instagram', 'products', 'blogs', 'blogs_tabs', 'recent_comments', 'product_categories','product_filter_by_color');
        foreach ($file_names as $file) {
            $file_path = get_template_directory() . '/inc/widgets/' . $file . '.php';
            if (file_exists($file_path)) {
                include_once $file_path;
            }
        }

/**
* Handles JavaScript detection.
*
* Adds a `js` class to the root `<html>` element when JavaScript is detected.
*
* @since ornaldo 1.0
*/
function ftc_javascript_detection(){
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'ftc_javascript_detection', 0);


/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

/**
 * Filter by color.
 */
require get_parent_theme_file_path('/inc/filter_by_color_options.php');

/* * * Visual Composer plugin ** */
if (class_exists('Vc_Manager') && class_exists('WPBakeryVisualComposerAbstract')) {
    $file_names = array('vc_map', 'update_param');
    foreach ($file_names as $file) {
        $file_path = get_template_directory() . '/inc/vc_extension/' . $file . '.php';
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
    vc_set_shortcodes_templates_dir(get_template_directory() . '/inc/vc_extension/templates');

    /* Disable VC Frontend Editor */
    vc_disable_frontend();
}

/* * * Save Of Options - Save Dynamic css ** */
add_action('of_save_options_after', 'ftc_update_dynamic_css', 10000);
if (!function_exists('ftc_update_dynamic_css')) {

    function ftc_update_dynamic_css($data = array()) {

        if (!is_array($data)) {
            return -1;
        }
        if (is_array($data['data'])) {
            $data = $data['data'];
        } else {
            return -1;
        }

        $upload_dir = wp_upload_dir();
        $filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        ob_start();
        include get_template_directory() . '/inc/dynamic_style.php';
        $dynamic_css = ob_get_contents();
        ob_end_clean();

        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
        }

        $creds = request_filesystem_credentials($filename_dir, '', false, false, array());
        if (!WP_Filesystem($creds)) {
            return false;
        }

        if ($wp_filesystem) {
            $wp_filesystem->put_contents(
                $filename_dir, $dynamic_css, FS_CHMOD_FILE
            );
        }
    }
}


function ftc_register_custom_css() {
    ob_start();
    include_once get_template_directory() . '/inc/dynamic_style.php';
    $dynamic_css = ob_get_contents();
    ob_end_clean();
    wp_add_inline_style('ftc-style', $dynamic_css);

}

add_action('wp_enqueue_scripts', 'ftc_register_custom_css', 9999);
// Disable widget live editor

add_filter( 'gutenberg_use_widgets_block_editor', 'ftc_class_editor_widget' );
add_filter( 'use_widgets_block_editor', 'ftc_class_editor_widget' );
function ftc_class_editor_widget(){
    global $smof_data;
    if(isset($smof_data['ftc_widget_classic_editor']) && $smof_data['ftc_widget_classic_editor'] == 1 ) {
        return false;
    }
    else{
      return true;
    }
}

/* Header Mobile Navigation */
if( ! function_exists( 'ftc_header_mobile_navigation' ) ) {
    function ftc_header_mobile_navigation() {
        global $smof_data;
        ?>
        <?php if( !is_page_template('page-blank.php') ): ?>
            <div class="ftc-mobile-wrapper">
                <div class="mutil-lang-cur">
                    <?php if( $smof_data['ftc_header_language'] ): ?>
                        <div class="ftc-sb-language"><?php echo ftc_wpml_language_selector(); ?></div>
                    <?php endif; ?>
                    <?php if( $smof_data['ftc_header_currency'] ): ?>
                        <div class="header-currency"><?php echo ftc_woocommerce_multilingual_currency_switcher(); ?></div>
                    <?php endif; ?>
                </div>
                <?php if( $smof_data['ftc_enable_search'] ): ?>
                    <?php ftc_get_search_form_by_category(); ?>
                <?php endif; ?>
                <div class= "menu-text"> 
                    <button type="button" class="btn btn-toggle-canvas" data-toggle="offcanvas">
                        <i class="fas fa-fw fa-bars"></i>
                        <!-- <i class="fa fa-close"></i> -->
                    </button>
                    <?php esc_html_e('Mobile Menu', 'ornaldo') ?>
                </div>
                <div class="mobile-menu-wrapper">
                    <?php wp_nav_menu( array( 'theme_location' => '','menu' => 'main menu', 'menu_id' => 'main-menu', 'menu_class' => 'ftc-smartmenu ftc-simple') ); ?>
                </div>
                <!-- <?php
                    global $smof_data, $woocommerce;
                    if ($smof_data['ftc_mobile_layout']): 
                ?>
                    <div class="mobile-wishlist">    
                        <?php if( class_exists('YITH_WCWL')): ?>
                            <div class="ftc-my-wishlist"><?php echo ftc_tini_wishlist(); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mobile-account">
                        <?php 
                            $_user_logged = is_user_logged_in();
                            ob_start();
                        ?>
                        <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php  echo esc_html_e('Login','ornaldo'); ?>">
                            <?php if ($_user_logged): ?>
                                <?php echo esc_html_e('Account','ornaldo'); ?>
                            <?php endif; ?>
                            <?php if (!$_user_logged): ?>
                                <?php echo esc_html_e('Login','ornaldo'); ?>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?> -->
                <?php if(isset($smof_data['ftc_header_social_editor'])) { ?>
                    <div class="header-mobile-social">
                        <?php echo wp_kses_post( do_shortcode($smof_data['ftc_header_social_editor']) ); ?>
                    </div>
                <?php } ?>
            </div>
        <?php endif; ?>
    <?php
    }
}

/* * * Logo Mobile * * */
if (!function_exists('ftc_theme_mobile_logo')) {
    function ftc_theme_mobile_logo() {
        global $smof_data;
        $logo_image = isset($smof_data['ftc_logo_mobile']['url']) ? esc_url($smof_data['ftc_logo_mobile']['url']) : '';
        $logo_text = isset($smof_data['ftc_text_logo']) ? stripslashes(esc_attr($smof_data['ftc_text_logo'])) : '';
        ?>
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <!-- Main logo mobile -->
                <?php if (strlen($logo_image) > 0): ?>
                    <img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo!empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" title="<?php echo!empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" class="normal-logo-mobile" />
                <?php endif; ?>

                <!-- Logo Text -->
                <?php
                if (strlen($logo_image) == 0) {
                    echo esc_html($logo_text);
                }
                ?>
            </a>
        </div>
    <?php
    }
}

/* * * Favicon ** */
if (!function_exists('ftc_theme_favicon')) {

    function ftc_theme_favicon() {
        if (function_exists('wp_site_icon') && function_exists('has_site_icon') && has_site_icon()) {
            return;
        }
        global $smof_data;
        $favicon = isset($smof_data['ftc_favicon']['url'] ) ? esc_url($smof_data['ftc_favicon']['url'] ) : '';
        if (strlen($favicon) > 0):
            ?>
            <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
            <?php
        endif;
    }

}

/* * * Logo ** */
if (!function_exists('ftc_theme_logo')) {

    function ftc_theme_logo() {
        global $smof_data;
        $logo_image = isset($smof_data['ftc_logo']['url']) ? esc_url($smof_data['ftc_logo']['url']) : '';
        $logo_text = isset($smof_data['ftc_text_logo']) ? stripslashes(esc_attr($smof_data['ftc_text_logo'])) : '';
        ?>
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <!-- Main logo -->
                <?php if (strlen($logo_image) > 0): ?>
                    <img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" title="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" class="normal-logo" />
                <?php endif; ?>

                <!-- Logo Text -->
                <?php
                if (strlen($logo_image) == 0) {
                    echo esc_html($logo_text);
                }
                ?>
            </a>
        </div>
        <?php
    }
}

/* * * Product Search Form by Category ** */
if (!function_exists('ftc_get_search_form_by_category')) {

    function ftc_get_search_form_by_category() {
        $search_for_product = ftc_has_woocommerce();
        if ($search_for_product) {
            $taxonomy = 'product_cat';
            $post_type = 'product';            
            $placeholder_text = esc_html__('Search ...', 'ornaldo');
        } else {
            $taxonomy = 'category';
            $post_type = 'post';
            $placeholder_text = esc_html__('Search', 'ornaldo');
        }

        $options = '<option value="">' . esc_html__('All categories', 'ornaldo') . '</option>';
        $options .= ftc_search_by_category_get_option_html($taxonomy, 0, 0);

        $rand = rand(0, 1000);
        $form = '<div class="ftc-search">
        <button type="submit" class="search-button"></button>
        <span class="title-search">Search</span>
        <form method="get" id="searchform' . $rand . '" action="' . esc_url(home_url('/')) . '">
        <select class="select-category" name="term">' . $options . '</select>
        <div class="ftc_search_ajax">
        <input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" placeholder="' . $placeholder_text . '" autocomplete="off" />
        <input type="submit" title="' . esc_attr__('Search', 'ornaldo') . '" id="searchsubmit' . $rand . '" value="' . esc_attr__('Search', 'ornaldo') . '" />
        <input type="hidden" name="post_type" value="' . $post_type . '" />
        <input type="hidden" name="taxonomy" value="' . $taxonomy . '" />
        </div></form></div>';

        print_r($form);
    }

}

if (!function_exists('ftc_search_by_category_get_option_html')) {

    function ftc_search_by_category_get_option_html($taxonomy = 'product_cat', $parent = 0, $level = 0) {
        $options = '';
        $spacing = '';
        for ($i = 0; $i < $level * 3; $i++) {
            $spacing .= '&nbsp;';
        }

        $args = array(
            'number' => ''
            , 'hide_empty' => 1
            , 'orderby' => 'name'
            , 'order' => 'asc'
            , 'parent' => $parent
        );

        $select = '';
        $categories = get_terms($taxonomy, $args);
        if (is_search() && isset($_GET['term']) && $_GET['term'] != '') {
            $select = $_GET['term'];
        }
        $level++;
        if (is_array($categories)) {
            foreach ($categories as $cat) {
                $options .= '<option value="' . $cat->slug . '" ' . selected($select, $cat->slug, false) . '>' . $spacing . $cat->name . '</option>';
                $options .= ftc_search_by_category_get_option_html($taxonomy, $cat->term_id, $level);
            }
        }

        return $options;
    }

}
/*shop variation*/
function ftc_template_loop_variation() {
    global $smof_data;

    $enableVariation = isset($smof_data['ftc_variation_product_shop']) && $smof_data['ftc_variation_product_shop'];
    if ((is_tax('product_cat') && $enableVariation) || (is_shop() && $enableVariation) || (is_post_type_archive('product') && $enableVariation)) {

        add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_add_to_cart', 11);
        add_filter('body_class',function($classes){
            return array_merge($classes, array('ftc-variation'));
        });
    }
}
/* Ajax search */
add_action('wp_ajax_ftc_ajax_search', 'ftc_ajax_search');
add_action('wp_ajax_nopriv_ftc_ajax_search', 'ftc_ajax_search');
if (!function_exists('ftc_ajax_search')) {

    function ftc_ajax_search() {
        global $wpdb, $post, $smof_data;

        $search_for_product = ftc_has_woocommerce();
        if ($search_for_product) {
            $taxonomy = 'product_cat';
            $post_type = 'product';
        } else {
            $taxonomy = 'category';
            $post_type = 'post';
        }

        $num_result = isset($smof_data['ftc_ajax_search_number_result']) ? (int) $smof_data['ftc_ajax_search_number_result'] : 10;

        $search_string = sanitize_text_field($_POST['search_string']);
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

        $args = array(
            'post_type' => $post_type
            , 'post_status' => 'publish'
            , 's' => $search_string
            , 'posts_per_page' => $num_result
            ,'tax_query'        => array()
        );

        if ($search_for_product) {
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'] = WC()->query->get_tax_query();
        }

        if ($category != '') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy
                    , 'terms' => $category
                    , 'field' => 'slug'
                )
            );
        }

        $results = new WP_Query($args);

        if ($results->have_posts()) {
            $extra_class = '';
            if (isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count) {
                $extra_class = 'view-all-results';
            }

            $html = '<ul class="ftc_list_search ' . $extra_class . '">';
            while ($results->have_posts()) {
                $results->the_post();
                $link = get_permalink($post->ID);

                $image = '';
                if ($post_type == 'product') {
                    $product = wc_get_product($post->ID);
                    $image = $product->get_image();
                } else if (has_post_thumbnail($post->ID)) {
                    $image = get_the_post_thumbnail($post->ID, 'thumbnail');
                }

                $html .= '<li>';
                $html .= '<div class="ftc-search-image">';
                $html .= '<a href="' . esc_url($link) . '">' . $image . '</a>';
                $html .= '</div>';
                $html .= '<div class="ftc-search-meta item-description">';
                $html .= '<a href="' . esc_url($link) . '" class="product_title product-name">' . ftc_search_highlight_string($post->post_title, $search_string) . '</a>';
                if ($post_type == 'product') {
                    if ($price_html = $product->get_price_html()) {
                        $html .= '<span class="price">' . $price_html . '</span>';
                    }
                }
                $html .= '</div>';
                $html .= '</li>';
            }
            $html .= '</ul>';

            if (isset($results->post_count, $results->found_posts)) {
                $view_all_text = sprintf(esc_html__('View all %d results', 'ornaldo'), $results->found_posts);

                $html .= '<div class="view-all">';
                $html .= '<a href="#">' . $view_all_text . '</a>';
                $html .= '</div>';
            }

            wp_reset_postdata();

            $return = array();
            $return['html'] = $html;
            $return['search_string'] = $search_string;
            wp_die(json_encode($return));
        }
        else{
            $html = '<span class="error">'.esc_html__('No item found.', 'ornaldo').'</span>';
            $return = array();
            $return['html'] = $html;
            $return['search_string'] = $search_string;
           wp_die(json_encode($return));
        }

        wp_die('');
    }
}

if (!function_exists('ftc_search_highlight_string')) {

    function ftc_search_highlight_string($string, $search_string) {
        $new_string = '';
        $pos_left = stripos($string, $search_string);
        if ($pos_left !== false) {
            $pos_right = $pos_left + strlen($search_string);
            $new_string_right = substr($string, $pos_right);
            $search_string_insensitive = substr($string, $pos_left, strlen($search_string));
            $new_string_left = stristr($string, $search_string, true);
            $new_string = $new_string_left . '<span class="hightlight">' . $search_string_insensitive . '</span>' . $new_string_right;
        } else {
            $new_string = $string;
        }
        return $new_string;
    }

}

/* Match with ajax search results */
add_filter('woocommerce_get_catalog_ordering_args', 'ftc_woocommerce_get_catalog_ordering_args_filter');
if (!function_exists('ftc_woocommerce_get_catalog_ordering_args_filter')) {

    function ftc_woocommerce_get_catalog_ordering_args_filter($args) {
        global $smof_data;
        if (is_search() && !isset($_GET['orderby']) && get_option('woocommerce_default_catalog_orderby') == 'relevance' && isset($smof_data['ftc_ajax_search']) && $smof_data['ftc_ajax_search']) {
            $args['orderby'] = '';
            $args['order'] = '';
            $args['meta_key'] = '';
        }
        return $args;
    }
}

/* * * Social Sharing ** */
if (!function_exists('ftc_template_social_sharing')) {

    function ftc_template_social_sharing() {
        if (is_active_sidebar('product-detail-social-icon')) {
            dynamic_sidebar('product-detail-social-icon');
        }
    }

}

/* * * Array Attribute Compare ** */
if (!function_exists('ftc_array_atts')) {

    function ftc_array_atts($pairs, $atts) {
        $atts = (array) $atts;
        $out = array();
        foreach ($pairs as $name => $default) {
            if (array_key_exists($name, $atts)) {
                if (is_array($atts[$name]) && is_array($default)) {
                    $out[$name] = ftc_array_atts($default, $atts[$name]);
                } else {
                    $out[$name] = $atts[$name];
                }
            } else {
                $out[$name] = $default;
            }
        }
        return $out;
    }

}

/* * * Breadcrumbs ** */
if (!function_exists('ftc_breadcrumbs')) {

    function ftc_breadcrumbs() {
        global $smof_data;

        $is_rtl = is_rtl() || ( isset($smof_data['ftc_enable_rtl']) && $smof_data['ftc_enable_rtl'] );

        if (ftc_has_woocommerce()) {
            if (function_exists('woocommerce_breadcrumb') && function_exists('is_woocommerce') && is_woocommerce()) {
                woocommerce_breadcrumb(array('wrap_before' => '<div class="ftc-breadcrumbs-content">', 'delimiter' => '<span>' . ($is_rtl ? '\\' : '/') . '</span>', 'wrap_after' => '</div>'));
                return;
            }
        }

        if (function_exists('bbp_breadcrumb') && function_exists('is_bbpress') && is_bbpress()) {
            $args = array(
                'before' => '<div class="ftc-breadcrumbs-content">'
                , 'after' => '</div>'
                , 'sep' => $is_rtl ? '\\' : '/'
                , 'sep_before' => '<span class="brn_arrow">'
                , 'sep_after' => '</span>'
                , 'current_before' => '<span class="current">'
                , 'current_after' => '</span>'
            );

            bbp_breadcrumb($args);
            /* Remove bbpress breadcrumbs */
            add_filter('bbp_no_breadcrumb', '__return_true', 999);
            return;
        }

        $delimiter = '<span class="brn_arrow">' . ($is_rtl ? '\\' : '/') . '</span>';

        $front_id = get_option('page_on_front');
        if (!empty($front_id)) {
            $home = get_the_title($front_id);
        } else {
            $home = esc_html__('Home', 'ornaldo');
        }
        $ar_title = array(
            'search' => esc_html__('Search results for ', 'ornaldo')
            , '404' => esc_html__('Error 404', 'ornaldo')
            , 'tagged' => esc_html__('Tagged ', 'ornaldo')
            , 'author' => esc_html__('Articles posted by ', 'ornaldo')
            , 'page' => esc_html__('Page', 'ornaldo')
            , 'portfolio' => esc_html__('Portfolio', 'ornaldo')
        );

        $before = '<span class="current">'; /* tag before the current crumb */
        $after = '</span>'; /* tag after the current crumb */
        global $wp_rewrite;
        $rewriteUrl = $wp_rewrite->using_permalinks();
        if (!is_home() && !is_front_page() || is_paged()) {

            echo '<div class="ftc-breadcrumbs-content">';

            global $post;
            $homeLink = esc_url(home_url('/'));
            echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo get_category_parents($parentCat, true, ' ' . $delimiter . ' ');
                }
                print_r($before . single_cat_title('', false) . $after);
            } elseif (is_search()) {
                print_r($before . $ar_title['search'] . '"' . get_search_query() . '"' . $after);
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                print_r($before . get_the_time('d') . $after);
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                print_r($before . get_the_time('F') . $after);
            } elseif (is_year()) {
                print_r($before . get_the_time('Y') . $after);
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $post_type_name = $post_type->labels->singular_name;
                    if (strcmp('Portfolio Item', $post_type->labels->singular_name) == 0) {
                        $post_type_name = $ar_title['portfolio'];
                    }
                    if ($rewriteUrl) {
                        echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    } else {
                        echo '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }

                    print_r($before . get_the_title() . $after);
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    print_r($before . get_the_title() . $after);
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                $post_type_name = $post_type->labels->singular_name;
                if (strcmp('Portfolio Item', $post_type->labels->singular_name) == 0) {
                    $post_type_name = $ar_title['portfolio'];
                }
                if (is_tag()) {
                 print_r($before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after);
             } elseif (is_taxonomy_hierarchical(get_query_var('taxonomy'))) {
                if ($rewriteUrl) {
                    echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
                } else {
                    echo '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                }

                $curTaxanomy = get_query_var('taxonomy');
                $curTerm = get_query_var('term');
                $termNow = get_term_by('name', $curTerm, $curTaxanomy);
                $pushPrintArr = array();
                if ($termNow !== false) {
                    while ((int) $termNow->parent != 0) {
                        $parentTerm = get_term((int) $termNow->parent, get_query_var('taxonomy'));
                        array_push($pushPrintArr, '<a href="' . get_term_link((int) $parentTerm->term_id, $curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
                        $curTerm = $parentTerm->name;
                        $termNow = get_term_by('name', $curTerm, $curTaxanomy);
                    }
                }
                $pushPrintArr = array_reverse($pushPrintArr);
                array_push($pushPrintArr, $before . get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))->name . $after);
                echo implode($pushPrintArr);
            } else {
                print_r($before . $post_type_name . $after);
            }
        } elseif (is_attachment()) {
            if ((int) $post->post_parent > 0) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                if (count($cat) > 0) {
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                }
                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            }
            print_r($before . get_the_title() . $after);
        } elseif (is_page() && !$post->post_parent) {
         print_r($before . get_the_title() . $after);
     } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_post($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            print_r($crumb . ' ' . $delimiter . ' ');
        print_r($before . get_the_title() . $after);
    } elseif (is_tag()) {
        print_r($before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after);
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        print_r($before . $ar_title['author'] . $userdata->display_name . $after);
    } elseif (is_404()) {
        print_r($before . $ar_title['404'] . $after);
    }

    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
            print_r($before . ' (');
        }
        print_r($ar_title['page'] . ' ' . get_query_var('paged'));
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
            echo ')' . $after;
        }
    } else {
        if (get_query_var('page')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
             print_r($before . ' (');
         }
         print_r($ar_title['page'] . ' ' . get_query_var('page'));
         if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
            echo ')' . $after;
        }
    }
}
echo '</div>';
}

wp_reset_postdata();
}

}

function ftc_breadcrumbs_title($show_breadcrumb = false, $show_page_title = false, $page_title = '', $extra_class_title = '') {
    global $smof_data;
    if ($show_breadcrumb || $show_page_title) {
        $breadcrumb_bg = '';
        if (isset($smof_data['ftc_enable_breadcrumb_background_image']) && $smof_data['ftc_enable_breadcrumb_background_image']) {
            $breadcrumb_bg = esc_url($smof_data['ftc_bg_breadcrumbs']['url'] );
        }

        $style = '';
        if ($breadcrumb_bg != '') {
            $style = 'style="background-image: url(' . $breadcrumb_bg . ')"';
            if (isset($smof_data['ftc_breadcrumb_bg_parallax']) && $smof_data['ftc_breadcrumb_bg_parallax']) {
                $extra_class .= ' ftc-breadcrumb-parallax';
            }
        }
        echo '<div class="ftc-breadcrumb " ' . $style . '>';
          if (isset($smof_data['ftc_enable_breadcrumb_background_image']) && $smof_data['ftc_enable_breadcrumb_background_image']) {
              echo '<div class="ftc-breadcrumb-title container">';
          }
          else{
            echo '<div class="ftc-breadcrumb-title-noback container">';
        }

        if ($show_page_title) {
            echo '<h1 class="product_title page-title entry-title ' . $extra_class_title . '">' . $page_title . '</h1>';
        }
        if ($show_breadcrumb) {
            ftc_breadcrumbs();
        }
         if(is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') || is_singular('product')){
            if(isset($smof_data['ftc_enable_category_breadcrumb']) && $smof_data['ftc_enable_category_breadcrumb'] ){
                echo '<div class="ftc-breadcrumbs-category">';
                dynamic_sidebar('list-categories-breadcrumbs');
                echo '</div>';
            }
        }
        echo '</div></div>';
    }
}

/* * * Add header dynamic css ** */
add_action('wp_head', 'ftc_add_header_dynamic_css', 1000);
if (!function_exists('ftc_add_header_dynamic_css')) {

    function ftc_add_header_dynamic_css($is_iframe = false) {
        if (!$is_iframe) {
            return;
        }
        $upload_dir = wp_upload_dir();
        $filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        $filename = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        if (is_ssl()) {
            $filename = str_replace('http://', 'https://', $filename);
        }
        if (file_exists($filename_dir)) {
            wp_register_style('header_dynamic', $filename);
            wp_enqueue_style('header_dynamic');
        }
    }

}

/* Cookie Notice */
if( ! function_exists( 'ftc_cookies_popup' ) ) {
    add_action( 'wp_footer', 'ftc_cookies_popup', 10 );

    function ftc_cookies_popup() {
        global $smof_data;
        if( ! $smof_data['cookies_info'] ) return;


        ?>
        <div class="ftc-cookies-popup">
            <div class="ftc-cookies-inner">
                <div class="cookies-info-text">
                    <h4  class="cookies-title"><?php esc_html_e( 'Cookies Notice' , 'ornaldo' ); ?></h4>
                    <?php echo do_shortcode( $smof_data['cookies_text'] ); ?>
                </div>
                <div class="cookies-buttons">
                    <a href="#" class="cookies-accept-btn"><?php esc_html_e( "Yes, I Accept" , 'ornaldo' ); ?></a>
                </div>
            </div>
        </div>
        <?php
    }
}

/* Install Required Plugins */
add_action('tgmpa_register', 'ftc_register_required_plugins');

function ftc_register_required_plugins() {
    $plugin_dir_path = get_template_directory() . '/inc/plugins/';
    $ver = wp_get_theme(); 
    $version = $ver->get('Version');
    $domain = $ver->get('TextDomain');
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'ThemeFTC', // The plugin name.
            'slug' => 'themeftc', // The plugin slug (typically the folder name).
            'source' => $plugin_dir_path . 'themeftc.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
            'name' => 'WooCommerce', // The plugin name.
            'slug' => 'woocommerce', // The plugin slug (typically the folder name).
            'source' => '', // The plugin source.
            'required' => false, // If false, the plugin is only 'recommended' instead of required.

        )
        , array(
            'name' => 'Redux Framework', // The plugin name.
            'slug' => 'redux-framework', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'WPBakery Visual Composer', // The plugin name.
            'slug' => 'js_composer', // The plugin slug (typically the folder name).
            'source' => 'http://demo.themeftc.com/plugins/js_composer.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
            'name' => 'Revolution Slider', // The plugin name.
            'slug' => 'revslider', // The plugin slug (typically the folder name).
            'source' => 'http://demo.themeftc.com/plugins/revslider.zip', // The plugin source.
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        ,array(
            'name' => 'FTC Importer', // The plugin name.
            'slug' => 'ftc_importer', // The plugin slug (typically the folder name).
             'source'             => 'https://ornaldo.themeftc.com/content/ftc-importer-ornaldo-'.$version .'.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
            'name' => 'Mega Main Menu', // The plugin name.
            'slug' => 'mega_main_menu', // The plugin slug (typically the folder name).
            'source' => 'http://demo.themeftc.com/plugins/mega_main_menu.zip', // The plugin source.
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
            'version' => '2.1.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
        'name' => 'Elementor', // The plugin name.
        'slug' => 'elementor', // The plugin slug (typically the folder name)
        'required' => false , // If false, the plugin is only 'recommended' instead of required.
    ),
        array(
        'name' => 'ThemeFTC Elementor', // The plugin name.
        'slug' => 'themeftc-for-elementor', // The plugin slug (typically the folder name).
        'source' => $plugin_dir_path . 'themeftc-for-elementor.zip', // The plugin source.
        'required' => true, // If false, the plugin is only 'recommended' instead of required.
        'version' => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
        'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        'external_url' => '', // If set, overrides default API URL and points to an external URL.
    )
        , array(
            'name' => 'Contact Form 7', // The plugin name.
            'slug' => 'contact-form-7', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'YITH WooCommerce Wishlist', // The plugin name.
            'slug' => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'YITH WooCommerce Compare', // The plugin name.
            'slug' => 'yith-woocommerce-compare', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Regenerate Thumbnails', // The plugin name.
            'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'YITH WooCommerce Ajax Product Filter', // The plugin name.
            'slug' => 'yith-woocommerce-ajax-navigation', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
         'name' => 'Dokan Lite', // The plugin name.
            'slug' => 'dokan-lite', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Woocommerce Variation Swatches', // The plugin name.
            'slug' => 'woo-product-variation-swatches', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}
?>