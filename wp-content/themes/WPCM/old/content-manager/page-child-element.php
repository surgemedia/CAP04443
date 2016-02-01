<?php
		// $field = get_field_object('sign_off_level');
		// $value = get_field('sign_off_level');
		// $label = $field['choices'][ $value ];
		// $color = get_color($value,false);

		// $field_design = get_field_object('sign_off_level_design');
		// $value_design = get_field('sign_off_level_design');
		// $label_design = $field['choices'][$value_design];
		// $color_design = get_color($value_design,false);

		?>
<?php $args = array(
	'post_parent' => get_the_id(),
	'post_type'   => 'page',
	'posts_per_page' => -1,
	'post_status' => 'any', 
	); 
?>
<?php $childs = get_children( $args, $output ); ?>
<li class="parent">
	<span class="col-sm-5"  >
	<?php the_title();?>
	</span>
	<a target="_blank" class="btn btn-info pull-left" href="<?php echo get_permalink();?>">View Page</a>
	<div class="btn <?php echo $color; ?> pull-left" data-toggle="collapse" href="#collapseContent<?php echo get_the_id() ?>" aria-expanded="false" aria-controls="collapseContent<?php echo get_the_id() ?>">
		<i class="glyphicon glyphicon-text-color"></i>   <span>Content</span>  
	</div>
	<!-- <div class="btn <?php //echo $color_design; ?> pull-left" data-toggle="collapse" href="#collapseDesign<?php //echo get_the_id() ?>" aria-expanded="false" aria-controls="collapseDesign<?php echo get_the_id() ?>">
		<i class="glyphicon glyphicon-sunglasses"></i>   <span>Design</span>  
	</div> -->
	<div class="btn label-default pull-left" data-toggle="collapse" href="#collapseSignoff<?php echo get_the_id() ?>" aria-expanded="false" aria-controls="collapseDesign<?php echo get_the_id() ?>">
		<i class="glyphicon glyphicon-lock"></i>   <span>Final Signoff</span>  
	</div>
	<?php /* ?>
	<span class="label <?php echo $color; ?>"> <?php echo $label; ?></span>
	<?php */ ?>

	<!-- Content tray -->
	<div class="tray collapse" id="collapseContent<?php echo get_the_id() ?>">
	<i class="glyphicon glyphicon-text-color"></i>  <span>Content</span>  
	<hr>
		<div class="inner">
			
			<?php 
			acf_form(array(
				'field_groups' => 'group_54ffabdbd47f0',
				'post_id'	=> get_the_id(),
				'post_title'	=> false,
				'fields' => ['approve','upload_content'],
				'submit_value'	=> 'Update Page Data'
			)); ?>
		</div>
	</div>
	<!-- Design Tray -->
	<div class="tray collapse" id="collapseDesign<?php echo get_the_id() ?>">
	<i class="glyphicon glyphicon-sunglasses"></i>  <span>Design</span>  
	<hr>
		<div class="inner">
			
			<?php 
			acf_form(array(
				'field_groups' => 'group_54ffabdbd47f0-2',
				'post_id'	=> get_the_id(),
				'post_title'	=> false,
				'fields' => ['aprove_design',
				'submit_value'	=> 'Update Page Data'
			)); ?>
		</div>
	</div>
		<!-- Final Signoff -->
	<div class="tray collapse" id="collapseSignoff<?php echo get_the_id() ?>">
		<i class="glyphicon glyphicon-lock"></i>  <span>Final Signoff</span>  
	<hr>

		<div class="inner">
			
			<?php 
			acf_form(array(
				'post_id'	=> get_the_id(),
				'post_title'	=> false,
				'fields' => ['final_approval'],
				'submit_value'	=> 'Update Page Data'
			)); ?>
		</div>
	</div>




</li>
<?php foreach ($childs as $child) { ?>
<?php
	$field = get_field_object('sign_off_level',$child->ID);
	$value = get_field('sign_off_level',$child->ID);
	$label = $field['choices'][ $value ];
	$sub_color = get_color($value,false);
	
?>
<li class="child">
	
	<a class="col-sm-5" data-toggle="collapse" href="#collapseExample<?php echo $child->ID ?>" aria-expanded="false" aria-controls="collapseExample<?php echo $child->ID ?>" ><?php echo get_the_title($child->ID);?></a>
	<span class="label <?php echo $sub_color; ?>"> <?php echo $label; ?></span>

	<div class="collapse" id="collapseExample<?php echo $child->ID ?>">
		<div class="inner">
		<a target="_blank" class="btn btn-info pull-left" href="<?php echo get_permalink($child->ID);?>">View Page</a>
			<?php acf_form(array(
										'post_id'	=> $child->ID,
										'post_title'	=> false,
										'fields' => ['approve','upload_content'],
										'submit_value'	=> 'Update Page Data'
			)); ?>
		</div>
	</div>
</li>
<?php } ?>