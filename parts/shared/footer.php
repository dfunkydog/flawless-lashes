	</div><!-- end of main -->
</div><!-- end of container -->
	<footer>
		<div id="footer">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-1', 'container' => false ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-2', 'container' => false ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-3', 'container' => false ) ); ?>
		</div>
		<div class="copyright">
			&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</div>
	</footer>
