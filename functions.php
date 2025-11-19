<?php
/**
 * Theme Functions
 * @package ZOCOBA WordPress Framework
 * @since 1.0
 */
defined('ABSPATH') || exit;

// Definir constantes de ruta para uso global
define('ZCB_PATH', get_stylesheet_directory());
define('ZCB_URI', get_stylesheet_directory_uri());

// Archivos a cargar (Orden estricto)
$includes = [
    'inc/config.php',      // Ajustes de WordPress y constantes
    'inc/assets.php',      // Carga de CSS y JS
    'inc/woo-hooks.php',   // Modificaciones de estructura (HTML)
];

foreach ($includes as $file) {
    $filepath = ZCB_PATH . '/' . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}