<?php
/**
 * Template Name: Form Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php 	//includePart('components/header.php');?>
<div class="simple-page col-lg-6 col-lg-offset-3" >
<h1 class="text-center"><?php the_title(); ?></h1>
<?php   the_content(); ?>
<?php if(get_field('contact_form')){ ?>
 <?php echo displayGravityForm(get_field('contact_form'),get_field('title_form')); ?>
<?php } ?>
</div>
<?php  	includePart('components/organism-contact.php', get_field('footer_form_background_image','option')); ?>
<?php endwhile; ?>
