<?php
//Theme Settings Page
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'General Options',
    'menu_title'  => 'Options',
    'menu_slug'   => 'general-options',
    'capability'  => 'edit_posts',
  ));
  
}
