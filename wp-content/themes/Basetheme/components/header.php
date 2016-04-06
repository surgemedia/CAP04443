<header class="banner <?php echo  $GLOBALS['header_class'] ?>">
  
    <div class="menu">
      <button type="button" class="navbar collapsed">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      </div>
  <div class="box">
    <div class="menu-wrap">
      <nav role="navigation">
           
        <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
           <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
        </div>
      </nav>
    </div>    
  </div>
  <?php if(!is_front_page()){ ?>
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img width="61" height="61" src="<?php echo get_field('small_logo','option') ?>" alt="<?php bloginfo('name'); ?>" /></a>
    <?php } ?>
  <?php if(is_user_logged_in()){ ?>
  <div class="logout pull-right"> 
    <a href="<?php echo wp_logout_url( home_url() ); ?>">
      LOG OUT
    </a>
  </div>
  <?php if(!is_page_template('template-shop.php')){ ?>
  <div class="shop pull-right"> 
    <a href="<?php echo get_field('shopping_page','option') ?>">
      Keep Shopping
    </a>
  </div>
  <?php }  ?>

  <?php } else { ?>
   <div class="logout pull-right">
    <a href="/">
     Log In
    </a>
  </div>

    <?php } ?>

</header> 