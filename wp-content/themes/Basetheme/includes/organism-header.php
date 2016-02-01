<div class="header">
	
	<div class="col-lg-6">
		<?php 	includePart('includes/molecule-home-detail.php',
											get_field("logo","options"), //logo
											"",//content
											"/about");?>
	</div>
	<div class="col-lg-6">
				<?php 	includePart('includes/molecule-login.php',
											"https://unsplash.it/600/800/?blur" //image
											);
 		?>
	</div>
</div>