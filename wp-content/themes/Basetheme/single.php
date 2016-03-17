<?php while (have_posts()) : the_post(); ?>
<?php //	includePart('components/header.php');?>
<div class="simple-page col-lg-6 col-lg-offset-3" >
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
</div>
<?php  	includePart('components/organism-contact.php', get_field('footer_form_background_image','option')); ?>
<?php endwhile; ?>
