<?php  
	$args['image']=$args[1];
	$args['title']=$args[2];
	$args['content']=$args[3];
	$args['register_text']=$args[4];
	$args['register_link']=$args[5];
	$args['more_info_link']=$args[6];
	$args['more_info_text']=$args[7];

?>
<section class="service">
	<div class="col-md-6 col-md-push-6">
		<div class="image" style="background-image: url('<?php echo $args['image'];?>')"></div>
	</div>
	<div class="col-md-6 col-md-pull-6">
		<div class="frame">
				<div class="box">
					<div class="content">
						<h1><?php echo$args['title'] ?></h1>
						<?php echo $args['content'] ?>
						<?php
							if(strlen($args['register_link']) > 0){
								$args['register_link'] = '/register';
							} 
							if(strlen($args['more_info_link']) > 0){
								$args['more_info_link'] = '/services';
							} 
						?>
						<a class="register" href="<?php echo $args['register_link'] ?>"><?php echo $args['register_text'] ?></a>
					
						<a class="more-info" href="<?php echo $args['more_info_link'] ?>"><?php echo $args['more_info_text'] ?></a>
					</div>
				</div>
		</div>
	</div>
</section>