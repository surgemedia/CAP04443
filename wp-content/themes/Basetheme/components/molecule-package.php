<?php  
	$id			=$args[1];
	$icon		=$args[2];
	$line1		=$args[3];
	$line2		=$args[4];
	$info		=$args[5];
	$price		=$args[6];
	$length		=$args[7];
	$detail 	=$args[8];
	$color 		= $args[9];
	$rand =    $args[10];

	$price_button = do_shortcode('[add_to_cart id="'.$id.'"]' );
	$price_button = explode('</span>',$price_button)[1];
	$price_button = explode('</div>',$price_button)[0];

?>


<article class="package col-sm-<?php echo ("half"==$length)? '6': '12'; ?> text-center <?php echo $color;?>">
			<div class="box">
				<i class="<?php echo $icon;?>"></i>
				<hgroup class="title">
					<?php if (!empty($line1)):?> <h1><?php echo $line1; ?></h1> <?php endif; ?>
					<?php if (!empty($line2)):?> <h1><?php echo $line2; ?></h1> <?php endif; ?>
					
				</hgroup>
				<p class="info"><?php echo $info; ?></p>
				<ul>
					<li class="free"><div class="price"><?php echo $price; ?></div></li>
					<li id="<?php  echo $rand ?>cart" class="pull-left">
						<!-- <a href="" data-color="<?php echo $color;?>">add</a> -->
						<?php 
						echo $price_button;
						 ?>
					</li>
					<li id="<?php  echo $rand ?>details"  class="pull-right"><a class="detail" data-parent="packages" role="button" data-toggle="collapse" href=".collapseExample-<?php echo $rand; ?>" aria-expanded="false" aria-controls="collapseExample" >details</a></li>
				</ul>
			</div>
</article>
<?php 	includePart('components/molecule-package-info.php',
												$id, //id
												$line1." ".$line2, //title
												$detail,
												$color,
												"visible-xs",
												$rand,
												$price_button
												);?> 