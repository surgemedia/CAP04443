<?php
/**
 * Template Name: Contactus Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php 	//includePart('components/header.php');?>
<?php //debug(get_permalink( get_option( 'woocommerce_shop_page_id' ))) ?>
<?php  	includePart('components/organism-contact.php', get_field('footer_form_background_image','option')); ?>
<?php endwhile; ?>
