<?php 
function createNewUser($user_name,$password){
		// does this user exsit
		$user_id = username_exists( $user_name );
		if ( !$user_id and email_exists($user_email) == false ) {
			$random_password = sha1($str);
			// $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_id = wp_create_user( $user_name, $random_password, $user_email );
		} else {
			$random_password = __('User already exists.  Password inherited.');
		}
	}

 ?>