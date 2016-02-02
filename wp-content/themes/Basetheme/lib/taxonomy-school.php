<?php 
// Register Custom Taxonomy
function schoolTaxonomy() {

	$labels = array(
		'name'                       => _x( 'Schools', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'School', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'School', 'text_domain' ),
		'all_items'                  => __( 'All schools', 'text_domain' ),
		'parent_item'                => __( 'Parent school', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent school:', 'text_domain' ),
		'new_item_name'              => __( 'New School Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New school', 'text_domain' ),
		'edit_item'                  => __( 'Edit school', 'text_domain' ),
		'update_item'                => __( 'Update school', 'text_domain' ),
		'view_item'                  => __( 'View school', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate schools with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove schools', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular schools', 'text_domain' ),
		'search_items'               => __( 'Search schools', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No schools', 'text_domain' ),
		'items_list'                 => __( 'schools list', 'text_domain' ),
		'items_list_navigation'      => __( 'schools list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'school', array('user' ), $args );

}
add_action( 'init', 'schoolTaxonomy', 0 );


/*=======================================
=            Show in Backend            =
 * Creates the admin page for the 'school' taxonomy under the 'Users' menu.  It works the same as any 
 * other taxonomy page in the admin.  However, this is kind of hacky and is meant as a quick solution.  When 
 * clicking on the menu item in the admin, WordPress' menu system thinks you're viewing something under 'Posts' 
 * instead of 'Users'.  We really need WP core support for this.
=======================================*/
add_action( 'admin_menu', 'my_add_school_admin_page' );
function my_add_school_admin_page() {

	$tax = get_taxonomy( 'school' );

	add_users_page(
		esc_attr( $tax->labels->menu_name ),
		esc_attr( $tax->labels->menu_name ),
		$tax->cap->manage_terms,
		'edit-tags.php?taxonomy=' . $tax->name
	);
}
/*==========================================
=            USER SCHOOL SELECT            =
==========================================*/
/* Add section to the edit user page in the admin to select school. */
add_action( 'show_user_profile', 'my_edit_user_school_section' );
add_action( 'edit_user_profile', 'my_edit_user_school_section' );

/**
 * Adds an additional settings section on the edit user/profile page in the admin.  This section allows users to 
 * select a school from a checkbox of terms from the school taxonomy.  This is just one example of 
 * many ways this can be handled.
 *
 * @param object $user The user object currently being edited.
 */
function my_edit_user_school_section( $user ) {
	$tax = get_taxonomy( 'school' );
	/* Make sure the user can assign terms of the school taxonomy before proceeding. */
	if ( !current_user_can( $tax->cap->assign_terms ) )
		return;
	/* Get the terms of the 'school' taxonomy. */
	$terms = get_terms( 'school', array( 'hide_empty' => false ) ); 
		include(locate_template('components/atom-userfields-school.php'));
	?>
<?php }

/*==========================================
=            Save the Data          =
 * Saves the term selected on the edit user/profile page in the admin. This function is triggered when the page 
 * is updated.  We just grab the posted data and use wp_set_object_terms() to save it.
==========================================*/
/* Update the school terms when the edit user page is updated. */
add_action( 'personal_options_update', 'my_save_user_school_terms' );
add_action( 'edit_user_profile_update', 'my_save_user_school_terms' );
function my_save_user_school_terms( $user_id ) {
// -------------SCHOOL
	$tax = get_taxonomy( 'school' );
	/* Make sure the current user can edit the user and assign terms before proceeding. */
	if ( !current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) )
		return false;
	$term = esc_attr( $_POST['school'] );
	/* Sets the terms (we're just using a single term) for the user. */
	wp_set_object_terms( $user_id, array( $term ), 'school', false);
	clean_object_term_cache( $user_id, 'school' );
// -------------SCHOOL YEAR
	$saved = false;
	  if ( current_user_can( 'edit_user', $user_id ) ) {
	    update_user_meta( $user_id, 'year', $_POST['year'] );
	    $saved = true;
	  }
	  return true;

}



 ?>