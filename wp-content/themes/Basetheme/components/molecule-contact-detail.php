<?php 
	$title=$args[1];
	$phone=$args[2];
	$email=$args[3];
	$pobox=$args[4];
 ?>

 <div class="contact-detail">
 	<div class="box">
 		<h1><?php echo $title; ?></h1>
 		<ul>
 			<li>
 				<i class="icon-telephone"></i>
 				<p><?php echo $phone; ?></p>
 			</li>
 			<li>
 				<i class="icon-send"></i>
 				<p><?php echo $email; ?></p>
 			</li>
 			<li>
 				<i class="icon-envelope"></i>
 				<p><?php echo $pobox; ?></p>
 			</li>
 		</ul>
 	</div>
 </div>