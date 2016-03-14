<?php
/**
* Template Name: Services Template
*/
?>

<div class="col-lg-6 left-side">
    <?php   includePart('components/header.php');?>
    <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <div class="box"><?php the_content(); ?></div>
    </div>
<?php endwhile; ?>
</div>

<div class="col-lg-6 packages col-lg-push-6 right-side">
    <?php
        /*======================================================
        =            GLOBAL TO TURN OFF ADD TO CART            =
        ======================================================*/
        $GLOBALS['turnoff_add'] = true;
        /*====================================================*/
        for ($i=0; $i < sizeof(get_field('packages_displayed')); $i++) { 
        $product_section = get_field('packages_displayed')[$i];
        if($product_section['title']){
                echo '<h1 class>'.$product_section['title'].'</h1>';
            }
             $args = array( 
            'post_type'              => array( 'product' ),
            'orderby'              => 'post__in',
            'post__in'              => $product_section['products_in_section']
             );
            $loop = new WP_Query( $args );
            $two_pack = Array();
            while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php 
    //check size of products
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
</div>

