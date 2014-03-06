<div class="container">
<div id="header">
		<div id="secondarymenu" class="stashed">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
		</div>
	<div id="loginbasketgroup">
	<svg height="30" width="30" class="menu-icon">
			<switch><g transform="translate(-225.58,-473.9)">
							<path fill="#666" d="m225.6 486.9 26 0 0 4-26 0zM225.6 494.9l26 0 0 4-26 0zM225.6 478.9l26 0 0 4-26 0z"/>
						</g>
						<foreignObject><img alt="" width="30px" height="30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAN1wAADdcBQiibeAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAABPSURBVEiJ7dQxDgAgCANAcDF+lG/xTcKCk09QktpuTJdAilaVdGS0qIRfRs0sRGTehjJzuXuc+b9V992YDwQeZo/xYfYYH2aP8WH2mPC1bBu+JCEZiQ6WAAAAAElFTkSuQmCC" /></foreignObject></switch>
		</svg>
		<?php global $woocommerce; ?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><img class="basket-icon" width="20" height="12" src="<?php echo get_stylesheet_directory_uri(); ?>/images/basket.png" alt=""><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>

		<a class="telephone" href="tel"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/phone.png" alt="">07704405960</a>






		<div class="loginarea">
			 <?php if ( is_user_logged_in() ) { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
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
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids,
     'parent'    => 0
);
$product_categories = get_terms( 'product_cat', $args );
foreach( $product_categories as $cat ) {
echo '<li><a href="'. get_site_url().'/?product_cat='. $cat->slug .'">'. $cat->name . '</a></li>';
}
?>

</ul>
</nav>
<div id="main">
