<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    
    wp_enqueue_style(
        'zcb-variables',
        ZCB_ASSETS_URI . '/css/base/variables.css',
        [],
        filemtime(ZCB_PATH . '/assets/base/css/variables.css')
    );
    wp_enqueue_style(
        'zcb-utilities',
        ZCB_ASSETS_URI . '/css/base/utilities.css',
        [],
        filemtime(ZCB_PATH . '/assets/base/css/utilities.css')
    );
    wp_enqueue_style(
        'wolmart-theme-child', 
        get_stylesheet_directory_uri() . '/style.css', 
        ['wolmart-theme'], 
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    wp_enqueue_style('zcb-shop', ZCB_CSS_URI . '/woo/new_shop.css', [], '1.0');
    wp_enqueue_style('zcb-checkout', ZCB_CSS_URI . '/woo/new_checkout.css', [], '2.0');
    wp_enqueue_style('zcb-fontawesome', ZCB_ASSETS_URI . '/fontawesone/css/all.min.css', [], '6.4.0');
    
    //Estilos condicionales
    if (is_shop() || is_product_category() || is_product() || is_product_tag()) {
        wp_enqueue_style('zcb-shop', ZCB_CSS_URI . '/woo/new_shop.css', [], '1.0');
    }
    if (is_product() ){
       wp_enqueue_style('zcb-product', ZCB_CSS_URI . '/woo/new_product.css', [], '1.0');
    }
}, 9999);