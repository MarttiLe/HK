<?php
    /* ***************************************************************************** */
    /* PAGE HEADING
    /* ***************************************************************************** */
    /* Description: Generic page heading used on most subpages
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $attributes = theme_get_block_attributes([
        'wrapper_classes'       => '',
        'container_classes'     => '',
        'title_classes'         => ''
    ], $args);


    // Get block field data
    $banners = get_field('banners', 'options');


    // Default output data
    $data = [
        'banner'                => '',
    ];
    
    // Process block data
    $page_id = get_the_ID();
    $banner_id = get_post_thumbnail_id($page_id);
    if(empty($banner_id)) {
        $banner_id = $banners['page_heading_banner'];
    }
    if (!empty($banner_id)) {
        $data['banner'] = wp_get_attachment_image_url($banner_id, 'hero-banner');
    }
?>

<div class="page-heading<?php echo $attributes['wrapper_classes']; ?>" style="background-image: url('<?php echo $data['banner']; ?>');">&nbsp;</div>