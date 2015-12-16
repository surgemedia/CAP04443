<?php
/**
 * Template Name: Home Page Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php 
	$exlude = array();
 ?>	
<section id="main-content" class="row">
	<div class="container">
	<?php debug('Main Content') ?>
		<main class="quote text-center"><?php the_content(); ?></main>
		<!-- <small class="col-lg-12 text-center">Aegir Brands &amp; Ben Trowse, Founding Partners</small> -->
	</div>
</section>
<?php  if(get_field('body_of_work')): ?>
    <?php while(the_repeater_field('body_of_work')): ?>
	<?php  $obj = get_sub_field('selected_work')[0]; ?>
       <?php debug(get_sub_field('selected_work')[0]); ?>
    <?php endwhile; ?>

 <?php endif; ?>

<?php endwhile; ?>


