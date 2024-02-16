<?php
    /**
     * SOCIALS ACTIVITY BLOCK
     * @param block_classes string (optional) - pass additional classes for the section element
    **/


    // Get block data
    $block_data = get_field('block_socials_activity');

    $block_classes = '';
    if(!empty($args['block_classes'])) {
        $block_classes = ' ' . $args['block_classes'];
    }

    $link = theme_get_acf_link_data($block_data['more_link']);
?>


<section class="socials-activity<?php echo $block_classes; ?>">
    <?php theme_get_nav_anchor($block_data['nav_anchor']); ?>

    <div class="container">
        <div class="section-heading section-heading--centered">
            <h2 class="socials-activity__title section-heading__title h1"><?php echo $block_data['title']; ?></h2>
        </div>

        <div class="socials-activity__inner">
            <?php if (!empty($block_data['shortcode'])) : ?>
                <?php echo do_shortcode($block_data['shortcode']); ?>
            <?php endif; ?>
        </div>

        <?php if(!empty($link)) : ?>
        <div class="socials-activity__options section-options has-white-links">
            <div class="section-options__item"><a href="<?php echo $link['url']; ?>" class="section-options__anchor"<?php echo $link['target']; ?>><?php echo $link['text']; ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>