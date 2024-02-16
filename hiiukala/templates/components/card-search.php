<?php
    /* ***************************************************************************** */
    /* SEARCH CARD
    /* ***************************************************************************** */
    /* Description: Singular search result item
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $attributes = theme_get_block_attributes([
        'wrapper_classes'       => '',
        'post'                  => ''  
    ], $args);


    // Default output data
    $data = [
        'post'                  => '',
        'post_type'             => '',
        'title'                 => '',
        'excerpt'               => '',
        'url'                   => ''
    ];

    
    // Process block data
    if (empty($attributes['post'])) {
        global $post;
        $data['title'] = get_the_title($post->ID);
        $data['excerpt'] = theme_get_excerpt($post->ID, 300);
        $data['url'] = get_permalink($post->ID);
        $data['post_type'] = get_post_type($post->ID);

    } else {
        $data['post'] = $attributes['post'];
        $data['title'] = get_the_title($data['post']->ID);
        $data['excerpt'] = theme_get_excerpt($data['post']->ID, 300);
        $data['url'] = get_permalink($data['post']->ID);
        $data['post_type'] = get_post_type($data['post']->ID);
    }

    switch($data['post_type']) {
        case 'post' :
            $data['post_type'] = __('Blogi', 'hiiukala-theme');
            break;
        case 'page' : 
            $data['post_type'] = __('Lehekülg', 'hiiukala-theme');
            break;
        case 'event' : 
            $data['post_type'] = __('Sündmus', 'hiiukala-theme');
            break;
    }
?>

<div class="search-card">
    <div class="search-card__inner">
        <p class="search-card__type"><?php echo $data['post_type']; ?></p>

        <h2 class="search-card__title"><a href="<?php echo $data['url']; ?>" class="search-card__anchor"><?php echo $data['title']; ?></a></h2>
        
        <?php if(!empty($data['excerpt'])) : ?>
        <p class="search-card__excerpt"><?php echo $data['excerpt']; ?></p>
        <?php endif; ?>

        <div class="search-card__actions">
            <a href="<?php echo $data['url']; ?>" class="search-card__button button button--color-secondary button--icon-only" title="<?php echo __( 'Loe rohkem', 'hiiukala-theme' ); ?>"><?php icon_svg('arrow-right'); ?></a>
        </div>
    </div>
</div>