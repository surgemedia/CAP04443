<?php 
	$title=$args[1];
	$phone=$args[2];
	$email=$args[3];
	$pobox=$args[4];
	$args['tel_safe'] = str_replace(' ','',  $phone);
	$args['tel_safe'] = str_replace('(','',  $args['tel_safe']);
	$args['tel_safe'] = str_replace(')','',  $args['tel_safe']);
 ?>

 <div class="contact-detail">
 	<div class="box">
 		<h1><?php echo $title; ?></h1>
 		<ul>
 			<li>
 				<i class="icon-telephone"></i>
 				<p><a href="tel:<?php echo $args['tel_safe']; ?>"><?php echo $phone; ?></a></p>
 			</li>
 			<li>
 				<i class="icon-send"></i>
 				<p><a href="mailto:<?php echo $email;?>"><?php echo $email; ?></a></p>
 			</li>
 			<li>
 				<i class="icon-envelope"></i>
 				<p><?php echo $pobox; ?></p>
 			</li>
 		</ul>
 	</div>
 </div>