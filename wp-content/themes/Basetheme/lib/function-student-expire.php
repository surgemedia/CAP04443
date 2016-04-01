<?php 

function studentYearlyExpire(){
	// WP_User_Query arguments
	debug($_GET);
	if(isset($_GET['action']) == true && $_GET['action'] == '400f7c908865f4663ceaa7dd1dedb9e1459ce643ad3a7b5a6b8161a2111de352'){
		require_once(ABSPATH.'wp-admin/includes/user.php' );
		$args = array (
				'role'           => 'customer',
				'orderby'        => 'user_name'
		);
		// The User Query
		$user_query = new WP_User_Query( $args );

		// The User Loop
		if ( ! empty( $user_query->results ) ) {
			foreach ( $user_query->results as $user ) {
					wp_delete_user($user->ID);
					
			}
	}
}
}
 ?>
