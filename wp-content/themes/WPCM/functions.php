<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */


$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/nav.php',                   // Custom nav modifications
  'lib/gallery.php',               // Custom [gallery] modifications
  'lib/extras.php',                // Custom functions
  'lib/function-debug.php',                                 // Debug Values
  'lib/function-content-manger-get-color.php',              // Page Content Manager
  'lib/function-truncate-content.php',                      // Truncate Content
  'lib/acf.php',                                            // ACF
  'lib/function-create-design-page.php',
  'lib/function-get_id_from_slug.php',
  'lib/action-post-type-testimonial.php',                          
                            
  // Wp Actions
  // 'lib/action-registor-menu-locations.php',                  



                                   
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


// $GLOBALS["WPCM_id"] = get_id_from_slug('design-review'); 