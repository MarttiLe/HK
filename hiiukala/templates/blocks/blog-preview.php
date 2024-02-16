<?php
    /**
     * BLOG PREVIEW BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block attributes
    $block_attributes = theme_get_block_attributes([
        'wrapper_classes'   => ''
    ], $args);


    // Get block data
    $block_data = get_field('block_blog_preview');


    // Process block data
    if($block_data['select_posts_manually']) {
        $blog_items = new WP_Query([
            'post__in'          => $block_data['posts'],
            'post_type'         => 'advice',
            'status'            => 'publish',
            'suppress_filters'  => false
        ]);
        $blog_items->posts = array_slice($blog_items->posts, 0, 3);
    } else {
        $post_amount = 3;
        if(!empty($block_data['amount_of_posts'])) {
            $post_amount = $block_data['amount_of_posts'];
        }

        $blog_items = new WP_Query([
            'post_type'         => 'post',
            'status'            => 'publish',
            'posts_per_page'    => $post_amount,
            'post__not_in'      => [$block_data['highlighted_post']],
            'suppress_filters'  => false
        ]);
        if(!empty($blog_items)) {
            $blog_items = $blog_items->posts;
        }   
    }

    $page_refs = get_field('page_refs', 'options');
?>


<section class="blog-preview<?php echo $block_attributes['wrapper_classes']; ?>">
    <?php theme_get_nav_anchor($block_data['nav_anchor']); ?>

    <div class="container">
        <div class="section-heading section-heading--has-options">
            <h2 class="blog-preview__title section-heading__title h1"><?php echo $block_data['title']; ?></h2>
            
            <div class="section-heading__options">
                <a href="<?php echo get_permalink($page_refs['blog']); ?>" class="section-heading__more"><?php echo __( 'Uudiste arhiiv', 'hiiukala-theme' ); ?></a>
            </div>
        </div>

        <div class="blog-preview__inner">
            <?php if(!empty($blog_items)) : ?>
            <div class="blog-preview__main">
                <?php
                    $block_attr = [
                        'post_id'  => $block_data['highlighted_post'],
                        'classes'  => 'blog-card--size-lg'
                    ];
                    get_template_part('templates/components/card-blog', null, $block_attr); 
                ?>
            </div>

            <div class="blog-preview__aside">
                <ul class="blog-preview__items blog-list">
                    <?php foreach($blog_items as $blog_item) : ?>
                        <li class="blog-list__item">
                            <?php
                                $block_attr = [
                                    'post_id'  => $blog_item->ID
                                ];
                                get_template_part('templates/components/card-blog', null, $block_attr);
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php else : ?>
                <div class="blog-preview__alert alert-bar alert-bar--white is-active"><p class="alert-bar__text"><?php echo __( 'There are currently no posts available', 'hiiukala-theme' ); ?></p></div>
            <?php endif; ?>
        </div>
    </div>
</section>