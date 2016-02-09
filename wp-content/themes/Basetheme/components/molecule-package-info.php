<?php  
	$id			=$args[1];
	$title	=$args[2];
	$detail =$args[3];
	$color  =$args[4];
	$show   =$args[5];
?>


<div class="<?php echo $show;?>">
	<section class="package-info collapseExample-<?php echo $id;?> collapse col-lg-12 text-center <?php echo $color;?>" id="">
				<div class="box">
					<div class="package-collection">
						
					</div>
					<hgroup class="title">
						<?php if (!empty($title)):?> <h2><?php echo $title; ?></h2><?php endif; ?>
					</hgroup>
					<p class="detail"><?php echo $detail; ?></p>
					<ul>
						<li class=""><a href="">add now</a></li>
						<li class=""><a role="button" data-toggle="collapse" href=".collapseExample-<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample" >close</a></li>
					</ul>
				</div>
	
	</section>
</div>
