<?php
global $ftc_page_datas, $smof_data;

get_header( $smof_data['ftc_header_layout'] ); 

$show_breadcrumb = ( !is_home() && !is_front_page() && isset($ftc_page_datas['ftc_show_breadcrumb']) && absint($ftc_page_datas['ftc_show_breadcrumb']) == 1 );
$show_page_title = ( !is_home() && !is_front_page() && absint($ftc_page_datas['ftc_show_page_title']) == 1 );
if( function_exists('is_bbpress') && is_bbpress() ){
	$show_page_title = true;
	$show_breadcrumb = true;
}
if( ($show_breadcrumb || $show_page_title) && isset($smof_data['ftc_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$smof_data['ftc_breadcrumb_layout'];
}

ftc_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
$page_column_class = ftc_page_layout_columns_class($ftc_page_datas['ftc_page_layout']);
?>

<div class="container">
	<div id="primary" class="content-area">
		<div class="row">
			<!-- Left Sidebar -->
			<?php if( $page_column_class['left_sidebar'] ): ?>
				<aside id="left-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
					<?php if( is_active_sidebar( $ftc_page_datas['ftc_left_sidebar'] ) ): ?>
						<?php dynamic_sidebar( $ftc_page_datas['ftc_left_sidebar'] ); ?>
					<?php endif; ?>
				</aside>
			<?php endif; ?>
			<main id="main" class="site-main <?php echo esc_attr($page_column_class['main_class']); ?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						the_content();
						wp_link_pages();
						?>
					</article>

					<?php	
					/* If comments are open or we have at least one comment, load up the comment template. */
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
				?>

			</main><!-- #main -->
			<!-- Right Sidebar -->
			<?php if( $page_column_class['right_sidebar'] ): ?>
				<aside id="right-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
					<?php if( is_active_sidebar($ftc_page_datas['ftc_right_sidebar'])): ?>
						<?php dynamic_sidebar($ftc_page_datas['ftc_right_sidebar']); ?>
					<?php endif; ?>
				</aside>
			<?php endif; ?>
		</div> <!-- .row -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer();
