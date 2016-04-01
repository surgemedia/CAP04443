<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('components/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      if(is_page() && !is_page_template('template-shop.php') && !is_page_template('template-checkout.php') && !is_page_template('template-services.php') && !is_front_page()){
        $GLOBALS['header_class'] = 'full-width-header';
        get_template_part('components/header');
      }

    ?>
    <div class="wrap" role="document">
      <div class="content row">
        <main class="">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <!-- <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside> --><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
    //debug(is_page_template('template-shop.php'));
     if (!is_page_template('template-shop.php') && !is_page_template('template-services.php')){
       get_template_part('components/footer');  
     }
  
      wp_footer();
    ?>
  </body>
</html>
