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
	header('Location: '.get_permalink(get_id_from_slug('get-photos')));
	die();
	}
}
// run it before the headers and cookies are sent
add_action( 'after_setup_theme', 'programmatic_login' );

?>