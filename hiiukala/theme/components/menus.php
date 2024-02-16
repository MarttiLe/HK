<?php

/* ***************************************************************************** */
/* THEME CUSTOM MENUS                                                            */
/* ***************************************************************************** */
/* Define all menus used by the theme here                                       */
/* All items should end with the suffix "-nav"                                   */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


function theme_custom_menus() {
	register_nav_menus([
        'primary-nav-left'  => __( 'Main navigation (Left)', 'hiiukala-theme' ),
        'primary-nav-right' => __( 'Main navigation (Right)', 'hiiukala-theme' ),
        'language-nav'      => __( 'Language navigation', 'hiiukala-theme')
    ]);
}
add_action( 'init', 'theme_custom_menus' );

?>