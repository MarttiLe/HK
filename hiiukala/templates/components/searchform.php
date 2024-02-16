<?php
    /* ***************************************************************************** */
    /* SEARCH FORM
    /* ***************************************************************************** */
    /* Description: Default search form component
    /* ACF fields: -
    /* Dependencies: -
    /* Usage notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $block_attributes = theme_get_block_attributes([
        'wrapper_classes'   => '',
        'entry'             => ''
    ], $args);


    // Default output data
    $data = [
        'entry'             => ''
    ];


    // Process block data
    if (!empty($block_attributes['entry'])) {
        $data['entry'] = $block_attributes['entry'];
    }
?>

<form role="search" method="get" id="search-form" class="search-form<?php echo $block_attributes['wrapper_classes']; ?>" action="<?php echo home_url( '/' ); ?>">

    <div class="text-field">
        <input class="text-field__input search-form__input" type="search" id="s" name="s" value="<?php echo $data['entry']; ?>" placeholder="<?php echo __('Otsing...', 'hiiukala-theme'); ?>">
        <label for="s" class="text-field__placeholder search-form__label"><?php echo __('Otsing...', 'hiiukala-theme'); ?></label>
        <button type="submit" id="search-submit" class="search-form__submit" title="<?php echo __('Submit search', 'hiiukala-theme'); ?>"><?php icon_svg('search'); ?></button>
    </div>

</form>