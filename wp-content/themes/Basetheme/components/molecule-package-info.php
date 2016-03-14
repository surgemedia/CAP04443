<?php
	$id		=$args[1];
	$title	=$args[2];
	$detail =$args[3];
	$color  =$args[4];
	$show   =$args[5];
	$rand   =$args[6];

	$package_info =  get_package_attributes($id);
?>
<div class="<?php echo $show;?>">
	<section  class="package-info collapseExample-<?php echo $rand;?> collapse col-xs-12 text-center <?php echo $color;?>" >
		<div class="box">
			<div class="package-collection">
			<?php // debug($package_info) ?>
			<?php for ($i=0; $i < sizeof($package_info); $i++) {
				//debug($package_info[$i]);
				switch (trim($package_info[$i])) {
					case '5-mini-wallet':
							$text = '5-mini-wallet';
							$class = "pack-2-frames wallet";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					case 'bookmarks':
							$text = "bookmarks";
							$class = "pack-bookmarks";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					case 'class':
							$text = "Class";
							$class = "pack-class";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					case 'pendant-key-rings':
							$text = "pendant key rings";
							$class = "pack-combination";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					case 'three-5x7s':
							$text = "Three 5x7s";
							$class = "pack-3-frames inches5x7";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					case 'two-3.5x5s':
							$text = "Two 3.5x5s";
							$class = "pack-2-frames inches3x5";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					case 'two-wallet':
							$text = "Two Wallet";
							$class = "pack-2-frames wallet";
							includePart('components/atom-package-img.php',$text,$class);
						break;
					default:
							//nothing
						break;
				}

			} ?>
				
			</div>
			<hgroup class="title">
			<?php if (!empty($title)):?> <h2><?php echo $title; ?></h2><?php endif; ?>
			</hgroup>
			<p class="detail"><?php echo $detail; ?></p>
			<ul>
			<?php if($GLOBALS['turnoff_add'] != true ){ ?>
				<li class=""><a href="javascript:jQuery('#<?php echo $rand ?>cart a').click();">add now</a></li>
			<?php } ?>
				<li class=""><a href="javascript:jQuery('#<?php echo $rand ?>details a').click();" >close</a></li>
			</ul>
		</div>
	</section>
</div>