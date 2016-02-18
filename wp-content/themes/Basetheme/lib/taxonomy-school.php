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
/*


 ?>