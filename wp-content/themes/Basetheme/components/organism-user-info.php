<?php 
	$school = $args[1];
	$year =  $args[2];
	$class = $args[3];
	$logo = $args[4];
	$student_name = $args[5];

 ?>
 <?php //debug($args); ?>
<div class="user-info">
	<div class="scroll-hide">
		<div class="box">
			<img width="auto" height="auto" src="<?php echo $logo ?>" alt="">
			<p><?php echo $school; ?></p>
			<p><?php echo $year; ?> - <?php echo $class; ?></p>
			<h1><?php echo $student_name; ?></h1>
		</div>
    <div class="purchase">
    	<div class="table-head hidden-xs">
    		<ul>
    			<li>ITEMS DETAILS</li>
    			<li>ITEM PRICE</li>
    			<li>QUANTITY</li>
    			<li>SUBTOTAL</li>
    		</ul>
    	</div>
    	<?php dynamic_sidebar('primary'); ?>
		</div>
	</div>
</div>
