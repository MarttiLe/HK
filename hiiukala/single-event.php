<?php
    /* ***************************************************************************** */
    /* EVENT TEMPLATE
    /* ***************************************************************************** */
    /* Description: Event post type single page template
    /* ACF: -
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $data = [
        'title'             => get_the_title(),
        'event_start'       => date('d.m.Y', strtotime(get_field('event_start_date'))),
        'event_end'         => date('d.m.Y', strtotime(get_field('event_end_date'))),
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

                        <div class="event-dates">
                            <span class="event-dates__label"><?php echo __('Kuupäev', 'hiiukala-theme'); ?>: </span>

                            <?php if (!empty($data['event_start'])) : ?>
                            <span class="event-dates__start"><?php echo $data['event_start']; ?></span>
                            <?php endif; ?>
                            <?php if (!empty($data['event_end'])) : ?>
                            &mdash;<span class="event-dates__end"><?php echo $data['event_end']; ?></span>
                            <?php endif; ?>
                        </div>
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