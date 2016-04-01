<?php 
/*=========================================
=            Pretty Meta Debug            =
=========================================*/
function debug($data) {
//makes debuging easier with clear values
    echo '<script>';
  	echo 'console.log('.json_encode($data).');'; 
    echo '</script>';
}
	
?>