<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Remove if you're not building a responsive site. (But then why would you do such a thing?) -->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico"/>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

<div class="container">
<div id="header">
	<div class="branding"><a class="blogname" href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt=""></a>
		<div id="menutoggle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/menutoggle.png" width="24px" height="24px" alt=""></div>
		<h2>This is a test should show on shop only</h2>
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