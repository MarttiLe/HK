<?php
    /* ***************************************************************************** */
    /* EVENTS ARCHIVE
    /* ***************************************************************************** */
    /* Description: Default Wordpress post category archive
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $current_category = get_queried_object();

    $data = [
        'title'             => '',
        'current_category'  => $current_category->term_id,
        'posts'             => '',
        'is_final_page'     => false,
        'categories'        => '',
        'events_page_url'     => ''
    ];

    // Process data
    $data['posts'] = new WP_Query([
        'post_type'         => 'event',
        'status'            => 'publish',
        'posts_per_page'    => -1,
        'order'             => 'DESC',
        'suppress_filters'  => false,
        'tax_query' => [
            [
                'taxonomy' => 'event_cat',
                'terms'    => [
                    $data['current_category']
                ],
            ]
        ],
        'meta_key'          => 'event_start_date',
        'orderby'           => 'meta_value_num',
        'order'             => 'DESC'
    ]);

    $data['categories'] = get_terms([
        'taxonomy'      => 'event_cat',
        'hide_empty'    => true,
        'order'         => 'DESC',
        'exclude'       => 1
    ]);
    $page_refs = get_field('page_refs', 'options');
    $data['events_page_url'] = get_permalink($page_refs['events']);
    $data['title'] = get_the_title($page_refs['events']);
?>

<?php get_header(); ?>

<section class="events page-content">
    <div class="container">
        <h1 class="events__title page-content__title h1"><?php echo $data['title']; ?></h1>    

        <?php if(!empty($data['categories'])) : ?>
        <div class="events__categories">
            <ul class="category-list">
                <li class="category-list__item">
                    <a href="<?php echo $data['events_page_url']; ?>" class="category-list__anchor" data-text="<?php echo __( 'All', 'hiiukala-theme' ); ?>"><?php echo __( 'All', 'hiiukala-theme' ); ?></a>
                </li>
                <?php foreach($data['categories'] as $category) : ?>
                <?php 
                    $active_classes = '';
                    if($category->term_id === $data['current_category']) {
                        $active_classes = ' is-active';
                    }
                ?>
                <li class="category-list__item">
                    <a href="<?php echo get_term_link($category->term_id, 'event_cat'); ?>" class="category-list__anchor<?php echo $active_classes; ?>" data-text="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="events__categories-mobile">
            <select name="event-categories" class="events__category-select js-nav-select">
                <option value="<?php echo $data['events_page_url']; ?>"><?php echo __( 'All', 'hiiukala-theme' ); ?></option>
                <?php foreach($data['categories'] as $category) : ?>
                    <option value="<?php echo get_term_link($category->term_id, 'event_cat'); ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <?php if($data['posts']->have_posts()) : ?>
            <ul class="events__items events-list">
                <?php $current_month = 12; // Start from the highest month and move down ?>
                <?php while($data['posts']->have_posts()) : ?>
                    <?php $data['posts']->the_post(); ?>
                    <?php
                        $post_date = get_field('event_start_date');
                        $post_month = (int)date("m", strtotime($post_date));
                        if ($post_month < $current_month) {
                            $current_month = $post_month;
                            echo '<li class="events-list__item"><div class="events-list__label">'. theme_get_month_name($current_month) .'</div></li>';
                        }
                    ?>
                        
                    <li class="events-list__item">
                        <?php get_template_part('templates/components/card-event', null, [
                            'classes' => 'event-card--archive'
                        ]); ?>
                    </li>

                    <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
            </ul>

            <div class="events__actions">
                <?php theme_pagination_nav($data['posts']); ?>
            </div>
        <?php else : ?>
        <div class="events__alert"><?php echo __( 'There are currently no posts available', 'hiiukala-theme' ); ?></div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>