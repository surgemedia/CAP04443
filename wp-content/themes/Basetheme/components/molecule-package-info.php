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
						<div class="col-lg-6">
							<i class="pack-3_5x5s"></i>
							<p>3.5x5s</p>
						</div>
						<div class="col-lg-6">
							<i class="pack-5x7s"></i>
							<p>5x7s</p>
						</div>
						<div class="col-lg-6">
							<i class="pack-bookmarks"></i>
							<p>Bookmarks</p>
						</div>
						<div class="col-lg-6">
							<i class="pack-class"></i>
							<p>Class</p>
						</div>
						<div class="col-lg-6">
							<i class="pack-graduation"></i>
							<p>Graduation</p>
						</div>
						<div class="col-lg-6">
							<i class="pack-mini_wallet"></i>
							<p>Mini Wallet</p>
						</div>
						<div class="col-lg-6">
							<i class="pack-pendant_key_rings"></i>
							<p>Pendant Key Rings</p>
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
