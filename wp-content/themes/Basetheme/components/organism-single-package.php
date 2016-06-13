<?php
	unset($product_meta);
	unset($id);
	$id=$args[1];
	$color=$args[2];
	$rand =$args[3];
	$product_meta = get_post_meta($id);

?>
<?php 	includePart('components/molecule-package.php',
										$id,
										get_field('icon',$id), //$icon
										explode(" ",get_post($id)->post_title, 2)[0],	//$line1
										explode(" ",get_post($id)->post_title, 2)[1],	//$line2
										get_field('subtitle',$id),//$info
										"$".$product_meta['_price'][0],//$price
										"full", //length
										get_post_field('post_content', $id),
										$color,
										$rand
										 //color
);?>
<?php 
	includePart('components/molecule-package-info.php',
											$id, //id
											get_post($id)->post_title, //title
											get_post_field('post_content', $id),
											$color,
											"hidden-xs",
											$rand
);
unset($product_meta);
unset($id);
?>