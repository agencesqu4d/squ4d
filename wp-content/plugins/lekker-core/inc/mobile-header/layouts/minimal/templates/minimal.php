<div class="qodef-page-mobile-header-logo-opener">
    <?php
    // Include mobile logo
    lekker_core_get_mobile_header_logo_image();
    
    // Include mobile widget area one
    if ( is_active_sidebar( 'qodef-mobile-header-widget-area' ) ) { ?>
        <div class="qodef-widget-holder">
            <?php dynamic_sidebar( 'qodef-mobile-header-widget-area' ); ?>
        </div>
    <?php } ?>
    
    <?php lekker_core_get_opener_icon_html( array(
        'option_name'  => 'fullscreen_menu',
        'custom_class' => 'qodef-fullscreen-menu-opener'
    ), true ); ?>
</div>
