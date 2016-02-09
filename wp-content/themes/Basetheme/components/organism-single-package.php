<?php  
	$id=$args[1];
	$color=$args[2];
?>

	<?php 	includePart('components/molecule-package.php',
												$id,
												"icon-insects", //$icon
												"Mini",					//$line1
												"Value Pack",		//$line2
												"Class + Mini Portrait Set",//$info
												"$30", //$price
												"full", //length 
												"The Mega Value Pack represents MEGA value, especially for families who like to send a decent sized photo to both sets of grandparents.
Our class groups are on a 8x10inch template (20.3x25.4cm). They are laminated in 100 micron film (as opposed to the more commonly used 80 micron film), which means they have a premium quality glass-like finish.
You can choose our standard border (your school colours), one of the custom borders (incorporating photos taken around your school) or we can work with you to develop a unique one to suit your tastes.",
												$color //color
												);?> 
<?php 	includePart('components/molecule-package-info.php',
												$id, //id
												"Mini Value Pack", //title
												"The Mega Value Pack represents MEGA value, especially for families who like to send a decent sized photo to both sets of grandparents.
		Our class groups are on a 8x10inch template (20.3x25.4cm). They are laminated in 100 micron film (as opposed to the more commonly used 80 micron film), which means they have a premium quality glass-like finish.
		You can choose our standard border (your school colours), one of the custom borders (incorporating photos taken around your school) or we can work with you to develop a unique one to suit your tastes.",
												$color,
												"hidden-xs"
												);?> 