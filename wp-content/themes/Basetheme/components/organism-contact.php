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
					get_field('contact_detail-phone','option'), //phone
					get_field('contact_detail-email','option'), //email
					get_field('contact_detail-address','option') //POBOX
		);?>
	</div>
</div>