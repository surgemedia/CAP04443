<?php 
// Register Custom Taxonomy
function clients_init() {

	$labels = array(
		'name'                       => _x( 'Clients', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Client', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Clients', 'text_domain' ),
		'all_items'                  => __( 'All Clients', 'text_domain' ),
		'parent_item'                => __( 'Parent Client', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Client:', 'text_domain' ),
		'new_item_name'              => __( 'New Client Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Client', 'text_domain' ),
		'edit_item'                  => __( 'Edit Client', 'text_domain' ),
		'update_item'                => __( 'Update Client', 'text_domain' ),
		'view_item'                  => __( 'View Client', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Clients', 'text_domain' ),
		'search_items'               => __( 'Search Clients', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'clients', array( 'case_study', 'work' ), $args );

}
add_action( 'init', 'clients_init', 0 );

// Register Custom Taxonomy
function services_init() {

	$labels = array(
		'name'                       => _x( 'Services', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Service', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Services', 'text_domain' ),
		'all_items'                  => __( 'All Services', 'text_domain' ),
		'parent_item'                => __( 'Parent Service', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Service:', 'text_domain' ),
		'new_item_name'              => __( 'New Service Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Service', 'text_domain' ),
		'edit_item'                  => __( 'Edit Service', 'text_domain' ),
		'update_item'                => __( 'Update Service', 'text_domain' ),
		'view_item'                  => __( 'View Service', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Services', 'text_domain' ),
		'search_items'               => __( 'Search Services', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'services', array( 'work' ), $args );

}
add_action( 'init', 'services_init', 0 );


function add_custom_menu_item(){
    add_menu_page( 'Clients', 'Clients', 'manage_options', 'page_slug', 'function', 'dashicons-heart', 25 );
}
add_action( 'admin_menu', 'add_custom_menu_item' );

function custom_menu_item_redirect() {

    $menu_redirect = isset($_GET['page']) ? $_GET['page'] : false;

    if($menu_redirect == 'page_slug' ) {
        wp_safe_redirect( home_url('/wp-admin/edit-tags.php?taxonomy=clients&post_type=case_study') );
        exit();
    }

}
add_action( 'admin_init', 'custom_menu_item_redirect', 1 );