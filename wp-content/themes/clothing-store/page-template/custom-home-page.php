<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_theme_mod('clothing_store_slider_arrows') != ''){ ?>
    <section id="slider" class="py-5">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php
          for ( $i = 1; $i <= 4; $i++ ) {
            $mod =  get_theme_mod( 'clothing_store_post_setting' . $i );
            if ( 'page-none-selected' != $mod ) {
              $clothing_store_slide_post[] = $mod;
            }
          }
           if( !empty($clothing_store_slide_post) ) :
          $args = array(
            'post_type' =>array('post'),
            'post__in' => $clothing_store_slide_post
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <div class="container">
            <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <div class="row">                
                <div class="col-lg-6 col-md-6 col-sm-6 slide-content ">
                  <div class="carousel-caption text-center text-md-left text-sm-left">
                    <h2 class="slider-title"><?php the_title();?></h2>
                    <p class="mb-0"><?php echo esc_html(wp_trim_words(get_the_content(),'20') );?></p>
                    <div class="home-btn text-center text-md-left text-sm-left my-4">
                      <a class="py-3 px-4" href="<?php the_permalink(); ?>"><i class="fas fa-shopping-cart mr-3"></i><?php echo esc_html('SHOP NOW','clothing-store'); ?></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 image-content">
                  <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
                  <div class="discount-box">
                    <?php if( get_theme_mod('clothing_store_product_discount_text') != '' ){ ?>
                      <h3><?php echo esc_html(get_theme_mod('clothing_store_product_discount_text','')); ?></h3>
                    <?php }?>
                    <?php if( get_theme_mod('clothing_store_product_discount_number') != '' ){ ?>
                      <p><?php echo esc_html(get_theme_mod('clothing_store_product_discount_number','')); ?></p>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
            <?php $i++; endwhile;
            wp_reset_postdata();?>
          </div>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <section id="millions-of-hours" class="py-5">
    <div class="container">
      <div class="border-box p-3 p-lg-5 text-center text-md-left">
        <div class="row">
          <div class="col-lg-7 col-md-6 col-sm-6 align-self-center">
            <?php if( get_theme_mod('clothing_store_millions_of_hours_heading') != '' ){ ?>
              <h3><?php echo esc_html(get_theme_mod('clothing_store_millions_of_hours_heading')); ?></h3>
            <?php }?>
            <?php if( get_theme_mod('clothing_store_millions_of_hours_sub_heading') != '' ){ ?>
              <h6 class=""><?php echo esc_html(get_theme_mod('clothing_store_millions_of_hours_sub_heading')); ?></h6>
            <?php }?>
          </div>
          <div class="col-lg-5 col-md-6 col-sm-6 align-self-center">
            <?php if( get_theme_mod('clothing_store_millions_of_hours_countdown_timer') != '' ){ ?>
              <div id="countdown-timer" class="text-center">
                <input type="hidden" name="new-year-date" id="new-year-date" value="<?php echo esc_attr(get_theme_mod('clothing_store_millions_of_hours_countdown_timer','')); ?>">
                <div class="time-box mr-2 mr-lg-3"><strong id="days" class="bold-number">118 </strong> <p class="slim-countdown-text mb-0"><?php esc_html_e('Days','clothing-store'); ?></p><span class="timer"></span></div>
                <div class="time-box mr-2 mr-lg-3"><strong id="hours" class="bold-number"> 14 </strong> <p class="slim-countdown-text mb-0"><?php esc_html_e('Hours','clothing-store'); ?></p><span class="timer"></span></div>
                <div class="time-box mr-2 mr-lg-3"><strong id="mins" class="bold-number"> 36 </strong> <p class="slim-countdown-text mb-0"><?php esc_html_e('Minutes','clothing-store'); ?></p><span class="timer"></span></div>                
                <div class="time-box"><strong id="seconds" class="bold-number"> 24 </strong> <p class="slim-countdown-text mb-0"><?php esc_html_e('Seconds','clothing-store'); ?></p><span class="timer"></span></div>
              </div>
            <?php }?>
          </div>
        </div>
        <div class="row mt-5">
          <?php 
          $clothing_store_catData = get_theme_mod('clothing_store_millions_of_hours_category');
          $clothing_store_count_catData = get_theme_mod('clothing_store_millions_of_hours_number');
          if ( class_exists( 'WooCommerce' ) ) {
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => $clothing_store_count_catData,
            'product_cat' => $clothing_store_catData,
            'order' => 'ASC'
          );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            <div class="col-lg-3 col-md-4 col-sm-4">
              <div class="product-img wrapper mb-3">
                <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, ''); else echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />'; ?>
                <div class="box-content">
                  <?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?>
                </div>
                <div class="sale-tag">
                  <span><?php woocommerce_show_product_sale_flash( $post, $product ); ?></span>
                </div>
                <div class="product-details mt-2">
                  <h4><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h4>
                  <span><?php esc_attr( apply_filters( 'woocommerce_product_price_class', '' ) ); ?><?php echo $product->get_price_html(); ?></span>
                  <span><?php $product = wc_get_product( $id ); echo wc_get_rating_html( $product->get_average_rating() ); ?></span>
                  <?php $rating  = $product->get_average_rating(); ?>
                  <span class="Stars text-right ml-3 ml-md-2 ml-lg-3" style="--rating:<?php echo $rating ?>"></span>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_query(); ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>