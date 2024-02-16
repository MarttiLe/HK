<?php
    /* ***************************************************************************** */
    /* HERO SLIDER BLOCK
    /* ***************************************************************************** */
    /* ACF: Block - Hero
    /* Requires: glide.js
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $block_attributes = theme_get_block_attributes([
        'wrapper_classes'   => ''
    ], $args);


    // Get block data
    $block_data = get_field('block_hero');


    // Process block data
    $slider_items_total = 0;
    if(!empty($block_data['slides'])) {
        $slider_items_total = count($block_data['slides']);
    }

    if($slider_items_total <= 1) {
        $block_attributes['wrapper_classes'] .= ' hero--no-slides';
    }

    $eas_vertical_logo = '';
    $eas_horizontal_logo = '';
    if(ICL_LANGUAGE_CODE === 'et') {
        $eas_vertical_logo = get_template_directory_uri() . '/assets/images/eas-et-vertical.svg';
        $eas_horizontal_logo = get_template_directory_uri() . '/assets/images/eas-et-horizontal.svg';
    } else if(ICL_LANGUAGE_CODE === 'en') {
        $eas_vertical_logo = get_template_directory_uri() . '/assets/images/eas-en-vertical.svg';
        $eas_horizontal_logo = get_template_directory_uri() . '/assets/images/eas-en-horizontal.svg';
    }else{
        $eas_vertical_logo = get_template_directory_uri() . '/assets/images/eas-et-vertical.svg';
        $eas_horizontal_logo = get_template_directory_uri() . '/assets/images/eas-et-horizontal.svg';
    }
?>


<section class="hero js-hero-carousel<?php echo $block_attributes['wrapper_classes']; ?>" data-hero-carousel-slides-total="<?php echo $slider_items_total; ?>">
    <?php theme_get_nav_anchor($block_data['nav_anchor']); ?>

    <div class="hero__container container">

        <?php if(!empty($block_data['slides'])) : ?>
            <ul class="hero__backgrounds">
                <?php foreach($block_data['slides'] as $key => $item) : ?>
                    <?php 
                        $is_active = '';
                        if($key === 0) {
                            $is_active = ' is-active';
                        }
                    ?>
                    <li class="hero__background js-hero-carousel-background<?php echo $is_active; ?>" data-hero-carousel-slide="<?php echo $key; ?>" style="background-image: url('<?php echo wp_get_attachment_image_url($item['image'], 'full-hd'); ?>');">&nbsp;</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>

    <img src="<?php echo $eas_vertical_logo; ?>" alt="<?php echo __('Project supported by EMKF RAKENDUSKAVA', 'sisiflow-theme'); ?>" class="hero__sponsor">
    <img src="<?php echo $eas_horizontal_logo; ?>" alt="<?php echo __('Project supported by EMKF RAKENDUSKAVA', 'hiiukala-theme'); ?>" class="hero__sponsor-mobile">
</section>