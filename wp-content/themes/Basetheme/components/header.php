<header class="banner">
  <div class="box">
    <!-- <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> -->
    <div class="menu">
      <button type="button" class="navbar collapsed">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      </div>
    <div class="menu-wrap">
      <nav role="navigation">
           
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
            ?>

        </div>
       
      </nav>
    </div>    
  </div>
  <div class="logout pull-right">
    <a href="">
      LOG OUT
    </a>
  </div>

</header> 