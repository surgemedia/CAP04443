	<?php 
	/*===============================================
	=            Get Data for Work Post           =
	===============================================*/
	//Get Image and Service Name;
	$url = getFeaturedUrl(get_the_id());
	$service = wp_get_post_terms($post->ID, 'services', array("fields" => "all"))[0];
	$service_name = $service->name;
	$service_slug = $service->slug;
	// Get Client Name
	$client = wp_get_post_terms($post->ID, 'clients', array("fields" => "all"))[0];
	$client_id = $client->term_id;
	$client_name = $client->name;
	$color = hex2rgba( get_field('overlay_color') , 0.8);
	$this_id = get_the_id();
	/*===============================================
	=            Gets the Case Study URL            =
	===============================================*/
	$case_study_url =  '';
	$args = array ( 
		'post_type' => array( 'case_study' ),
		'tax_query' => array(
                                array(
                                'taxonomy' => 'clients',
                                'field' => term_id,
                                'terms' => $client_id,
                                )
                            )
		);
	$case_query = new WP_Query( $args );
		if ( $case_query->have_posts() ) {
			while ( $case_query->have_posts() ) { $case_query->the_post();
			
			$case_study_url = get_post_permalink();

			} } 
		wp_reset_postdata();

 	?>

	<article class="work-obj col-lg-4" style="background:url('<?php echo aq_resize($url,645,485,true,true,true); ?>');">
		<div class="overlay" style="background-color:<?php echo $color; ?>">
			<hgroup>
				<h1><a href="<?php echo $case_study_url.'#'.$service_slug ?>"><?php echo $client_name ?></a></h1>
				<h2><?php echo $service_name ?></h2>
			</hgroup>
			<a href=""></a>
		</div>
	</article>