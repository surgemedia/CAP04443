<?php
/**
* Template Name: Shop Template
*/
?>
<?php //while (have_posts()) : the_post(); ?>
<div class="col-lg-6 left-side">
    <?php 	includePart('components/header.php');?>
    <?php 
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


for ($i=0; $i < sizeof(get_field('package_under_school', 'school_'.$school->term_id)); $i++) { 
$product_section = get_field('package_under_school', 'school_'.$school->term_id)[$i];
if($product_section['title']){
        echo '<h1 class>'.$product_section['title'].'</h1>';
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
        get_field('color',get_post()->ID),
        rand()
        ); 
    }

    if(get_field('size',get_post()->ID) == 'half'){
        array_push($two_pack,get_post());
        if(sizeof($two_pack) == 2){
                includePart('components/organism-double-package.php',
                $two_pack[0]->ID, //$id1
                $two_pack[1]->ID, //$id2
                get_field('color',$two_pack[0]),  //colors
                get_field('color',$two_pack[1]), //colors
                get_post_meta($two_pack[0]->ID),  //post meta
                get_post_meta($two_pack[1]->ID), //post meta
                rand(),
                rand()
                );
                
             $two_pack = Array();
        }
    }
     ?>
<?php endwhile; wp_reset_query();  unset($product_section); }  ?>
<?php //var_dump($remove_page_on_click); ?>
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
