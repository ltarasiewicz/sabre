<?php while (have_posts()) : the_post();?>
    <?php get_template_part('templates/homepage/brands', 'strap'); ?>
    <?php get_template_part('templates/homepage/about', 'page'); ?>
<?php endwhile; ?>
