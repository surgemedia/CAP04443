<?php while (have_posts()) : the_post(); ?>
<?php 	includePart('components/header.php');?>
<div class="check-form col-lg-6 col-lg-offset-3" >
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
</div>
<?php 	includePart('components/organism-contact.php', "https://unsplash.it/1080/600/?blur"); //image?>
<?php endwhile; ?>
