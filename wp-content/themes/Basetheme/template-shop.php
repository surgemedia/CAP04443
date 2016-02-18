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
        $school =  get_field('school','user_'.$user_id);
        includePart('components/organism-user-info.php',
        $school->name,
        get_field('grade','user_'.$user_id),
        get_field('class','user_'.$user_id),
        get_field('image', $school),
        wp_get_current_user()->data->display_name
        );
    unset($school);
    unset($user_id);
    ?>
</div>
<div class="col-lg-6 packages col-lg-push-6 right-side">
    <?php

// Setup your custom query
$args = array( 
    'post_type'              => array( 'product' ),
    'category_name'          => 'hillbrook',
    );
$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post(); ?>

   <?php debug(get_post()->ID); ?>
   <?php debug(get_post()->ID); ?>



<?php endwhile; wp_reset_query(); // Remember to reset ?>



    <?php /* 	includePart('components/organism-double-package.php',
    "1", //$id1
    "2", //$id2
    "pink",
    "blue"
    );?>
    <?php 	includePart('components/organism-double-package.php',
    "3", //$id1
    "4", //$id2
    "grey",
    "grey-dark"
    );?>
    <?php 	includePart('components/organism-single-package.php',
    "5", //$id1
    "pink"
    );   */?>
</div>
<?php //endwhile; ?>
