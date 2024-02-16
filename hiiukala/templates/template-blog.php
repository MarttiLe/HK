<?php
    /* ***************************************************************************** */
    /* Template Name: Blog page
    /* ***************************************************************************** */
    /* Description: Theme blog page template
    /* ACF fields: Template - Blog page
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $data = [
        'title'             => get_the_title(get_the_ID()),
        'posts'             => '',
        'posts_per_page'    => get_option('posts_per_page'),
        'paged'             => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
        'is_final_page'     => false,
        'categories'        => '',
        'blog_page_url'     => ''
    ];

    // Process data
    $data['posts'] = new WP_Query([
        'post_type'         => 'post',
        'status'            => 'publish',
        'posts_per_page'    => $data['posts_per_page'],
        'paged'             => $data['paged'],
        'order'             => 'DESC',
        'suppress_filters'  => false
    ]);

	if($data['paged'] >= $data['posts']->max_num_pages) {
		$data['is_final_page'] = true;
	}

    $data['categories'] = get_categories([
        'hide_empty'    => true,
        'order'         => 'DESC',
        'exclude'       => 1
    ]);
    $page_refs = get_field('page_refs', 'options');
    $data['blog_page_url'] = get_permalink($page_refs['blog']);
?>

<?php get_header(); ?>

<section class="blog page-content">
    <div class="container">
        <h1 class="blog__title page-content__title h1"><?php echo $data['title']; ?></h1>    

        <?php if(!empty($data['categories'])) : ?>
        <div class="blog__categories">
            <ul class="category-list">
                <li class="category-list__item">
                    <a href="<?php echo $data['blog_page_url']; ?>" class="category-list__anchor is-active" data-text="<?php echo __( 'All', 'hiiukala-theme' ); ?>"><?php echo __( 'All', 'hiiukala-theme' ); ?></a>
                </li>
                <?php foreach($data['categories'] as $category) : ?>
                <li class="category-list__item">
                    <a href="<?php echo get_term_link($category->term_id, 'category'); ?>" class="category-list__anchor" data-text="<?php echo $category->cat_name; ?>"><?php echo $category->cat_name; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="blog__categories-mobile">
            <select name="blog-categories" class="blog__category-select js-nav-select">
                <option value="<?php echo $data['blog_page_url']; ?>"><?php echo __( 'All', 'hiiukala-theme' ); ?></option>
                <?php foreach($data['categories'] as $category) : ?>
                    <option value="<?php echo get_term_link($category->term_id, 'category'); ?>"><?php echo $category->cat_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <?php if($data['posts']->have_posts()) : ?>
            <ul class="blog__items blog-list">
                <?php while($data['posts']->have_posts()) : ?>
                    <?php $data['posts']->the_post(); ?>
                        
                    <li class="blog-list__item">
                        <?php get_template_part('templates/components/card-blog'); ?>
                    </li>

                    <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
            </ul>

            <div class="blog__actions">
                <?php theme_pagination_nav($data['posts']); ?>
            </div>
        <?php else : ?>
        <div class="blog__alert"><?php echo __( 'There are currently no posts available', 'hiiukala-theme' ); ?></div>
        <?php endif; ?>

    </div>
</section>


<?php get_footer(); ?>