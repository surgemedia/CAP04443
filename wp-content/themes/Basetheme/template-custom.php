<?php
/**
* Template Name: Custom Template
*/
?>
<?php while (have_posts()) : the_post(); ?>
<div class="col-lg-6 left-side">
    <?php 	includePart('components/header.php');?>
    <?php 	includePart('components/organism-user-info.php');?>
</div>
<div class="col-lg-6 packages col-lg-push-6 right-side">
    <?php 	includePart('components/organism-double-package.php',
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
    );?>
</div>
<?php endwhile; ?>
