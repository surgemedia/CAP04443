<?php
/**
 * Template Name: Custom Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>

<div class="col-lg-6">
	<?php 	includePart('includes/organism-user-info.php');?>
</div>
<div class="col-lg-6">
		<div class="card col-lg-6">
			<i class="glyphicon glyphicon-start"></i>
			<div class="package">
				Package heart
			</div>
			<p class="info">heart + love</p>
			<a href="">add</a>
			<div class="price">$30</div>
			<a href="">details</a>
		</div>
</div>


<?php endwhile; ?>
