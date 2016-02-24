<?php  
function programmatic_login(){
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$user_data = get_user_by('login', $username );

	  $eq = get_field('eq', 'user_'.$user_data->data->ID);
	  $firstname = get_field('first_name', 'user_'.$user_data->data->ID);
	  $school = get_user_meta($user_data->data->ID, $key = '', $single = false)['school'][0];
	  $cp_barcode = get_field('cp_barcode', 'user_'.$user_data->data->ID);
		$creds = array();
	    $creds['user_login'] = $username;
	    $creds['user_password'] = $firstname.'_'.$username;
	    $creds['remember'] = true;
	    $user = wp_signon( $creds, false );
	    if ( is_wp_error($user) ){
	        echo $user->get_error_message();
	    }
	wp_set_object_terms( $user_data->data->ID, array( $school ), 'school', false);
	header('Location: '.get_permalink(get_id_from_slug('user')));
	die();
	}
}
// run it before the headers and cookies are sent
add_action( 'after_setup_theme', 'programmatic_login' );

// // $user = get_user_by('login', $username );
// // // var_dump($user->caps['administrator']);
// // if ( !is_wp_error( $user ) && $user->caps['administrator'] == NULL)
// // 	{
// // 	  clean_user_cache($user->ID);
// // 	  wp_clear_auth_cookie();
// // 	  wp_set_current_user($user->ID);
// // 	  wp_set_auth_cookie($user->ID, true, false);
// // 	  update_user_caches($user);
// // 	  // wp_redirect( get_permalink( get_page_by_title( 'User' )->ID ));
// // 	}
// // }


// /**
//  * Programmatically logs a user in
//  * 
//  * @param string $username
//  * @return bool True if the login was successful; false if it wasn't
//  */
//     function programmatic_login( $username ) {
//         if ( is_user_logged_in() ) {
//             wp_logout();
//         }

//     add_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );    // hook in earlier than other callbacks to short-circuit them
//     $user = wp_signon( array( 'user_login' => $username ) );
//     remove_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );

//     if ( is_a( $user, 'WP_User' ) ) {
//         wp_set_current_user( $user->ID, $user->user_login );
// 		  clean_user_cache($user->ID);
// 		  wp_clear_auth_cookie();
// 		  // wp_set_current_user($user->ID);
// 		  wp_set_auth_cookie($user->ID, true, false);
// 		  update_user_caches($user);
//         if ( is_user_logged_in() ) {
//             return true;
//         }
//     }

//     return false;
//  }

//  /**
//   * An 'authenticate' filter callback that authenticates the user using only     the username.
//   *
//   * To avoid potential security vulnerabilities, this should only be used in     the context of a programmatic login,
//   * and unhooked immediately after it fires.
//   * 
//   * @param WP_User $user
//   * @param string $username
//   * @param string $password
//   * @return bool|WP_User a WP_User object if the username matched an existing user, or false if it didn't
//   */
//  function allow_programmatic_login( $user, $username, $password ) {
//     return get_user_by( 'login', $username );
//  }

?>