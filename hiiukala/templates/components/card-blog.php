<?php
    /**
     * BLOG POST CARD
     * @param post_id int (optional) - pass post ID to get a specific post, otherwise global wp $post object will be used
     * @param item_classes string (optional) - pass additional classes for the LI element
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

    $item_classes = '';
    if(!empty($args['classes'])) {
        $item_classes = ' ' . $args['classes'];
    }

    $featured_img = get_post_thumbnail_id($id);
    if(!empty($featured_img)) {
        $featured_img = wp_get_attachment_image_url($featured_img, 'blog-thumb');
    } else {
        $featured_img = wp_get_attachment_image_url(get_field('placeholder_img_blog', 'options'), 'blog-thumb');
    }

    $post_data = [
        'id'                => $id,
        'title'             => $post->post_title,
        'excerpt'           => theme_get_excerpt(false, 175),
        'url'               => get_permalink($id),
        'image'             => $featured_img,
        //'date'              => date('F j, Y', strtotime($post->post_date)),
        'date'              => date('d.m.Y', strtotime($post->post_date)),
    ];

    wp_reset_postdata();
?>

<a href="<?php echo $post_data['url']; ?>" class="blog-card<?php echo $item_classes; ?>">
    <div class="blog-card__image" style="background-image: url('<?php echo $post_data['image']; ?>');">&nbsp;</div>

    <div class="blog-card__content">
        <div class="blog-card__main">
            <date class="blog-card__date"><?php echo $post_data['date']; ?></date>
            <h3 class="blog-card__title"><?php echo $post_data['title']; ?></h3>
            <p class="blog-card__excerpt"><?php echo $post_data['excerpt']; ?></p>
        </div>

        <div class="blog-card__options">
            <div class="blog-card__more more-link"><?php echo __( 'Loe rohkem', 'hiiukala-theme' ); ?><?php icon_svg('arrow-right'); ?></div>
        </div>
    </div>
</a>