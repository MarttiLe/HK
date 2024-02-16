<?php
    /**
     * ABOUT BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_about');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>


<section class="about<?php echo $block_classes; ?>">
    <?php theme_get_nav_anchor($block_data['nav_anchor']); ?>

    <div class="container">
        <div class="section-heading section-heading--centered">
            <h2 class="about__title section-heading__title h1"><?php echo $block_data['title']; ?></h2>
        </div>

        <?php if(!empty($block_data['achievements'])) : ?>
        <ul class="about__items">
            <?php foreach($block_data['achievements'] as $key => $achievement) : ?>
            <?php $delay = 500 + $key * 500; ?>
            <li class="about__item">
                <div class="achievement">
                    <div class="circular-icon">
                        <?php icon_svg($achievement['icon']); ?>
                    </div>
                    <h3 class="achievement__text">
                        <span id="odometer-<?php echo $key; ?>" class="achievement__number h1 odometer">0</span>
                        <span class="achievement__title"><?php echo $achievement['title']; ?></span>
                    </h3>
                </div>

                <script>
                    setTimeout(function(){
                        odometer = document.querySelector('#odometer-<?php echo $key; ?>');
                        odometer.innerHTML = <?php echo $achievement['number'] ?>;
                    }, <?php echo $delay; ?>);
                </script>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <div class="about__content">
            <?php if(!empty($block_data['content_left'])) : ?>
            <div class="about__content-left editor-content">
                <?php echo $block_data['content_left']; ?>
            </div>
            <?php endif; ?>

            <?php if(!empty($block_data['content_right'])) : ?>
            <div class="about__content-right">
                <?php echo $block_data['content_right']; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if(!empty($block_data['image_gallery_slider'])) : ?>
        <div class="about__gallery">
            <?php
                $block_attr = [
                    'items' => $block_data['image_gallery_slider']
                ];
                get_template_part('templates/components/image-slider', null, $block_attr);
            ?>
        </div>
        <?php endif; ?>
    </div>
</section>