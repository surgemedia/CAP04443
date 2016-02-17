<?php  
function programmatic_login($username){

$user = get_user_by('login', $username );
// var_dump($user->caps['administrator']);
if ( !is_wp_error( $user ) && $user->caps['administrator'] == NULL)
	{
	  clean_user_cache($user->ID);
	  wp_clear_auth_cookie();
	  wp_set_current_user($user->ID);
	  wp_set_auth_cookie($user->ID, true, false);
	  update_user_caches($user);
	}
}




?>