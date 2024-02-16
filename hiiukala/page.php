<?php
    /* ***************************************************************************** */
    /* PAGE TEMPLATE GENERIC
    /* ***************************************************************************** */
    /* Description: Standard page template, fallback for every page that doesn't have
    /*              a specified template
    /* ACF: -
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $data = [
        'wrapper_classes'   => '',
        'container_classes' => '',
        'title'             => get_the_title(get_the_ID()),
        'parent_id'         => '',
        'has_sidebar'       => false
    ];

    // Process data
    global $post;
    $data['page_id'] = $post->ID;
    $data['parent_id'] = $post->post_parent;

    if (!empty($data['parent_id'])) {
        $data['has_sidebar'] = true;
    } else {
        $has_children = get_children([
            'post_parent'   => $data['page_id'],
            'fields'        => 'ids'
        ]);
        if (!empty($has_children)) {
            $data['parent_id'] = $data['page_id'];
            $data['has_sidebar'] = true;
        }
    }

    if ($data['has_sidebar']) {
        $data['wrapper_classes'] = ' page-content--has-sidebar';
    } else {
        $data['container_classes'] = ' container--sm';
    }
?>

<?php 
    get_header();

    get_template_part('templates/components/page-heading', null, []);
?>

<div class="page-content<?php echo $data['wrapper_classes']; ?>">
    <div class="container<?php echo $data['container_classes']; ?>">
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

            <?php if (!empty($data['parent_id'])) : ?>
                <div class="page-content__aside">
                    <?php
                        get_template_part('templates/components/sidebar-nav', null, [
                            'page_id'   => $data['page_id'],
                            'parent_id' => $data['parent_id']
                        ]);
                    ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>