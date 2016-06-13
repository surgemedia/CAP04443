<?php
	$id		=$args[1];
	$title	=$args[2];
	$detail =$args[3];
	$color  =$args[4];
	$show   =$args[5];
	$rand   =$args[6];

	$package_info =  get_package_attributes($id);
	//debug($title);
?>
<div class="<?php echo $show;?>">
	<section  class="package-info collapseExample-<?php echo $rand;?> collapse col-xs-12 text-center <?php echo $color;?>" >
		<div class="box">
			<div class="package-collection">
			<?php for ($i=0; $i < sizeof($package_info); $i++) {
				//debug($package_info[$i]);
				switch (trim($package_info[$i])) {
					//5x7s
					case '5x7s':
							$text = 'One 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '5x7s-1':
							$text = 'One 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '5x7s-2':
							$text = 'Two 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '5x7s-3':
							$text = 'Three 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '5x7s-4':
							$text = 'Four 5x7s';
							$class = "pack-5x7s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//3x35
					case '3.5x5s-1':
							$text = 'One 3.5x5s';
							$mainClass = "pack-1-frames";
							$class = "pack-3-5x5s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '3.5x5s-2':
							$text = 'Two 3.5x5s';
							$class = "pack-3-5x5s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '3.5x5s-3':
							$text = 'Three 3.5x5s';
							$class = "pack-3-5x5s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '3.5x5s-4':
							$text = 'Four 3.5x5s';
							$class = "pack-3-5x5s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//6x4s
					case '6x4s-1':
							$text = 'One 6x4s';
							$mainClass = "pack-1-frames";
							$class = "pack-6x4s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '6x4s-2':
							$text = 'Two 6x4s';
							$mainClass = "pack-2-frames";
							$class = "pack-6x4s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '6x4s-3':
							$text = 'Three 6x4s';
							$class = "pack-6x4s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '6x4s-4':
							$text = 'Four 6x4s';
							$class = "pack-6x4s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;

					//8x12s
					case '8x12s-1':
							$text = 'One 8x12s';
							$mainClass = "pack-1-frames";
							$class = "pack-8x12s";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case '8x12s-2':
							$text = 'Two 8x12s';
							$mainClass = "pack-2-frames";
							$class = "pack-8x12s";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case '8x12s-3':
							$text = 'Three 8x12s';
							$class = "pack-8x12s";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case '8x12s-4':
							$text = 'Four 8x12s';
							$class = "pack-8x12s";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//pack-A4-folder
					case 'a4-folder':
							$text = 'A4 Folder';
							$class = "pack-a4-folder";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Folder-A4':
							$text = 'A4 Folder';
							$class = "pack-a4-folder";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					//portrait-group-folder
					case 'Folder-portrait-group':
							$text = 'Portrait Group Folder';
							$class = "pack-portrait-group-folder";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					//TRADITIONAL-GROUP-FOLDER
					case 'Folder-traditional-group':
							$text = 'Traditional Group Folder';
							$class = "pack-traditional-group-folder";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					//Bookmarks
					case 'Bookmarks-1':
							$text = "One Bookmarks";
							$class = "pack-bookmarks";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Bookmark-1':
							$text = "One Bookmarks";
							$class = "pack-bookmarks";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Bookmarks-2':
							$text = "Two Bookmarks";
							$class = "pack-bookmarks";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case 'Bookmarks-3':
							$text = "Three Bookmarks";
							$class = "pack-bookmarks";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case 'bookmarks':
							$text = "Three Bookmarks";
							$class = "pack-bookmarks";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Bookmarks-Family-1':
							$text = "One Family Bookmarks";
							$class = "pack-Bookmarks-Family";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Bookmarks-Family-2':
							$text = "Two Family Bookmarks";
							$class = "pack-Bookmarks-Family";
							includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case 'Bookmarks-Family-3':
							$text = "Three Family Bookmarks";
							$class = "pack-Bookmarks-Family";
							includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case 'Bookmarks-Family-4':
							$text = "Four Family Bookmarks";
							$class = "pack-Bookmarks-Family";
							includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//Class
					case 'class':
							$text = "Class";
							$class = "pack-class";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'pendant-key-rings':
							$text = "Pendant Key Rings";
							$class = "pack-pendant-key-rings";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Pendant-Key-Rings-Family':
							$text = "Family Pendant Key Rings";
							$class = "pack-Pendant-Key-Rings-Family";
							includePart('components/atom-package-img.php',$text,$class);
							break;
					//Wallets
					case 'Wallet-mini-5': //2x3s
								$text = "Five Mini Wallets";
								$class = "pack-MINI-WALLETS";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Wallets-1': //2x3s
								$text = "One Wallets";
								$class = "pack-WALLETS";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Wallet-1': //2x3s
								$text = "One Wallets";
								$class = "pack-WALLETS";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Wallets-2': //2x3s
								$text = "Two Wallets";
								$class = "pack-WALLETS";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case 'Wallet-2': //2x3s
								$text = "Two Wallets";
								$class = "pack-WALLETS";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case 'Wallets-Family-1': //2x3s
								$text = "One Family Wallets";
								$class = "pack-Wallets-Family";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case 'Wallets-Family-2': //2x3s
								$text = "Two Family Wallets";
								$class = "pack-Wallets-Family";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case 'Wallets-Family-3': //2x3s
								$text = "Three Family Wallets";
								$class = "pack-Wallets-Family";
								includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case 'Wallets-Family-4': //2x3s
								$text = "Four Family Wallets";
								$class = "pack-Wallets-Family";
								includePart('components/atom-package-img-4.php',$text,$class);
							break;
					//Family Sizes
					case "Family-3.5x5-1":
								$text = "One Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case "Family-3-5x5-1":
								$text = "One Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case "Family-3.5x5s-2":
								$text = "Two Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;

					case "Family-3-5x5s-2":
								$text = "Two Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case "Family-3.5x5s-3":
								$text = "Three Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case "Family-3-5x5s-3":
								$text = "Three Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case "Family-3.5x5s-4":
								$text = "Four Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img-4.php',$text,$class);
							break;
					case "Family-3-5x5s-4":
								$text = "Four Family 3.5x5";
								$class = "pack-FAMILY-3-5x5s";
								includePart('components/atom-package-img-4.php',$text,$class);
							break;
					case "Family-5x7s-1":
								$text = "One Family 5x7s";
								$class = "pack-FAMILY-5x7s";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case "Family-5x7s-2":
								$text = "Two Family 5x7s";
								$class = "pack-FAMILY-5x7s";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case "Family-5x7s-3":
								$text = "Three Family 5x7s";
								$class = "pack-FAMILY-5x7s";
								includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case "Family-5x7s-4":
								$text = "Four Family 5x7s";
								$class = "pack-FAMILY-5x7s";
								includePart('components/atom-package-img-4.php',$text,$class);
							break;
					case "Family-6x4s-1":
								$text = "One Family 6x4s";
								$class = "pack-FAMILY-6x4s";
								includePart('components/atom-package-img.php',$text,$class);
							break;
					case "Family-6x4s-2":
								$text = "Two Family 6x4s";
								$class = "pack-FAMILY-6x4s";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case "Family-6x4s-3":
								$text = "Three Family 6x4s";
								$class = "pack-FAMILY-6x4s";
								includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case "Family-6x4s-4":
								$text = "Four Family 6x4s";
								$class = "pack-FAMILY-6x4s";
								includePart('components/atom-package-img-4.php',$text,$class);
							break;
					case "Family-8x12s-1":
								$text = "One Family-8x12s";
								$class = "pack-FAMILY-8x12s";
								includePart('components/atom-package-img-1.php',$text,$class);
							break;
					case "Family-8x12s-2":
								$text = "two Family-8x12s";
								$class = "pack-FAMILY-8x12s";
								includePart('components/atom-package-img-2.php',$text,$class);
							break;
					case "Family-8x12s-3":
								$text = "Three Family-8x12s";
								$class = "pack-FAMILY-8x12s";
								includePart('components/atom-package-img-3.php',$text,$class);
							break;
					case "Family-8x12s-4":
								$text = "Four Family-8x12s";
								$class = "pack-FAMILY-8x12s";
								includePart('components/atom-package-img-4.php',$text,$class);
							break;
					case "memorymate":
								$text = "Memory Mate";
								$class = "pack-memorymate";
								includePart('components/atom-package-img.php',$text,$class);
							break;

						default:
							if(strlen(trim($package_info[$i])) > 1){
								$text = $package_info[$i];
								$class = "pack-misc";
								includePart('components/atom-package-img.php',$text,$class);
							}
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
<?php unset($detail); ?>