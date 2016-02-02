<?php 
function includePart($args){
			$args = func_get_args();
				include(locate_template($args[0]));
				unset($args);
			}
 ?>