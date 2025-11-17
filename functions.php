<?php
/**
 * Theme Functions
 * @package ZOCOBA WordPress Framework
 * @since 1.0
 */
// Direct load is not allowed
defined('ABSPATH') || exit;

// Cargar archivos separados
$includes = [
    'inc/zcb_core.php',
    'inc/zcb_assets.php',
    'inc/dokan_hooks.php',
];

foreach ($includes as $file) {
    $filepath = get_theme_file_path($file);
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        error_log("Archivo no encontrado: $filepath");
    }
}

