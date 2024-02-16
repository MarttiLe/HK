<?php
    /* ***************************************************************************** */
    /* GROUPED EMPLOYEES BLOCK
    /* ***************************************************************************** */
    /* ACF: Block - Grouped employees
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $attributes = theme_get_block_attributes([
        'wrapper_classes'       => ''
    ], $args);


    // Get block field data
    $fields = get_field('block_employees');


    // Default output data
    $data = [
        'nav_anchor'            => $fields['nav_anchor'],
        'groups'                => $fields['groups']
    ];
?>


<section class="employees<?php echo $attributes['wrapper_classes']; ?>">
    <?php theme_get_nav_anchor($data['nav_anchor']); ?>

    <div class="container">

        <?php if (!empty($data['groups'])) : ?>
            <?php foreach ($data['groups'] as $group) : ?>

                <div class="employees__group">
                    <div class="employees__heading">
                        <h3 class="employees__group-title h4"><?php echo $group['name']; ?>:</h3>
                    </div>
                    
                    <div class="employees__people">
                        <?php if (!empty($group['items'])) : ?>
                        <ul class="employees__items">
                            <?php foreach ($group['items'] as $person) : ?>
                                <li class="employees__item">
                                    <h4 class="employees__name"><?php echo $person['name']; ?></h4>
                                    <?php if (!empty($person['role'])) : ?>
                                    <span class="employees__role"><?php echo $person['role']; ?></span>
                                    <?php endif; ?>
                                    
                                    <ul class="employees__contacts icon-list has-black-links">
                                        <?php if (!empty($person['phone'])) : ?>
                                            <li class="icon-list__item">
                                                <?php icon_svg('phone', 'icon-list__icon'); ?>
                                                <a href="tel:<?php echo theme_get_formatted_tel($person['phone']); ?>"><?php echo $person['phone']; ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($person['email'])) : ?>
                                            <li class="icon-list__item">
                                                <?php icon_svg('mail', 'icon-list__icon'); ?>
                                                <a href="mailto:<?php echo antispambot($person['email']); ?>"><?php echo antispambot($person['email']); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>

</section>