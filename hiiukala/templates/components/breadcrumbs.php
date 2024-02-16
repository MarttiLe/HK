<?php
    /* ***************************************************************************** */
    /* BREADCRUMBS
    /* ***************************************************************************** */
    /* Description: Generic breadcrumb component
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
        'list_classes'          => ''
    ], $args);
?>

<div class="breadcrumbs<?php echo $attributes['wrapper_classes']; ?>">
    <div class="breadcrumbs__inner">
        <?php theme_breadcrumbs_list($attributes['list_classes']); ?>
    </div>
</div>