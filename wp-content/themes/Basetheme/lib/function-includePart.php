<?php 
function includePart($args){
			$args = func_get_args();
			echo '<!--'.$args[0].'-->';
				include(locate_template($args[0]));
				unset($args);
			}
 ?>