<?php while (have_posts()) : the_post(); ?>
	<?php 
// debug(get_id_from_slug('design-review'));
 ?>
<?php $page_id = get_the_ID(); ?>
<?php create_design_page(); ?>
<h1>Default Content Fields</h1>
<?php 

	echo "<pre>Title: ".get_the_title().'<br>';
	echo "Content (WYSWIG): ".get_the_content()."</pre>";

 ?>
 <h2>Extra Content Fields</h2>
	<?php 
	$the_query = new WP_Query( array( 'post_type' => 'acf-field-group') );

		// The Group Loop
		if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
		  $group_ID = get_the_ID();
		  $name = get_the_title();
		  if($group_ID != 43){
		  echo '<pre><h5><strong>Field Group: '.$name.'</strong></h5>';
					$field_query = new WP_Query( array( 'post_type' => 'acf-field','post_parent' => $group_ID, ) );
					// The Group Loop
					if ( $field_query->have_posts() ) :
					while ( $field_query->have_posts() ) : 
					 $field_query->the_post();
					 $field_ID = get_the_ID();
					 $name = get_the_title();
					 $field_obj = get_post( $field_ID);
					  // debug($field_obj);
					
					  echo '<br>Field Name: '.$field_obj->post_title.'<br>';
					  echo 'Field Type: ' .trim(explode(":",$field_obj->post_content)[6],';s'). '<br>';

					  echo 'Field Content:'."";
					  echo debug_notags(get_field($field_obj->post_name,$page_id))."<br>";
					  // echo '<dd>Field Type: ' .debug(explode(":",$field_obj->post_content)) . '</dd>';
					  // echo '<dd>Field Type: ' .debug(explode(":",$field_obj->post_content)[4]) . '</dd>';

				 	

					endwhile;
					endif;
					}
					echo "</pre>";
		endwhile;
		endif;
		
		// Reset Post Data
		wp_reset_postdata();
 ?>
 <?php  ?>
<?php endwhile; ?>