<?php
global $smof_data;

get_header( $smof_data['ftc_header_layout'] );

$page_column_class = ftc_page_layout_columns_class( $smof_data['ftc_blog_layout'] );
$page_title = esc_html__( 'Blog', 'ornaldo' );
ftc_breadcrumbs_title(true, true, $page_title);
?>

<div class="container">
	<div id="primary" class="content-area">
		<div class="row">
			<!-- Left Sidebar -->
			<?php if( $page_column_class['left_sidebar'] ): ?>
				<aside id="left-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
					<?php if( is_active_sidebar( $smof_data['ftc_blog_left_sidebar'] ) ): ?>
						<?php dynamic_sidebar( $smof_data['ftc_blog_left_sidebar'] ); ?>
					<?php endif; ?>
				</aside>
			<?php endif; ?>	
			<main id="main" class="site-main <?php echo esc_attr($page_column_class['main_class']); ?>">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;

					the_posts_pagination( array(
						'prev_text' => ftc_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous', 'ornaldo' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'ornaldo' ) . '</span>' . ftc_get_svg( array( 'icon' => 'arrow-right' ) ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( '', 'ornaldo' ) . ' </span>',
					) );

				else :

					echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'ornaldo').'</div>';

				endif;
				?>

			</main><!-- #main -->
			<!-- Right Sidebar -->
			<?php if( $page_column_class['right_sidebar'] ): ?>
				<aside id="right-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
					<?php if( is_active_sidebar( $smof_data['ftc_blog_right_sidebar'] ) ): ?>
						<?php dynamic_sidebar( $smof_data['ftc_blog_right_sidebar'] ); ?>
					<?php endif; ?>
				</aside>
			<?php endif; ?>	
		</div><!-- .row -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer();
