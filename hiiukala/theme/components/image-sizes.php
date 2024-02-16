<?php

/* ***************************************************************************** */
/* THEME CUSTOM IMAGE SIZES                                                      */
/* ***************************************************************************** */
/* Define all image sizes used by the theme here                                 */
/* Avoid creating unnecessary image sizes to save server space                   */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


// DEFINE CUSTOM IMAGE SIZES
function theme_custom_image_sizes() {
    add_image_size( 'hero-banner', 1920, 600, true );
    add_image_size( 'blog-thumb', 640, 480, true);
    add_image_size( 'gallery-thumb', 360, 360, true);
    add_image_size( '720p', 1280, 720, true);
}
add_action( 'after_setup_theme', 'theme_custom_image_sizes' );


// ADD SPECIFIC CUSTOM IMAGE SIZES TO WP MEDIA EDITOR
function theme_custom_media_image_sizes( $sizes ) {
    $add_sizes = [
        //'sample-size' => __('Sample size', 'hiiukala-theme'),
    ];

    $newsizes = array_merge( $sizes, $add_sizes );
    return $newsizes;
}
//add_filter( 'image_size_names_choose', 'theme_custom_media_image_sizes' );

?>