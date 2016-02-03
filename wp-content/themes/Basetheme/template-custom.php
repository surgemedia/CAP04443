<?php
/**
 * Template Name: Custom Template
 */
?>

<?php while (have_posts()) : the_post(); ?>

<div class="col-lg-6">
  <?php 	includePart('components/header.php');?> 
	<?php 	includePart('components/organism-user-info.php');?>
</div>
<div class="col-lg-6 packages">
	<?php 	includePart('components/organism-double-package.php',
												"1", //$id1
												"2" //$id2
												);?> 
	<?php 	includePart('components/organism-double-package.php',
												"3", //$id1
												"4" //$id2
												);?>  
	<?php 	includePart('components/organism-single-package.php',
												"5" //$id1
												);?>
	<!-- <?php 	includePart('components/molecule-package.php',
	         											      											"icon-bows", //$icon
	         											      											"Class",					//$line1
	         											      											"",		//$line2
	         											      											"8x10'' laminated photo with school name, logo, & the group's name ",//$info
	         											      											"$40", //$price
	         											      											"half" //length 
	         											      											);?>      -->         											      
													
</div>


<?php endwhile; ?>

