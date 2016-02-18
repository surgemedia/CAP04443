<div class="header">
	<div class="home-menu col-xs-12 col-lg-6">
		<img class="hidden-lg" width="auto" height="69" src="<?php echo get_field("logo","option"); ?>" alt="">
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
				get_field("logo","options"), //logo
				"",//content
		"/about");?>
	</div>
</div>