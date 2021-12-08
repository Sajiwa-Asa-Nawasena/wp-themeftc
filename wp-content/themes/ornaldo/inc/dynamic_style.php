<?php 
global $smof_data;
if( !isset($data) ){
	$data = $smof_data;
}

$data = ftc_array_atts(
   array(
    /* FONTS */
    'ftc_body_font_enable_google_font'					=> 1
    ,'ftc_body_font_family'								=> "Arial"
    ,'ftc_body_font_google'								=> "Montserrat"

    ,'ftc_secondary_body_font_enable_google_font'		=> 1
    ,'ftc_secondary_body_font_family'					=> "Arial"
    ,'ftc_secondary_body_font_google'					=> "Raleway"

    /* COLORS */
    ,'ftc_primary_color'									=> "#cd5f49"

    ,'ftc_secondary_color'								=> "#444444"

    ,'ftc_body_background_color'								=> "#ffffff"
    /* RESPONSIVE */
    ,'ftc_responsive'									=> 1
    ,'ftc_layout_fullwidth'								=> 0
    ,'ftc_enable_rtl'									=> 0

    /* FONT SIZE */
    /* Body */
    ,'ftc_font_size_body'								=> 13
    ,'ftc_line_height_body'								=> 20

    /* Custom CSS */
    ,'ftc_custom_css_code'								=> ''
), $data);		

$data = apply_filters('ftc_custom_style_data', $data);

extract( $data );

/* font-body */
if( $data['ftc_body_font_enable_google_font'] ){
	$ftc_body_font				= $data['ftc_body_font_google']['font-family'] ;
}
else{
	$ftc_body_font				= $data['ftc_body_font_family'];
}

if( $data['ftc_secondary_body_font_enable_google_font'] ){
	$ftc_secondary_body_font		= $data['ftc_secondary_body_font_google']['font-family'] ;
}
else{
	$ftc_secondary_body_font		= $data['ftc_secondary_body_font_family'];
}

?>	

/*
1. FONT FAMILY
2. GENERAL COLORS
*/


/* ============= 1. FONT FAMILY ============== */

body{
line-height: <?php echo esc_html($ftc_line_height_body)."px"?>;
}

html, 
body,.widget-title.heading-title,
.widget-title.product_title,.newletter_sub_input .button.button-secondary,
.bottommid12 ul li a,
#mega_main_menu.primary ul li .mega_dropdown > li.sub-style > .item_link .link_text
,  .item-description .product_title, .item-description .price,
.woocommerce div.product .product_title, .blogs article h3.product_title, .list-posts .post-info .entry-title
, .content_title p, .newsletter-footer p.submit-footer, .single-post article .post-info .entry-title,
#comments .comments-title, .text_service p, 
.woocommerce div.product p.price, 
.woocommerce.widget_shopping_cart .total strong,
.category16 span.sub-product-categories a,
.mobile-wishlist .ftc-my-wishlist a,
section.widget-container.widget_categories ul li,
.ftc-shop-cart p, .site-footer .infomid h2.widgettitle
,.elementor-element.text-bring-h20 h2.text-heading1-h20
,span.text-img1
,.ftc-element-testimonial.style_6 h2.heading-testi,
.elementor-element.count-down-h21 .ftc-countdown-element .items .ftc-number,
.elementor-element.count-down-h21 .ftc-countdown-element .itemsspan.ftc-label,
.elementor-element.testi-home21 .ftc-element-testimonial.style_6 h4.name a,
.ftc-elements-blogs.style_5 .post-text h4 a,
.ftc-blogs-slider.style_v6 .blogs-slider .post-text h4 a,
span.text-img-h22,
span.text-bring-h22,
.ftc-blogs-slider.style_v4 .post-text a.ftc-readmore,
span.text-bring-h23,
.text-number-h23 h4,
.text-number2-h23 h4,
.ftc-variation .woocommerce .products .ftc-product.product.variable .item-description form.variations_form .single_variation_wrap .woocommerce-variation-price span.price bdi{
  font-family: <?php echo esc_html($ftc_body_font) ?>;
}
.widget_recently_viewed_products ul.product_list_widget span.price span,
.ftc-off-canvas-cart p.woocommerce-mini-cart__buttons.buttons > a.button.wc-forward
{
  font-family: <?php echo esc_html($ftc_body_font) ?> !important;
}

#mega_main_menu.primary ul li .mega_dropdown > li.sub-style > ul.mega_dropdown,
#mega_main_menu li.multicolumn_dropdown > .mega_dropdown > li .mega_dropdown > li,
#mega_main_menu.primary ul li .mega_dropdown > li > .item_link .link_text,
.info-open,
.info-phone,
.ftc-sb-account .ftc_login > a,
.ftc-sb-account,
.dropdown-button span > span,
body p,
.wishlist-empty,
div.product .social-sharing li a,
.ftc-search form,
.conditions-box,
.testimonial-content .info,
.testimonial-content .byline,
.widget-container ul.product-categories ul.children li a,
.ftc-products-category ul.tabs li span.title,
.woocommerce-pagination,
.woocommerce-result-count,
.woocommerce .products.list .product h3.product-name > a,
.woocommerce-page .products.list .product h3.product-name > a,
.woocommerce .products.list .product .price .amount,
.woocommerce-page .products.list .product .price .amount,
.products.list .short-description.list,
div.product .single_variation_wrap .amount,
div.product div[itemprop="offers"] .price .amount,
.orderby-title,
.blogs .post-info,
.blog .entry-info .entry-summary .short-content,
.single-post .entry-info .entry-summary .short-content,
.single-post article .post-info .info-category,
#comments .comment-metadata a,
.post-navigation .nav-previous,
.post-navigation .nav-next,
.woocommerce-review-link,
.ftc_feature_info,
.woocommerce div.product p.stock,
.woocommerce div.product .summary div[itemprop="description"],
.woocommerce div.product .woocommerce-tabs .panel,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce div.product form.cart .group_table td.price,
footer,
footer a,
.blogs article .image-eff:before,
.blogs article a.gallery .owl-item:after,
.header-language, .header-currency,
a.ftc-checkout-menu, .custom_content, .woocommerce .product   .item-description .meta_info a
, .intro-bottom .content_intro, .ftc-breadcrumb-title .ftc-breadcrumbs-content,
.woocommerce .woocommerce-ordering .orderby, .woocommerce-page .woocommerce-ordering .orderby
, article a.button-readmore, .contact_info_map .info_contact .info_column ul li,
.woocommerce div.product div.summary p.cart a, .woocommerce div.product form.cart .button,
.feature_home1 a.slide-button, .summary .woocommerce-product-details__short-description ,
.pp_woocommerce div.product form.cart .group_table td.label,
.pp_woocommerce div.product form.cart .button,
.ftc-enable-ajax-search .ftc-search-meta.item-description a.product_title,
.ftc-enable-ajax-search .ftc-search-meta .price,
.vcard.author, .caftc-link, .tags-link, .date-time.date-time-meta, .full-content, a.tini-wishlist,
.tabh7 .item-description .product_title.product-name, .deal-h7 h3.product_title.product-name a,
.deal-h7 .short-description, .header-layout7 .cart-number,  .text_ban7 h4
, .cookies-info-text , .collapsed-content,
.newproduct16 h3.product_title.product-name
,.ftc-product-tabs.style_9 .woocommerce .product .images ,.group-button-product span.ftc-tooltip.button-tooltip
,.ftc-product-tabs.style_9 .ftc-product .item-description .product_title
,.ftc-product-tabs.style_9 .ftc-product .item-description .price
,.ftc-element-testimonial.style_6 .testimonial-content .infomation
,.ftc-element-testimonial.style_6 .testimonial-content h4.name
, .header-home-20 .elementor-element.elementor-widget-ftc_account_header .ftc_login span,
.ftc-header-template.header-home-20 .ftc-cart-tini .cart-total,
.header-home-20 .elementor-element.elementor-widget-ftc_language_switch,
.header-home-20 .elementor-element.elementor-widget-ftc_currency_switch,
.elementor-column.elementor-element.blog-h21 .post-text p,
.ftc_products_slider.style_1 .woocommerce .product .item-description .product_title a,
.ftc_products_slider.style_1 .woocommerce div.product span.price,
.ftc-elements-blogs.style_5 .post-text .meta span.published,
.ftc-blogs-slider.style_v6 .blogs-slider .post-text .meta span.published,
.ftc-elements-blogs.style_5 .post-text a,
.ftc-blogs-slider.style_v6 .blogs-slider .post-text a,
.ftc-blogs-slider.style_v4 .post-text .meta span.published,
.ftc-product-grid.style_2.woocommerce .product .item-description h3.product_title a,
.ftc-product-grid.style_2.woocommerce div.product span.price,
.ftc-element-testimonial.style_1 .swiper-wrapper .item .infomation,
.ftc-blogs-slider.style_v5 .blogs-slider .post-text .meta,
a.lang_sel_sel.icl-en,
a.wcml_selected_currency,
.ftc_products_slider.style_2 .woocommerce .products .product .item-description .product-categories a,
.ftc_products_slider.style_2 .woocommerce .products .product .item-description h3.product_title a,
.ftc_products_slider.style_2 .woocommerce .products .product .item-description span.price{
  font-family: <?php echo esc_html($ftc_secondary_body_font) ?>;
}
body,
.site-footer,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce .product .conditions-box span,
.item-description .meta_info .yith-wcwl-add-to-wishlist a,  .item-description .meta_info .compare,
.info-company li i,
.social-icons .ftc-tooltip:before,
.tagcloud a,
.details_thumbnails .owl-nav > div:before,
div.product .summary .yith-wcwl-add-to-wishlist a:before,
.pp_woocommerce div.product .summary .compare:before,
.woocommerce div.product .summary .compare:before,
.woocommerce-page div.product .summary .compare:before,
.woocommerce #content div.product .summary .compare:before,
.woocommerce-page #content div.product .summary .compare:before,
.woocommerce div.product form.cart .variations label,
.woocommerce-page div.product form.cart .variations label,
.pp_woocommerce div.product form.cart .variations label,
blockquote,
.ftc-number h3.ftc_number_meta,
.woocommerce .widget_price_filter .price_slider_amount,
.wishlist-empty,
.woocommerce div.product form.cart .button,
.woocommerce table.wishlist_table
{
    font-size: <?php echo esc_html($ftc_font_size_body) ?>px;
}
/* ========== 2. GENERAL COLORS ========== */
/* ========== Primary color ========== */
.header-currency:hover .ftc-currency > a,
.ftc-sb-language:hover li .ftc_lang,
.woocommerce a.remove:hover,
.dropdown-container .ftc_cart_check > a.button.view-cart:hover,
.ftc-my-wishlist a:hover,
.ftc-sb-account .ftc_login > a:hover,
.header-currency .ftc-currency ul li:hover,
.dropdown-button span:hover,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a:hover,
#mega_main_menu.primary > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link:hover *,
#mega_main_menu.primary > .menu_holder.sticky_container > .menu_inner > ul > li.current-menu-item > .item_link *,
.ftc-mobile-wrapper #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item:before,
.ftc-mobile-wrapper #mega_main_menu.primary > .menu_holder > .menu_inner > ul > .current-menu-ancestor:first-child:before,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link *,
#mega_main_menu.primary .mega_dropdown > li > .item_link:hover *,
#mega_main_menu.primary .mega_dropdown > li.current-menu-item > .item_link *,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link *,
.woocommerce .products .product .price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating,
.star-rating:before,
div.product div[itemprop="offers"] .price .amount,
div.product .single_variation_wrap .amount,
.pp_woocommerce .star-rating:before,
.woocommerce .star-rating:before,
.woocommerce-page .star-rating:before,
.woocommerce-product-rating .star-rating span,
ins .amount,
.ftc-meta-widget .price ins,
.ftc-meta-widget .star-rating,
.ul-style.circle li:before,
.woocommerce form .form-row .required,
.blogs .comment-count i,
.blog .comment-count i,
.single-post .comment-count i,
.single-post article .post-info .info-category .cat-links a,
.single-post article .post-info .info-category .vcard.author a,
.ftc-breadcrumb-title .ftc-breadcrumbs-content,
.ftc-breadcrumb-title .ftc-breadcrumbs-content span.current,
.ftc-breadcrumb-title .ftc-breadcrumbs-content a:hover,
.grid_list_nav a.active,
.ftc-quickshop-wrapper .owl-nav > div.owl-next:hover,
.ftc-quickshop-wrapper .owl-nav > div.owl-prev:hover,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-color-orange .vc_icon_element-icon,
.comment-reply-link .icon,
body table.compare-list tr.remove td > a .remove:hover:before,
a:hover,
a:focus,
.vc_toggle_title h4:hover,
.vc_toggle_title h4:before,
.blogs article h3.product_title a:hover,
article .post-info a:hover,
article .comment-content a:hover,
.main-navigation li li.focus > a,
.main-navigation li li:focus > a,
.main-navigation li li:hover > a,
.main-navigation li li a:hover,
.main-navigation li li a:focus,
.main-navigation li li.current_page_item a:hover,
.main-navigation li li.current-menu-item a:hover,
.main-navigation li li.current_page_item a:focus,
.main-navigation li li.current-menu-item a:focus,.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a, article .post-info .cat-links a,article .post-info .tags-link a,
.vcard.author a,article .entry-header .caftc-link .cat-links a,.woocommerce-page .products.list .product h3.product-name a:hover,
.woocommerce .products.list .product h3.product-name a:hover,
.tp-leftarrow.tparrows:before, #mega_main_menu.primary .mega_dropdown > li.current-menu-item > .item_link *, 
#mega_main_menu.primary .mega_dropdown > li > .item_link:focus *,
#mega_main_menu.primary .mega_dropdown > li > .item_link:hover *,
#mega_main_menu.primary li.post_type_dropdown > .mega_dropdown > li > .processed_image:hover > .cover > a > i,
.ftc-shoppping-cart a.ftc_cart:hover, .header-currency ul li:hover,
.header-language a.lang_sel_sel.icl-en:hover, .header-currency a.wcml_selected_currency:hover,
ul.product_list_widget li > a:hover, h3.product-name > a:hover	,
.intro-box:hover, .owl-nav .owl-next,.counter-wrapper > div .number-wrapper .number,
.newsletter-footer input[type="submit"]:hover, footer a:hover, .ftc-footer .copy-com a:hover,
.ftc-sidebar > .widget-container.ftc-product-categories-widget .ftc-product-categories-list ul li.active > a, 
.ftc-sidebar > .widget-container.ftc-product-categories-widget .ftc-product-categories-list ul li > a:hover
, .widget-container ul > li a:hover, .widget-container.widget_categories ul li:hover,
.contact_info_map ul li a:hover, .woocommerce-info::before , .woocommerce-message::before,
span.author:hover, .comment-meta a:hover, a.comment-edit-link:hover,
.footer-mobile > div > a:hover,.footer-mobile > div .ftc-my-wishlist:hover *,
.footer-mobile > div .ftc-my-wishlist i,.footer-mobile > div > a i,
.ftc-shop-cart .ftc-shoppping-cart .dropdown-container .woocommerce-Price-amount,
.woocommerce table.shop_table td .woocommerce-Price-amount,
.ftc-shop-cart .ftc-shoppping-cart a.ftc_cart:hover,
.widget_recently_viewed_products ul.product_list_widget span.price .woocommerce-Price-amount,
.ftc-mobile-wrapper ul#mega_main_menu_ul > li.menu-item-has-children > a.item_link:hover span.link_text:before,
body .dokan-pagination-container .dokan-pagination li a:hover,
body .dokan-pagination-container .dokan-pagination li.active a,
.nav-right .ftc-my-wishlist a.tini-wishlist:hover i,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link .link_text:hover,
.nav-right .ftc-my-wishlist a.tini-wishlist:hover span,
p.woocommerce-mini-cart__buttons.buttons > a.button.wc-forward:hover,
.off-can-vas-inner span.woocommerce-Price-amount.amount,
.ftc-mobile-wrapper .ftc-search button.search-button:hover, .newsletterpopup .close-popup:hover:after,
span.number, .watch-videos:hover, .nav-right a.ftc-checkout-menu:hover, .header-layout7 .search-button::after, h2.numberh7, .footmidh7 .info-company li i, .infomid .widget.widget_tag_cloud .tagcloud a:hover, .header-layout7 .cart-total:hover, .footmidh7 .text-noi:hover,
.dokan-category-menu #cat-drop-stack > ul li.parent-cat-wrap a:hover, .ftc-mobile-wrapper .menu-text .btn-toggle-canvas.btn-danger:hover i, cart-number:hover,
.ftc-portfolio-wrapper .portfolio-inner .item .figcaption h3 a:hover, .single-portfolio .info-content h2.entry-title:hover ,.ftc-portfolio-wrapper .filter-bar li.current, .ftc-portfolio-wrapper .filter-bar li:hover, .deal-h7 .btnh7 .ftc-sb-button:hover a, #dokan-seller-listing-wrap ul.dokan-seller-wrap li .store-content .store-info .store-data h2 a:hover, .bannerh7 .wpb_wrapper .ftc-sb-button a:hover, .btn-foot-top .btnh7 a.ftc-button:hover,
.ftc-single-video:before, .hotsp1 a.link-hp, .hotsp1 h2:hover, .slide_lb .tparrows:before,
.ftc_search_ajax span.woocommerce-Price-amount.amount, .single-portfolio .related .blogs.owl-carousel .owl-nav >div
, .ftc_excerpt a:hover,
.clientsay12.ftc-sb-testimonial .name a:hover,
.clientsay12.ftc-sb-testimonial .owl-item.active.center .testimonial-content .name a:hover ,
.bottommid12 ul.tittle li:hover a,
.header-layout8 .ftc-sb-account .ftc_login a.my-account:before,
.header-layout8 i.fa.fa-heart,
.header-layout8 .ftc-checkout-menu:before,
.header-layout8 .ftc-sb-account .ftc_login > a:hover,
.header-layout8 a.ftc-checkout-menu:hover,
.header-layout8 .ftc-tini-cart:before,
.header-layout8 a.ftc-cart-tini.cart-item-canvas:before,
.header-layout8 button.search-button,
.header-layout9 .ftc-sb-account .ftc_login a.my-account:before,
.header-layout9 .ftc-checkout-menu:before,
.header-layout9 .ftc-sb-account .ftc_login > a:hover,
.header-layout9 a.ftc-checkout-menu:hover,
.header-layout9 .ftc-tini-cart:before,
.header-layout9 a.ftc-cart-tini.cart-item-canvas:before,
.header-layout9 button.search-button,
.blog12 span.vcard.author a:hover,
.bloghome12 .blogs article h3.product_title a:hover,
.header-layout8 .cart-total:hover,
.header-layout8 .mobile-button .fa-bars:before,
.header-layout9 .mobile-button .fa-bars:before,
.header-layout8 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.header-layout8 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.header-layout9 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.header-layout9 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.header-layout11 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.header-layout11 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.header-layout10 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.header-layout10 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.bloghome15 .blog12 .blogs article h3.product_title a:hover,
.regitter16 .father p a,
.newproduct16 .fa-eye:before,
.newproduct16 .fa-heart-o:before,
.newproduct16 .fa-heart:before,
.newproduct16 .fa-retweet:before,
.time16 .report16 i.fa.fa-file-alt:before,
.time16 .timeclock16 i.fa.fa-clock:before,
.footer-bot16 span.company,
.banner16 .test1 p a:hover,
.banner16 .test2 p a:hover,
.woocommerce .newproduct16 .product .conditions-box .onsale,
.footer-middle-16 ul.bullet li a:hover,
.header-layout8 .price-total,
.header-layout9 .price-total,
.newproduct16 .product .images .group-button-product > div a.button.add_to_cart_button,
.newproduct16 .product .images .group-button-product > div a.added_to_cart,
.newproduct16 .product .images .group-button-product > a.compare.added,
footer .footer-top16 .social-icons li i:hover:before,
.footer-middle-16 ul.bullet li:hover a:before,
.widget-container.ftc-product-categories-widget ul.product-categories li.cat-parent > span.icon-toggle:hover,
.header6 button.search-button:hover,
.header6 a.ftc-cart-tini.cart-item-canvas:hover,
.header6 a.ftc-cart-tini.cart-item-canvas:hover:before,
.mobile-button:hover,
.header-content a.ftc-cart-tini.cart-item-canvas:hover:before,
.header-content a.ftc-cart-tini.cart-item-canvas:hover,
.header-layout10 .mobile-button:hover .fa-bars:before,
.ftc-mobile-wrapper ul#mega_main_menu_ul > li.menu-item-has-children:hover:before,
#swipebox-close:hover:after,
.header-layout10 a.ftc-cart-tini.cart-item-canvas:hover,
.header-layout10 a.ftc-cart-tini.cart-item-canvas:hover:before, 
.dokan-store-widget h3:hover:after,
.header-layout9 i.fa.fa-heart,
span.text-themeftc,
.header-home-20 .elementor-element.elementor-widget-ftc_header_checkout a:hover,
.header-home-20 .elementor-element.elementor-widget-ftc_wishlist_header a:hover,
.header-home-20 .elementor-element.elementor-widget-ftc_account_header a:hover,
.navigation-slider.style_3 .nav-next:hover:before,
.navigation-slider.style_3 .nav-prev:hover:before,
.navigation-slider.style_4 .nav-next:hover,
.navigation-slider.style_4 .nav-prev:hover,
.ftc-element-testimonial.style_1 .navigation-slider.style_4 .nav-prev:hover,
.ftc-header-template.header-home-23 .header-menu-h20 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link .link_text:hover,
.ftc-header-template.header-home-23  button.search-button:hover,
.ftc-header-template.header-home-23 .header-menu-h20 #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_ancestor > .item_link .link_text,
.header-left-element .elementor-widget-ftc_language_switch .lang_sel_click > ul > li > a:hover,
.header-element-right .elementor-element.elementor-widget-ftc_account_header a:hover,
.header-element-right .elementor-element.elementor-widget-ftc_wishlist_header a:hover,
.header-element-right .elementor-element.elementor-widget-ftc_header_checkout a:hover,
.ftc-footer .copy-com a:hover,
.rtl .header6 .search-button:hover:after,
 .grid_list_nav a.active,
.elementor .elementor-element.icon-e-commerce-h20 .elementor-icon-box-wrapper:hover .elementor-icon-box-title,
 .ftc-simple li:hover > a > .sub-arrow,
 .elementor-widget-ftc_language_switch .lang_sel_click > ul > li > ul > li:hover, .wcml_currency_switcher ul li:hover,
a.ftc-cart-tini.cart-item-canvas:hover:before, 
a.ftc-cart-tini:hover:before,
.navigation-slider.style_2 .nav-next:hover:before,
.navigation-slider.style_2 .nav-prev:hover:before,
.ftc-blogs-slider.style_v2 .blogs-slider .inner-wrap a:hover,
.ftc-elements-blogs-timeline .ftc-blogs .post-text h4 a:hover,
.widget-container.ftc-product-categories-widget ul.product-categories li a:hover,
.icon-list-h1e .elementor-element.elementor-widget-icon-box:hover h3.elementor-icon-box-title > span,
.icon-list-h1e .elementor-element.elementor-widget-icon-box:hover .elementor-icon-box-icon i,
.woocommerce table.shop_table td.product-name a:hover,
.woocommerce table.shop_table td.product-add-to-cart a span.ftc-tooltip.button-tooltip:hover{
    color: <?php echo esc_html($ftc_primary_color) ?>;
}
nav.grid_list_nav a.active svg rect, nav.grid_list_nav a:hover svg rect{
  fill: <?php echo esc_html($ftc_primary_color) ?>;
}
.newproduct16 .woocommerce .product .images .group-button-product > div a:before,
.woocommerce a.remove:hover, body table.compare-list tr.remove td > a .remove:hover:before,
.blogfoooter16 section#ftc_blogs-66 a.post-title:hover,
.ftc-mobile-wrapper .mobile-wishlist .ftc-my-wishlist a:hover,
.ftc-mobile-wrapper .mobile-account a:hover,
.ftc-mobile-wrapper .mobile-wishlist .ftc-my-wishlist a:hover span,
.header-layout8 button.search-button:hover,
.header-layout9 button.search-button:hover,
.productwidget16 span.woocommerce-Price-amount.amount,
.slider12 .tparrows:before,
.navi.tp-leftarrow.tparrows:before,
.navi7.tparrows:before,
h3.product_title.product-name a:hover , .btn-db .ftc-sb-button a:hover, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor:hover > .item_link *,
.header-layout8 .ftc-search-product button.search-button{
   color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
#swipebox-arrows a:hover,
.ftc-shop-cart a.ftc-cart-tini.cart-item-canvas:hover span.cart-number,
.clientsay12 .owl-nav .owl-next:hover,
.bannerh6 .img_ct .owl-nav > div:hover,
.elementor-element.footer-mail-form .mc4wp-form:hover input[type="submit"],
.ftc-shop-cart a.ftc-cart-tini.cart-item-canvas:hover .cart-number:first-child,
 .woocommerce .product .item-description .meta_info .add-to-cart:hover a.added_to_cart.wc-forward:after,
 .wpb_widgetised_column.wpb_content_element .widget_tag_cloud .tagcloud a.tag-cloud-link{
background-color: <?php echo esc_html($ftc_primary_color) ?>;
}

.clientsay12 .owl-nav .owl-prev:hover, .elementor-element.logo-header-element>.elementor-widget-container:before, .elementor-element.search-product-element .elementor-widget-ftc_ajax_search{
background-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.dropdown-container .ftc_cart_check > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
body input.wpcf7-submit:hover,
.woocommerce .products.list .product   .item-description .add-to-cart a:hover,
.woocommerce .products.list .product   .item-description .button-in a:hover,
.woocommerce .products.list .product   .item-description .meta_info  a:not(.quickview):hover,
.woocommerce .products.list .product   .item-description .quickview i:hover,
.counter-wrapper > div,
.tp-bullets .tp-bullet:after,
.woocommerce .product .conditions-box .onsale,
.woocommerce #respond input#submit:hover, 
.woocommerce a.button:hover,
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
.woocommerce .products .product  .images .button-in:hover a:hover,
.woocommerce .products .product  .images a:hover,
.vc_color-orange.vc_message_box-solid,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a.next:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.next:hover,
.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce .form-row input.button:hover,
.load-more-wrapper .button:hover,
body .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab:hover,
body .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active,
.woocommerce div.product form.cart .button:hover,
.woocommerce div.product div.summary p.cart a:hover,
div.product .summary .yith-wcwl-add-to-wishlist a:hover,
.woocommerce #content div.product .summary .compare:hover,
div.product .social-sharing li a:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
.tagcloud a:hover,
.woocommerce .wc-proceed-to-checkout a.button.alt:hover,
.woocommerce .wc-proceed-to-checkout a.button:hover,
.woocommerce-cart table.cart input.button:hover,
.owl-dots > .owl-dot span:hover,
.owl-dots > .owl-dot.active span,
footer .style-3 .newletter_sub .button.button-secondary.transparent,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
body .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
body .vc_tta.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
body div.pp_details a.pp_close:hover:before,
.vc_toggle_title h4:after,
body.error404 .page-header a,
body .button.button-secondary,
.pp_woocommerce div.product form.cart .button,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-background-color-orange.vc_icon_element-background,
.style1 .ftc-countdown .counter-wrapper > div,
.style2 .ftc-countdown .counter-wrapper > div,
.style3 .ftc-countdown .counter-wrapper > div,
#cboxClose:hover,
body > h1,
table.compare-list .add-to-cart td a:hover,
.vc_progress_bar.wpb_content_element > .vc_general.vc_single_bar > .vc_bar,
div.product.vertical-thumbnail .details-img .owl-controls div.owl-prev:hover,
div.product.vertical-thumbnail .details-img .owl-controls div.owl-next:hover,
ul > .page-numbers.current,
ul > .page-numbers:hover,
article a.button-readmore:hover,.text_service a,.vc_toggle_title h4:before,.vc_toggle_active .vc_toggle_title h4:before,
.post-item.sticky .post-info .entry-info .sticky-post,
.woocommerce .products.list .product   .item-description .compare.added:hover
, a.slide-button span, .tp-rightarrow.tparrows,
a.slide-button:hover:after, .logo-wrapper, .logo-wrapper:before,
button.search-button, .text_for_men.row1 h3:after,
.text_for_women.row2 h3:after ,
.woocommerce .product .item-description .meta_info a.quickview:hover i,
.woocommerce .product .item-description .meta_info .yith-wcwl-add-to-wishlist a:hover,
.ftc-meta-widget.item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info .yith-wcwl-add-to-wishlist:hover,
.ftc-product .item-description .add-to-cart a, .lastest-product .vc_tta-container h2:before	,
.lastest-product .vc_tta-container h2, .woocommerce .product  .item-description .meta_info .add-to-cart a:first-child:hover:after, 
.ftc-meta-widget.item-description .meta_info .add-to-cart a:first-child:hover:after,
.owl-nav .owl-prev, article a.button-readmore, article a.button-readmore:hover:after
, body .subscribe_comingsoon input[type="submit"]:hover, #to-top a,
.page-numbers.current, a.page-numbers:hover, .single-post .form-submit input[type="submit"]:hover
, .woocommerce div.product div.summary p.cart a, .woocommerce div.product form.cart .button,
.woocommerce div.product div.summary p.cart a:hover:after, 
.woocommerce div.product form.cart .button:hover:after,
.details_thumbnails .owl-nav .owl-prev:hover, .details_thumbnails .owl-nav .owl-next:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
.site-content .related.products h2 .bg-heading,
.ftc-quickshop-wrapper .owl-nav > div.owl-next:hover, 
.ftc-quickshop-wrapper .owl-nav > div.owl-prev:hover,
.pp_woocommerce div.product form.cart .button:hover:after,
a.slide-button, 
.home3 article a.button-readmore:after, 
.home3 .woocommerce .product .item-description .meta_info .add-to-cart a:first-child:after,
.home3 .ftc-product .item-description .add-to-cart a:hover ,
.home3 .woocommerce .product .item-description .meta_info a.added_to_cart.wc-forward:after,
#today,.woocommerce .product .item-description .meta_info a.compare:hover i,
.woocommerce .product .item-description .meta_info a.compare.added:hover,
.newsletterpopup form > div .submit-footer input[type="submit"],
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
a.ftc_cart:hover .cart-number p.count-number,
.load-more-wrapper .button,
article a.button.load-more:hover:after,
.dokan-clearfix input[type="submit"].dokan-btn-theme,
.dokan-clearfix .dokan-btn-theme,
.dokan-clearfix a.dokan-btn-theme,
input[type="submit"].dokan-btn-theme,
a.dokan-btn-theme,
.dokan-btn-theme,
p.woocommerce-mini-cart__buttons.buttons > a.button.checkout.wc-forward:hover,
.testi15 .clientsay12 .owl-nav .owl-next:hover, .testi15 .clientsay12 .owl-nav .owl-prev:hover,
.ftc-sb-button a.ftc-button-1:hover,
.category16 span.sub-product-categories a:before,
.countdown16 .bannerh6 .ftc-product .item-description .add-to-cart,
.countdown16 .bannerh6 .ftc-product .item-description .add-to-cart:before,
.alltitle16,
.productwidget16 .titlewidget,
.countdown16 .bannerh6 .counter-wrapper > div,
.text_service a:hover::after,body.error404 .page-header a:hover::after, .header-layout7 a.ftc-cart-tini:before, .bannerh7, .btnh7 .ftc-sb-button a:hover, .formfooth7 input[type="submit"]:hover,  .btn-foot-top ,.four-button .woocommerce .product .images .group-button-product > div a:hover, .btn-db .ftc-sb-button a, a.cookies-accept-btn:hover, .deal-h7 .btnh7 .ftc-sb-button a, .header-layout7 .ftc-shop-cart a.ftc-cart-tini.cart-item-canvas span.cart-number, .cateh7 .owl-nav >div:hover, .ftc-mobile-wrapper .menu-text button.btn-danger, .single-portfolio .single-navigation a:hover:before, .single-portfolio ul li:hover, .ftc-product-attribute .variation-product__option:not(.color).selected, .woocommerce .product .images .ftc-single-video:hover, .prod-cat-show-top-content-button a, .cross-sells h2,
.hotspot-product a.button, .hotspot-product a.button:hover:after, .slide_lb .tp-leftarrow.tparrows, .hotspot-product a.added_to_cart.wc-forward
,.blog-home12 article a.button-readmore:hover, .woocommerce .product12 .product .images .group-button-product > div:hover a
,aside#right-sidebar .widget_product_tag_cloud .tagcloud a:hover{
    background-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.footer-top .footer-top16,
.rev-btn.rev-withicon, .rev-btn:hover i,
.countdown13 .ftc-sb-button a.ftc-button-1:hover,
.slider-home3 .rev-btn.rev-withicon:hover, .ftc-sb-button a:hover, .ftc-product .item-description .add-to-cart a:hover,  .header7 .header-nav, .revslider7 .rev-btn,
.revslider7 .tparrows:hover,.revslider7 .rev-btn, .slide_lb .rev-btn,
.dot16 .tp-bullet.selected,
.dot16 .tp-bullet:hover, 
.navi12.tparrows:hover,
.tp-rightarrow.tparrows.navi
{
  background-color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
.dropdown-container .ftc_cart_check > a.button.view-cart:hover,
.dropdown-container .ftc_cart_check > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
body input.wpcf7-submit:hover,
.counter-wrapper > div,
.woocommerce .products .product:hover ,
.woocommerce-page .products .product:hover ,
#right-sidebar .product_list_widget:hover li,
.woocommerce .product   .item-description .meta_info a:hover,
.woocommerce-page .product   .item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info .yith-wcwl-add-to-wishlist a:hover,
.woocommerce .products .product:hover ,
.woocommerce-page .products .product:hover ,
.ftc-products-category ul.tabs li:hover,
.ftc-products-category ul.tabs li.current,
body .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
body .vc_tta.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
body div.pp_details a.pp_close:hover:before,
.wpcf7 p input:focus,
.wpcf7 p textarea:focus,
.woocommerce form .form-row .input-text:focus,
body .button.button-secondary,
.ftc-quickshop-wrapper .owl-nav > div.owl-next:hover,
.ftc-quickshop-wrapper .owl-nav > div.owl-prev:hover,
#cboxClose:hover, .woocommerce-account .woocommerce-MyAccount-navigation li.is-active,
.ftc-product-items-widget .ftc-meta-widget.item-description .meta_info .compare:hover,
.ftc-product-items-widget .ftc-meta-widget.item-description .meta_info .add_to_cart_button a:hover,
.woocommerce .product   .item-description .meta_info .add-to-cart a:hover,
.ftc-meta-widget.item-description .meta_info .add-to-cart a:hover 
, .woocommerce .widget_layered_nav ul li a:hover:before,
input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme,
p.woocommerce-mini-cart__buttons.buttons > a.button.wc-forward:hover,
p.woocommerce-mini-cart__buttons.buttons > a.button.checkout.wc-forward:hover,
.ftc-sb-button a.ftc-button-1:hover,
.woocommerce-page .widget_layered_nav ul li a:hover:before, #mega_main_menu.primary li.default_dropdown > .mega_dropdown > .menu-item.current-menu-item > .item_link:before, #mega_main_menu.primary li.default_dropdown > .mega_dropdown > .menu-item > .item_link:focus:before, #mega_main_menu.primary li.default_dropdown > .mega_dropdown > .menu-item > .item_link:hover:before, .ftc-sb-button a,.ftc-sb-button a:hover,.ftc-sb-button a.ftc-button, .woocommerce .products .product .images:hover a, .tabh6 .home5 .woocommerce .products .product .images:hover, .ftc-sb-button a.ftc-button-1:hover ,.footmidh7 .info-company li i, .infomid .widget.widget_tag_cloud .tagcloud a:hover, #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link span.link_text:after, .deal-h7 .woocommerce div.product div.images:before,
.deal-h7 .woocommerce .product .images > a:before, .deal-h7 .woocommerce .product .images > a:after, .deal-h7 .woocommerce div.product div.images:after, .ftc-mobile-wrapper .menu-text button.btn-danger, .our-por .vc_tta-tab.vc_active>a, .ftc-portfolio-wrapper .filter-bar li.current, .ftc-portfolio-wrapper .filter-bar li:hover, #hover-t.cateh7 .owl-stage .owl-item:after, .site-content .related.products h2 .bg-heading:after, 
.hotspot-product a.button:hover:before, .slide-lb .tp-leftarrow.tparrows:after,
.banner16 .test1 p a:hover, 
.banner16 .test2 p a:hover,
.woocommerce .newproduct16 .product .conditions-box .onsale:before,
.banner17.banner16 .test2 p a:hover,
.bannerh6 .img_ct .owl-nav > div:hover,
.thum_list_gallery ul li:hover,
.ftc-product-grid.style_2 .ftc-product.product .images:hover,
.ftc-elements-blogs-timeline .inner-wrap .post-text .ftc-readmore:hover{
    border-color: <?php echo esc_html($ftc_primary_color) ?>; 
}
a.ftc-button:after,.deal-h7 .btnh7 .ftc-sb-button:hover a,.header-layout10 .ftc-search-product .ftc_search_ajax input[type="text"]{
border-color: <?php echo esc_html($ftc_primary_color) ?> !important; 
}
#ftc_language ul ul,
.header-currency ul,
.ftc-account .dropdown-container,
.ftc-shop-cart .dropdown-container,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_item,
#mega_main_menu > .menu_holder > .menu_inner > ul > li:hover,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
#mega_main_menu > .menu_holder > .menu_inner > ul > li.current_page_item > a:first-child:after,
#mega_main_menu > .menu_holder > .menu_inner > ul > li > a:first-child:hover:before,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link:before,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_item > .item_link:before,
#mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .mega_dropdown,
.woocommerce .product .conditions-box .onsale:before,
.woocommerce .product .conditions-box .featured:before,.tabh5 li.vc_tta-tab.vc_active a:after,
.woocommerce .product .conditions-box .out-of-stock:before, a.slide-button span:after,
.logo-wrapper:after,.header-language ul ul, button.search-button:before,
.lastest-product .vc_tta-container h2:after, .owl-nav .owl-prev:after,
.woocommerce-info, .site-content .related.products h2 .bg-heading :after,
.tini-cart-inner, a.ftc-cart-tini.cart-item-canvas,
.ftc-tini-cart:before, a.ftc-cart-tini.cart-item-canvas:before,
h4.titleblog15::before,
.woocommerce-message, .ftc-shoppping-cart:before, .rtl .logo-wrapper:after, .rtl .lastest-product .vc_tta-container h2:after , .slide_lb .tp-leftarrow.tparrows:after,
.rtl .button-shop-sld1:hover.rev-btn i:after,
.elementor-widget-ftc_language_switch .lang_sel_click > ul > li > ul, 
.wcml_currency_switcher ul, .elementor-element.logo-header-element>.elementor-widget-container:after{
    border-top-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.woocommerce .products.list .product:hover  .item-description:after,
.woocommerce-page .products.list .product:hover  .item-description:after, .tabh7 .vc_tta-tabs-list li.vc_tta-tab.vc_active
{
    border-left-color: <?php echo esc_html($ftc_primary_color) ?>;
}
footer#colophon .ftc-footer .widget-title:before,
.woocommerce div.product .woocommerce-tabs ul.tabs,
#customer_login h2 span:before,
.cart_totals  h2 span:before,
.tp-rightarrow.tparrows:after,
a.slide-button:hover span:before, .woocommerce .product .item-description .meta_info .add-to-cart a:first-child:hover:before
, article a.button-readmore:hover:before,.woocommerce div.product div.summary p.cart a:hover:before, 
.woocommerce div.product form.cart .button:hover:before,
.pp_woocommerce div.product form.cart .button:hover:before,
a.slide-button:hover:before, .rev-btn:hover i:after,
.home3 article a.button-readmore:before,
.home3 .woocommerce .product .item-description .meta_info .add-to-cart a:first-child:before,
.home3 .woocommerce .product .item-description .meta_info a.added_to_cart.wc-forward:before,
.newsletterpopup .textwidget > p.text-popup::after,
article a.button.load-more:hover:before,
.text_service a:hover::before,body.error404 .page-header a:hover::before ,.rtl .ftc-tini-cart:before,
.rtl .header-ftc.header-layout3 .ftc-tini-cart:before,
.elementor-element.footer-mail-form .mc4wp-form:hover p.submit-footer:after,
.woocommerce .product .item-description .meta_info a.added_to_cart.wc-forward:hover:before{
    border-bottom-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.navi.tp-rightarrow.tparrows:after
{
    border-bottom-color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
/* ========== Secondary color ========== */
body,
#mega_main_menu.primary ul li .mega_dropdown > li.sub-style > .item_link .link_text,
.woocommerce a.remove,
body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab,
.woocommerce .products .star-rating.no-rating,
.woocommerce-page .products .star-rating.no-rating,
.star-rating.no-rating:before,
.pp_woocommerce .star-rating.no-rating:before,
.woocommerce .star-rating.no-rating:before,
.woocommerce-page .star-rating.no-rating:before,
.woocommerce .product .images .group-button-product > div a,
.woocommerce .product .images .group-button-product > a, 
.vc_progress_bar .vc_single_bar .vc_label,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline-custom,
.style1 .ftc-countdown .counter-wrapper > div .countdown-meta,
.style2 .ftc-countdown .counter-wrapper > div .countdown-meta,
.style3 .ftc-countdown .counter-wrapper > div .countdown-meta,
.style4 .ftc-countdown .counter-wrapper > div .number-wrapper .number,
.style4 .ftc-countdown .counter-wrapper > div .countdown-meta,
body table.compare-list tr.remove td > a .remove:before,
.woocommerce-page .products.list .product h3.product-name a,
button.search-button:hover, button.search-button:focus
, .intro-box
{
    color: <?php echo esc_html($ftc_secondary_color) ?>;
}
.dropdown-container .ftc_cart_check > a.button.checkout,
.info-company li i,
body .button.button-secondary:hover,
body div.ftc-size_chart .pp_close:before,
div.pp_default .pp_close, body div.pp_woocommerce.pp_pic_holder .pp_close,
body div.ftc-product-video.pp_pic_holder .pp_close,
body .ftc-lightbox.pp_pic_holder a.pp_close,
#cboxClose, #to-top a:hover, .cateh7 .owl-nav .owl-prev, .cateh7 .owl-nav .owl-next
{
    background-color: <?php echo esc_html($ftc_secondary_color) ?>;
}
.dropdown-container .ftc_cart_check > a.button.checkout,
body .button.button-secondary:hover,
#cboxClose
{
    border-color: <?php echo esc_html($ftc_secondary_color) ?>;
}

/* ========== Body Background color ========== */
body
{
    background-color: <?php echo esc_html($ftc_body_background_color) ?>;
}

