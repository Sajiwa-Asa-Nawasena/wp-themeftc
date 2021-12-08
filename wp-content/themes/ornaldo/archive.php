<?php
global $smof_data;

get_header( $smof_data['ftc_header_layout'] ); 

$page_column_class = ftc_page_layout_columns_class( $smof_data['ftc_blog_layout'] );
$page_title = '';
switch( true ){
	case is_day():
	$page_title = esc_html__( 'Day: ', 'ornaldo' ) . get_the_date();
	break;
	case is_month():
	$page_title = esc_html__( 'Month: ', 'ornaldo' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'ornaldo' ) );
	break;
	case is_year():
	$page_title = esc_html__( 'Year: ', 'ornaldo' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'ornaldo' ) );
	break;
	case is_search():
	$page_title = esc_html__( 'Search Results for: ', 'ornaldo' ) . get_search_query();
	break;
	case is_tag():
	$page_title = esc_html__( 'Tag: ', 'ornaldo' ) . single_tag_title( '', false );
	break;
	case is_category():
	$page_title = esc_html__( 'Category: ', 'ornaldo' ) . single_cat_title( '', false );
	break;
	case is_author():
	$page_title = esc_html__( 'Author: ', 'ornaldo' ) . get_the_author();
	break;
	case is_404():
	$page_title = esc_html__( 'OOPS! FILE NOT FOUND', 'ornaldo' );
	break;
	default:
	$page_title = esc_html__( 'Archives', 'ornaldo' );
	break;
}

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
				if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => ftc_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'ornaldo' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' .  esc_html__( 'Next page', 'ornaldo' ) . '</span>' . ftc_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' .  esc_html__( 'Page', 'ornaldo' ) . ' </span>',
				) );

			else :

				echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'ornaldo').'</div>';

				endif; ?>

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
