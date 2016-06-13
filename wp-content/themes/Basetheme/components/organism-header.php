<div class="header">
	<div class="home-menu col-xs-12 col-lg-6">
		<img class=" hidden-lg hidden-xs " width="auto" height="69" src="<?php echo get_field("logo","option"); ?>" alt="">
		<img class="img-responsive hidden-md hidden-lg hidden-sm" width="61" height="61" src="<?php echo get_field('small_logo','option') ?>" alt="<?php bloginfo('name'); ?>" />
		<?php 	includePart('components/header.php');?>
	</div>
	<div class="col-xs-12 col-lg-6 col-lg-push-6">
		<?php 	includePart('components/molecule-login.php',
			get_field('login_background') //image
			);
		?>
	</div>
	<div class="col-xs-12 col-lg-6 col-lg-pull-6">
		<?php 	includePart('components/molecule-home-detail.php',
				get_field("logo","option"), //logo
				"",//content
				"/about",
				get_field("logo","option")
				);?>
	</div>
</div>