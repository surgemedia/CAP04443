<?php  
	$image=$args[1];
	$title=$args[2];
	$content=$args[3];
	$register_text=$args[4];
?>
<section class="service">
	<div class="col-lg-6">
		<div class="image" style="background-image: url('<?php echo $image;?>')"></div>
	</div>
	<div class="col-lg-6">
		<div class="frame">
				<div class="box">
					<div class="content">
						<h1><?php echo $title; ?></h1>
						<?php echo $content ?>
						<a class="register" href="#"><?php echo $register_text; ?></a>
					
						<a class="more-info" href="#">More Info</a>
					</div>
				</div>
		</div>
	</div>
</section>