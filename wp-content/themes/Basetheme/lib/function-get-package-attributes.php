<?php 
	function get_package_attributes($id) {
		$product = wc_get_product($id); 
		if($product != NULL){
		$attributes = $product->get_attributes();

		$all_atr = $product->get_attribute( $attributes['pa_type-of-photo']['name'] );
		$all_atr = explode(',',$all_atr);
	} else {
		$all_atr = false;
	}
		return $all_atr;
	}
 ?>