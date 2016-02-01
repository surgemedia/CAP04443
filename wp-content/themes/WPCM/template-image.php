<?php
/**
 * Template Name: Image Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
<?php echo get_the_post_thumbnail(); ?>
<?php endwhile; ?>
