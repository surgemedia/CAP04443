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
			<img width="auto" height="auto" src="<?php echo aq_resize($logo,300,111,false,true,true); ?>" alt="">
			<p><?php echo $school; ?></p>
			<p><?php echo $year; ?> - <?php echo $class; ?></p>
            <p>Student's Name</p>
			<h1 class="student-name"><?php echo $student_name; ?></h1>
		</div>
    <div class="purchase col-md-10 col-md-push-1 ">
    	<div class="table-head hidden-sm hidden-xs ">
    		<ul>
    			<li>ITEMS DETAILS</li>
    			<li>ITEM PRICE</li>
    			<li>QUANTITY</li>
    			<li>SUBTOTAL</li>
    		</ul>
    	</div>
    	<?php 
    		global $woocommerce;
    		$GLOBALS['remove_page_on_click'];
    		$GLOBALS['remove_page_on_click'] = false;
    		$items = $woocommerce->cart->get_cart();
    		//debug(sizeof($items));
    		if(sizeof($items) == 0){ 
			$GLOBALS['remove_page_on_click'] = true;?>
            <div style="border: 2px dashed; color: #d1d1d1; text-align: center; padding: 3em; margin-bottom: 6em;">
                No Items
            </div>
		<?php	} else {
       			echo do_shortcode('[woocommerce_cart]');
			}
    	 ?>
		</div>
	</div>
</div>
