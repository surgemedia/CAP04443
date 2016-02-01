<?php
/**
* Template Name: Content Manager
*/
?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('templates/page', 'header'); ?>
<div id="content-manager" >
	<h3>Pages</h3>
	<ul>
		<?php
		// WP_Query arguments
		$args = array (
			'post_type'              => ['page'],
			'orderby'                => 'parent',
			'posts_per_page' => -1,
			'post_status' => 'any',
			'post_parent' => 0
		);
		// The Query
		$query = new WP_Query( $args );
		// The Loop
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
		$query->the_post(); ?>
		
		<?php get_template_part('templates/content-manager/page', 'child-element'); ?>
	
	<?php
	}
	} else {
		get_template_part('templates/', 'no-content-post');
	}
	// Restore original Post Data
	wp_reset_postdata();
	?>
</ul>
<h3>People</h3>
<?php
// WP_Query arguments
$args = array (
	'post_type'              => ['people'],
	'orderby'                => 'parent',
	'posts_per_page' => -1,
	'post_status' => 'any',
);
// The Query
$query = new WP_Query( $args );
// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
$query->the_post(); ?>
<?php $field = get_field_object('sign_off_level');
	$value = get_field('sign_off_level');
$label = $field['choices'][ $value ]; ?>
<div class="container">
	<a class="col-sm-3" href="<?php get_permalink();?>"><?php the_title();?></a>
	<span class="label label-default"> <?php echo $label; ?></span>

</div>
<?php
}
} else {
	get_template_part('templates/', 'no-content-post');
}
// Restore original Post Data
wp_reset_postdata();
?>
<h3>Testimonails</h3>
<?php
// WP_Query arguments
$args = array (
	'post_type'              => ['testimonial'],
	'orderby'                => 'parent',
	'posts_per_page' => -1,
	'post_status' => 'any',
);
// The Query
$query = new WP_Query( $args );
// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
$query->the_post(); ?>
<?php $field = get_field_object('sign_off_level');
	$value = get_field('sign_off_level');
$label = $field['choices'][ $value ]; ?>
<div class="container">
	<a class="col-sm-3" href="<?php get_permalink();?>"><?php the_title();?></a>
	<span class="label label-default"> <?php echo $label; ?></span>

</div>
<?php
}
} else {
	get_template_part('templates/', 'no-content-post');
}
// Restore original Post Data
wp_reset_postdata();
?>










<?php  acf_enqueue_uploader(); ?>
<script type="text/javascript">
(function($) {
	
	// setup fields
	acf.do_action('append', $('#popup-id'));
	
})(jQuery);	
</script>
</div>
<?php endwhile; ?>