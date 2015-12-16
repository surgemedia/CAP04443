<header class="banner" role="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="navbar navbar-default col-xs-12 ">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navigation" aria-expanded="false">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse " id="primary-navigation">
          <?php
              if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(['theme_location' => 'primary_navigation','depth'=> 7,'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
              endif;
          ?>
      </div>
    </nav>
  </div>
</header>
