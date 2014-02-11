<div class="container">
<div id="header">
	<div class="branding"><a class="blogname" href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt=""></a>
		<div id="menutoggle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/menutoggle.png" width="24px" height="24px" alt=""></div>
	</div>
	<nav>
		<ul id="atme">
			<li class="twitter"><a href="http://twitter.com/FlawlessLLashes"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.png" alt="">twitter</a></li>
			<li class="facebook"><a href="http://facebook.com/lashacademybeautique"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.png" alt="">facebook</a></li>
			<li class="phone"><a href="tel"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/phone.png" alt="">07704405960</a></li>
			<li class="email"><a href="mailto:info@eueyelashinstitute.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mail.png" alt="">info@eueyelashinstitute.com</a></li>
		</ul>
		<?php wp_nav_menu( array( 'theme_location' => 'primary-2', 'container' => false ) ); ?>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
	</nav>
</div>
<div id="main">
