<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================

	Required external files

	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	register_nav_menus(array(
		'primary' => 'Primary Navigation dropdown menu',
		'footer-1' => 'Footer area 1 menu',
		'footer-2' => 'Footer area 2 menu',
		'footer-3' => 'Footer area 3 menu'
		));

	/* ========================================================================================================================

	Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================

	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	======================================================================================================================== */



	/* ========================================================================================================================

	Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Ubuntu:300,500|Montserrat:400');
            wp_enqueue_style( 'googleFonts');

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );

		wp_register_script( 'plugins', get_template_directory_uri().'/js/plugins.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'plugins' );

		if(is_front_page()){
			wp_register_script( 'slider', get_template_directory_uri().'/js/cycle2.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'slider' );
		}
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'site' );


	}



	/* ========================================================================================================================

	Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}

	add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
if ( ! isset( $attr['caption'] ) ) {
if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
$content = $matches[1];
$attr['caption'] = trim( $matches[2] );
}
}
$output = apply_filters('img_caption_shortcode', '', $attr, $content);
if ( $output != '' )
return $output;
extract(shortcode_atts(array(
'id' => '',
'align' => 'alignnone',
'width' => '',
'caption' => ''
), $attr));
if ( 1 > (int) $width || empty($caption) )
return $content;
if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

/* ========================================================================================================================

Integrate wocommerce via hooks.

======================================================================================================================== */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_cart', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_cart', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
add_action('woocommerce_before_cart', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_cart', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div id="wooshop">';
}

function my_theme_wrapper_end() {
  echo '</div>';
}

add_theme_support( 'woocommerce' );


/*=========================

woocommerce customisations

=========================*/

// Change the breadcrumb delimeter from '/' to '»'
add_filter( 'woocommerce_breadcrumb_defaults', 'fl_breadcrumb_delimiter' );
function fl_breadcrumb_delimiter( $defaults ) {
$defaults['delimiter'] = ' &raquo; ';
return $defaults;
}

/*-----------------------
add cart to header area
-----------------------*/
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
global $woocommerce;
ob_start();
?>
<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><img class="basket-icon" width="20" height="12" src="<?php echo get_stylesheet_directory_uri(); ?>/images/basket.png" alt=""><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
<?php
$fragments['a.cart-contents'] = ob_get_clean();
return $fragments;
}


//add_filter( 'woocommerce_product_tabs', 'fl_woo_remove_reviews_tab', 98);
function fl_woo_remove_reviews_tab($tabs) {

 unset($tabs['reviews']);

 return $tabs;
}


/*-----------------------
limit related product to 3
-----------------------*/

function woo_related_products_limit() {
  global $product;

	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> 3,
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> $orderby,
		'post__in'            	=> $related,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30);
add_Action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',15);


// Display 18 products per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 18;' ), 20 );


/*-----------------------------------
add share buttons under add to cart
-----------------------------------*/

add_action('woocommerce_share','wooshare');
function wooshare(){
	echo'<div id="fl-woo-share">
	<div class="fb-like" data-href="'.get_permalink().'" data-layout="button" data-send="false" data-width="100"></div>
	<a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>

	<script>
	    ! function (d, s, id) {
	        var js, fjs = d.getElementsByTagName(s)[0];
	        if (!d.getElementById(id)) {
	            js = d.createElement(s);
	            js.id = id;
	            js.src = "//platform.twitter.com/widgets.js";
	            fjs.parentNode.insertBefore(js, fjs);
	        }
	    }(document, "script", "twitter-wjs");
	</script>
	<a href="http://pinterest.com/pin/create/button/?url='. urlencode(get_permalink()).'&media='.urlencode(wp_get_attachment_url( get_post_thumbnail_id() )).'&description='.apply_filters( 'woocommerce_short_description', $post->post_excerpt ).'" class="pin-it-button"
	count-layout="horizontal">
	    <img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />
	</a>
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';?>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=281787978603249";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- Place this tag in your head or just before your close body tag. -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<!-- Place this tag where you want the share button to render. -->
	<div class="g-plus" data-action="share" data-annotation="none"></div>
</div>
	<?php
}


/*===============================================================

Customize wordpress gallery

===============================================================*/

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode( 'gallery','fl_gallery' );



		/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function fl_gallery($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => '',
		'type'       => 'default_style',
	), $attr, 'gallery'));
	if($type != 'default_style') $size = 'large';

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>";
		$size_class = sanitize_html_class( $size );
	if($type == 'default_style') {
		$gallery_div = "<div id='$selector' class='gallery {$type} galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
	} else {
		$output = "<div id='$selector' class='fl-gallery'>\n";
		$output .="<div class='cycle-slideshow' data-cycle-swipe='true' data-cycle-timeout='7000' data-cycle-fx='scrollHorz' data-cycle-pause-on-hover='true' data-cycle-slides='> div' data-cycle-prev='#prev' data-cycle-next='#next'>\n";
	}


	$i = 0;
	if($type == 'default_style'){
		foreach ( $attachments as $id => $attachment ) {
			if ( ! empty( $link ) && 'file' === $link )
				$image_output = wp_get_attachment_link( $id, $size, false, false );
			elseif ( ! empty( $link ) && 'none' === $link )
				$image_output = wp_get_attachment_image( $id, $size, false );
			else
				$image_output = wp_get_attachment_link( $id, $size, true, false );

			$image_meta  = wp_get_attachment_metadata( $id );

			$orientation = '';
			if ( isset( $image_meta['height'], $image_meta['width'] ) )
				$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

			$output .= "<{$itemtag} class='gallery-item'>";
			$output .= "
				<{$icontag} class='gallery-icon {$orientation}'>
					$image_output
				</{$icontag}>";
			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
			}
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '<br style="clear: both" />';
		}
	} else {
		foreach ($attachments as $id => $attachment) {
			$image_output = wp_get_attachment_image( $id, $size, false );
			$output .="<div>";
			$output .= $image_output;
			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$custom_url = get_post_meta( $id, '_gallery_link_url', true );
				if(wp_get_attachment_url( $id )){
					$output .= "<div class='caption_overlay'>\n
					<h3>" . wp_get_attachment_link( $id,'') . "</h3>
					<p><a href='". $custom_url ."'>
					" . wptexturize($attachment->post_excerpt) . "
					</a></p>\n
					</div>";
				}else{
				$output .= "<div class='caption_overlay'>\n
					<h3>" . wptexturize($attachment->post_title) . "</h3>
					<p>
					" . wptexturize($attachment->post_excerpt) . "
					</p>\n
					</div>";
				}
			}
			$output .="</div>";

		}
	}

	if($type == 'default_style'){$output .= "
			<br style='clear: both;' />
		</div>\n";} else {
			$output .= "</div>\n
			<div id='slider-nav'><a id='prev' href='#''>Prev</a><a id='next' href='#'>Next</a></div>
			</div>";
		}

	return $output;
}// END OF CUSTOM GALLERY
/*****ADD STYLE BUTTON IN WORDPRESS GALLERY*/


add_action('print_media_templates', function(){

  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  ?>
  <script type="text/html" id="tmpl-my-custom-gallery-setting">
    <label class="setting">
      <span><?php _e('type'); ?></span>
      <select data-setting="type">
        <option value="default_style"> default_style </option>
        <option value="slider"> Slider </option>
      </select>
    </label>
  </script>

  <script>

    jQuery(document).ready(function(){

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        my_custom_attr: 'default_val'
      });

      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('my-custom-gallery-setting')(view);
        }
      });

    });

  </script>
  <?php

});

/*======================================

Facebook opengraph and other meta data

======================================*/

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

// add Open Graph Meta Info

function insert_og_info() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="fb:admins" content="YOUR USER ID"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:description" content=" '. get_the_excerpt() . ' "/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="' . get_bloginfo ( 'name' ) .'"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "";

    echo '<meta name="twitter:card" content="summary_large_image"/>';
	echo '<meta name="twitter:site" content="@FlawlessLLashes"/>';

}
add_action( 'wp_head', 'insert_og_info', 5 );

// Workaround for the mysterious bug in Woocommerce that prevents order emails
// from being sent.

add_action( 'woocommerce_thankyou', 'order_email_workaround' );

function order_email_workaround ($order_id) {
    global $woocommerce;
    $mailer = $woocommerce->mailer();
    // Email customer with order-processing receipt
    $email = $mailer->emails['WC_Email_Customer_Processing_Order'];
    $email->trigger( $order_id );
    // Email admin with new order email
    $email = $mailer->emails['WC_Email_New_Order'];
    $email->trigger( $order_id );
}

//remove built in styles each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
return $enqueue_styles;
}

function fl_title(){
	global $post;
$postid = $post->ID;

$seo_title = get_post_meta($postid, 'seo_title',true);

if(is_product()){


if ($seo_title) : echo $seo_title; else: echo wp_title( ''); endif;
} elseif(is_product_category() ){
	{echo strip_tags(category_description( ) ); }
}
else
	{echo 'Semi permanent eyelash products'. wp_title( '|' ); }
}

add_action('wp_head', 'fl_analytics');
function fl_analytics() { ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-58398931-1', 'auto');
	  ga('send', 'pageview');

</script>

</script>
<?php }