<?php
    /* ***************************************************************************** */
    /* SEARCH
    /* ***************************************************************************** */
    /* Description: Default Wordpress search page, there is an automatic redirect
    /*              in theme config, disable it to use this page
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $data = [
        'title'             => __('Search', 'hiiukala-theme'),
        'query'             => get_search_query(),
        'results'           => ''
    ];


    // Process data
    if (!empty($data['query'])) {
        $data['results'] = new WP_Query([
            'post_type'         => ['post', 'page', 'event'],
            'posts_per_page'    => -1,
            'status'            => 'publish',
            's'                 => $data['query'],
            'order'             => 'DESC',
            'suppress_filters'  => false
        ]);
        $data['results'] = $data['results']->posts;
        if (count($data['results']) === 0) {
            $data['results'] = '';
        }
    }
?>

<?php get_header(); ?>

<section class="search-results page-content">
    <div class="container container--sm">
        <div class="search-results__form">
            <?php 
                echo get_template_part('templates/components/searchform', null, [
                    'wrapper_classes'   => 'search-form--lg',
                    'entry'             => $data['query']
                ]); 
            ?>
        </div>

        <?php if (empty($data['query'])) : ?>
        <p class="search-results__error alert-message is-active"><?php echo __('Enter your search above. Results will be displayed here.', 'hiiukala-theme'); ?></p>
        <?php endif; ?>

        <?php if (!empty($data['query']) && empty($data['results'])) : ?>
        <p class="search-results__error alert-message alert-message--negative is-active"><?php echo __('Unfortunately there were no matches to that query. Please try a different keyword.', 'hiiukala-theme'); ?></p>
        <?php endif; ?>

        <?php if (!empty($data['results'])) : ?>
        <p class="search-results__title"><?php echo __('Your results...', 'hiiukala-theme'); ?></p>
        <ul class="search-results__items">
            <?php foreach($data['results'] as $result) : ?>
            <li class="search-results__item">
                <?php 
                    echo get_template_part('templates/components/card-search', null, [
                        'post'             => $result
                    ]); 
                ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>