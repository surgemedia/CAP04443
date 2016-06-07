<?php
/**
* Template Name: Shop Template
*/
?>
<?php //while (have_posts()) : the_post(); ?>

<div class="col-lg-6 left-side">
    <?php 	includePart('components/header.php');?>
    <?php
      /*=========================================
        =            Get School                 =
        =========================================*/
        //debug(getCurrentSchool());
        $user_id = wp_get_current_user()->data->ID;
        $school = get_user_meta(wp_get_current_user()->data->ID, $key = '', $single = false)['school'][0];
        $school_id = wp_set_object_terms($user_id, array( $school ), 'school', false);
        $school = get_term_by('id', $school_id[0], 'school');

        /*=========================================
        =             Student Info            =
        =========================================*/
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

    $acf_field_sizeof = get_field('package_under_school', 'school_'.$school->term_id);
    for ($product_loop=0; $product_loop < sizeof($acf_field_sizeof); $product_loop++) { 
        $product_section = $acf_field_sizeof[$product_loop];
     
        if($product_section['title']){ echo '<h1 class="section-title">'.$product_section['title'].'</h1>'; }
        $args = array( 
            'post_type'              => array( 'product' ),
            'orderby'              => 'post__in',
            'post__in'              => $product_section['products_in_section']
             );

        $list_of_halfs = [];
        for ($halfs=0; $halfs < sizeof($product_section['products_in_section']); $halfs++) { 
            if(get_field('size',$product_section['products_in_section'][$halfs]) == 'half'){
            array_push($list_of_halfs,$product_section['products_in_section'][$halfs]);
            }
        }

        // print_r($list_of_halfs );
        $loop = new WP_Query( $args );
        $two_pack = Array();
    while ( $loop->have_posts() ) : $loop->the_post();

    $set_args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
    $list_of_schools =  wp_get_post_terms( get_post()->ID, 'school', $set_args );
    $term_list = array();

    //add product to school on load.
    for ($j=0; $j < sizeof($list_of_schools); $j++) { 
       array_push($term_list,$list_of_schools[$j]->term_id);
    }
    array_push($term_list,intval($school_id[0]));

    if(get_field('size',get_post()->ID) == 'full'){
        includePart('components/organism-single-package.php',
        get_post()->ID, //$id1
        get_field('color',get_post()->ID),
        rand()
        ); 
    }


    if(get_field('size',get_post()->ID) == 'half'){
        array_push($two_pack,get_post());
        if(sizeof($two_pack) == 2){
               //  debug($two_pack[1]->ID); //$id2
            //debug($two_pack[0]->ID); //$id1
                includePart('components/organism-double-package.php',
                $two_pack[1]->ID, //$id2
                $two_pack[0]->ID, //$id1
                get_field('color',$two_pack[1]), //colors
                get_field('color',$two_pack[0]),  //colors
                get_post_meta($two_pack[1]->ID), //post meta
                get_post_meta($two_pack[0]->ID),  //post meta
                rand(),
                rand()
                );
                
             $two_pack = Array();
        } else {
            if(sizeof($list_of_halfs)%2 != 0){

            $postData = get_post($list_of_halfs[sizeof($list_of_halfs)-1]);
            includePart('components/organism-single-package.php',
                $postData->ID, //$id1
                get_field('color',$postData),  //colors
                rand() );
            }
            $list_of_halfs = NULL;
        }
    }
     ?>
<?php endwhile; wp_reset_query(); 

} 
 unset($product_section); 
 ?>

<?php if($GLOBALS['remove_page_on_click']){ ?>
    <script>
    function reloadPageFirstProduct(){
    var count = false;
    window.setInterval(function(){
        if(getCookie('woocommerce_cart_hash').length > 0 && count == false){
        window.location.reload(false); 
        count = true;
        }
    }, 500);
}
reloadPageFirstProduct();
//redirect on cart.php to get-photos

    </script>
<?php }  else { ?>
<script>
function showUpdateCart(){
    jQuery('.woocommerce  ul.cart_list.product_list_widget input.button' ).addClass('hide');
    jQuery( ".input-text" ).change(function() {
        jQuery('.woocommerce  ul.cart_list.product_list_widget input.button' ).removeClass('hide');
    });
}
    showUpdateCart();
</script>
<?php } ?>
</div>
<?php //endwhile; ?>