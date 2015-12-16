<article class="casestudy-obj col-lg-4">
    <a href="<?php echo get_post_permalink(); ?>">
    <?php $client = wp_get_post_terms($post->ID, 'clients', array("fields" => "all"))[0]; ?>
    <img src="<?php echo get_field('logo', $client) ?>" alt="<?php the_title(); ?>">
    </a>
</article>