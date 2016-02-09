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

 ?>