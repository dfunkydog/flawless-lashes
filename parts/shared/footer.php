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
			<a href="https://plus.google.com/107689856055514328406" rel="publisher">Google+</a>
	</footer>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
