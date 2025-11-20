<?php
namespace Zocoba\inc;

defined( 'ABSPATH' ) || exit;

class Setup {

    public function __construct() {
        add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
        add_action( 'init', [ $this, 'security_headers' ] );
    }

    /**
     * Configuración básica del tema
     */
    public function theme_setup() {
        // Optimización: Soporte para imágenes WebP
        add_filter( 'file_is_displayable_image', function ( $result, $path ) {
            if ( $result === true ) return true;
            if ( ! file_exists( $path ) || ! is_readable( $path ) ) return false;
            $info = @getimagesize( $path );
            return $info !== false && $info[2] === IMAGETYPE_WEBP;
        }, 10, 2 );
    }

    /**
     * Mejoras de Seguridad y Limpieza
     */
    public function security_headers() {
        // Eliminar versión de WP del código fuente (Seguridad por oscuridad básica)
        remove_action( 'wp_head', 'wp_generator' );
        
        // Eliminar Emojis de WP (Mejora de Velocidad)
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
    }
}