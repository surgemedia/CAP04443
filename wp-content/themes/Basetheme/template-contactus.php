<?php
/**
 * Template Name: Contactus Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php 	//includePart('components/header.php');?>
<?php  	includePart('components/organism-contact.php', get_field('footer_form_background_image','option')); ?>
<?php endwhile; ?>
