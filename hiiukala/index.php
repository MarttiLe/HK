<?php
    /* ***************************************************************************** */
    /* INDEX PAGE
    /* ***************************************************************************** */
    /* Description: Default index page, here to keep the theme check happy
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>