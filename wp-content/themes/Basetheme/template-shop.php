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
    unset($user_id);
    ?>
</div>
<div class="col-lg-6 packages col-lg-push-6 right-side">
    <?php

//debug(get_field('package_under_school', 'school_'.$school->term_id)[0]['products_in_section']);
// Setup your custom query
//debug(get_field('package_under_school', 'school_'.$school->term_id));




for ($i=0; $i < sizeof(get_field('package_under_school', 'school_'.$school->term_id)); $i++) { 
    # code...
$product_section = get_field('package_under_school', 'school_'.$school->term_id)[$i];
if($product_section['title']){
        echo '<span>'.$product_section['title'].'</span>';
    }
$args = array( 
    'post_type'              => array( 'product' ),
    'orderby'              => 'post__in',
    'post__in'              => $product_section['products_in_section'],
     'tax_query' => array( array(  'taxonomy' => 'school',   'field' => 'slug', 'terms'    => $term_name,  ),  ), );
//debug($product_section['products_in_section']);
$loop = new WP_Query( $args );
$two_pack = Array();
while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php 
    
    if(get_field('size',get_post()->ID) == 'full'){
         //debug(get_post());
        includePart('components/organism-single-package.php',
        get_post()->ID, //$id1
        get_field('color',get_post()->ID)
        ); 
    }

    if(get_field('size',get_post()->ID) == 'half'){
        array_push($two_pack,get_post());
        if(sizeof($two_pack) == 2){
            //debug(get_post());
             //debug($two_pack);
                includePart('components/organism-double-package.php',
                $two_pack[0]->ID, //$id1
                $two_pack[1]->ID, //$id2
                get_field('color',$two_pack[0]),
                get_field('color',$two_pack[1]),
                get_post_meta($two_pack[0]->ID),
                get_post_meta($two_pack[1]->ID)
                );
                
             $two_pack = Array();
        }
    }
       


     ?>
<?php endwhile; 
wp_reset_query(); 
unset($product_section);
} //end for loop
//unset($school);
 ?>



<?php 
// for ($i=0; $i < sizeof($products); $i++) {

//         if(sizeof($products[$i]) == 2){
//         includePart('components/organism-double-package.php',
//         $products[$i][0]->ID, //$id1
//         $products[$i][1]->ID, //$id2
//         get_field('color',$products[$i][0]),
//         get_field('color',$products[$i][1]),
//         get_post_meta($products[$i][0]->ID),
//         get_post_meta($products[$i][1]->ID)
//         );
//         }

//         if(sizeof($products[$i]) == 1){
//         includePart('components/organism-single-package.php',
//         $products[$i][0]->ID, //$id1
//         get_field('color',$products[$i][0])
//         ); 
//         }
// }
 ?>

</div>
<?php //endwhile; ?>
