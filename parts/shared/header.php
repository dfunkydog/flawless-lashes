<div id="global-menu">
	<div class="menu-toggle">
		<svg height="30" width="30" viewBox="0 0 30 30" class="menu-icon">
      <switch>
        <g id="burger">
		    <path class="ham border-box" d="M0 0L0 27 29 27 29 0 0 0zM1 1L28 1 28 26 1 26 1 1z"/>
		    <path class="ham top" d="m4 5 21 0 0 3-21 0z"/>
		    <path class="ham middle" d="m4 12 21 0 0 3-21 0z"/>
		    <path class="ham bottom" d="m4 19 21 0 0 3-21 0z"/>
		  </g>
            <foreignObject><img alt="" width="30px" height="30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAN1wAADdcBQiibeAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAABPSURBVEiJ7dQxDgAgCANAcDF+lG/xTcKCk09QktpuTJdAilaVdGS0qIRfRs0sRGTehjJzuXuc+b9V992YDwQeZo/xYfYYH2aP8WH2mPC1bBu+JCEZiQ6WAAAAAElFTkSuQmCC" /></foreignObject></switch>
    </svg>
	</div>
		<?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_class'=> 'menu hidden', ) ); ?>

</div>
<div class="container">
<div id="header">
	<div id="loginbasketgroup">

		<?php global $woocommerce; ?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><img class="basket-icon" width="20" height="12" src="<?php echo get_stylesheet_directory_uri(); ?>/images/basket.png" alt=""><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>

		<div class="loginarea">
			 <?php if ( is_user_logged_in() ) { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
				<a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) ?>" title="<?php _e('Logout','woothemes'); ?>"><?php _e('Logout','woothemes'); ?></a>
				<?php }
				else { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login or register','woothemes'); ?></a>

			<?php } ?>
		</div>
	</div>
	<div id="brandingsearch"><a class="blogname" href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt=""></a>

		<div id="search-container" class="search-box-wrapper hide">
			<div class="search-box">
				<?php get_product_search_form(); ?>
			</div>
		</div>
	</div>

</div>
<nav class="shop-nav">
	<ul><?php
		$args = array(
		      'number' => 'null',
		      'orderby' => 'name',
		      'order' => 'ASC',
		      'columns' => '4',
		      'hide_empty' => true,
		      'parent' => '0',
		      'ids' => ''
		 );
		$product_categories = get_terms( 'product_cat', $args);
		foreach( $product_categories as $cat ) {
			echo '<li><a href="'. get_site_url().'/?product_cat='. $cat->slug .'">'. $cat->name . '</a></li>';
			}
		?>
	</ul>
</nav>
<div id="main">
