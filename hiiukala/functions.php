<?php

// LOAD THEME
require_once( 'theme/theme.php' );

// INITIALIZE THEME
if(function_exists( 'theme_init')) {
	add_action( 'after_setup_theme', 'theme_init' );
}

/* ***************************************************************************** */
/* THEME CUSTOM FUNCTIONS                                                        */
/* ***************************************************************************** */


// MODIFY ACF ICON PLUGIN PATH
function theme_acf_icon_path_suffix( $path_suffix ) {
    return 'assets/icons/';
}
add_filter( 'acf_icon_path_suffix', 'theme_acf_icon_path_suffix' );


function theme_get_month_name($number) {
    switch($number) {
        case 1:
            return __('January', 'hiiukala-theme');
        case 2:
            return __('February', 'hiiukala-theme');
        case 3:
            return __('March', 'hiiukala-theme');
        case 4:
            return __('April', 'hiiukala-theme');
        case 5:
            return __('May', 'hiiukala-theme');
        case 6:
            return __('June', 'hiiukala-theme');
        case 7:
            return __('July', 'hiiukala-theme');
        case 8:
            return __('August', 'hiiukala-theme');
        case 9:
            return __('September', 'hiiukala-theme');
        case 10:
            return __('October', 'hiiukala-theme');
        case 11:
            return __('November', 'hiiukala-theme');
        case 12:
            return __('December', 'hiiukala-theme');
        default: 
            return;    
    }
}


?>