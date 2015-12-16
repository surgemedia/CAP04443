<?php
/**
 * Template Name: Home Page Template
 */
?>

<?php while (have_posts()) : the_post(); ?>


<?php get_template_part('templates/carousel'); ?>

<section id="main-content" class="row">
	<div class="container">
		<main class="quote text-center"><?php the_content(); ?></main>
		<small class="col-lg-12 text-center">Aegir Brands &amp; Ben Trowse, Founding Partners</small>
	</div>
</section>



<section id="work" class="container-fluid">
<div class="row">
<?php 
// debug(get_field('featured_work'));
$featured_work = get_field('featured_work');
$case_study_home = array();
$work_home = array();

for ($i=0; $i < sizeof($featured_work); $i++) { 
	$obj = $featured_work[$i];
	$case_study_obj = $obj[case_study];
	$work_type = $obj[type_of_work];
	array_push($work_home, $work_type);
	array_push($case_study_home, $case_study_obj->ID);
	$case_study_url = get_permalink($case_study_obj->ID);
}
for ($j=0; $j < sizeof($case_study_home); $j++) {
	include(locate_template('templates/work-obj.php'));
}
		 ?>
	</div>
</section>

<section id="casestudy">
	<hgroup class="text-center">
		<h1>Our Clients</h1>
		<h2>The passion for what we do comes through  <br> our Outstanding Clients</h2>
	</hgroup>
	<div class="container-fluid">
	<?php 
		// WP_Query arguments
		$args = array (
			'post_type'              => array( 'case_study' ),
			'posts_per_page'	=> -1,
			'post__in' => get_field('featured_case_study'),
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				include(locate_template('templates/casestudy-obj.php'));
			}
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();
	?>
	</article>

	</div>
</section>
<?php endwhile; ?>


