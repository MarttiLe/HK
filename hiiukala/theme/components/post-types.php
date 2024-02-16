<?php

/* ***************************************************************************** */
/* THEME CUSTOM POST TYPES                                                       */
/* ***************************************************************************** */
/* Define all custom post types, taxonomies & statuses here                      */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


// CUSTOM POST TYPES
function theme_custom_post_types() {

    // Event post type
    register_post_type('event', [
        'labels' => [
            'name' => __('Events', 'hiiukala-theme'),
            'singular_name' => __('Event', 'hiiukala-theme'),
            'all_items' => __('All events', 'hiiukala-theme'),
            'add_new' => __('Add new', 'hiiukala-theme'),
            'add_new_item' => __('Add event', 'hiiukala-theme'),
            'edit' => __('Edit', 'hiiukala-theme'),
            'edit_item' => __('Edit event', 'hiiukala-theme'),
            'new_item' => __('New event', 'hiiukala-theme'),
            'view_item' => __('View event', 'hiiukala-theme'),
            'search_items' => __('Search for events', 'hiiukala-theme'),
            'not_found' => __('No events found', 'hiiukala-theme'),
            'not_found_in_trash' => __('Trash is empty', 'hiiukala-theme'),
            'parent_item_colon' => ''
        ],
        'description' => __('Events post type', 'hiiukala-theme'),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-post',
        'has_archive' => true,
        'rewrite' => [
            'slug' => 'event',
            'with_front' => false
        ],
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_rest' => true,
        'supports' => [
            'title',
            'editor',
            'thumbnail'
        ],
        'taxonomies' => ['event_cat'],
    ]);

}
add_action('init', 'theme_custom_post_types');


// CUSTOM TAXONOMIES
function theme_custom_taxonomies() {

    // Event categories taxonomy
	register_taxonomy( 'event_cat', 'event', [
		'hierarchical'          => true,
		'labels'                => [
            'name'              => _x( 'Categories', 'taxonomy general name', 'hiiukala-theme' ),
            'singular_name'     => _x( 'Category', 'taxonomy singular name', 'hiiukala-theme' ),
            'search_items'      => __( 'Search categories', 'hiiukala-theme' ),
            'all_items'         => __( 'All categories', 'hiiukala-theme' ),
            'parent_item'       => __( 'Parent category', 'hiiukala-theme' ),
            'parent_item_colon' => __( 'Parent category:', 'hiiukala-theme' ),
            'edit_item'         => __( 'Edit category', 'hiiukala-theme' ),
            'update_item'       => __( 'Update category', 'hiiukala-theme' ),
            'add_new_item'      => __( 'Add new category', 'hiiukala-theme' ),
            'new_item_name'     => __( 'New category name', 'hiiukala-theme' ),
            'menu_name'         => __( 'Categories', 'hiiukala-theme' ),
        ],
        'show_in_rest'          => true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => [
            'slug' => 'events'
        ]
    ]);

}
add_action('init', 'theme_custom_taxonomies');


// CUSTOM POST STATUSES
function theme_custom_post_statuses() {

    register_post_status('inactive', [
        'label' => __('Inactive', 'hiiukala-theme'),
        'post_type' => ['item'],
        'public' => true,
        'exclude_from_search' => true,
        'show_in_admin_all_list' => true,
        'show_in_admin_status_list' => true,
        'label_count' => _n_noop('Inactive <span class="count">(%s)</span>', 'Inactive <span class="count">(%s)</span>', 'hiiukala-theme'),
    ]);

}
//add_action('init', 'theme_custom_post_statuses');


?>