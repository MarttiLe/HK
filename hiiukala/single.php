<?php
    /* ***************************************************************************** */
    /* POST TEMPLATE
    /* ***************************************************************************** */
    /* Description: Standard post template, fallback for every post type single post
    /* ACF: -
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $data = [
        'title'             => get_the_title(),
    ];
?>

<?php 
    get_header();

    get_template_part('templates/components/page-heading', null, []);
?>

<div class="page-content">
    <div class="container container--sm">
        <div class="page-content__inner">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="page-content__main">
                    <div class="page-content__heading">
                        <h1 class="page-content__title h1"><?php echo $data['title']; ?></h1>
                        <div class="page-content__breadcrumbs"><?php get_template_part('templates/components/breadcrumbs', null, []); ?></div>
                    </div>

                    <div class="page-content__editor editor-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>