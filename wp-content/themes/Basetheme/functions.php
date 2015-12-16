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
  'lib/extras.php',                // Custom functions
  'lib/nav-walker.php',            // Navigation compatible with bootstrap & Sage
  'lib/function-debug.php',                // Custom functions
  'lib/aq_resizer.php',                // Custom functions
  'lib/function-get-featured-image-url.php',                // Custom functions
  'lib/function-hex2rgba.php',                // Custom functions
  'post_types/action-post-type-case-study.php',                // Custom Post Type
  'post_types/action-post-type-work.php',               // Custom Post Type
  'post_types/register-taxonomies.php',               // Custom Post Type
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
