<?php
/**
 * Theme Functions
 * @package ZOCOBA WordPress Framework
 * @author ZOCOBA
 * @link https://zocoba.io
 * @license GPL-2.0+
 * @version 2.0
 * Updated filenames for better clarity.
 * Removed redundant comments.
 * Added error logging for missing files.
 * Updated file paths to use get_theme_file_path().
 * @modified 2024-06
 */
// Direct load is not allowed
defined('ABSPATH') || exit;

// Cargar archivos separados.
$includes = [
    'inc/config.php',     // Configuración base (antes zcb_core.php)
    'inc/assets.php',     // Carga de assets (antes zcb_assets.php)
    'inc/dokan_hooks.php', // (Sin cambios)
];

foreach ($includes as $file) {
    $filepath = get_theme_file_path($file);
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        error_log("Archivo de inclusión no encontrado: $filepath");
    }
}