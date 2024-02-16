<?php
    /* ***************************************************************************** */
    /* Template Name: Front page
    /* ***************************************************************************** */
    /* Description: Theme frontpage template
    /* ACF fields: Template - Front page
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php 
    get_header();

    if (get_field('display_block_hero')) {
        get_template_part('templates/blocks/hero', null, []);
    }

    if (get_field('display_block_quicklinks')) {
        get_template_part('templates/blocks/quicklinks', null, []);
    }

    if (get_field('display_block_blog_preview')) {
        get_template_part('templates/blocks/blog-preview', null, [
            'wrapper_classes'   => 'blog-preview--front'
        ]);
    }

    if (get_field('display_block_events_preview')) {
        get_template_part('templates/blocks/events-preview', null, []);
    }

    if (get_field('display_block_socials_activity')) {
        get_template_part('templates/blocks/socials-activity', null, []);
    }

    if (get_field('display_block_about')) {
        get_template_part('templates/blocks/about', null, []);
    }

    get_footer(); 
?>