<?php
/*
Plugin Name: CodePen oEmbed
Description: Adds oEmbed support for CodePen.io
Version: 1.0
Author: Pippin Williamson and Andrew Norcross
Author URI: http://pippinsplugins.com
Contributors: mordauk, norcross
*/

wp_oembed_add_provider( 'http://codepen.io/*/pen/*', 'http://codepen.io/api/oembed' );
