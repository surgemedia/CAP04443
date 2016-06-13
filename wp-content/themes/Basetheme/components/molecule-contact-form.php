<?php 
	$title=$args[1];
 ?>

 <div class="contact-form">
 	<div class="box">
 		<h1 data-hide-on-submit="true" ><?php echo $title; ?></h1>
 		<div class="form">
 			<!-- ************** BEGIN GRAVITY FORM  ************-->
               <?php echo displayGravityForm(get_field('contact_form','option'),false); ?>
       <!-- ************** END GRAVITY FORM  ************-->

 		</div>
 	</div>
 </div>