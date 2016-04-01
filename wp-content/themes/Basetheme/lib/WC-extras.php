<?php 
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
	 
	function woo_custom_cart_button_text() {
	 
	        return __( 'add', 'woocommerce' );
	 
	}
	add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
 
	function woo_archive_custom_cart_button_text() {
	 
	        return __( 'Add', 'woocommerce' );
	 
	}
			//Change the Billing Address checkout label
		function wc_billing_field_strings( $translated_text, $text, $domain ) {
		    switch ( $translated_text ) {
		        case 'Billing Details' :
		            $translated_text = __( 'Your contact info', 'woocommerce' );
		            break;
		    }
		    return $translated_text;
		}
		add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );
		
		function woocommerce_button_proceed_to_checkout() {
			       $checkout_url = WC()->cart->get_checkout_url();
			       ?>
			       <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Order Now','woocommerce' ); ?></a>
			       <?php
			     }
//Late FEE
// function woo_add_cart_fee() {
 
//   global $woocommerce;
	
//   $woocommerce->cart->add_fee( __('Late Fee', 'woocommerce'), 5 );
	
// }
// add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );
// 		function cp_add_custom_price( $cart_object ) {
// 	global $woocommerce;
// 	foreach ( $cart_object->cart_contents as $key => $value ) {
// $excost = 5.99;
// $woocommerce->cart->add_fee( 'Express delivery', $excost, true, 'standard' );
// 	}
// }
// add_action( 'woocommerce_cart_calculate_fees', 'cp_add_custom_price' );


 ?>