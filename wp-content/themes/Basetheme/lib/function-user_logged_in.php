<?php 
function user_logged_in() {
	  $user_info = json_decode(json_encode(wp_get_current_user()), true);
      $size = sizeof($user_info['data']);
      if($size > 0) {
      	return true;
      } else {
      	return false;
      }
}
 ?>