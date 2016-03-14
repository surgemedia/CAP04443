<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
global $woocommerce;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				// debug($cart_item['quantity']);
					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
					<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="title visible-xs">ITEMS DETAILS</div>
						<div class="name"><?php echo $product_name . '&nbsp;'; ?></div>
						
						<div class="title visible-xs">ITEMS PRICE</div>
						<?php 
							$cart_id = WC()->cart->generate_cart_id( explode(',',$_GET['cart-update'])[0] );
					    	$prod_in_cart = WC()->cart->find_product_in_cart( $cart_id );
					    	WC()->cart->set_quantity( $prod_in_cart, explode(',',$_GET['cart-update'])[1],true );
					     ?>
						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . sprintf( '%s', $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
						
						<div class="title visible-xs">QUANTITY</div>
						<div class="quantity">
						<?php //debug($cart_item['product_id']); ?>
						<select class="my_select_box" name="" id="" >
						<?php  ?>
							
							
						<?php //WC_Cart::set_quantity( $cart_item_key, explode(',',$_GET['cart-update'])[1] ); ?>
							<?php for ($i=1; $i < 21; $i++) { 
								$selected = false;
								if($cart_item['quantity'] == $i && ($i < 20)){
									$selected = 'selected';
								}
									$option = '<option value="'.$cart_item['product_id'].'#'.$i.'" ';
									$option .= ' ';
									 $option .= $selected.'>'.$i.'</option>';
									echo $option;
								if($i > 20){
									echo '<option value='.$cart_item['quantity'].' '.$selected.'>'.$cart_item['quantity'].'</option>';
								}

								} 
							?>
							<?php //echo $cart_item['quantity']; ?>
							<?php// echo getQtyInCart($_product->id) ?>
						</select>

						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">x</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
							?>
						</div>
						
						<div class="title visible-xs">SUBTOTAL</div>
						<div class="subtotal">
							<span>$<?php echo $cart_item['line_subtotal']; ?></span>
						</div>
						<?php echo WC()->cart->get_item_data( $cart_item );
							
						 ?>

					</li>
					<?php
				}
			}
		?>
<script>
	jQuery(".my_select_box").chosen({
    width: "50%",
    max_selected_options:20
  });

	jQuery('.my_select_box').on('change', function(evt, params) {
   if(evt.target == this){
   		select_info = '?cart-update='+jQuery(this).val().split('#');
   		window.location.href = '<?php echo get_permalink(get_id_from_slug('get-photos')); ?>' + select_info;
     }
  });
</script>
	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->
<?php if ( ! WC()->cart->is_empty() ) : ?>

	<p class="total col-sm-6 col-sm-offset-6"><strong class=""><?php _e( 'YOUR TOTAL', 'woocommerce' ); ?>:</strong> 
	<?php //echo WC()->cart->get_cart_total(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<!-- <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php _e( 'View Cart', 'woocommerce' ); ?></a> -->
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'ORDER NOW', 'woocommerce' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
