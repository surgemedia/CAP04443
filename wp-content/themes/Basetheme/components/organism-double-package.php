<?php  
	//Products
	$product1=$args[1];
	$product2=$args[2];
	//Colors
	$color1= $args[3];
	$color2= $args[4];
	if(strlen($color1) <= 0){
		$color1 = 'blue';
	}
	if(strlen($color2) <= 0){
		$color2 = 'pink';
	}

	//Meta Data
	$product1_meta =  $args[5];
	$product2_meta =  $args[6];	
	$rand1 =  $args[7];	
	$rand2  =  $args[8];	



?>
	<?php if(strlen($product2) > 0){ ?>
	<?php 	includePart('components/molecule-package.php',
				$product2,
				get_field('icon',$product2), 	//icon
				explode(" ",get_post($product2)->post_title, 2)[0],							//line1
				explode(" ",get_post($product2)->post_title, 2)[1],					//line2
				get_field('subtitle',$product2),			//info
				"$".$product2_meta['_price'][0], //price
				"half", 						//length 
				get_the_content($product2), //detail
				$color2 ,
				$rand2        				//color
				);?> 
	<?php } ?>

	<?php if(strlen($product1) > 0){ ?>
	<?php 	includePart('components/molecule-package.php',
				$product1,
				get_field('icon',$product1), 	//$icon
				explode(" ",get_post($product1)->post_title, 2)[0],						//$line1
				explode(" ",get_post($product1)->post_title, 2)[1],					//$line2
				get_field('subtitle',$product1),			//$info
				"$".$product1_meta['_price'][0], 							//$price
				"half",						 	//length 
				get_the_content($product1),
				$color1,
				$rand1					 	//color
				);?> 
	<?php } ?>

	<?php if(strlen($product1) > 0){ ?>
	<?php 	includePart('components/molecule-package-info.php',
			$product1, //id
			get_the_title($product1), //title
			get_the_content($product1),
			$color1,
			"hidden-xs",
			$rand1 
			);?> 
	<?php } ?>

	<?php if(strlen($product2) > 0){ ?>
	<?php 	includePart('components/molecule-package-info.php',
			$product2, //id
			get_the_title($product2), //title
			get_the_content($product2),
			$color2,
			"hidden-xs",
			$rand2
			);?> 
	<?php } ?>