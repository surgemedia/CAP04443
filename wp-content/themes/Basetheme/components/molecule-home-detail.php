<?php 
	$logo=$args[1];
	$details=$args[2];
	$link=$args[3];

 ?>


<div class="home-detail">
	<img class="img-responsive hidden-sm hidden-xs" width="530" height="150" src="<?php echo $logo; ?>" alt="">
	<div class="box">
		<?php echo $details ?>
		<p><?php the_content(); ?></p>
		<a class="btn-basic" href="<?php echo $link; ?>">Read More</a>
	</div>
</div>