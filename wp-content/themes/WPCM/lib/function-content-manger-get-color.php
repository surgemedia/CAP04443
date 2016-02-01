<?php 
function get_color($value,$echo = true){
$output;
switch($value) {
			case 1:
			$output = "label-danger";
			break;
			case 2:
			$output = "label-warning";
			break;
			case 3:
			$output = "label-info";
			break;
			case 4:
			$output = "label-success";
			break;
			default: $output = "label-default";
			
			}
if($echo != true){
return $output;
} else {
	echo $output;
}
}