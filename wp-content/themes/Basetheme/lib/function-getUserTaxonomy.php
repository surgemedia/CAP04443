<?php 
function getUserTaxonomy($passed_id,$term){
	$user_id;
	if(strlen($passed_id) <= 0){
		$user_id = get_current_user_id();  // Get current user Id
	} else {
		$user_id = $passed_id;
	}
	$user_groups = wp_get_object_terms($user_id, $term, array('fields' => 'all_with_object_id'));  // Get user group detail
	return $user_groups;
}
 ?>