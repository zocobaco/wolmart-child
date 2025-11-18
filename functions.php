<?php
/**
 * Theme Functions
 * @package ZOCOBA WordPress Framework
 * @since 1.0
 */
defined('ABSPATH') || exit;

// Cargar archivos separados con nombres semánticos
$includes = [
    'inc/config.php',             // Configuración base y constantes (antes zcb_core.php)
    'inc/assets.php',             // Manejador de carga de CSS/JS (antes zcb_assets.php)
    'inc/woo-hooks.php',  // ¡NUEVO! Personalizaciones de Hooks
    // 'inc/dokan_hooks.php',     // (Si tienes este archivo, puedes mover su contenido a woocommerce-hooks.php y borrarlo)
];

foreach ($includes as $file) {
    $filepath = get_theme_file_path($file);
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        error_log("Archivo de inclusión no encontrado: $filepath");
    }
}