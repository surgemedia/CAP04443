<?php 
/*=========================================
=            Pretty Meta Debug            =
=========================================*/
function debug($data) {
//makes debuging easier with clear values
    echo '<pre>';
    print_r($data); 
    echo '</pre>';
}
function debug_notags($data) {
//makes debuging easier with clear values
    echo '';
    print_r($data); 
    echo '';
}
function debug_commnent($data) {
//makes debuging easier with clear values
    echo '<!--<pre>';
    print_r($data); 
    echo '</pre>-->';
}