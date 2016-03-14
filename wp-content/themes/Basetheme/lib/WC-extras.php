<?php 
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
	 
	function woo_custom_cart_button_text() {
	 
	        return __( 'add', 'woocommerce' );
	 
	}
	add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
 
	function woo_archive_custom_cart_button_text() {
	 
	        return __( 'Add', 'woocommerce' );
	 
	}
 ?>