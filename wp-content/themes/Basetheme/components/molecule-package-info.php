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
				debug($package_info[$i]);
				switch (trim($package_info[$i])) {
					//5x7s
					case '5x7s':
							$text = 'One 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '2-5x7s':
							$text = 'Two 5x7s';
							$mainClass = "pack-2-frames";
							$class = "pack-5x7s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					csane '3-5x7s':
							$text = 'Three 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '4-5x7s':
							$text = 'Four 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//3x35
					case '3.5x5s':
							$text = 'One 3.5x5s';
							$mainClass = "pack-1-frames";
							$class = "pack-3-5x5s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '2-3.5x5s':
							$text = 'Two 3.5x5s';
							$class = "pack-2-5x5s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '3-3.5x5s':
							$text = 'Three 3.5x5s';
							$class = "pack-3-5x5s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '4-3.5x5s':
							$text = 'Four 3.5x5s';
							$class = "pack-4-5x5s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//6x4s
					case '6x4s':
							$text = 'One 6x4s';
							$mainClass = "pack-1-frames";
							$class = "pack-6x4s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '2-6x4s':
							$text = 'Two 6x4s';
							$mainClass = "pack-2-frames";
							$class = "pack-6x4s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '3-6x4s':
							$text = 'Three 6x4s';
							$class = "pack-6x4s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '4-6x4s':
							$text = 'Four 6x4s';
							$class = "pack-6x4s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;

					//8x12s
					case '8x12s':
							$text = 'One 8x12s';
							$mainClass = "pack-1-frames";
							$class = "pack-8x12s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '2-8x12s':
							$text = 'Two 8x12s';
							$mainClass = "pack-2-frames";
							$class = "pack-8x12s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '3-8x12s':
							$text = 'Three 8x12s';
							$class = "pack-8x12s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '4-8x12s':
							$text = 'Four 8x12s';
							$class = "pack-8x12s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//pack-A4-folder
					case 'a4-folder':
							$text = 'Four A4 Folder';
							$class = "pack-A4-folder";
							includePart('components/atom-package-img-1.php',$text,$class);
							break;
					//portrait-group-folder
					case 'portrait-group-folder':
							$text = 'Portrait Group Folder';
							$class = "portrait-group-folder";
							includePart('components/atom-package-img-1.php',$text,$class);
							break;
					//TRADITIONAL-GROUP-FOLDER
					case 'traditional-group-folder':
							$text = 'traditional group folder';
							$class = "traditional-group-folder";
							includePart('components/atom-package-img-1.php',$text,$class);
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
							$class = "pack-pendant-key-rings";
							includePart('components/atom-package-img-1.php',$text,$class);
							break;
					case '2-wallet':
								$text = "Two Wallet";
								$class = "two-wallet";
								includePart('components/atom-package-img-1.php',$text,$class);
							break;

						default:
								//nothing
							break;
					}
					// case 'two-3.5x5s':
					// 		$text = "Two 3.5x5s";
					// 		$class = "pack-2-frames inches3x5";
					// 		includePart('components/atom-package-img.php',$text,$class);
					// 		break;
					// case 'three-5x7s':
					// 		$text = "Three 5x7s";
					// 		$class = "pack-3-frames inches5x7";
					// 		includePart('components/atom-package-img.php',$text,$class);
					// 		break;

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