<?php 
// Register Custom Post Type
function casestudies_init() {

	$labels = array(
		'name'                => _x( 'Case Studies', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Case Study', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Case Studies', 'text_domain' ),
		'name_admin_bar'      => __( 'Case Study', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Case Study:', 'text_domain' ),
		'all_items'           => __( 'All Case Studies', 'text_domain' ),
		'add_new_item'        => __( 'Add New Case Study', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Case Study', 'text_domain' ),
		'edit_item'           => __( 'Edit Case Study', 'text_domain' ),
		'update_item'         => __( 'Update Case Study', 'text_domain' ),
		'view_item'           => __( 'View Case Study', 'text_domain' ),
		'search_items'        => __( 'Search Case Study', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Case Study', 'text_domain' ),
		'description'         => __( 'Case Studies of our clients', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'          => array( 'services', 'clients' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-exerpt-view',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'case_study', $args );

}
add_action( 'init', 'casestudies_init', 0 );