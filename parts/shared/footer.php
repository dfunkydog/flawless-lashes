	</div><!-- end of main -->
</div><!-- end of container -->
	<footer>
		<div id="footer">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-1', 'container' => false ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-2', 'container' => false ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-3', 'container' => false ) ); ?>
		</div>
		<div class="colophon">

			<div class="cards">
				<a href="http://www.sagepay.co.uk/support/online-shoppers/about-sage-pay" onclick="javascript:window.open('http://www.sagepay.co.uk/support/online-shoppers/about-sage-pay','What is SagePay','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" title="What is SagePay?">
				<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/sage.png" width="181" height="55" alt="Payments By SagePay"></a>

				<script type="text/javascript" src="https://sealserver.trustwave.com/seal.js?code=cbf2214823f949b99b8f53fbb2d0a741">
				</script>
				<a href="http://www.mastercard.co.uk/securecode.html"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/securecode.png" width="110" height="55" alt="matercard securecode"></a>
				<a href="http://www.visaeurope.com/making-payments/verified-by-visa/"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/verified-by-visa.jpg" width="110" height="55"  alt="Verified by visa"></a>

			</div>
			<div class="copyright">&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
			</div>
		</div>
	</footer>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
