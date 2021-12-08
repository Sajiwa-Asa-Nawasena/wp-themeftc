<nav id="site-navigation" class="main-navigation" aria-label="<?php echo esc_attr( 'Primary Menu', 'ornaldo' ); ?>">
	<?php if( !ftc_has_megamainmenu() ): ?>
		<div class="menu-ftc" data-controls="primary-menu">
			<a><?php echo esc_html_e( 'Menu', 'ornaldo' ); ?></a>
		</div>
	<?php endif; 
	wp_nav_menu( array('theme_location' => 'primary','menu_id'        => 'primary-menu',) );
	 ?>
</nav><!-- #site-navigation -->