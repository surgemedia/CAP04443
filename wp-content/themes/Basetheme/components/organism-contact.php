<?php 
	$image=$args[1];
 ?>

<div class="contact" style="background-image:url('<?php echo $image;?>')">
	
	<div class="col-md-6 col-md-push-6">
				<?php 	includePart('components/molecule-contact-form.php',
											"Make An Enquiry" //title
											);
 		?>
	</div>
	<div class="col-md-6 col-md-pull-6">
		<?php 	includePart('components/molecule-contact-detail.php',
											"Contact Us", //title
											"(07) 3846 6391",//phone
											"info@capricornphotography.com.au",//email
											"PO Box 58, Albany Creek 4035"//POBOX
											);?>
	</div>
</div>