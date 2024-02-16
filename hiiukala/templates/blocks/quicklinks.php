<?php
    /**
     * QUICK LINKS BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_quicklinks');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }
?>


<section class="quicklinks<?php echo $block_classes; ?>">
    <?php theme_get_nav_anchor($block_data['nav_anchor']); ?>

    <div class="quicklinks__inner">
        <div class="container">
            <?php if(!empty($block_data['quick_links'])) : ?>   
                <ul class="quicklinks__items">
                    <?php foreach($block_data['quick_links'] as $quicklink) : ?>
                        <?php $link = theme_get_acf_link_data($quicklink['link']); ?>
                        <li class="quicklinks__item">
                            <a href="<?php echo $link['url']; ?>"<?php echo $link['target']; ?> class="quicklink">
                                <div class="quicklink__inner">
                                    <div class="circular-icon">
                                        <?php icon_svg($quicklink['icon'], 'quicklink__icon'); ?>
                                    </div>
                                    <h3 class="quicklink__title"><?php echo $quicklink['title']; ?></h3>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="separator separator--wave">&nbsp;</div>
            <?php endif; ?>
        </div>
    </div>
</section>