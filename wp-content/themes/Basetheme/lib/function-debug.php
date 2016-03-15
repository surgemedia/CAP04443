<?php 
/*=========================================
=            Pretty Meta Debug            =
=========================================*/
function debug($data) {
//makes debuging easier with clear values
    echo '<script>';
  	echo 'console.log('.json_encode($data).');'; 
    echo '</script>';
}
	function woocommerce_button_proceed_to_checkout() {
	       $checkout_url = WC()->cart->get_checkout_url();
	       ?>
	       <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Order Now','woocommerce' ); ?></a>
	       <?php
	     }
?>