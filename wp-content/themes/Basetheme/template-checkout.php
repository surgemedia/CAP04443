<?php
/**
 * Template Name: Checkout Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php 	includePart('components/header.php');?>

  

<?php the_content(); ?>





<?php 	includePart('components/organism-contact.php',
											"https://unsplash.it/1080/600/?blur"); //image
																						?>
							

<?php endwhile; ?>
