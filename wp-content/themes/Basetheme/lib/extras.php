<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/*======================================
=            EXTRA FUCTIONS            =
======================================*/

$custom_includes = [
  'lib/function-debug.php',    // Scripts and stylesheets
  'lib/aq_resizer.php',    // Scripts and stylesheets
  'lib/gravity_forms-v5.php',    // Scripts and stylesheets
  'lib/function-display-gravity-form.php',    // Scripts and stylesheets
  'lib/function-get_id_from_slug.php',    // Scripts and stylesheets
  'lib/function-get-featured-image-url.php',    // Scripts and stylesheets
  'lib/function-truncate-content.php',    // Scripts and stylesheets
  'lib/function-includePart.php',    // Scripts and stylesheets
  'lib/function-getUserTaxonomy.php',    // Scripts and stylesheets
  'lib/function-add-cart-fragment.php', // Add Cart Fragment
  'lib/function-show-option-page.php', // Show ACF option page
  'lib/taxonomy-school.php',   // Scripts and stylesheets
  'lib/function-programmatic_login.php',    // Scripts and stylesheets
  'lib/function-my_edit_user_section.php',    // Scripts and stylesheets
  'lib/function-user_logged_in.php',    // Scripts and stylesheets
  'lib/function-get-package-attributes.php',    // Scripts and stylesheets
  'lib/WC-extras.php',    // Scripts and stylesheets
  'lib/woocommerce-show-attributes.php'    // Scripts and stylesheets





];

foreach ($custom_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion in Extra', 'sage'), $file), E_USER_ERROR);
  }

  include $filepath;
}
unset($file, $filepath);

add_theme_support( 'woocommerce' );


// WP ALL EXPORT INTERTAL FUNCTION
/*
<?php
function getSchoolNameOrder($value){
  $school_id = get_user_meta($value, $key = '', $single = false)['school'][0];
  $school = get_term_by('id', $school_id[0], 'school');
  return $school_id; 
};

function getIDOrder($value){
  $user_id = get_user_meta($value, $key = '', $single = false)['description'][0];
  $user_id = explode('_',$user_id,2)[1];
  return $user_id;
};
?>
*/