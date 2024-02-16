<?php
    /**
     * EVENT POST CARD
     * @param post_id int (optional) - pass post ID to get a specific post, otherwise global wp $post object will be used
     * @param classes string (optional) - pass additional classes for the LI element
    **/

    if(!empty($args['post_id']) && is_int($args['post_id'])) {
        $post = get_post($args['post_id']);
        $id = $args['post_id'];
    } else {
        global $post;
        $id = $post->ID;
    }
    if(empty($post) || is_wp_error($post)) {
        return;
    }

    $block_classes = '';
    if(!empty($args['classes'])) {
        $block_classes = ' ' . $args['classes'];
    }

    $event_date = get_field('event_start_date', $id);
    if(empty($event_date)) {
        $event_date = $post->post_date;
    }

    $post_data = [
        'id'                => $id,
        'title'             => $post->post_title,
        'url'               => get_permalink($id),
        //'date'              => date('F j, Y', strtotime($event_date)),
        'date'              => date('d.m.Y', strtotime($event_date)),
    ];

    wp_reset_postdata();
?>

<a href="<?php echo $post_data['url']; ?>" class="event-card<?php echo $block_classes; ?>">
    <div class="event-card__inner">
        <div class="event-card__content">
            <div class="event-card__main">
                <date class="event-card__date"><?php echo $post_data['date']; ?></date>
                <h3 class="event-card__title h2"><?php echo $post_data['title']; ?></h3>
            </div>
        </div>

        <div class="event-card__options">
            <div class="button button--bordered button--color-secondary button--icon-right has-animated-icon-right"><?php echo __( 'Loe rohkem', 'hiiukala-theme' ); ?><?php icon_svg('arrow-right'); ?></div>
        </div>
    </div>
</a>