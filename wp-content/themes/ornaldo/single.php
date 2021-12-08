<?php
global $smof_data, $post;

get_header( $smof_data['ftc_header_layout'] );

$page_column_class = ftc_page_layout_columns_class($smof_data['ftc_blog_details_layout']);
ftc_breadcrumbs_title(true, $smof_data['ftc_blog_details_title'], get_the_title());
?>

<div class="container">
	<div id="primary" class="content-area">
    <div class="row">
      <!-- Left Sidebar -->
      <?php if( $page_column_class['left_sidebar'] && $post->post_type != 'ftc_footer'): ?>
        <aside id="left-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
          <?php if( is_active_sidebar($smof_data['ftc_blog_details_left_sidebar']) ): ?>
            <?php dynamic_sidebar( $smof_data['ftc_blog_details_left_sidebar'] ); ?>
          <?php endif; ?>
        </aside>
      <?php endif; ?>	
      <!-- end left sidebar -->
      
      <main id="main" class="site-main <?php echo esc_attr($page_column_class['main_class']); ?>">

       <?php
       /* Start the Loop */
       while ( have_posts() ) : the_post();

         get_template_part( 'template-parts/post/single-content', get_post_format() );

         the_post_navigation( array(
          'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'ornaldo' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Previous', 'ornaldo' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . ftc_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
          'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'ornaldo' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Next', 'ornaldo' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . ftc_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
        ) );

       endwhile; 
       ?> 
     </main><!-- #main -->
     
     <!-- Right Sidebar -->
     <?php if( $page_column_class['right_sidebar'] && $post->post_type != 'ftc_footer' ): ?>
      <aside id="right-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
        <?php if( is_active_sidebar($smof_data['ftc_blog_details_right_sidebar']) ): ?>
          <?php dynamic_sidebar( $smof_data['ftc_blog_details_right_sidebar'] ); ?>
        <?php endif; ?>
      </aside>
    <?php endif; ?>	
    <!-- end right sidebar -->
  </div><!-- .row -->
</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer();
