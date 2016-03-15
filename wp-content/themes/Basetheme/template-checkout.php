<?php
/**
 * Template Name: Checkout Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php 	includePart('components/header.php');?>
	
<?php   the_content(); ?>
<?php endwhile; ?>
