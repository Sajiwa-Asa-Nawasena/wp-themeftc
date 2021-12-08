<?php
/* * ***********************************************
 * WooCommerce Custom Hook                        *
 * ************************************************ */

/* * * Shop - Category ** */

/* Remove hook */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('ftc_template_loop_time_deals','woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

/* Add new hook */
add_action('woocommerce_before_shop_loop_item_title', 'ftc_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_product_label', 1);
add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_categories', 10);
add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_title', 20);
add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_sku', 30);
add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_short_description', 40);
add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_short_description_listview', 69);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 60);
add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_add_to_cart', 70);
add_action('woocommerce_before_shop_loop', 'ftc_shop_top_content_widget_area_button', 25);

add_filter('loop_shop_per_page', 'ftc_change_products_per_page_shop');
add_filter('woocommerce_product_get_rating_html', 'ftc_get_empty_rating_html', 10, 2);

function ftc_template_loop_product_label() {
    global $product, $post, $smof_data;
    $out_of_stock = false;
    
    if ( ! $product->is_in_stock() ) {
        $out_of_stock = true;
    }
    ?>
    <div class="conditions-box">
        <?php
        /* Sale label */
        if ( $product->is_on_sale() && ! $out_of_stock ) {
            if ($product->get_regular_price() > 0 && isset($smof_data['ftc_show_sale_label_as']) && $smof_data['ftc_show_sale_label_as'] != 'text') {
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

                if ( isset($smof_data['ftc_show_sale_label_as']) && $smof_data['ftc_show_sale_label_as'] == 'percent' && $product->get_type() == 'simple') {
                    echo '<span class="onsale percent">-' . $percentage . '%</span>';
                }
            } else {
                echo '<span class="onsale">' . esc_html(stripslashes($smof_data['ftc_product_sale_label_text'])) . '</span>';
            }
        }

        /* Hot label */
        if ($product->is_featured() && !$out_of_stock) {
            echo '<span class="featured">' . esc_html(stripslashes($smof_data['ftc_product_feature_label_text'])) . '</span>';
        }

        /* Out of stock */
        if ($out_of_stock) {
            echo '<span class="out-of-stock">' . esc_html(stripslashes($smof_data['ftc_product_out_of_stock_label_text'])) . '</span>';
        }
        ?>
    </div>
    <?php
}



function ftc_template_loop_product_title() {
    global $post, $product;
    $url = esc_url( get_permalink($post->ID) );
    echo "<h3 class=\"product_title product-name\">";
    echo "<a href='{$url}'>" . esc_attr(get_the_title()) . "</a>";
    echo "</h3>";
}

function ftc_template_loop_product_thumbnail() {
        global $product, $smof_data;
        $lazy_load = isset($smof_data['ftc_prod_lazy_load']) && $smof_data['ftc_prod_lazy_load'] && $smof_data['ftc_prod_placeholder_img']['url'] != '' && !( defined('DOING_AJAX') && DOING_AJAX );
        $placeholder_img_src = isset($smof_data['ftc_prod_placeholder_img']['url']) ? $smof_data['ftc_prod_placeholder_img']['url'] : wc_placeholder_img_src();

        if (defined('YITH_INFS') && (is_shop() || is_product_taxonomy())) { /* Compatible with YITH Infinite Scrolling */
            $lazy_load = false;
        }
        if (defined('YITH_WCAN') && (is_shop() || is_product_taxonomy())) {
            $lazy_load = false;
        }
        $gallery_slider = '';

        if (isset($smof_data['ftc_config_prod_img']) && ($smof_data['ftc_config_prod_img'] == 'gallery_slider')){
            $gallery_slider = true;
        } 
        if ((isset($smof_data['ftc_gallery_on_product']) && $smof_data['ftc_gallery_on_product']) || isset($smof_data['ftc_loadmore_button_infinite']) && $smof_data['ftc_loadmore_button_infinite'] || isset($smof_data['ftc_prod_scroll_load']) && $smof_data['ftc_prod_scroll_load'] ){
        $gallery_slider = false;
    }
    $prod_galleries = $product->get_gallery_image_ids();

        $cover_image = (isset($smof_data['ftc_config_prod_img']) && (int) $smof_data['ftc_config_prod_img'] == 1) ? true : false;
        $hover_image = (isset($smof_data['ftc_config_prod_img']) && (int) $smof_data['ftc_config_prod_img'] == 2) ? true : false;

        if ( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 )) {
            $hover_image = false;
        }
        $class_image = '';

        if ($hover_image) {
            $class_image = 'cover_image';
        } else {
            $class_image = 'no-image';
        }

        $image_size = apply_filters('ftc_loop_product_thumbnail', 'shop_catalog');

        $dimensions = wc_get_image_size($image_size);

        if ($gallery_slider) {
            ftc_templates_loop_gallery_slider();
        } else {
            echo '<span class="' . $class_image . ' woocommerce-product-gallery__image">';
            if (!$lazy_load) {
                echo woocommerce_get_product_thumbnail($image_size);
                echo '</span>';
                if ($hover_image) {
                    echo '<span class="hover_image">';
                    echo wp_get_attachment_image($prod_galleries[0], $image_size, 0, array('class' => 'product-hover-image'));
                }
            } else {
                $front_img_src = '';
                $alt = '';
                if (has_post_thumbnail($product->get_id())) {
                    $post_thumbnail_id = get_post_thumbnail_id($product->get_id());
                    $image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
                    if (isset($image_obj[0])) {
                        $front_img_src = $image_obj[0];
                    }
                    $alt = trim(strip_tags(get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true)));
                } else if (wc_placeholder_img_src()) {
                    $front_img_src = wc_placeholder_img_src();
                }
                if ($cover_image || $hover_image) {
                    echo '<img src="' . esc_url($placeholder_img_src) . '" data-src="' . esc_url($front_img_src) . '" class="attachment-shop_catalog wp-post-image ftc-image" alt="' . esc_attr($alt) . '" width="' . $dimensions['width'] . '" height="' . $dimensions['height'] . '" />';
                }
                echo '</span>';

                if ($hover_image) {
                    echo '<span class="hover_image">';            
                    $back_img_src = '';
                    $alt = '';
                    $image_obj = wp_get_attachment_image_src($prod_galleries[0], $image_size, 0);
                    if (isset($image_obj[0])) {
                        $back_img_src = $image_obj[0];
                        $alt = trim(strip_tags(get_post_meta($prod_galleries[0], '_wp_attachment_image_alt', true)));
                    } else if (wc_placeholder_img_src()) {
                        $back_img_src = wc_placeholder_img_src();
                    }

                    echo '<img src="' . esc_url($placeholder_img_src) . '" data-src="' . esc_url($back_img_src) . '" class="product-hover-image ftc-image" alt="' . esc_attr($alt) . '" width="' . $dimensions['width'] . '" height="' . $dimensions['height'] . '" />';
                }
            }
            echo '</span>';
        }

    }
    function ftc_templates_loop_gallery_slider() {
        global $product, $smof_data;
        $attachment_ids = $product->get_gallery_image_ids();

        $image_ids = array();
        /* Main image */
        if ( has_post_thumbnail() ){
            $image_ids[] = get_post_thumbnail_id();             
        }
        /* Thumbnails */
        $attachment_ids = $product->get_gallery_image_ids();
        if( is_array($attachment_ids) ){
            $image_ids = array_merge($image_ids, $attachment_ids);
            if( count($image_ids) > 10 ){
                $image_ids = array_slice($image_ids, 0, 10);
            }
        }

        if( count($image_ids) == 0 ){ /* Always show image */
            $image_ids[] = 0;
        }

        ?>
        <ul class="ftc-gallery-slider loading">
            <?php foreach ($image_ids as $image_id) {
                $image_info = wp_get_attachment_image_src($image_id, 'shop_single');
                $image_link = isset($image_info[0])?$image_info[0]:wc_placeholder_img_src();
                ?>
                <li class="gallery_slider_item">
                    <img src="<?php echo esc_url($image_link); ?>" alt="img">
                </li>
            <?php } ?>
        </ul>
        <?php
    }

// ! Add qutity text for single product
if( ! function_exists( 'ftc_single_qutity_txt' ) ) {
    function ftc_single_qutity_txt() {
        global $product;
        if ( ! $product->is_type( 'grouped' ) ) printf( '<span class="qty-span">%1s</span>', esc_html__( 'quantity', 'ornaldo' ) ); 
    }
}

if(!function_exists('ftc_shop_page_link')) {
    function ftc_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }

        return $link;
    }
}

function ftc_change_products_per_page_shop() {
    global $smof_data;
    if (is_tax(get_object_taxonomies('product')) || is_post_type_archive('product')) {
        if (isset($smof_data["ftc_prod_cat_per_page"]) && absint($smof_data["ftc_prod_cat_per_page"]) > 0) {
            return absint($smof_data["ftc_prod_cat_per_page"]);
        }
    }
}

function ftc_template_loop_add_to_cart() {
    global $smof_data;

    if ( isset($smof_data['ftc_enable_catalog_mode']) && $smof_data['ftc_enable_catalog_mode']) {
        return;
    }

    echo "<div class='add-to-cart add_to_cart_button'>";
    woocommerce_template_loop_add_to_cart();
    echo "</div>";
}

function ftc_template_loop_product_sku() {
    global $product, $post;
    echo "<span class=\"product-sku\">" . $product->get_sku() . "</span>";
}

if( ! function_exists( 'ftc_after_products_widgets' ) ) {
    function ftc_after_products_widgets() {
        echo '<div class="after-products-widgets">';
        dynamic_sidebar('shop-after-products');
        echo '</div>';
    }
}

function ftc_template_loop_short_description() {
    global $product, $post, $smof_data;
    $has_grid_list = get_option('ftc_enable_glt', 'yes') == 'yes';
    $grid_limit_words = absint($smof_data['ftc_prod_cat_grid_desc_words']);
    $show_grid_desc = $smof_data['ftc_prod_cat_grid_desc'];

    if (empty($post->post_excerpt))
        return;

    if (!(is_tax(get_object_taxonomies('product')) || is_post_type_archive('product'))):
        ?>
    <div class="short-description">
        <?php ftc_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
    </div>
    <?php
else:
    if ($show_grid_desc):
        ?>
        <div class="short-description grid" style="<?php echo esc_html(($has_grid_list) ? 'display: none' : ''); ?>" >
            <?php ftc_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
        </div>
        <?php
    endif;
endif;
}

function ftc_template_loop_short_description_listview() {
    global $product, $post, $smof_data;
    $list_limit_words = absint($smof_data['ftc_prod_cat_list_desc_words']);
    $show_list_desc = $smof_data['ftc_prod_cat_list_desc'];
    $is_archive = is_tax(get_object_taxonomies('product')) || is_post_type_archive('product');
    if ($show_list_desc && $is_archive):
        ?>
        <div class="short-description list" style="display: none" >
            <?php ftc_the_excerpt_max_words($list_limit_words, '', true, '', true); ?>
        </div>
        <?php
    endif;
}

function ftc_template_loop_categories() {
   global $product;        
   $categories_label = esc_html__('Categories: ', 'ornaldo');
   echo wc_get_product_category_list($product->get_id(),', ', '<div class="product-categories"><span>'.$categories_label.'</span>', '</div>'); 
}

function ftc_get_empty_rating_html($rating_html, $rating) {
    if ($rating == 0) {
        $rating_html = '<div class="star-rating no-rating">';
        $rating_html .= '<span style="width:0%"></span>';
        $rating_html .= '</div>';
    }
    return $rating_html;
}

function ftc_shop_top_content_widget_area_button() {
    global $smof_data;
    if (is_active_sidebar('product-category-top-content') && isset($smof_data['ftc_prod_cat_top_content']) && $smof_data['ftc_prod_cat_top_content']) {
        ?>
        <div class="prod-cat-show-top-content-button"><a href="#"><?php esc_html_e('Filter', 'ornaldo') ?></a></div>
        <?php
    }
}
add_action('woocommerce_before_shop_loop', 'ftc_shop_top_filter_boxed_button', 30);
     function ftc_shop_top_filter_boxed_button(){
   global $smof_data;
   if($smof_data['ftc_prod_cat_layout'] == '0-1-0' && isset($smof_data['ftc_prod_box_sidebar_filter']) && $smof_data['ftc_prod_box_sidebar_filter'] && is_active_sidebar($smof_data['ftc_prod_cat_left_sidebar'])) {
    ?>
    <div class="button-filter-boxed"><a href="#"><?php esc_html_e('Off-Canvas Filter', 'ornaldo') ?></a></div>
    <?php
}
}   

/* * * End Shop - Category ** */



/* * * Single Product ** */

/* Remove hook */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


/* Add hook */
add_action('ftc_before_product_image', 'ftc_template_loop_product_label', 10);
add_action('ftc_before_product_image', 'ftc_template_single_product_video_button', 20);
add_action('ftc_before_product_image', 'ftc_template_video_360', 30);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 0);
add_action('woocommerce_single_product_summary', 'ftc_template_single_navigation', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 2);
add_action('woocommerce_single_product_summary', 'ftc_template_single_availability', 4);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
//add_action('woocommerce_single_product_summary', 'ftc_template_single_sku', 6);
add_action('woocommerce_single_product_summary', 'ftc_template_single_meta', 60);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);
add_action('woocommerce_single_product_summary', 'ftc_template_product_size_chart_button', 80);
if( isset($smof_data['ftc_prod_related']) && $smof_data['ftc_prod_related']){
    add_action( 'ftc_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

add_action('woocommerce_share', 'ftc_template_before_single_social_sharing', 9);
add_action('woocommerce_share', 'ftc_template_after_single_social_sharing', 11);

if (function_exists('ftc_template_loop_time_deals')) {
    add_action('woocommerce_single_product_summary', 'ftc_template_loop_time_deals', 20);
}

add_filter('woocommerce_available_variation', 'ftc_variable_product_price_filter', 10, 3);

add_filter('woocommerce_output_related_products_args', 'ftc_output_related_products_args_filter');

if (!is_admin()) { /* Fix for WooCommerce Tab Manager plugin */
    add_filter('woocommerce_product_tabs', 'ftc_product_remove_tabs', 999);
    add_filter('woocommerce_product_tabs', 'ftc_add_product_custom_tab', 90);
}

add_action('wp_ajax_load_product_size_chart', 'ftc_load_product_size_chart_callback');
add_action('wp_ajax_nopriv_load_product_size_chart', 'ftc_load_product_size_chart_callback');
/* * * End Product ** */

// Single Product Video 
function ftc_template_single_product_video_button() {
    if (wp_is_mobile()) {
        return;
    }
    global $product;
    $video_url = get_post_meta($product->get_id(), 'ftc_prod_video_url', true);
    if ( !empty($video_url) ) {
        echo '<a class="ftc-single-video" href="' . esc_url($video_url) . '"><span class="watch-videos">'.esc_html__('Watch Video','ornaldo').'</span></a>';
        wp_add_inline_script('ftc-global', 'jQuery(document).ready(function( $ ) {
            $("a.ftc-single-video").magnificPopup({
                type: "iframe",
                preloader: false,
                fixedContentPos: false
                });
            });', 'after');
    }
}
/*section add to cart bottom*/
if ( isset($smof_data['ftc_prod_stic_bot']) && $smof_data['ftc_prod_stic_bot']) {
    add_action('wp_footer', 'ftc_section_add_to_cart');
}


function ftc_section_add_to_cart(){
    global $product, $post;
    if(!class_exists('WooCommerce')){
        return ;
    }
    if(is_singular('product') && !$product->is_type( 'variable' ) && !wp_is_mobile() ){

        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ), array(100, 100) );
        ?>
        <section class="ftc-sticky-atc">
            <div class="container">
                <div class="content-product">
                    <div class="images"><img src="<?php echo esc_url($image[0]); ?>"/></div>
                    <div class="description">
                        <div class="title-product">
                            <h4><?php echo wp_kses_post(get_the_title()); ?></h4>
                        </div>
                        <div class="rating">
                            <?php
                            $product = wc_get_product();
                            $rating_count = $product->get_rating_count();
                            $average = $product->get_average_rating();
                            echo wc_get_rating_html( $average, $rating_count ); ?>
                        </div>
                        <div class="price">
                            <?php echo  wp_kses_post($product->get_price_html());?>
                        </div>
                    </div>
                </div>
                <div class="single-add-to-cart">
                    <?php echo wp_kses_post(woocommerce_template_single_add_to_cart() ); ?>
                </div>
            </div>
        </section>
        <?php
    }
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'ftc_template_single_excerpt', 5 );

function ftc_template_single_excerpt(){
    $the_excerpt = get_the_excerpt('');
    $count_des = mb_strlen( $the_excerpt , 'UTF-8');
    if ($count_des >180){
    ?>
    <div class="ftc_excerpt">
      <div class="collapsed-content">     
          <?php  global $more;
            $temp = $more;
            $more = false;
            $short_description = get_the_excerpt('');
            $short_descript = substr($short_description, 0, 180). '...';          
            print_r($short_descript);
            $more = $temp;
            ?>
</div>
<div class="full-content">
      <?php   $full_description = the_excerpt(); ?>
</div>
<a href="#" id="readMore">Read more</a>
<a href="#" id="readless" style="display: none">Read less</a>
    </div>
    <?php
}
else{
    echo  '<div class="collapsed-content">' ;
    echo '<p>'.$the_excerpt. '</p>';
    echo '</div>';
}
}


/*Custom Desciption in Tab*/
add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {

    $tabs['description']['callback'] = 'woo_custom_description_tab_content';
        // Custom description callback
  $tabs['description']['title'] = esc_html( 'Description','ornaldo' );
$tabs['description']['priority'] = 10;
    return $tabs;
}
function woo_custom_description_tab_content($tab) {
    
    $short_description = get_the_content('');
    $count_des = mb_strlen( $short_description , 'UTF-8');
    if ($count_des >110){
    ?>
    <div class="ftc_desciption_tab">
      <div class="desciption_content">     
          <?php  global $more;
            $temp = $more;
            $more = false;
            $short_description = get_the_content('');
            $short_descript = substr($short_description, 0, 300);
            print_r($short_descript);
            $more = $temp;
            ?>
</div>
<div class="description_fullcontent">
      <?php   $full_description = the_content(); ?>
</div>
<a href="#" id="readmore_des">Read more</a>
<a href="#" id="readless_des" style="display: none">Read less</a>
    </div>
    <?php
}
else{
    print_r($short_description);
}
}

function ftc_template_single_navigation() {
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    ?>
    <div class="detail-nav-summary">
        <?php
        if (! empty($prev_post) ) {
            $post_id = $prev_post->ID;
            $product = wc_get_product($post_id);
            ?>
            <a href="<?php echo get_permalink($post_id); ?>" rel="prev">
                <div class="nav-product prev-product">
                    <div class="nav-product__image">
                        <?php echo wp_kses_post($product->get_image()); ?>
                    </div>
                    <div class="nav-product__description">
                        <span class="product-title"><?php echo esc_html($product->get_title()); ?></span>
                        <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                    </div>
                </div>
            </a>
            <?php
        }

        if (! empty($next_post) ) {
            $post_id = $next_post->ID;
            $product = wc_get_product($post_id);
            ?>
            <a href="<?php echo get_permalink($post_id); ?>" rel="next">
                <div class="nav-product next-product">
                 <div class="nav-product__image">
                    <?php echo wp_kses_post($product->get_image()); ?>
                </div>
                <div class="nav-product__description">
                    <span class="product-title"><?php echo esc_html($product->get_title()); ?></span>
                    <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                </div>
            </div>
        </a>
        <?php
    }
    ?>
</div>
<?php
}

function ftc_template_before_single_social_sharing() {
    ?>
    <div class="social-sharing">
        <div class="print">
            <a href="javascript:window.print()" rel="nofollow"><i class="fa fa-print"></i><?php esc_html_e('Print', 'ornaldo') ?></a>
        </div>
        <div class="email">
            <a href="mailto:?subject=<?php echo esc_attr(sanitize_title(get_the_title())); ?>&amp;body=<?php echo esc_url(get_permalink()); ?>">
                <i class="fa fa-envelope"></i>
                <?php esc_html_e('Email to a Friend', 'ornaldo') ?>
            </a>
        </div>
        <ul class="ftc-social-sharing">

            <li class="twitter">
                <a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i> Tweet</a>
            </li>

            <li class="facebook">
                <a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i> Share</a>
            </li>

            <li class="google-plus">
                <a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i> Google+</a>
            </li>

            <li class="pinterest">
                <?php $image_link = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link); ?>" target="_blank"><i class="fa fa-pinterest"></i> Pinterest</a>
            </li>

        </ul>
        <?php
    }

    function ftc_template_after_single_social_sharing() {
        ?>
    </div>
    <?php
}

function ftc_template_single_meta() {
    global $product, $post, $smof_data;

    echo '<div class="content">';
    do_action('woocommerce_product_meta_start');
    if ($smof_data['ftc_prod_cat']) {
        echo wc_get_product_category_list($product->get_id(), ', ', '<div class="caftc-link"><span>' . _n('Category:', 'ornaldo', count($product->get_category_ids()), 'ornaldo') . ' ', '</span><span class="cat-links"></span></div>');
    }
    if ($smof_data['ftc_prod_tag']) {
        echo wc_get_product_tag_list($product->get_id(), ', ', '<div class="tags-link"><span>' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'ornaldo') . ' ', '</span><span class="tag-links"></span></div>');
    }
    do_action('woocommerce_product_meta_end');
    echo '</div>';
}

function ftc_template_single_sku() {
    global $product;
    if (wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type('variable') )) {
        echo '<div class="sku-wrapper product_meta">' . esc_html__('Sku: ', 'ornaldo') . '<span class="sku">' . (( $sku = $product->get_sku() ) ? $sku : esc_html__('N/A', 'ornaldo')) . '</span></div>';
    }
}

function ftc_template_single_availability() {
    global $product;

    $product_stock = $product->get_availability();
    $availability_text = empty($product_stock['availability']) ? esc_html__('In Stock', 'ornaldo') : esc_attr($product_stock['availability']);
    ?>  
    <p class="availability stock <?php echo esc_attr( $product_stock['class'] ); ?>" data-original="<?php echo esc_attr( $availability_text ) ?>" data-class="<?php echo esc_attr($product_stock['class']) ?>"><span><?php echo esc_html($availability_text); ?></span></p> 
    <?php
}
/* Add new hook */
add_action('woocommerce_after_single_product_summary', 'show_cross_sell_in_single_product', 30);
function show_cross_sell_in_single_product(){
    $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);

    if(empty($crosssells)){
        return;
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post__in' => $crosssells
    );
    $products = new WP_Query( $args );
    if( $products->have_posts() ) :
        echo '<div class="ftc-cross-sells"><h2>'.esc_html__('Cross-Sells Products', 'ornaldo').'</h2>';
        woocommerce_product_loop_start();
        while ( $products->have_posts() ) : $products->the_post();
            wc_get_template_part( 'content', 'product' );
endwhile; // end of the loop.
woocommerce_product_loop_end();
echo '</div>';
endif;
wp_reset_postdata();
}
/* Product Size Chart*/
function ftc_template_product_size_chart_button() {
     if (wp_is_mobile()) {
                return;
            }
    global $smof_data, $product,$post;

    $size_chart_image_options = isset($smof_data['ftc_prod_size_chart']['url']) ? esc_url($smof_data['ftc_prod_size_chart']['url']) : '';
    $size_chart_image_product = get_post_meta($product->get_id(), 'ftc_prod_size_chart', true);
    
    $show_size_chart = get_post_meta($post->ID, 'ftc_show_size_chart', true);
    if( $show_size_chart ) {
        if (!empty($size_chart_image_product) || !empty($size_chart_image_options)) {
            $ajax_url = admin_url('admin-ajax.php', is_ssl() ? 'https' : 'http') . '?ajax=true&action=load_product_size_chart&product_id=' . $product->get_id();
            echo '<a class="ftc-size_chart" href="' . esc_url($ajax_url) . '"><i class="fa fa-table"></i> ' . esc_html__('Size Chart','ornaldo') . '</a>';
        }
    }
}

function ftc_load_product_size_chart_callback() {
    global $smof_data, $product;
    if (empty($_GET['product_id'])) {
        wp_die('Invalid Products');
    }

    $prod_id = absint($_GET['product_id']);

    if ($prod_id <= 0) {
        wp_die('Invalid Products');
    }

    $size_chart_image_options = isset($smof_data['ftc_prod_size_chart']['url']) ? esc_url($smof_data['ftc_prod_size_chart']['url']) : '';

    $size_chart_image_product = get_post_meta($prod_id, 'ftc_prod_size_chart', true);
    ob_start();
    if (!empty($size_chart_image_product) && $size_chart_image_product) {
        echo '<div class="product-size-chart"><img src="'.esc_url($size_chart_image_product).'"/></div>';
    }
    elseif (!empty($size_chart_image_options) && $size_chart_image_options) {
        echo '<div class="product-size-chart"><img src="'.esc_url($size_chart_image_options).'"/></div>';
    }
    wp_die(ob_get_clean());
}

/* * * Product tab ** */
function ftc_product_remove_tabs($tabs = array()) {
    global $smof_data;
    if ( !$smof_data['ftc_prod_tabs'] ) {
        return array();
    }
    return $tabs;
}

function ftc_add_product_custom_tab($tabs = array()) {
    global $smof_data, $post;

    $custom_tab_title = $smof_data['ftc_prod_custom_tab_title'];

    $product_custom_tab = get_post_meta($post->ID, 'ftc_prod_custom_tab', true);
    if ($product_custom_tab) {
        $custom_tab_title = get_post_meta($post->ID, 'ftc_prod_custom_tab_title', true);
    }

    if ($smof_data['ftc_prod_custom_tab']) {
        $tabs['ftc_custom'] = array(
            'title' => esc_html($custom_tab_title)
            , 'priority' => 90
            , 'callback' => "ftc_product_custom_tab_content"
        );
    }
    return $tabs;
}

function ftc_product_custom_tab_content() {
    global $smof_data, $post;

    $custom_tab_content = $smof_data['ftc_prod_custom_tab_content'];

    $product_custom_tab = get_post_meta($post->ID, 'ftc_prod_custom_tab', true);
    if ($product_custom_tab) {
        $custom_tab_content = get_post_meta($post->ID, 'ftc_prod_custom_tab_content', true);
    }

    echo do_shortcode(stripslashes(wp_specialchars_decode($custom_tab_content)));
}

/* Related Products */

function ftc_output_related_products_args_filter($args) {
    $args['posts_per_page'] = 6;
    $args['columns'] = 5;
    return $args;
}

/* Always show variable product price if they are same */

function ftc_variable_product_price_filter($value, $object = null, $variation = null) {
    if ($value['price_html'] == '') {
        $value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }
    return $value;
}

/* * * General hook ** */

/* * ***********************************************************
 * Custom group button on product (quickshop, wishlist, compare) 
 * Begin tag:   10000
 * Add To Cart:     10001
 * Wishlist:    10002
 * Compare:     10003
 * Quickshop:   10004
 * End tag:     10005
 * ************************************************************ */
add_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_add_to_cart', 10001); /*group-button*/

function ftc_product_group_button_start() {
    global $smof_data;
    $num_icon = 0;
    if (has_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_add_to_cart') && !$smof_data['ftc_enable_catalog_mode'] && apply_filters('ftc_display_add_to_cart_button_on_thumbnail', true)) {
        $num_icon++;
    }

    echo "<div class=\"group-button-product\" >";
}

function ftc_product_group_button_end() {
    echo "</div>";
}

function ftc_meta_start() {
    echo "<div class='meta_info'>";
}

function ftc_meta_end() {
    echo "</div>";
}

add_action('woocommerce_after_shop_loop_item_title', 'ftc_product_group_button_start', 10000);
add_action('woocommerce_after_shop_loop_item_title', 'ftc_product_group_button_end', 10005);
add_action('woocommerce_after_shop_loop_item', 'ftc_meta_start', 69);
add_action('woocommerce_after_shop_loop_item', 'ftc_meta_end', 100);

if( class_exists('YITH_WCQV_Frontend') ){
    remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
    add_action('woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button'), 100);
    add_action('woocommerce_after_shop_loop_item_title', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button'), 10004);
}

if( ! function_exists('ftc_set_wishlist_cookies') ) {
    function ftc_set_wishlist_cookies($set = true ) {
        if(! function_exists('wc_setcookie') || ! function_exists('YITH_WCWL') ) return;
        $products = YITH_WCWL()->get_products( array(
            #'wishlist_id' => 'all',
            'is_default' => true
        ) );
        if ( $set ) {
            wc_setcookie( 'ftc_items_in_wishlist', 1 );
            wc_setcookie( 'ftc_wishlist_hash', md5( json_encode( $products ) ) );
        } elseif ( isset( $_COOKIE['ftc_items_in_wishlist'] ) ) {
            wc_setcookie( 'ftc_items_in_wishlist', 0, time() - HOUR_IN_SECONDS );
            wc_setcookie( 'ftc_wishlist_hash', '', time() - HOUR_IN_SECONDS );
        }
        do_action( 'ftc_set_wishlist_cookies', $set );
    }
}

/* Wishlist */
if (class_exists('YITH_WCWL')) {

    function ftc_add_wishlist_button_to_product_list() {
        global $product, $yith_wcwl;

        $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists(array('is_default' => true)) : false;
        if (!empty($default_wishlists)) {
            $default_wishlist = $default_wishlists[0]['ID'];
        } else {
            $default_wishlist = false;
        }

        $exists = YITH_WCWL()->is_product_in_wishlist($product->get_id(), $default_wishlist);

        $wishlist_url = YITH_WCWL()->get_wishlist_url();

        $added_class = $exists ? 'added' : '';

        echo '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-' . $product->get_id() . ' ' . $added_class . '">';
        echo '<a href="' . esc_url(add_query_arg('add_to_wishlist', $product->get_id()))
        . '" data-product-id="' . esc_attr($product->get_id()) . '" data-product-type="' . esc_attr($product->get_type())
        . '" class="add_to_wishlist wishlist" ><i class="fa fa-heart-o"></i><span class="ftc-tooltip button-tooltip">' . esc_html__('Wishlist', 'ornaldo') . '</span></a>';
        echo '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/ajax-loader.gif' . '" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />';

        echo '<span class="yith-wcwl-wishlistaddedbrowse hide" style="display: none">';
        echo '<a href="' . esc_url($wishlist_url) . '"><i class="fa fa-heart"></i><span class="ftc-tooltip button-tooltip">' . esc_html__('Wishlist', 'ornaldo') . '</span></a>';
        echo '</span>';

        echo '<span class="yith-wcwl-wishlistexistsbrowse ' . ($exists ? 'show' : 'hide') . '" style="' . ($exists ? '' : 'display: none') . '">';
        echo '<a href="' . esc_url($wishlist_url) . '"><i class="fa fa-heart"></i><span class="ftc-tooltip button-tooltip">' . esc_html__('Wishlist', 'ornaldo') . '</span></a>';
        echo '</span>';

        echo '</div>';
    }

    add_action('woocommerce_after_shop_loop_item_title', 'ftc_add_wishlist_button_to_product_list', 10002);/*group-button*/
    add_action('woocommerce_after_shop_loop_item', 'ftc_add_wishlist_button_to_product_list', 69);/*meta-info*/
}

/* Compare */
if (class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_products_list') == 'yes') {
    global $yith_woocompare;
    $is_ajax = ( defined('DOING_AJAX') && DOING_AJAX );
    if ($yith_woocompare->is_frontend() || $is_ajax) {
        if ($is_ajax) {
            if (defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend')) {
                $compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
                if (file_exists($compare_frontend_class)) {
                    require_once $compare_frontend_class;
                }
            }
            $yith_woocompare->obj = new YITH_Woocompare_Frontend();
        }
        remove_action('woocommerce_after_shop_loop_item', array($yith_woocompare->obj, 'add_compare_link'), 20);

        function ftc_add_compare_button_to_product_list() {
            if (wp_is_mobile())
                return;
            global $yith_woocompare, $product;
            echo '<a class="compare" href="' . esc_url($yith_woocompare->obj->add_product_url($product->get_id())) . '" data-product_id="' . esc_attr($product->get_id()) . '">' . get_option('yith_woocompare_button_text') . '</a>';
        }
        add_action('woocommerce_after_shop_loop_item_title', 'ftc_add_compare_button_to_product_list', 10003);
        add_action('woocommerce_after_shop_loop_item', 'ftc_add_compare_button_to_product_list', 70);

        add_filter('option_yith_woocompare_button_text', 'ftc_compare_button_text_filter', 99);

        function ftc_compare_button_text_filter($button_text) {
            return '<i class="fa fa-retweet"></i><span class="ftc-tooltip button-tooltip">' . esc_html($button_text) . '</span>';
        }

    }
}
/* Compare - Add custom style */
if (isset($_GET['action']) && $_GET['action'] == 'yith-woocompare-view-table') {
    add_action('wp_head', 'ftc_add_custom_style_compare_popup');
}

function ftc_add_custom_style_compare_popup() {
    global $smof_data;
    echo '<link rel="stylesheet" type="text/css" media="all" href="' . esc_url(get_template_directory_uri()) . '/assets/css/default.css" />';
    echo '<link rel="stylesheet" type="text/css" media="all" href="' . esc_url(get_template_directory_uri()) . '/style.css" />';
    echo '<link rel="stylesheet" type="text/css" media="all" href="' . esc_url(get_template_directory_uri()) . '/assets/css/font-awesome.css" />';
}

/* * * End General hook ** */

/* * * Cart - Checkout hooks ** */
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display', 10);

add_action('woocommerce_proceed_to_checkout', 'ftc_cart_continue_shopping_button', 20);

/* Continue Shopping button */

function ftc_cart_continue_shopping_button() {
    echo '<a href="' . esc_url(wc_get_page_permalink('shop')) . '" class="button button-secondary">' . esc_html__('Continue Shopping', 'ornaldo') . '</a>';
}
global $smof_data;
if(isset( $smof_data['ftc_enable_glt'] ) && $smof_data['ftc_enable_glt'] ){
    add_action('wp', 'carna_setup_gridlist', 20);
}
function carna_setup_gridlist(){
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
        add_action( 'wp_enqueue_scripts', 'carna_setup_scripts_script', 20);
        add_action( 'woocommerce_before_shop_loop','carna_gridlist_toggle_button', 10);
    }
}
function carna_gridlist_toggle_button() {
    global $smof_data;
    if( isset($smof_data['ftc_enable_glt']) && $smof_data['ftc_enable_glt'] ){
        ?>
        <nav class="grid_list_nav">
            <a href="#" id="grid" title="<?php  echo esc_html_e('Grid view', 'ornaldo'); ?>">&#8862; <span><?php echo esc_html__('Grid view', 'ornaldo'); ?></span>
                <svg version="1.1" id="Layer_1" class="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <rect width="5" height="5"></rect> <rect x="7" width="5" height="5"></rect> <rect x="14" width="5" height="5"></rect> <rect y="7" width="5" height="5"></rect> <rect x="7" y="7" width="5" height="5"></rect> <rect x="14" y="7" width="5" height="5"></rect> <rect y="14" width="5" height="5"></rect> <rect x="7" y="14" width="5" height="5"></rect> <rect x="14" y="14" width="5" height="5"></rect> </svg>
            </a>
            <a href="#" id="columns4" title="<?php echo esc_html_e('Grid-4-columns', 'ornaldo'); ?>">&#8863; <span><?php echo esc_html__('Grid 4 Columns', 'ornaldo'); ?></span>
                <svg version="1.1" id="Layer_1" class="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <rect width="4" height="4"></rect> <rect x="5" width="4" height="4"></rect> <rect x="10" width="4" height="4"></rect> <rect x="15" width="4" height="4"></rect> <rect y="5" width="4" height="4"></rect> <rect x="5" y="5" width="4" height="4"></rect> <rect x="10" y="5" width="4" height="4"></rect> <rect x="15" y="5" width="4" height="4"></rect> <rect y="15" width="4" height="4"></rect> <rect x="5" y="15" width="4" height="4"></rect> <rect x="10" y="15" width="4" height="4"></rect> <rect x="15" y="15" width="4" height="4"></rect> <rect y="10" width="4" height="4"></rect> <rect x="5" y="10" width="4" height="4"></rect> <rect x="10" y="10" width="4" height="4"></rect> <rect x="15" y="10" width="4" height="4"></rect> </svg>
            </a>
            <a href="#" id="list" title="<?php echo esc_html_e('List view', 'ornaldo'); ?>">&#8863; <span><?php echo esc_html__('List view', 'ornaldo'); ?></span>
                <svg version="1.1" id="list-view" class="svg" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18" height="18" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve">
                    <rect x="0" width="3" height="2" ></rect>
                    <rect x="5" width="18" height="2"></rect>
                    <rect x="0" y="16" width="3" height="2" ></rect>
                    <rect y="16" x="5" width="18" height="2"></rect>
                    <rect x="0" y="8" width="3" height="2" ></rect>
                    <rect y="8" x="5" width="18" height="2"></rect>
                </svg>
            </a>
        </nav>
        <?php
    }
}
function carna_setup_scripts_script()
    {
        wp_enqueue_script('cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array('jquery'), null, true);
        add_action('wp_footer', 'carna_gridlist_set_default_view');
    }



    function carna_gridlist_set_default_view()
    {
        global $smof_data;
        $default = $smof_data['ftc_glt_default'];
        if (!$default) {
            $default = 'grid';
        }
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            "use strict";
            if ( typeof jQuery.cookie == 'function' && jQuery.cookie('gridcookie') == null ) {
                jQuery('#main-content div.products').addClass('<?php echo esc_js($default); ?>');
                jQuery('.grid_list_nav #<?php echo esc_js($default); ?>').addClass('active');
            }

            if( typeof jQuery.cookie == 'function' ){
                jQuery('#grid').on("click",function() {
                    if( jQuery(this).hasClass('active') ){
                        return false;
                    }
                    jQuery(this).addClass('active');
                    jQuery('#list').removeClass('active');
                    jQuery('#columns4').removeClass('active');
                    jQuery.cookie('gridcookie','grid', { path: '/' });
                    jQuery('#main-content div.products').fadeOut(300, function() {
                        jQuery(this).addClass('grid').removeClass('list').removeClass('columns4').fadeIn(300);
                    });
                    return false;
                });

                jQuery('#list').on("click",function() {
                    if( jQuery(this).hasClass('active') ){
                        return false;
                    }
                    jQuery(this).addClass('active');
                    jQuery('#grid').removeClass('active');
                    jQuery('#columns4').removeClass('active');  
                    jQuery.cookie('gridcookie','list', { path: '/' });
                    jQuery('#main-content div.products').fadeOut(300, function() {
                        jQuery(this).removeClass('grid').addClass('list').removeClass('columns4').fadeIn(300);
                    });
                    return false;
                });


                jQuery('#columns4').click(function() {
                    if( jQuery(this).hasClass('active') ){
                        return false;
                    }
                    jQuery(this).addClass('active');
                    jQuery('#grid').removeClass('active');
                    jQuery('#list').removeClass('active');
                    jQuery.cookie('gridcookie','columns4', { path: '/' });
                    jQuery('#main-content div.products').fadeOut(300, function() {
                        jQuery(this).removeClass('list').addClass('columns4').fadeIn(300);
                    });
                    return false;
                });
                
                if( jQuery.cookie('gridcookie') ){
                    jQuery('#main-content div.products, #grid_list_nav').addClass(jQuery.cookie('gridcookie'));
                }

                    if( jQuery.cookie('gridcookie') == 'grid' ){
                    jQuery('.grid_list_nav #grid').addClass('active');
                    jQuery('.grid_list_nav #list').removeClass('active');
                    jQuery('.grid_list_nav #columns4').removeClass('active');

                }

                if( jQuery.cookie('gridcookie') == 'list' ){
                    jQuery('.grid_list_nav #list').addClass('active');
                    jQuery('.grid_list_nav #grid').removeClass('active');
                    jQuery('.grid_list_nav #columns4').removeClass('active');
                }

                if( jQuery.cookie('gridcookie') == 'columns4' ){
                    jQuery('.grid_list_nav #columns4').addClass('active');
                    jQuery('.grid_list_nav #list').removeClass('active');
                    jQuery('.grid_list_nav #grid').removeClass('active');
                }

                    jQuery('#grid_list_nav a').on('click',function (event) {
                        event.preventDefault();
                    });
                }
            });
        </script>
        <?php
    }

/* Product  360 */
add_action('ftc_before_product_image', 'ftc_template_video_360', 30);
function ftc_template_video_360() {
    global $post;

    $gallery_ids = get_post_meta($post->ID, 'ftc_product360', true);
    if (empty($gallery_ids)) {
        return;
    }
    $gallery_ids = explode(',', $gallery_ids);
    if( is_array($gallery_ids) && has_post_thumbnail() ){
        array_unshift($gallery_ids, get_post_thumbnail_id());
    }
    $frames_count = count( $gallery_ids );
    $images_js_string = '';
    ?>
    <a class="ftc-video360" href="#product-360">Video 360</a>
    <div id="product-360" class="product-360 mfp-hide">
        <div class="threesixty threesixty-product-360">
            <ul class="threesixty_images">
                <?php $i=0; foreach( $gallery_ids as $gallery_id ): $i++;  ?>
                <?php
                $img = wp_get_attachment_image_src( $gallery_id, 'full' );
                $width = $img[1];
                $height = $img[2];
                $images_js_string .= "'" . $img[0] . "'";
                if( $i < $frames_count ) {
                    $images_js_string .= ","; 
                }
                ?>
            <?php endforeach; ?>
        </ul>
        <div class="spinner">
            <span>0%</span>
        </div>
    </div>
</div>
<?php
wp_add_inline_script('ftc-global', 'jQuery(document).ready(function( $ ) {
            $(".threesixty-product-360").ThreeSixty({
                totalFrames: ' . esc_js( $frames_count ) . ',
                endFrame: ' . esc_js( $frames_count ) . ',
                currentFrame: 1,
                imgList: ".threesixty_images",
                progress: ".spinner",
                imgArray: ' . "[".$images_js_string."]" . ',
                height: ' . esc_js( $height ) . ',  
                width: ' . esc_js( $width ) . ',
                responsive: true,
                navigation: true
            });
        });', 'after');
}
/*end product 360 */
function ftc_loadmore_shop() {
    ?>
    <button class="onewave-products-load-more hidden">
        <span class="load-more"><?php esc_html_e('Load more', 'ornaldo'); ?></span>
    </button> 
    <span class="page-load-status">
        <p class="infinite-scroll-request"><?php esc_html_e('Loading...', 'ornaldo'); ?></p>
        <p class="infinite-scroll-last"><?php esc_html_e('No Products for load', 'ornaldo'); ?></p>
    </span>
    <?php
}
add_action('woocommerce_after_shop_loop', 'ftc_loadmore_shop');
add_action('woocommerce_after_shop_loop', 'ftc_loadmore_shop_ajax');
function ftc_loadmore_shop_ajax(){
    global $smof_data;
    if(isset($smof_data['ftc_loadmore_button_infinite']) && $smof_data['ftc_loadmore_button_infinite']){
        echo '<div class="button-loadmore-ajax">';
        echo '<a class="ftc-load-more-button-shop">'.esc_html__('Load more products', 'ornaldo').'<span class="ftc-loading-shop">';
        echo '<p>'.esc_html__('Loading', 'ornaldo').'</p><div class="line"></div><div class="line"></div><div class="line"></div>';
        echo '</span></a>' ;
        echo '</div>';
    }
}


if( isset($smof_data['ftc_Infinite_scroll']) && $smof_data['ftc_Infinite_scroll'] != 0 ) {
    add_filter( 'body_class', function( $classes ) {
        return array_merge( $classes, array( 'infinite' ) );
    } );
}