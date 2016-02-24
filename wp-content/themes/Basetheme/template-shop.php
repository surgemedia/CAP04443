<?php
/**
* Template Name: Shop Template
*/
?>
<?php //while (have_posts()) : the_post(); ?>
<div class="col-lg-6 left-side">
    <?php 	includePart('components/header.php');?>
    <?php 
   // debug(wp_get_current_user());

        $user_id = wp_get_current_user()->data->ID;
        $school = get_user_meta(wp_get_current_user()->data->ID, $key = '', $single = false)['school'][0];
        $school_id = wp_set_object_terms($user_id, array( $school ), 'school', false);
        $school = get_term_by('id', $school_id[0], 'school');
       
        includePart('components/organism-user-info.php',
        $school->name,
        get_field('grade','user_'.$user_id),
        get_field('class','user_'.$user_id),
        get_field('image', 'school_'.$school->term_id),
        wp_get_current_user()->data->display_name
        );
    $term_name = $school->slug;
    unset($school);
    unset($user_id);
    ?>
</div>
<div class="col-lg-6 packages col-lg-push-6 right-side">
    <?php

// Setup your custom query
$args = array( 
    'post_type'              => array( 'product' ),
     'tax_query' => array(
        array(
            'taxonomy' => 'school',
            'field'    => 'slug',
            'terms'    => $term_name,
        ),
      ),
    );
//debug($args);
$products = Array();
$loop = new WP_Query( $args );
$temp = Array();
$count = 1;
while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php 
    if($count != 3){
    array_push($temp,get_post());
    $count++;
    } else {
         array_push($products,Array(get_post()));
         $count = 1;
    } 
    if(sizeof($temp) == 2){
    array_push($products,$temp);
    $temp = Array();
    }
     ?>
<?php endwhile; wp_reset_query(); // Remember to reset ?>



<?php //debug($products); ?>
<?php for ($i=0; $i < sizeof($products); $i++) {

        if(sizeof($products[$i]) == 2){
            // debug($products[$i][0]);
            // debug($products[$i][1]);
        includePart('components/organism-double-package.php',
        $products[$i][0]->ID, //$id1
        $products[$i][1]->ID, //$id2
        get_field('color',$products[$i][0]),
        get_field('color',$products[$i][1]),
        get_post_meta($products[$i][0]->ID),
        get_post_meta($products[$i][1]->ID)
        );
        }

        if(sizeof($products[$i]) == 1){
           // debug($products[$i][0]);
        includePart('components/organism-single-package.php',
        $products[$i][0]->ID, //$id1
        get_field('color',$products[$i][0])
        ); 
        }
}
 ?>

</div>
<?php //endwhile; ?>
