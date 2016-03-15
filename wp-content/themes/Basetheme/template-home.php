<?php
/**
* Template Name: Home Template
*/
?>
<?php while (have_posts()) : the_post(); ?>
<?php 	includePart('components/organism-header.php');?>
<?php 	includePart('components/molecule-process.php', aq_resize(get_field("image"),1920,1280,true,true,true), get_field("title"), get_field("process_description")); ?>
<?php 	includePart('components/organism-services.php');?>
<?php 	includePart('components/organism-contact.php', get_field('footer_form_background_image','option')); //image
?>
<?php endwhile; ?>