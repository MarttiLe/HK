<?php

/* ***************************************************************************** */
/* BLOCK EDITOR (GUTENBERG) CUSTOMIZATIONS                                       */
/* ***************************************************************************** */
/* Change block editor defaults                                                  */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


// CUSTOMIZE BLOCKS AVAILABLE IN THE THEME
// Full block list can be found here: https://wordpress.org/support/article/blocks/
function theme_supported_gutenberg_blocks( $allowed_blocks, $post ) {
	$allowed_blocks = [
		// Common blocks
		'core/image',
		'core/video',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/quote',
		// Formatting blocks
		'core/table',
		'core/code',
		'core/html',
		// Layout blocks
		'core/columns',
		'core/media-text',
		'core/buttons',
		'core/separator',
		'core/spacer',
		// Widget blocks
		'core/shortcode',
		// Embeds blocks
		'core/embed',
	];

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'theme_supported_gutenberg_blocks', 10, 2 );


// ADD CUSTOM COLOR SCHEMES
add_theme_support( 'editor-color-palette', [
	[
		'name'  => __( 'Brand light', 'hiiukala-theme' ),
		'slug'  => 'brand_light',
		'color'	=> '#832B3D',
	],
	[
		'name'  => __( 'Brand dark', 'hiiukala-theme' ),
		'slug'  => 'brand_dark',
		'color'	=> '#252626',
	],
	[
		'name'	=> __( 'Brand gray light', 'hiiukala-theme' ),
		'slug'	=> 'brand_gray_light',
		'color'	=> '#CCCCCC',
	],
	[
		'name'	=> __( 'Brand gray', 'hiiukala-theme' ),
		'slug'	=> 'brand_gray',
		'color'	=> '#666666',
	],
	[
		'name'	=> __( 'Brand gray dark', 'hiiukala-theme' ),
		'slug'	=> 'brand_gray_dark',
		'color'	=> '#333333',
	]
]);


// CUSTOM THEME BLOCK CATEGORIES
function theme_block_categories( $categories, $post ) {
    if ( $post->post_type !== 'post' ) {
        return $categories;
    }
    return array_merge(
        $categories,
        [
            [
                'slug' => 'theme-blocks',
                'title' => __( 'Theme custom blocks', 'hiiukala-theme' ),
                'icon'  => 'star-filled',
            ],
		]
    );
}
//add_filter( 'block_categories', 'theme_block_categories', 10, 2 );