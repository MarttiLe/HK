<?php
    /**
     * IMAGE SLIDER COMPONENT
     * Requires glide.js
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get component data
    if(!empty($args['items'])) {
        $block_data = $args['items'];
    } else {
        $block_data = get_field('image_gallery_slider');
    }  

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>

<?php if(!empty($block_data['items'])) : ?>
<div class="image-gallery image-gallery-slider slider js-image-gallery-slider<?php echo $block_classes; ?>">
    <div class="slider__track" data-glide-el="track">
        <ul class="image-gallery__items slider__items">
            <?php foreach($block_data['items'] as $gallery_item) : ?>
            <li class="image-gallery__item slider__item">
                <a href="<?php echo wp_get_attachment_image_url($gallery_item['image'], '720p'); ?>" class="image-gallery__anchor" data-fancybox="image-gallery">
                    <?php echo theme_get_wp_image($gallery_item['image'], 'gallery-thumb', 'image-gallery__img', __( 'Gallery image', 'hiiukala-theme' )); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="image-gallery-slider__arrows slider-controls" data-glide-el="controls" data-sal="slide-up">
        <button class="image-gallery-slider__arrow slider-controls__arrow slider-controls__arrow--prev js-months-slider-prev" data-glide-dir="<" title="<?php echo __( 'Previous slide', 'hiiukala-theme' ); ?>"><?php icon_svg('arrow-right', 'slider-controls__icon'); ?></button>
        <button class="image-gallery-slider__arrow slider-controls__arrow slider-controls__arrow--next js-months-slider-next" data-glide-dir=">" title="<?php echo __( 'Next slide', 'hiiukala-theme' ); ?>"><?php icon_svg('arrow-right', 'slider-controls__icon'); ?></button>
    </div>
</div>
<?php endif; ?>