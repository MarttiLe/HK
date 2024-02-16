<?php
    /* ***************************************************************************** */
    /* EVENTS PREVIEW BLOCK
    /* ***************************************************************************** */
    /* Description: -
    /* ACF: Block - Events preview
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block data
    $block_data = get_field('block_events_preview');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }


    // Manage block details
    $event_items = new WP_Query([
        'post_type'         => 'event',
        'status'            => 'publish',
        'posts_per_page'    => -1,
        'suppress_filters'  => false
    ]);

    $page_refs = get_field('page_refs', 'options');

    // Build month data
    $display_number_of_previous_months = 6;
    $display_number_of_next_months = 9;
    $current_month_index = $display_number_of_previous_months;

    $current_month_year = date('Y-m-01');
    $dates = [];
    $months_data = [];

    for($i = 1; $i < $display_number_of_previous_months+1; $i++) {
        $date = date('Y-m-d', strtotime('-'. $i .'months', strtotime($current_month_year)));
        array_push($dates, $date);
    }
    $dates = array_reverse($dates);
    array_push($dates, $current_month_year);
    for($i = 1; $i < $display_number_of_next_months+1; $i++) {
        $date = date('Y-m-d', strtotime('+'. $i .'months', strtotime($current_month_year)));
        array_push($dates, $date);
    }

    foreach($dates as $date) {
        $first_date_in_month = date('Ymd', strtotime('first day of ' . $date));
        $last_date_in_month = date('Ymd', strtotime('last day of ' . $date));
        $month_data = explode('-', $date);
        $month = $month_data[1];
        $year = $month_data[0];
        
        $month_posts = new WP_Query([
            'post_type'         => 'event',
            'status'            => 'publish',
            'posts_per_page'    => -1,
            'meta_query' => [
                [
                    'key'     => 'event_start_date',
                    'value'   => $first_date_in_month,
                    'compare' => '>=',
                ],
                [
                    'key'     => 'event_start_date',
                    'value'   => $last_date_in_month,
                    'compare' => '<=',
                ]
            ],
            'suppress_filters'  => false
        ]);

        $month_data = [
            'month'  => theme_get_month_name($month),
            'year'   => $year,
            'posts'  => $month_posts->posts
        ];
        array_push($months_data, $month_data);
    }
?>


<section class="events-preview<?php echo $block_classes; ?>">
    <?php theme_get_nav_anchor($block_data['nav_anchor']); ?>

    <div class="container">
        <div class="section-heading section-heading--has-options has-white-links">
            <h2 class="events-preview__title section-heading__title h1"><?php echo $block_data['title']; ?></h2>
            
            <div class="section-heading__options">
                <a href="<?php echo get_permalink($page_refs['events']); ?>" class="section-heading__more"><?php echo __( 'Kõik sündmused', 'hiiukala-theme' ); ?></a>
            </div>
        </div>

        <div class="events-preview__inner">                
            <?php if(!empty($months_data)) : ?>
                <div class="events-preview__slider months-slider slider js-months-slider">
                    <div class="slider__track" data-glide-el="track">
                        <ul class="events-preview__months months-list">
                            <li class="months-list__item slider__item">
                                <a href="<?php echo get_permalink($page_refs['events']); ?>" class="month-card is-inactive">
                                    <div class="month-card__month"><?php echo __( 'Archived events', 'hiiukala-theme' ); ?></div>
                                    <div class="month-card__year">...</div>
                                </a>
                            </li>

                            <?php foreach($months_data as $key => $month) : ?>
                            <li class="months-list__item slider__item">
                                <a href="#" class="month-card js-nav-tab<?php if($key === $current_month_index) { echo ' is-active'; } else if($key < $display_number_of_previous_months) { echo ' is-inactive'; } ?>" data-tabs-id="events" data-tabs-content-id="<?php echo $key; ?>">
                                    <div class="month-card__month"><?php echo $month['month']; ?></div>
                                    <div class="month-card__year"><?php echo $month['year']; ?></div>
                                </a>
                            </li>
                            <?php endforeach; ?>

                            <li class="months-list__item slider__item">
                                <a href="<?php echo get_permalink($page_refs['events']); ?>" class="month-card">
                                    <div class="month-card__month"><?php echo __( 'Upcoming events', 'hiiukala-theme' ); ?></div>
                                    <div class="month-card__year">...</div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="months-slider__arrows slider-controls" data-glide-el="controls" data-sal="slide-up">
                        <button class="months-slider__arrow slider-controls__arrow slider-controls__arrow--prev js-months-slider-prev" data-glide-dir="<" title="<?php echo __( 'Previous slide', 'hiiukala-theme' ); ?>"><?php icon_svg('arrow-right', 'slider-controls__icon'); ?></button>
                        <button class="months-slider__arrow slider-controls__arrow slider-controls__arrow--next js-months-slider-next" data-glide-dir=">" title="<?php echo __( 'Next slide', 'hiiukala-theme' ); ?>"><?php icon_svg('arrow-right', 'slider-controls__icon'); ?></button>
                    </div>
                </div>

                <?php foreach($months_data as $key => $month) : ?>
                    <div class="tab-content js-nav-tab-content<?php if($key === $current_month_index) { echo ' is-active'; } ?>" data-tabs-id="events" data-tabs-content-id="<?php echo $key; ?>">
                        <?php if(!empty($month['posts'])) : ?>
                            <ul class="events-preview__items events-list">
                                <?php foreach($month['posts'] as $month_post) : ?>
                                    <li class="events-list__item">
                                        <?php
                                            $block_attr = [
                                                'post_id'  => $month_post->ID
                                            ];
                                            get_template_part('templates/components/card-event', null, $block_attr);
                                        ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <div class="events-preview__alert"><?php echo __( 'There are currently no events listed for this month', 'hiiukala-theme' ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>