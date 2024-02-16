<?php
    /* ***************************************************************************** */
    /* SIDEBAR NAV
    /* ***************************************************************************** */
    /* Description: Navigation sidebar for generic pages
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: This component supports 1 level of depth
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $attributes = theme_get_block_attributes([
        'wrapper_classes'       => '',
        'wp_menu'               => '',
        'page_id'               => '',
        'parent_id'             => '',
        'title'                 => ''
    ], $args);


    // Default output data
    $data = [
        'is_wp_menu'            => false,
        'page_id'               => get_the_ID(),
        'parent_id'             => '',
        'title'                 => __( 'Pages', 'hiiukala-theme' ),
        'items'                 => '',
        'wp_menu_location'      => ''
    ];
    

    // Process block data
    if (!empty($attributes['wp_menu'])) {

        // WP menu mode
        $data['is_wp_menu'] = true;
        $data['wp_menu_location'] = $attributes['wp_menu'];

    } else {

        // Automatic page children mode
        if (!empty($attributes['page_id'])) {
            $data['page_id'] = $attributes['page_id'];
        }
    
        if (!empty($attributes['parent_id'])) {
            $data['parent_id'] = $attributes['parent_id'];
        } else {
            global $post;
            $data['parent_id'] = $post->post_parent;
            if (empty($data['parent_id'])) {
                $has_children = get_children([
                    'post_parent'   => $data['page_id'],
                    'fields'        => 'ids'
                ]);
                if (!empty($has_children)) {
                    $data['parent_id'] = $data['page_id'];
                }
            }
        }
        if (empty($data['parent_id'])) {
            return;
        }

        $data['items'] = get_posts([
            'numberposts'       => -1,
            'post_parent'       => $data['parent_id'],
            'post_type'         => 'page',
            'suppress_filters'  => false,
        ]);

    }

    if (!empty($attributes['title'])) {
        $data['title'] = $attributes['title'];
    } else {
        $data['title'] = get_the_title($data['parent_id']);
    }
?>

<nav class="sidebar-nav<?php echo $attributes['wrapper_classes']; ?>">
    <h3 class="sidebar-nav__title h3"><?php echo $data['title']; ?></h3>

    <?php if($data['is_wp_menu']) : ?>

        <?php
            wp_nav_menu([
                'container'         => false,
                'menu_class'        => 'sidebar-nav__items menu',
                'theme_location'    => $data['wp_menu_location'],
                'depth'             => 1
            ]);
        ?>

    <?php else : ?>

        <ul class="sidebar-nav__items">
            <?php foreach($data['items'] as $item) : ?>
                <?php
                    $item_classes = '';
                    if ($item->ID === $data['page_id']) {
                        $item_classes = ' is-active';
                    }
                ?>

                <li class="sidebar-nav__item<?php echo $item_classes; ?>">
                    <a href="<?php echo get_permalink($item->ID); ?>" class="sidebar-nav__anchor"><?php echo $item->post_title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

</nav>