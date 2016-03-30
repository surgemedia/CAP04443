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
 ?>