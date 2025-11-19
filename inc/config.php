<?php
defined('ABSPATH') || exit;

// Permitir subida de imágenes WebP (Vital para velocidad tipo Amazon)
add_filter('file_is_displayable_image', function ($result, $path) {
    if ($result === true) return true;
    if (!file_exists($path) || !is_readable($path)) return false;
    $info = @getimagesize($path);
    return $info !== false && $info[2] === IMAGETYPE_WEBP;
}, 10, 2);

// Desactivar emojis de WP (Carga innecesaria en un e-commerce)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');