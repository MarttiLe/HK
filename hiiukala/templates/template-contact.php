<?php
    /* ***************************************************************************** */
    /* Template Name: Contact page
    /* ***************************************************************************** */
    /* Description: Template for the contact page
    /* ACF: -
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Default output data
    $data = [
        'title'             => get_the_title()
    ];


    // Get fields
    $contacts = get_field('contacts', 'options');
    $organisation = get_field('organisation', 'options');
?>

<?php 
    get_header();

    get_template_part('templates/components/page-heading', null, []);
?>

<div class="contact page-content page-content--has-sidebar">
    <div class="container">
        <div class="page-content__inner">

            <div class="page-content__main">
                <div class="page-content__heading">
                    <h1 class="page-content__title h1"><?php echo $data['title']; ?></h1>
                    <div class="page-content__breadcrumbs"><?php get_template_part('templates/components/breadcrumbs', null, []); ?></div>
                </div>

                <div class="page-content__editor contact__content has-black-links">

                    <?php if (!empty($organisation['name'])) : ?>
                    <h2 class="contact__title h3"><?php echo $organisation['name']; ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($contacts['ceo'])) : ?>
                    <strong><?php echo __('Tegevjuht', 'hiiukala-theme'); ?></strong>: <?php echo $contacts['ceo']; ?>
                    <?php endif; ?>

                    <?php if (!empty($contacts['phone'])) : ?>
                    <br><strong><?php echo __('Telefon', 'hiiukala-theme'); ?></strong>: <a href="tel:<?php echo theme_get_formatted_tel($contacts['phone']); ?>" class="contact__anchor"><?php echo $contacts['phone']; ?></a>
                    <?php endif; ?>

                    <?php if (!empty($contacts['email'])) : ?>
                    <br><strong><?php echo __('E-post', 'hiiukala-theme'); ?></strong>: <a href="mailto:<?php echo antispambot($contacts['email']); ?>" class="contact__anchor"><?php echo antispambot($contacts['email']); ?></a>
                    <?php endif; ?>

                    <div class="separator separator--sm">&nbsp;</div>

                    <?php if (!empty($contacts['address'])) : ?>
                        <br><strong><?php echo __('Aadress', 'hiiukala-theme'); ?></strong>:
                        <?php if (!empty($contacts['address_google_maps'])) : ?>
                            <a href="<?php echo $contacts['address_google_maps']; ?>" target="_blank" rel="noopener" class="contacts__anchor"><?php echo $contacts['address']; ?></a>
                            <?php else : ?>
                            <?php echo $contacts['address']; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($contacts['opening_times'])) : ?>
                    <br><strong><?php echo __('Lahtiolekuajad', 'hiiukala-theme'); ?></strong>: <?php echo $contacts['opening_times']; ?>
                    <?php endif; ?>

                    <div class="separator separator--sm">&nbsp;</div>

                    <?php if (!empty($organisation['reg_code'])) : ?>
                    <strong><?php echo __('Reg nr', 'hiiukala-theme'); ?></strong>: <?php echo $organisation['reg_code']; ?>
                    <?php endif; ?>

                    <?php if (!empty($organisation['bank_account'])) : ?>
                    <br><strong><?php echo __('Arveldusarve', 'hiiukala-theme'); ?></strong>: <?php echo $organisation['bank_account']; ?>
                    <?php endif; ?>

                    <div class="editor-content">
                        <?php the_content(); ?>
                    </div>
                    
                </div>
            </div>

            <div class="page-content__aside contact__aside">
                <div class="sidebar-map">
                    <?php get_template_part('templates/blocks/google-map', null, []); ?>
                </div>
            </div>

        </div>
    </div>

    <?php get_template_part('templates/blocks/employees', null, [
        'wrapper_classes' => 'contact__employees'
    ]); ?>

</div>

<?php get_footer(); ?>