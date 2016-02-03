<?php  
	$id			=$args[1];
	$title	=$args[2];
	$detail =$args[3];

?>


<section class="package-info collapse col-lg-12 text-center" id="collapseExample-<?php echo $id; ?>">
			<div class="box">
				<div class="package-collection">
					
				</div>
				<hgroup class="title">
					<?php if (!empty($title)):?> <h2><?php echo $title; ?></h2><?php endif; ?>
				</hgroup>
				<p class="detail"><?php echo $detail; ?></p>
				<ul>
					<li class=""><a href="">add now</a></li>
					<li class=""><a role="button" data-toggle="collapse" href="#collapseExample-<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample" >close</a></li>
				</ul>
			</div>

</section>