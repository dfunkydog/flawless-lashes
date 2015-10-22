<?php



/**
 * Apply a different tax rate based on the user role.
 */
function wc_diff_rate_for_user( $tax_class, $product ) {
    if ( is_user_logged_in() && current_user_can( 'distributor_ex_vat' ) ) {
        $tax_class = 'No vat';
    }

    return $tax_class;
}
add_filter( 'woocommerce_product_tax_class', 'wc_diff_rate_for_user', 1, 2 );

//Remove tags, classes etc after add to cart on product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Set a minimum number of products requirement before checking out



if ( current_user_can( 'distributor' ) || current_user_can( 'distributor_ex_vat' ) ) {
add_action( 'woocommerce_check_cart_items', 'dist_min_products' );
}


function dist_min_products() {
    if ( is_user_logged_in() ){
        if( is_cart() || is_checkout() ) {
        // Only run in the Cart or Checkout pages
            // Set the minimum number of products before checking out
            $minimum_num_products = 20;
            $minimum_lash_products = 100;
            $mesage = false;
            // Get the Cart's total number of products
            $cart_num_products = WC()->cart->cart_contents_count;
            // Compare values and add an error is Cart's total number of products
            // happens to be less than the minimum required before checking out.
            // Will display a message along the lines of
            // A Minimum of 20 products is required before checking out. (Cont. below)
            // Current number of items in the cart: 6

                //If there are more than 10 items we then check
                // to check for minimum number of lashes
                foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
                    $_product = $values['data'];
                        $terms = get_the_terms( $_product->id, 'product_cat' );
                        $line_count = $values['quantity'];
                // second level loop search, in case some items have several categories
                            foreach ($terms as $term) {
                                $_categoryid = $term->term_id;
                            }
                    //if line count is less than minimum products stop & message
                    //otherwise check if line is lashes and less than minimum lash
                    //products. if so stop and message
                    if ( $line_count < $minimum_num_products) {
                        $message = 'You must purchase a minimum of ' .$minimum_num_products . ' items or '
                            .$minimum_lash_products.' Bottles of Adhesive per product line';
                            break;

                    } else if ( (($_categoryid === 78 ) || ( $_categoryid === 459)) && ( $line_count < $minimum_lash_products ) ){
                        $message = 'You must purchase a minimum of ' . $minimum_lash_products . ' units/bottles of lash adhesive per product line';
                    }

                }
                if($message){
                    wc_add_notice( $message,
                     'error');
                }


        }
    }
}
