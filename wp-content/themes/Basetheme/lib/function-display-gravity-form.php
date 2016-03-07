<?php 
/*=========================================
=  To display Gravity Form in ACF        =
=========================================*/
function displayGravityForm($form_object,$title) {
//displays the form selected in Page and created in Forms 
    gravity_form_enqueue_scripts($form_object['id'], true);
	gravity_form($form_object['id'], $title, true, false, '', true, 1);
}