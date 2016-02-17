<?php
/**
* Template Name: Home Template
*/
?>
<?php while (have_posts()) : the_post(); ?>
<?php 	includePart('components/organism-header.php');?>
<?php 	includePart('components/molecule-process.php',
get_field("image"),
get_field("title"),
get_field("process_description"));?>
<?php 	includePart('components/organism-services.php');?>
<?php 	includePart('components/organism-contact.php',
"https://unsplash.it/1080/600/?blur"); //image
?>
<?php endwhile; ?>
