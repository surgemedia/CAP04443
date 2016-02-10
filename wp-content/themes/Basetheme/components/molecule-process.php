<?php  
	$image=$args[1];
	$title=$args[2];
	$process_description= $args[3];
?>

<div class="process" style="background-image:url('<?php echo $image;?>');">
	<div class="box">
		<div class="content">
			<h1><?php echo $title;?></h1>
			<ul>
				<?php
					// check if the repeater field has rows of data
					if( have_rows('processes') ):
						$counter=1;
					 	// loop through the rows of data
					    while ( have_rows('processes') ) : the_row();?>

					  			<li><i class="icon-<?php the_sub_field('icon'); ?>"></i>
					  			<span><b><?php echo $counter.".";?></b> <?php the_sub_field('text');?></span>
					  			</li>
						<?php
							$counter++;
					    endwhile;

					else :

					    // no rows found

					endif;

				?>		
			</ul>
			<div class="description"><?php echo $process_description; ?></div>
			<a class="btn-basic" href="">Register Now</a>
		</div>
	</div>
</div>