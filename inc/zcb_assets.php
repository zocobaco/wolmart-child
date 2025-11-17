// Código Nuevo para zocobaco/wolmart-child/wolmart-child-7be202306e65b21a8edac6c17373832f258f9138/inc/assets.php
<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    
    // 1. Base CSS: Variables y Utilidades (Carga siempre)
    // Se agregan las dependencias para que style.css y otros archivos dependan de estos.
    wp_enqueue_style(
        'zcb-variables',
        ZCB_ASSETS_URI . '/css/base/variables.css',
        [],
        filemtime(ZCB_PATH . '/assets/css/base/variables.css')
    );
    wp_enqueue_style(
        'zcb-utilities',
        ZCB_ASSETS_URI . '/css/base/utilities.css',
        [],
        filemtime(ZCB_PATH . '/assets/css/base/utilities.css')
    );

    // 2. Estilos del Tema Hijo (Solo metadatos)
    wp_enqueue_style(
        'wolmart-theme-child', 
        get_stylesheet_directory_uri() . '/style.css', 
        ['wolmart-theme', 'zcb-variables', 'zcb-utilities'], 
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    // 3. Font Awesome
    wp_enqueue_style('zcb-fontawesome', ZCB_ASSETS_URI . '/fontawesone/css/all.min.css', [], '6.4.0');

    // 4. Estilos modulares personalizados (Carga siempre, con dependencia de wolmart-theme-child)
    // Asumiendo que los archivos del paso 2 están en assets/css/custom/
    wp_enqueue_style('zcb-layout', ZCB_CSS_URI . '/custom/layout.css', ['wolmart-theme-child'], '1.0');
    wp_enqueue_style('zcb-header', ZCB_CSS_URI . '/custom/header.css', ['wolmart-theme-child'], '1.0');
    wp_enqueue_style('zcb-sidebar', ZCB_CSS_URI . '/custom/sidebar.css', ['wolmart-theme-child'], '1.0');
    wp_enqueue_style('zcb-misc', ZCB_CSS_URI . '/custom/misc.css', ['wolmart-theme-child'], '1.0');

    // 5. Estilos condicionales de WooCommerce (Para optimizar la carga)
    if (class_exists('WooCommerce')) {
        // Estilos para archivo de tienda/categoría
        if (is_shop() || is_product_category() || is_product_tag()) {
            wp_enqueue_style('zcb-shop', ZCB_CSS_URI . '/woo/new_shop.css', ['wolmart-theme-child'], '1.0');
        }
        // Estilos para página de producto individual
        if (is_product() ){
           wp_enqueue_style('zcb-product', ZCB_CSS_URI . '/woo/new_product.css', ['wolmart-theme-child'], '1.0');
        }
        // Estilos para páginas de checkout, carrito y cuenta
        if (is_checkout() || is_cart() || is_account_page()){
             wp_enqueue_style('zcb-checkout', ZCB_CSS_URI . '/woo/new_checkout.css', ['wolmart-theme-child'], '2.0');
        }
    }
}, 9999);