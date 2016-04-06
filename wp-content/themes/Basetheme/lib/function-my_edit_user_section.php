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
 
 
 ?>