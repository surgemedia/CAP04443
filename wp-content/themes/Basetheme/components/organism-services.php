<?php
$flick="even";
// check if the repeater field has rows of data
if( have_rows('services') ):

 	// loop through the rows of data
    while ( have_rows('services') ) : the_row();

  			if ("even"==$flick) {
					includePart('components/molecule-service-even.php',
											get_sub_field("image"),
											get_sub_field("title"),
											get_sub_field("content"),
											get_sub_field("register_text"),
											get_sub_field("register_link"),
											get_sub_field("more_info_text"),
											get_sub_field("more_info_link"));
											$flick="odd";
  			} else {
  				includePart('components/molecule-service-odd.php',
											get_sub_field("image"),
											get_sub_field("title"),
											get_sub_field("content"),
											get_sub_field("register_text"),
											get_sub_field("register_link"),
											get_sub_field("more_info_text"),
											get_sub_field("more_info_link"));
											$flick="even";
  			}
    endwhile;

else :

    // no rows found

endif;

?>