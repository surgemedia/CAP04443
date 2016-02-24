<?php
/* Adds the taxonomy page in the admin. */
add_action( 'admin_menu', 'my_add_admin_page' );

/**
 * Creates the admin page for the 'school' taxonomy under the 'Users' menu.  It works the same as any 
 * other taxonomy page in the admin.  However, this is kind of hacky and is meant as a quick solution.  When 
 * clicking on the menu item in the admin, WordPress' menu system thinks you're viewing something under 'Posts' 
 * instead of 'Users'.  We really need WP core support for this.
 */
function my_add_admin_page() {

	$tax = get_taxonomy( 'school' );

	add_users_page(
		esc_attr( $tax->labels->menu_name ),
		esc_attr( $tax->labels->menu_name ),
		$tax->cap->manage_terms,
		'edit-tags.php?taxonomy=' . $tax->name
	);
}


/* Add section to the edit user page in the admin to select school. */
add_action( 'show_user_profile', 'my_edit_user_section' );
add_action( 'edit_user_profile', 'my_edit_user_section' );

/**
 * Adds an additional settings section on the edit user/profile page in the admin.  This section allows users to 
 * select a school from a checkbox of terms from the school taxonomy.  This is just one example of 
 * many ways this can be handled.
 *
 * @param object $user The user object currently being edited.
 */
function my_edit_user_section( $user ) {

	$tax = get_taxonomy( 'school' );

	/* Make sure the user can assign terms of the school taxonomy before proceeding. */
	if ( !current_user_can( $tax->cap->assign_terms ) )
		return;

	/* Get the terms of the 'school' taxonomy. */
	$terms = get_terms( 'school', array( 'hide_empty' => false ) ); ?>

	<h3><?php _e( 'School' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="school"><?php _e( 'Select School' ); ?></label></th>

			<td><?php

			/* If there are any school terms, loop through them and display checkboxes. */
			if ( !empty( $terms ) ) {

				foreach ( $terms as $term ) { ?>
					<input type="radio" name="school" id="school-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( true, is_object_in_term( $user->ID, 'school', $term ) ); ?> /> <label for="school-<?php echo esc_attr( $term->slug ); ?>"><?php echo $term->name; ?></label> <br />
				<?php }
			}

			/* If there are no school terms, display a message. */
			else {
				_e( 'There are no schools available.' );
			}

			?></td>
		</tr>

	</table>
<?php } ?>
<?php 

/* Update the school terms when the edit user page is updated. */
add_action( 'personal_options_update', 'my_save_user_school_terms' );
add_action( 'edit_user_profile_update', 'my_save_user_school_terms' );

/**
 * Saves the term selected on the edit user/profile page in the admin. This function is triggered when the page 
 * is updated.  We just grab the posted data and use wp_set_object_terms() to save it.
 *
 * @param int $user_id The ID of the user to save the terms for.
 */
function my_save_user_school_terms( $user_id ) {

	$tax = get_taxonomy( 'school' );

	/* Make sure the current user can edit the user and assign terms before proceeding. */
	if ( !current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) )
		return false;

	$term = esc_attr( $_POST['school'] );

	/* Sets the terms (we're just using a single term) for the user. */
	wp_set_object_terms( $user_id, array( $term ), 'school', false);

	clean_object_term_cache( $user_id, 'school' );
}
 ?>