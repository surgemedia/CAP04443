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
	function cp_add_custom_price( $cart_object ) {
		global $woocommerce;
			$spfee = 15; // initialize special fee
		    $woocommerce->cart->add_fee( 'Late Fee', $spfee, true, '' );

	}
	function createLateFee(){
			// if(sizeof(getCurrentSchool()) > 0){
			// $date = get_field('late_fee_applies_after', 'school_'.getCurrentSchool(true)->term_id);
			// if(isset($date)){
			// $datetime1 = new DateTime($date);
	  //       $datetime2 = new DateTime(date('m/d/Y'));
	  //       debug($datetime1);
	  //       debug($datetime2);

	  //       $interval = $datetime1->diff($datetime2);
	  //       debug($interval->format('%R'));
		 //        if ($interval->format('%R') != '-') {
		 //            add_action( 'woocommerce_cart_calculate_fees', 'cp_add_custom_price' );
		 //            // add_action('woocommerce_before_checkout_form', 'cp_add_custom_price');
		 //        	return true;
		 //        };
	  //       };
   //      };
	}
	function getCurrentSchool(){
		$user_id = wp_get_current_user()->data->ID;
        $school = get_user_meta(wp_get_current_user()->data->ID, $single = false)['school'][0];
        $school1 = get_term_by('slug', $school, 'school');
        return $school1;
	}
    add_action('init','createLateFee');

 ?>