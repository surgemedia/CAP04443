<?php  
	$id			=$args[1];
	$title	=$args[2];
	$detail =$args[3];
	$color  =$args[4];
	$show   =$args[5];
?>


<div class="<?php echo $show;?>">
	<section class="package-info collapseExample-<?php echo $id;?> collapse col-xs-12 text-center <?php echo $color;?>" id="">
				<div class="box">
					<div class="package-collection">
						<div class="col-lg-6 package-img">
							<i class="pack-3-frames inches5x7"></i>
							<div>Three 5x7s</div>
						</div>
						<div class="col-lg-6 package-img">
							<i class="pack-2-frames inches3x5"></i>
							<div>Two 3.5x5s</div>
						</div>
						<div class="col-lg-6 package-img">
							<i class="pack-2-frames wallet"></i>
							<div>Two wallets</div>
						</div>
						<div class="col-lg-6 package-img">
							<i class="pack-5-frames wallet"></i>
							<div>5 Mini Wallet</div>
						</div>
						<div class="col-lg-6 package-img">
							<i class="pack-class"></i>
							<div>Class</div>
						</div>
						<div class="col-lg-6 package-img">
							<i class="pack-combination"></i>
							<div>Pendant Key Rings</div>
						</div>						
						<div class="col-lg-6 package-img">
							<i class="pack-bookmarks"></i>
							<div>Bookmarks</div>
						</div>
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
