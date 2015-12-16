	<?php

	$args = array ( 
		'post_type' => array( 'work' ),
		'tax_query' => array(
                                array(
                                'taxonomy' => 'services',
                                'field' => 'slug',
                                'terms' => $work_home[$j],
                                )
                            ),
		'post__in' => get_field('selected_work',$case_study_home[$j]),
		'orderby' => 'post__in'
		);
	$case_query = new WP_Query( $args );
		if ( $case_query->have_posts() ) {
			while ( $case_query->have_posts() ) { $case_query->the_post();
			$url = getFeaturedUrl(get_the_id());
	 		$client = wp_get_post_terms(get_the_id(), 'clients', array("fields" => "all"))[0];
	 		
	 		// 	$client_id = $client->term_id;
			// $client_name = $client->name;

			$color = hex2rgba( get_field('overlay_color') , 0.8); ?>
	<article class="work-obj col-lg-4" style="background:url('<?php echo aq_resize($url,645,485,true,true,true); ?>');">
		<div class="overlay" style="background-color:<?php echo $color; ?>">
			<hgroup>
				<h1><a href="<?php echo $case_study_url.'#'.$work_home[$j]; ?>"><?php echo $client->name ?></a></h1>
				<h2><?php echo $work_home[$j]; ?></h2>
			</hgroup>
		</div>
	</article>
			<?php
			} }
	wp_reset_postdata();
	?>
	

	<?php
	/*===============================================
	=            Get Data for Work Post           =
	===============================================*/
	// //Get Image and Service Name;
	// $url = getFeaturedUrl(get_the_id());
	// $service = wp_get_post_terms($post->ID, 'services', array("fields" => "all"))[0];
	// $service_name = $service->name;
	// $service_slug = $service->slug;
	// // Get Client Name
	// $client_id = $client->term_id;
	// $client_name = $client->name;
	// $color = hex2rgba( get_field('overlay_color') , 0.8);
	// $this_id = get_the_id();
	/*===============================================
	=            Gets the Case Study URL            =
	===============================================*/
	
	

 	?>

	