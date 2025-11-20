<?php
namespace Zocoba\inc;

defined( 'ABSPATH' ) || exit;

class Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 9999 ); // Prioridad alta
    }

    public function enqueue_styles() {
        // 1. Cargar Tema Padre
        wp_enqueue_style( 'wolmart-theme' );

        // 2. Iconos Profesionales (FontAwesome 6)
        wp_enqueue_style( 
            'zcb-icons', 
            ZCB_URI . '/assets/fontawesone/css/all.min.css', 
            [], 
            '6.4.0' 
        );

        // 3. Estilos Compilados (Unificados)
        // Cargamos el archivo generado por SCSS
        $main_css_path = '/assets/css/style.css';
        
        if ( file_exists( ZCB_PATH . $main_css_path ) ) {
            wp_enqueue_style(
                'zcb-main',
                ZCB_URI . $main_css_path,
                [ 'wolmart-theme', 'elementor-frontend' ], // Carga después de Elementor
                filemtime( ZCB_PATH . $main_css_path ) // Cache busting automático
            );
        }

        // 4. Carga Condicional para WooCommerce (Velocidad)
        if ( class_exists( 'WooCommerce' ) && $this->is_woocommerce_page() ) {
            $woo_css_path = '/assets/css/woo-commerce.css';
            
            if ( file_exists( ZCB_PATH . $woo_css_path ) ) {
                wp_enqueue_style(
                    'zcb-woo',
                    ZCB_URI . $woo_css_path,
                    [ 'zcb-main' ],
                    filemtime( ZCB_PATH . $woo_css_path )
                );
            }
        }
    }

    /**
     * Helper para detectar páginas de tienda
     */
    private function is_woocommerce_page() {
        return is_shop() || is_product() || is_product_category() || is_cart() || is_checkout();
    }
}