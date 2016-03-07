<?php 
  // Update items in cart via AJAX
add_filter('add_to_cart_fragments', 'woo_add_to_cart_ajax');
function woo_add_to_cart_ajax( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">(<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>)</a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
function woocommerce_set_cart_qty_action() { 
  global $woocommerce;
  foreach ($_REQUEST as $key => $quantity) {
    // only allow integer quantities
    if (! is_numeric($quantity)) continue;

    // attempt to extract product ID from query string key
    $update_directive_bits = preg_split('/^set-cart-qty_/', $key);
    if (count($update_directive_bits) >= 2 and is_numeric($update_directive_bits[1])) {
      $product_id = (int) $update_directive_bits[1]; 

      $cart_id = $woocommerce->cart->generate_cart_id($product_id);
      // See if this product and its options is already in the cart
      $cart_item_key = $woocommerce->cart->find_product_in_cart( $cart_id ); 
      // If cart_item_key is set, the item is already in the cart
      if ( $cart_item_key ) {
        $woocommerce->cart->set_quantity($cart_item_key, $quantity);
      } else {
        // Add the product to the cart 
        $woocommerce->cart->add_to_cart($product_id, $quantity);
      }
       // debug($product_id);
       // debug($cart_id);
       // debug($cart_item_key);
    }
  }
}

add_action( 'init', 'woocommerce_set_cart_qty_action' );
 ?>